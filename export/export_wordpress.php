<?php
class export_wordpress implements \PornBOT\Export\ExportInterface
{
    const WP_DIR = 'C:/wamp/www/analnymous';

    public function process($data)
    {
        require_once(static::WP_DIR . '/wp-load.php');
        if ($post_id = $this->insert_post($data)) {
            $customfields = array(
                'duracao' => $data['duration'],
                'views' => 0
            );

            foreach ($customfields as $meta_key => $meta_value) {
                add_post_meta($post_id, $meta_key, $meta_value);
            }

            printlog('Inseriu o video: ' . $data['title']);
        }
    }

    private function insert_post($data)
    {
        $slug = sanitize_title($data['title']);
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

        return wp_insert_post($attributes);
    }
}