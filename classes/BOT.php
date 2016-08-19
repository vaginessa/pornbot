<?php
class BOT implements BotInterface
{
	public function name()
	{
		return null;
	}
	
	public function type()
	{
		return null;
	}
	
	public function url()
	{
		return null;
	}
	
	public function title()
	{
		return array(
			'pattern' => '',
			'wordmatch' => ''
		);
	}

	public function duration()
	{
		return array(
			'pattern' => '',
			'wordmatch' => ''
		);
	}

	public function thumbnail()
	{
		return array(
			'pattern' => '',
			'wordmatch' => ''
		);
	}

	public function link()
	{
		return array(
			'pattern' => '',
			'wordmatch' => ''
		);
	}
}