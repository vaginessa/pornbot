<?php
//if (defined('PHP_SAPI') && PHP_SAPI !== 'cli') die('This script run only CLI');

include_once(__DIR__ . '/config.php');
include_once($CFG->dirroot . '/core/Loader.php');
(new PornBOT\Bootstrap)->start();