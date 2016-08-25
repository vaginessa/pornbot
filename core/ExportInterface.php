<?php
/**
 * Version information
 *
 * @package    pornbot
 * @copyright  2016 Joseph Felix
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace PornBOT\Export;

/**
 * Interface ExportInterface
 */
interface ExportInterface
{
    /**
     * Processa o registro buscado pelo bot
     * @param $data
     * @return mixed
     */
    public function process($data);
}