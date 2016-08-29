<?php
/**
 * Version information
 *
 * @package    pornbot
 * @copyright  2016 Joseph Felix
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace PornBOT;

global $CFG;
require_once($CFG->dirroot . '/core/Helpers.php');
require_once($CFG->dirroot . '/core/ExportInterface.php');
require_once($CFG->dirroot . '/core/BotInterface.php');
require_once($CFG->dirroot . '/core/BotException.php');
require_once($CFG->dirroot . '/core/BOT.php');
require_once($CFG->dirroot . '/core/Format.php');
require_once($CFG->dirroot . '/core/Prepare.php');
require_once($CFG->dirroot . '/core/XMLParser.php');
require_once($CFG->dirroot . '/core/HTMLParser.php');

/**
 * Class Bootstrap
 * @package PornBOT
 */
class Bootstrap
{
    /**
     * Busca todas as core dos sites que o bot ira buscar
     * @return array
     */
    private function files()
    {
        global $CFG;
        $classes = [];
        $path = $CFG->dirroot . '/sites';
        $dir = dir($path);
        while ($file = $dir->read()) {
            if ($file !== '.' && $file !== '..') {
                $classes[] = $file;
            }
        }
        return $classes;
    }

    /**
     * Cria uma instancia de um site aleatório que o bot irá buscar
     * @return object
     */
    public function get_instance()
    {
        global $CFG;
        $files = $this->files();
        $classes = get_declared_classes();
        foreach ($files as $file) {
            require_once($CFG->dirroot . '/sites/' . $file);
        }
        $classes = array_values(array_diff(get_declared_classes(), $classes));
        return new $classes[mt_rand(0, sizeof($classes) - 1)];
    }


    /**
     * Exporta os dados dos videos para a classe configurada
     *
     * @return mixed
     */
    private function export_instance()
    {
        global $CFG;
        require_once($CFG->dirroot . '/export.php');
        $class_name = "export_{$CFG->export_to}";
        return new $class_name;
    }

    /**
     * Inicia e executa o bot
     */
    public function start()
    {
        global $CFG;
        set_time_limit($CFG->timeout);

        $export = $this->export_instance();
        $instance = $this->get_instance();

        printlog('Iniciando para o site: ' . $instance->name());

        if ($instance->type() == 'xml') {
            (new \PornBOT\Parsers\XMLParser)->start($instance, $export);
        } elseif ($instance->type() == 'html') {
            (new \PornBOT\Parsers\HTMLParser)->start($instance, $export);
        } elseif ($instance->type() == 'json') {
            //@todo implementar JSON
        }
    }
}