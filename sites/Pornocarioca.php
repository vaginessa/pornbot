<?php
class Pornocarioca extends BOT implements BotInterface
{
	public function name()
	{
		return 'pornocarioca.com';
	}
	
	public function type()
	{
		return 'html';
	}
	
	public function url()
	{
		return 'http://www.pornocarioca.com/';
	}
	
	public function title()
	{
		return array(
			'pattern' => 'li.list-item div.list-content p',
			'wordmatch' => ' '
		);
	}
	
	public function duration()
	{
		return array(
			'pattern' => 'li.list-item span.duration',
			'wordmatch' => ':'
		);
	}
	
	public function thumbnail()
	{
		return array(
			'pattern' => 'meta[itemprop="thumbnailUrl image"]',
			'attr' => 'content',
			'wordmatch' => '/wp-content/uploads/'
		);
	}
	
	public function link()
	{
		return array(
			'pattern' => 'li.list-item a',
			'attr' => 'href',
			'wordmatch' => 'pornocarioca.com'
		);
	}
}