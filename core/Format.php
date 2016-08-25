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
 * Class Format
 * @package PornBOT
 */
abstract class Format
{
    /**
     * Método usado para formatar o título
     * @param $value
     * @param BOT $instance
     * @return mixed
     */
    public static function format_title($value, BOT $instance)
    {
        return $value;
    }

    /**
     * Método usado para formatar a duração do vídeo
     * @param $value
     * @param BOT $instance
     * @return mixed
     */
    public static function format_duration($value, BOT $instance)
    {
        return $value;
    }

    /**
     * Método usado para formatar o thumbnail do vídeo
     * @param $value
     * @param BOT $instance
     * @return mixed
     */
    public static function format_thumbnail($value, BOT $instance)
    {
        return $value;
    }

    /**
     * Método usado para formatar o link do vídeo
     * @param $value
     * @param BOT $instance
     * @return mixed
     */
    public static function format_link($value, BOT $instance)
    {
        return $value;
    }
}