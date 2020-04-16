<?php
namespace NotifySlack;

interface EventInterface {
    function add_hook() : void;
    function is_enabled() : bool;
}