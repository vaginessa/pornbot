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
 * Interface BotInterface
 * @package PornBOT
 */
interface BotInterface
{
    /**
     * Nome do site
     * @return string
     */
	public function name();

    /**
     * Renderizador utilizado
     * @return string
     */
	public function type();

    /**
     * Url do site a ser buscado
     * @return string
     */
	public function url();

    /**
     * Método usado para buscar o título do vídeo
     * @return array
     */
	public function title();

    /**
     * Método usado para buscar a duração do vídeo
     * @return mixed
     */
	public function duration();

    /**
     * Método usado para buscar o thumbnail do vídeo
     * @return mixed
     */
	public function thumbnail();

    /**
     * Método usado para buscar os links dos vídeos
     * @return mixed
     */
	public function link();
}