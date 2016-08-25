<?php
/**
 * Version information
 *
 * @package    pornbot
 * @copyright  2016 Joseph Felix
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Class export_wordpress
 */
class export_wordpress implements \PornBOT\Export\ExportInterface
{
    /**
     * Diretório do projeto de site porno
     */
    const WP_DIR = 'C:/wamp/www/analnymous';

    /**
     * Método usado para processar todo conteúdo que o bot recebeu
     * @param $data
     * @return
     */
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

    /**
     * Método usado para inserir uma postagem no wordpress
     *
     * @param $data
     * @return mixed
     */
    private function insert_post($data)
    {
        $slug = sanitize_title($data['title']);
        $attributes = array(
            'post_author' => 1,
            'post_content' => '',
            'post_title' => $data['title'],
            'post_status' => 'publish',
            'comment_status' => 'open',
            'post_name' => $slug,
            'post_parent' => 0,
            'guid' => site_url() . "/videos/{$slug}",
            'post_type' => 'videos',
        );

        return wp_insert_post($attributes);
    }
}