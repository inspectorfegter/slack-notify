<?php
namespace NotifySlack;

interface SettingsInterface {
    public function get_slack_settings() : array;
    public function get_plugin_info() : array;
}