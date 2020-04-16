<?php
namespace NotifySlack;

interface SlackClientInterface {
    function send_notification( string $message );
}