<?php
namespace NotifySlack;

class Events implements EventsInterface {

    private $settings;
    private $events = [];

    public function __construct ( SettingsInterface $settings ) {
        $this->settings = $settings;
    }

    public function register( string $name, EventInterface $event ) : Event {
        return $this->events[$name] = $event;
    }

    public function invoke_events() {
        foreach( $this->events as $k => $event ) {
            $event->is_enabled() && $event->add_hook();
        }
    }

}