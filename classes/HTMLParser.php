<?php
require_once($CFG->dirroot . '/classes/Curl.php');
require_once($CFG->dirroot . '/classes/CaseInsensitiveArray.php');
require_once($CFG->dirroot . '/classes/PHPQuery.php');
use \Curl\Curl;

class HTMLParser
{
	private $document;
	
	private function getDocument($url)
	{
		$curl = new Curl();
		$curl->setUserAgent('Pornbot v1.0');
		$curl->setOpt(CURLOPT_FOLLOWLOCATION, true);
		$curl->setOpt(CURLOPT_RETURNTRANSFER, true);
		$curl->get($url);
		if ( $curl->error ) {
			throw new BOTException('Error: ' . $curl->errorCode . ': ' . $curl->errorMessage);
		}
		
		return phpQuery::newDocumentHTML($curl->response);
	}
	
	public function start(BOT $instance)
	{
		try {
			$this->document = $this->getDocument($instance->url());
			$data = array(
				'title' => $this->document->find($instance->titles())->text(),
				'duration' => $this->document->find($instance->duration())->text()
			);
			foreach ($data as $index => &$row) 
				$row = call_user_func_array("Format::format_{$index}", [$row]);
			echo '<pre>';
			print_r($data);
			echo '</pre>';
		} catch( BOTException $err )
		{
			die($err);
		}
	}
}
