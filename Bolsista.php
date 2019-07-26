<?php
/*
  Plugin Name: Bolsista de Bolsistas 2019/PROEXAE
  Description: Plugin para gerenciamento da Bolsista de Bolsistas 2019/PROEXAE
  Version: 1.1.0
  Author: DPD-NTI
 */

use MocaBonita\includes\Path;
use MocaBonita\includes\HTTPMethod;
use MocaBonita\includes\wp\WPAction;
use MocaBonita\includes\wp\WPShortcode;

require_once (plugin_dir_path(__FILE__). 'vendor/autoload.php');

class Bolsista extends MocaBonita\MocaBonita
{

    public function __construct()
    {
        parent::__construct();
        $this->addTODO();
        $this->addMenu();
        $this->addLinks();
        $this->addActionPosts();
        $this->addShortcode();
    }

    /**
     * Abstract method to add menu
     */
    public function addMenu()
    {
        $wpMenu = [
            [
                'Bolsista',
                'Bolsista',
                'edit_pages',
                'bolsista',
                $this,
                'doAction',
                'dashicons-format-aside',
                2
            ]
        ];
        $wpSubMenu = [];
        $this->addMenuItem($wpMenu, $wpSubMenu);
    }

    /**
     * Abstract method to add links (style and javascript ones)
     */
    public function addLinks()
    {
        if (isset($_GET['page']) == 'bolsista'):
            $css = [
                plugins_url(Path::PLGCSS . 'bootstrap.min.css'),
                plugins_url(Path::PLGCSS . 'custom.css'),
            ];

            $js = [
                plugins_url(Path::PLGJS . 'bootstrap.min.js'),
                plugins_url(Path::PLGJS . 'js-view.js')
            ];
            $this->insertCSS($css);
            $this->insertJS($js);

        else:
            $css = [
                plugins_url(Path::PLGCSS . 'bootstrap.min.css'),
                plugins_url(Path::PLGCSS . 'custom.css')
            ];
            $js = [
                plugins_url(Path::PLGJS . 'bootstrap.min.js'),
                plugins_url(Path::PLGJS . 'js-view.js')
            ];
            $this->insertCSS($css);
            $this->insertJS($js);
        endif;
    }

    /**
     * Abstract method to add wp shortcodes
     */
    public function addShortcode()
    {
        WPShortcode::addShortCode('acoBolsista', $this->todo->getController('indicacao'), 'acoBolsistaShortcode');
        WPShortcode::addShortCode('acoVoluntario', $this->todo->getController('indicacao'), 'acoVoluntarioShortcode');
        WPShortcode::addShortCode('acoColaborador', $this->todo->getController('indicacao'), 'acoColaboradorShortcode');
        WPShortcode::addShortCode('pibexBolsista', $this->todo->getController('indicacao'), 'pibexBolsistaShortcode');
        WPShortcode::addShortCode('pibexVoluntario', $this->todo->getController('indicacao'), 'pibexVoluntarioShortcode');
        WPShortcode::addShortCode('pibexColaborador', $this->todo->getController('indicacao'), 'pibexColaboradorShortcode');
    }

    /**
     * Abstract method to add todo
     */
    public function addTODO()
    {
        $this->insertTODO('\Bolsista\controller\BolsistaController', 'bolsista');
    }

    /**
     * Abstract method to add actions posts
     */
    public function addActionPosts(){}
}

add_action('plugins_loaded', function (){
    new Bolsista();
});