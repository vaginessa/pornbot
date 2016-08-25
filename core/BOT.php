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
 * Class BOT
 * @package PornBOT
 */
class BOT implements BotInterface
{
    /**
     * Nome do site que o bot irá buscar
     * @return null
     */
	public function name()
	{
		return null;
	}

    /**
     * Tipo de algoritmo de parse utilizado para buscar o conteúdo
     * @return null
     */
	public function type()
	{
		return null;
	}

    /**
     * Link da página que o bot irá buscar
     * @return null
     */
	public function url()
	{
		return null;
	}

    /**
     * Dados que irão ser consumidos pelo bot na busca do título do vídeo
     * @return array
     */
	public function title()
	{
		return array(
			'pattern' => '',
            'regexp' => false
		);
	}

    /**
     * Dados que irão ser consumidos pelo bot na busca da duração do vídeo
     * @return array
     */
	public function duration()
	{
		return array(
			'pattern' => '',
            'regexp' => false
		);
	}

    /**
     * Dados que irão ser consumidos pelo bot na busca pelo thumbnail do vídeo
     * @return array
     */
	public function thumbnail()
	{
		return array(
			'pattern' => '',
            'regexp' => false
		);
	}

    /**
     * Dados que irão ser consumidos pelo bot na busca pelo link dos vídeos
     * @return array
     */
	public function link()
	{
		return array(
			'pattern' => '',
            'regexp' => false
		);
	}
}