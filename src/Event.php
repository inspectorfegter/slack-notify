<?php
namespace NotifySlack;

class Event {

    private $settings;

    public function __construct( Settings $settings, SlackClientInterface $slack_client ) {
        $this->settings = $settings;
        $this->slack_client = $slack_client;
    }
    
    public function is_enabled() : bool {
        return true;
    }

    protected function send_notification( string $message ) {
        $this->slack_client->send_notification( $message );
    }
}