<?php
require_once($CFG->libdir . '/activerecord/ActiveRecord.php');

class export_database implements \PornBOT\Export\ExportInterface
{
    /**
     * Configura uma conexão a base de dados
     * @return null
     */
    private function config()
    {
        global $CFG;

        $connections = array(
            'development' => "{$CFG->db_type}://{$CFG->db_user}:{$CFG->db_pass}@{$CFG->db_host}/{$CFG->db_schema}"
        );

        $model_directory = $CFG->dirroot . '/export/models';

        ActiveRecord\Config::initialize(
            function ($config) use ($connections, $model_directory) {
                $config->set_model_directory($model_directory);
                $config->set_connections($connections);
                $config->set_default_connection('development');
            });
    }

    /**
     * Processa o registro buscado pelo bot
     *
     * @param $data
     * @return null
     */
    public function process($data)
    {
        $this->config();

        $video = new Video($data);
        return $video->save();
    }
}