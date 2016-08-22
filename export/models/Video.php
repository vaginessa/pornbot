<?php

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