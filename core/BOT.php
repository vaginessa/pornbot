<?php

namespace PornBOT;

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
            'regexp' => false
		);
	}

	public function duration()
	{
		return array(
			'pattern' => '',
            'regexp' => false
		);
	}

	public function thumbnail()
	{
		return array(
			'pattern' => '',
            'regexp' => false
		);
	}

	public function link()
	{
		return array(
			'pattern' => '',
            'regexp' => false
		);
	}
}