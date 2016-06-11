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
	
	public function titles()
	{
		return 'li.list-item div.list-content p';
	}
	
	public function dates()
	{
		
	}
}