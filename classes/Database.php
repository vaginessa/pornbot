<?php

class Database
{
    public function Database()
    {
        global $CFG;

        $connections = array(
            'development' => "{$CFG->db_type}://{$CFG->db_user}:{$CFG->db_pass}@{$CFG->db_host}/{$CFG->db_schema}"
        );

        $model_directory = $CFG->dirroot . '/classes/models';

        ActiveRecord\Config::initialize(function ($config) use ($connections, $model_directory) {
            $config->set_model_directory($model_directory);
            $config->set_connections($connections);
            $config->set_default_connection('development');
        });
    }

    /**
     * Processa os dados capturados no crawler
     *
     * @param $data
     */
    public function process($data)
    {
        $slug = format_uri($data['title']);
        $video = Video::find(array('conditions' => array('post_name' => $slug)));
        $new_video = true;

        if (is_object($video)) {
            $new_video = false;
        }

        $attributes = array(
            'post_author' => 1,
            'post_date' => date('Y-m-d H:i:s'),
            'post_date_gmt' => date('Y-m-d H:i:s'),
            'post_content' => '',
            'post_title' => $data['title'],
            'post_excerpt' => '',
            'post_status' => 'publish',
            'comment_status' => 'open',
            'ping_status' => 'open',
            'post_password' => '',
            'post_name' => $slug,
            'to_ping' => '',
            'pinged' => '',
            'post_modified' => date('Y-m-d H:i:s'),
            'post_modified_gmt' => date('Y-m-d H:i:s'),
            'post_content_filtered' => '',
            'post_parent' => 0,
            'guid' => "http://localhost/analnymous/videos/{$slug}",
            'menu_order' => 0,
            'post_type' => 'videos',
            'post_mime_type' => '',
            'comment_count' => 0
        );

        $videomodel = new Video($attributes, true, false, $new_video);

        // Se não existir
        if (!$new_video) {

            // Atualiza o video já existente
            $videomodel->update_attribute('id', $video->id);
            printlog('Atualizou o video: ' . $data['title']);

        } else {

            // Insere na tabela
            printlog('Inseriu o video: ' . $data['title']);
        }

        $videomodel->save();
    }
}