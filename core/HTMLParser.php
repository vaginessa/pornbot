<?php
/**
 * Version information
 *
 * @package    pornbot
 * @copyright  2016 Joseph Felix
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace PornBOT\Parsers;

global $CFG;
require_once($CFG->libdir . '/curl/Curl.php');
require_once($CFG->libdir . '/phpquery/PHPQuery.php');

use \Curl\Curl;
use PornBOT\BOT as BOT;
use PornBOT\Prepare as Prepare;
use PornBOT\Exception\BOTException as BotException;

/**
 * Class HTMLParser
 * @package PornBOT\Parsers
 */
class HTMLParser
{
    /**
     * DOMElement da página
     * @var phpQueryObject
     */
    private $document;

    /**
     * Busca o DOMElement html a partir de um link
     *
     * @param $url
     * @return \phpQueryObject|\QueryTemplatesParse|\QueryTemplatesSource|\QueryTemplatesSourceQuery
     * @throws BotException
     */
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
            throw new BOTException('Link inválido: ' . $url);
        }

        return \phpQuery::newDocumentHTML($curl->response);
    }

    /**
     * Inicia o bot
     *
     * @param BOT $instance
     * @param $export
     * @return null
     */
    public function start(BOT $instance, $export)
    {
        $this->document = $this->getDocument($instance->url());
        $url = (object)$instance->link();
        $prepare = new Prepare($this->document);

        try {
            foreach ($prepare->prepare_links($url) as $link) {

                $pornurl = $prepare->prepare_link($url, $link);

                $this->document = $this->getDocument($pornurl);

                $prepare->setDocument($this->document);

                $titleinstance = (object)$instance->title();
                $durationinstance = (object)$instance->duration();
                $thumbinstance = (object)$instance->thumbnail();

                $title = $prepare->prepare_title($titleinstance);
                $duration = $prepare->prepare_duration($durationinstance);
                $thumbnail = $prepare->prepare_thumbnail($thumbinstance);

                if ($thumbnail && $title && $duration) {

                    $data = array(
                        'title' => $title,
                        'duration' => $duration,
                        'thumbnail' => $thumbnail,
                        'link' => $pornurl
                    );

                    foreach ($data as $index => &$row) {
                        $row = call_user_func_array("\\PornBOT\\Format::format_{$index}", [$row, $instance]);
                    }

                    $export->process($data);
                }
            }

        } catch (BOTException $err) {
            printlog($err->getMessage());
        }


    }
}
