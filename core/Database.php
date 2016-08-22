<?php

/**
 * Class Database
 */
class Database
{
    /**
     * Database constructor.
     */
    public function Database()
    {
        global $CFG;

        $connections = array(
            'development' => "{$CFG->db_type}://{$CFG->db_user}:{$CFG->db_pass}@{$CFG->db_host}/{$CFG->db_schema}"
        );

        $model_directory = $CFG->dirroot . '/core/models';

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
        $post_id = $this->insert_post($data);

        $customfields = array(
            'duracao' => $data['duration'],
            'views' => 0
        );

        foreach ($customfields as $meta_key => $meta_value) {
            $this->insert_custom($post_id, $meta_key, $meta_value);
        }
    }

    /**
     * Insere um campo de postagem personalizado
     *
     * @param $post_id
     * @param $meta_key
     * @param $meta_value
     */
    private function insert_custom($post_id, $meta_key, $meta_value)
    {
        $customfield = new CustomField(
            array(
                'post_id' => $post_id,
                'meta_key' => $meta_key,
                'meta_value' => $meta_value
            )
        );

        $customfield->save();
    }

    /**
     * Insere uma postagem no banco de dados e retorna o ID
     *
     * @param $data
     * @return int
     */
    private function insert_post($data)
    {
        $slug = format_uri($data['title']);
        $video = Video::find(array('conditions' => array('post_name' => $slug)));
        $new_video = !is_object($video);

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
            $videomodel->save();
            printlog('Atualizou o video: ' . $data['title']);
        } else {
            // Insere na tabela
            $videomodel->save();
            printlog('Inseriu o video: ' . $data['title']);
        }

        return $videomodel->id;
    }
}