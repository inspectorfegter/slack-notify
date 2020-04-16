<?php
namespace NotifySlack\Events;
use WP_User;
use NotifySlack\Event;
use NotifySlack\EventInterface;

class UserLoginEvent extends Event implements EventInterface {

    function add_hook() : void {
        add_action( 'wp_login', [ $this, 'callback' ], 10, 2 );
    }
    
    public function callback( $username, WP_User $user ) {
        $this->send_notification( "$user->user_email logged in" );
    }

}