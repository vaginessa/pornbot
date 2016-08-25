<?php
/**
 * Version information
 *
 * @package    pornbot
 * @copyright  2016 Joseph Felix
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace PornBOT\Exception;

/**
 * Class BOTException
 * @package PornBOT\Exception
 */
class BOTException extends \Exception
{
    /**
     * Imprime uma mensagem de erro
     * @return string
     */
	public function __toString()
	{
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}