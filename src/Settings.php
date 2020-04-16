<?php
namespace NotifySlack;

class Settings implements SettingsInterface {

    protected $settings;

    protected $option_key = 'notify_slack';

    public function __construct() {
        $this->plugin_url = plugins_url( '/', __FILE__ );
        $this->plugin_path = plugin_dir_path( __FILE__ );
        $this->settings = $this->collate_settings();
    }

    public function get_slack_settings () : array {
        return $this->settings;
    }

    public function get_plugin_info () : array {
        return [
            'url' => $this->plugin_url,
            'path' => $this->plugin_path
        ];
    }

    protected function collate_settings() : array {
        return array_merge(
            $this->get_hardcoded_settings(),
            $this->get_stored_settings()
        );
    }

    protected function get_stored_settings() : array {
        return get_option( $this->option_key, [] );
    }


    protected function get_hardcoded_settings() : array {
        return [
            'channel' => defined( 'NOTIFY_SLACK_CHANNEL' ) ? NOTIFY_SLACK_CHANNEL : false,
            'token' => defined( 'NOTIFY_SLACK_TOKEN' ) ? NOTIFY_SLACK_TOKEN : false,
            'debug' => defined( 'NOTIFY_SLACK_DEBUG' ) ? NOTIFY_SLACK_DEBUG : false
        ];
    }
}