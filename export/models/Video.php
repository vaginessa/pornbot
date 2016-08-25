<?php
/**
 * Version information
 *
 * @package    pornbot
 * @copyright  2016 Joseph Felix
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Class Video
 */
class Video extends ActiveRecord\Model
{
    /**
     * Nome da tabela que guarda os videos
     * @var string
     */
    static $table_name = 'videos';

    /**
     * Nome da chave primária
     * @var string
     */
    static $primary_key = 'id';
}