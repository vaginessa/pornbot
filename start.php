<?php
/**
 * Version information
 *
 * @package    pornbot
 * @copyright  2016 Joseph Felix
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (defined('PHP_SAPI') && PHP_SAPI !== 'cli') die('This script run only CLI');

include_once(__DIR__ . '/config.php');
include_once($CFG->dirroot . '/core/Loader.php');
(new PornBOT\Bootstrap)->start();