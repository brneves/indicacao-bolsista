<?php

namespace MocaBonita\includes\wp;

/**
 * Inserts links into wordpress site.
 *
 * @author Rômulo Batista
 * @category WordPress
 * @package moca_bonita\wp
 * @copyright Copyright (c) 2015-2016 Núcleo de Tecnologia da Informação - NTI, Universidade Estadual do Maranhão - UEMA
 */
class WPCode {

    /**
     * Add a style file
     *
     * @param string $css The style URL path
     */
    public function addStyle(array $css) {
        foreach ($css as $i => $value) {
            wp_enqueue_style('style_mb_' . $i, $value);
        }
    }

    /**
     * Add a javascript file
     *
     * @param string $js The javascript URL path
     */
    public function addJS(array $js) {
        foreach ($js as $i => $value) {
            wp_enqueue_script('script_mb_' . $i, $value, '', '', true);
        }
    }

}
