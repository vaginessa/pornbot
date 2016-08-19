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
        $video = new Video(
            array(
                'post_author' => 1,
                'post_date' => date('Y-m-d H:i:s'),
                'post_content' => '',
                'post_title' => $data['title'],
                'post_status' => 'publish',
                'comment_status' => 'open',
                'ping_status' => 'open',
                'post_name' => $slug,
                'post_modified' => date('Y-m-d H:i:s'),
                'post_parent' => 0,
                'guid' => "http://localhost/analnymous/videos/{$slug}",
                'menu_order' => 0,
                'post_type' => 'videos'
            )
        );

        if ($video->save()) {
            printlog('Inseriu: ' . $data['title']);
        }
    }
}