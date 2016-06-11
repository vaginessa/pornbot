<?php
require_once($CFG->dirroot . '/classes/Curl.php');
require_once($CFG->dirroot . '/classes/CaseInsensitiveArray.php');
require_once($CFG->dirroot . '/classes/PHPQuery.php');
use \Curl\Curl;

class HTMLParser
{
	private $document;
	public function start(BOT $instance)
	{
		$curl = new Curl();
		$curl->setUserAgent('Pornbot v1.0');
		$curl->setOpt(CURLOPT_FOLLOWLOCATION, true);
		$curl->setOpt(CURLOPT_RETURNTRANSFER, true);
		$curl->get($instance->url());
		if ( $curl->error )
		{
			throw new Exception('Error: ' . $curl->errorCode . ': ' . $curl->errorMessage);
		}
		
		$this->document = phpQuery::newDocumentHTML($curl->response);
		$titles = explode("\n", $this->document->find($instance->titles())->text());
		echo '<pre>';
		print_r($titles);
		echo '</pre>';
	}
}
