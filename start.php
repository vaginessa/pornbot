<?php
//if (defined('PHP_SAPI') && PHP_SAPI !== 'cli') die('This script only run on CLI');

include_once(__DIR__ . '/classes/Config.php');
include_once($CFG->dirroot . '/classes/Loader.php');
(new Bootstrap)->start();