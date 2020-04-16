<?php
namespace NotifySlack;

class SlackClient implements SlackClientInterface {
    
    public function __construct( Settings $settings ) {
        $this->settings = $settings->get_slack_settings();
    }

    public function send_notification( string $message ) : bool {

        if ( ! $this->verify_settings() ) {
            return false;
        }

        $data = [ 'text' => $message ];
        $response = wp_remote_post( 'https://slack.com/api/chat.postMessage', [
            'blocking' => $this->settings['debug'],
            'headers' => [
                'Authorization' => "Bearer {$this->settings['token']}",
                'Content-type' => 'application/json; charset=utf-8'
            ],
            'body' => json_encode( [
                'text' => $message,
                'channel' => '#' . str_replace( '#', '', $this->settings['channel'] )
            ] )
        ] );

        if ( $this->settings['debug'] ) {
            wp_die( '<pre><h1>Notify Slack Debug</h1>' . print_r( json_decode( wp_remote_retrieve_body( $response ) ), true ) . '</pre>' ); 
        }
        return true;
    }

    protected function verify_settings() : bool {
        return $this->settings['token'] && $this->settings['channel'];
    }
}