<?php
namespace NotifySlack;

interface EventsInterface {
    public function register( string $name, EventInterface $event ) : Event;
}