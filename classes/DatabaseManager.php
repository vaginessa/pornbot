<?php
class DatabaseManager
{
	private $instance;
	
	/**
	* Busca a instancia do mysqli 
	*/
	public function get_instance()
	{
		if (!$this->instance) {
			$this->instance = $this->connect();
		}
		return $this->instance;
	}
	
	/**
	* Conecta a base de dados
	*/
	private function connect()
	{
		global $CFG;
		$instance = new mysqli($CFG->db_host, $CFG->db_user, $CFG->db_pass, $CFG->db_schema);
		
		if ($instance->connect_error) {
			die("Connection failed: " . $instance->connect_error);
		}
		
		return $instance;
	}

    /**
     * DatabaseManager constructor.
     */
	public function DatabaseManager()
	{
		$this->db = $this->get_instance();
	}
}