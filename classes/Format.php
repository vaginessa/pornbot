<?php
abstract class Format
{
	public static function format_title($titles)
	{
		return array_map('utf8_decode', explode("\n", $titles));
	}
	
	public static function format_duration($durations)
	{
		return explode("\n", $durations);
	}
}