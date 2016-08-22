<?php

namespace PornBOT\Export;

/**
 * Interface ExportInterface
 */
interface ExportInterface
{
    /**
     * Processa o registro buscado pelo bot
     * @param $data
     * @return mixed
     */
    public function process($data);
}