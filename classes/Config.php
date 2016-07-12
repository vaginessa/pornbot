<?php

unset($CFG);
global $CFG;
$CFG = new stdClass();

$CFG->db_host = 'localhost';
$CFG->db_user = 'root';
$CFG->db_pass = '';
$CFG->db_schema = 'wordpress';

$CFG->dirroot = 'C:/wamp/www/pornbot';
$CFG->debug = true;
$CFG->max_videos = 10;