<?php
/**
 * Plugin Name:       Slack Notify
 * Description:       Sends WordPress events to a Slack channel
 * Version:           1.0.0
 * Author:            Brian Fegter
 * Author URI:        https://coderrr.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */
namespace NotifySlack;

spl_autoload_register( function ( $class ) {
    if ( strpos( $class, __NAMESPACE__ ) === false ) {
        return false;
    }
    $class = str_replace( '\\', '/', ( explode( __NAMESPACE__ . '\\', $class ) ) [1] );

    if ( ! class_exists( $class ) ) {
        $path = plugin_dir_path( __FILE__ ) . 'src/' . $class . '.php';

        if ( file_exists( $path ) ) {
            require $path;
        }
    }
} );

$settings = new Settings;
new AdminUI( $settings );
$slack_client = new SlackClient( $settings );
$events = new Events( $settings );
$user_login = new Events\UserLoginEvent( $settings, $slack_client );
$events->register( 'user_login', $user_login );
$events->invoke_events();