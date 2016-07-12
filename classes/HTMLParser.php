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
			
			$title = (object)$instance->title();
			$duration = (object)$instance->duration();
			$thumbnail = (object)$instance->thumbnail();
			$link = (object)$instance->link();
			
			$data = array(
				'title' => $this->document->find($title->pattern)->text(),
				'duration' => $this->document->find($duration->pattern)->text(),
				'thumbnail' => $this->document->find($thumbnail->pattern)->elements,
				'link' => $this->document->find($link->pattern)->elements
			);
			foreach ($data as $index => &$row) {
				$row = call_user_func_array("Format::format_{$index}", [$row, $instance]);
			}
			print_r($data);
		} catch( BOTException $err )
		{
			die($err);
		}
	}
}
