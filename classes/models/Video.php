<?php
class Video extends ActiveRecord\Model
{
    static $table_name = 'wp_posts';
    static $primary_key = 'id';
}