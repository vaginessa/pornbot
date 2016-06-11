<?php
require_once($CFG->dirroot . '/classes/BotInterface.php');
require_once($CFG->dirroot . '/classes/BOT.php');
require_once($CFG->dirroot . '/classes/XMLParser.php');
require_once($CFG->dirroot . '/classes/HTMLParser.php');

class Bootstrap
{
	/**
	* Busca todas as classes dos sites que o bot irá buscar
	* @return array
	*/
	private function files()
	{
		global $CFG;
		$classes = [];
		$path = $CFG->dirroot . '/sites';
		$dir = dir($path);
		while ($file = $dir->read())
			if ($file !== '.' && $file !== '..')
				$classes[] = $file;
		return $classes;
	}
	
	/**
	* Cria uma instancia de um site aleatório que o bot irá buscar
	* @return object
	*/
	public function get_instance()
	{
		global $CFG;
		$files = $this->files();
		$classes = get_declared_classes();		
		foreach ( $files as $file ) {
			require_once($CFG->dirroot . '/sites/' . $file);
		}	
		$classes = array_values(array_diff(get_declared_classes(), $classes));		
		return new $classes[mt_rand(0, sizeof($classes)-1)];
	}
	
	/**
	* Inicia e executa o bot
	*/
	public function start()
	{
		$instance = $this->get_instance();
		
		if ( $instance->type() == 'xml' )
		{
			(new XMLParser)->start($instance);
		} elseif ( $instance->type() == 'html' )
		{
			(new HTMLParser)->start($instance);
		} elseif ( $instance->type() == 'json' )
		{
			//@todo implementar JSON
		}
	}
}