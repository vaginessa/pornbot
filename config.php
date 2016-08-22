<?php

unset($CFG);
global $CFG;
$CFG = new stdClass();

$CFG->db_type = 'mysql';
$CFG->db_host = '127.0.0.1';
$CFG->db_user = 'root';
$CFG->db_pass = '';
$CFG->db_schema = 'analnymous';

$CFG->export_to = 'wordpress';

$CFG->dirroot = 'C:/wamp/www/pornbot';
$CFG->libdir = $CFG->dirroot . DIRECTORY_SEPARATOR . 'lib';
$CFG->debug = true;
$CFG->max_videos = 10;
$CFG->timezone = 'America/Sao_Paulo';
$CFG->timeout = 0;