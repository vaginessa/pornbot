<?php

abstract class Format
{
    public static function format_title($value, BOT $instance)
    {
        $instance = (object)$instance->title();
        if (isset($instance->wordmatch)) {
            if (strpos($value, $instance->wordmatch) > 0) {
                return utf8_decode($value);
            }
        } else {
            return utf8_decode($value);
        }
    }

    public static function format_duration($value, BOT $instance)
    {
        $instance = (object)$instance->duration();
        if (isset($instance->wordmatch)) {
            if (strpos($value, $instance->wordmatch) > 0) {
                return $value;
            }
        } else {
            return $value;
        }
    }

    public static function format_thumbnail($value, BOT $instance)
    {
        $instance = (object)$instance->thumbnail();
        if (isset($instance->wordmatch)) {
            if (strpos($value, $instance->wordmatch) > 0) {
                return $value;
            }
        } else {
            return $value;
        }
    }

    public static function format_link($value, BOT $instance)
    {
        $instance = (object)$instance->link();
        if (isset($instance->wordmatch)) {
            if (strpos($value, $instance->wordmatch) > 0) {
                return $value;
            }
        } else {
            return $value;
        }
    }
}