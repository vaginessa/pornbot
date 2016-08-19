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
        $curl->setOpt(CURLOPT_SSL_VERIFYHOST, false);
        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
        $curl->get($url);
        if ($curl->error) {
            throw new BOTException('Error: ' . $curl->errorCode . ': ' . $curl->errorMessage);
        }

        return phpQuery::newDocumentHTML($curl->response);
    }

    public function start(BOT $instance)
    {
        try {
            $this->document = $this->getDocument($instance->url());
            $url = (object)$instance->link();
            $links = $this->document->find($url->pattern)->elements;
            foreach ($links as $link) {
                $this->document = $this->getDocument($link->getAttribute($url->attr));
                $title = (object)$instance->title();
                $duration = (object)$instance->duration();
                $thumb = (object)$instance->thumbnail();

                $title = $this->document->find($title->pattern)->eq(0)->text();
                $duration = $this->document->find($duration->pattern)->eq(0)->text();
                $thumbnail = $this->document->find($thumb->pattern)->get(0);

                if (!$thumbnail || !$title || !$duration) {
                    continue;
                }

                $data = array(
                    'title' => $title,
                    'duration' => $duration,
                    'thumbnail' => $thumbnail->getAttribute($thumb->attr),
                    'link' => $link->getAttribute($url->attr)
                );
                foreach ($data as $index => &$row) {
                    $row = call_user_func_array("Format::format_{$index}", [$row, $instance]);
                }
                print_r($data);
            }
        } catch (BOTException $err) {
            print 'Err';
        }
    }
}
