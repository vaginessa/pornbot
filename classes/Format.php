<?php
abstract class Format
{
	public static function format_title($videotitles, BOT $instance)
	{
		$titles = [];
		$instance = (object)$instance->title();
		foreach (explode("\n", $videotitles) as $videotitle)
		{
			$value = isset($instance->attr) ? $videotitle->getAttribute($instance->attr) : $videotitle;
			if ( isset( $instance->wordmatch ) )
			{
				if ( strpos( $value, $instance->wordmatch ) > 0 ) {
					$titles[] = $value;
				}
			} else
			{
				$titles[] = $value;
			}
		}
		return array_map('utf8_decode', $titles);
	}
	
	public static function format_duration($videodurations, BOT $instance)
	{
		$durations = [];
		$instance = (object)$instance->duration();
		foreach (explode("\n", $videodurations) as $videoduration)
		{
			$value = isset($instance->attr) ? $videoduration->getAttribute($instance->attr) : $videoduration;
			if ( isset( $instance->wordmatch ) )
			{
				if ( strpos( $value, $instance->wordmatch ) > 0 ) {
					$durations[] = $value;
				}
			} else
			{
				$durations[] = $value;
			}
		}
		
		return $durations;
	}
	
	public static function format_thumbnail($images, BOT $instance)
	{
		$thumbnails = [];
		$instance = (object)$instance->thumbnail();
		foreach ($images as $thumbnail)
		{
			$value = isset($instance->attr) ? $thumbnail->getAttribute($instance->attr) : $thumbnail;
			if ( isset( $instance->wordmatch ) )
			{
				if ( strpos( $value, $instance->wordmatch ) > 0 ) {
					$thumbnails[] = $value;
				}
			} else
			{
				$thumbnails[] = $value;
			}
		}
		return $thumbnails;
	}
	
	public static function format_link($links, BOT $instance)
	{
		$videos = [];
		$instance = (object)$instance->link();
		foreach ($links as $link)
		{
			$value = isset($instance->attr) ? $link->getAttribute($instance->attr) : $link;
			if ( isset( $instance->wordmatch ) )
			{
				if ( strpos( $value, $instance->wordmatch ) > 0 ) {
					$videos[] = $value;
				}
			} else
			{
				$videos[] = $value;
			}
		}
		return $videos;
	}
}