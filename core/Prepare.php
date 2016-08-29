<?php
/**
 * Version information
 *
 * @package    pornbot
 * @copyright  2016 Joseph Felix
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace PornBOT;

/**
 * Class Prepare
 * @package PornBOT
 */
class Prepare
{
    /**
     * Document da página atual
     *
     * @var mixed
     */
    private $document;

    /**
     * Prepare constructor.
     *
     * @param mixed $document
     */
    public function __construct($document = false)
    {
        $this->document = $document;
    }

    /**
     * Altera o estado do document atual
     *
     * @param mixed $document
     */
    public function setDocument($document)
    {
        $this->document = $document;
    }

    /**
     * Prepara o link do parser para a interface de tratamento
     *
     * @param $instance
     * @param $link
     * @return mixed
     */
    public function prepare_link($instance, $link)
    {
        return ($link instanceof DOMELEMENT) ? $link->getAttribute($instance->attr) : $link;
    }

    /**
     * Prepara os links do parser para a interface de tratamento
     *
     * @param $url
     * @return mixed
     */
    public function prepare_links($url)
    {
        if (!$url->regexp) {
            return $this->document->find($url->pattern)->elements;
        }

        preg_match_all($url->pattern, $this->document->html(), $links);
        return isset($links[1]) ? $links[1] : array();
    }

    /**
     * Prepara os títulos do parser para a interface de tratamento
     *
     * @param $instance
     * @return string
     */
    public function prepare_title($instance)
    {
        if (!$instance->regexp) {
            if ($title = $this->document->find($instance->pattern)->get(0)) {
                return $title->getAttribute($instance->attr);
            }
        }

        preg_match($instance->pattern, $this->document->html(), $title);
        return isset($title[1]) ? $title[1] : false;
    }

    /**
     * Prepara as durações do parser para a interface de tratamento
     *
     * @param $instance
     * @return string
     */
    public function prepare_duration($instance)
    {
        if (!$instance->regexp) {
            if ($duration = $this->document->find($instance->pattern)->get(0)) {
                return $duration->getAttribute($instance->attr);
            }
        }

        preg_match($instance->pattern, $this->document->html(), $duration);
        return isset($duration[1]) ? $duration[1] : false;
    }

    /**
     * Prepara o thumbnail do parser para a interface de tratamento
     *
     * @param $instance
     * @return string
     */
    public function prepare_thumbnail($instance)
    {
        if (!$instance->regexp) {
            if ($thumbnail = $this->document->find($instance->pattern)->get(0)) {
                return $thumbnail->getAttribute($instance->attr);
            }
        }

        preg_match($instance->pattern, $this->document->html(), $thumbnail);
        return isset($thumbnail[1]) ? $thumbnail[1] : false;
    }
}