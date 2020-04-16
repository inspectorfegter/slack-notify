<?php
namespace NotifySlack;

class AdminUI {

    public function __construct( SettingsInterface $settings ) {
        add_action( 'admin_menu', [ $this, 'register_options_page' ] );
    }

    public function register_options_page() {
        add_options_page( 'Notify Slack', 'Notify Slack', 'manage_options', 'notifyslack', [ $this, 'render_options_page' ] );
    }

    public function render_options_page() {
        echo 'Options Page';
    }

}