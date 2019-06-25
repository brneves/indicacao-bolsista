<?php
/*
  Plugin Name: Indicação de Bolsistas 2019
  Description: Plugin para gerenciamento da Indicação de Bolsistas 2019
  Version: 1.1.0
  Author: DPD-NTI
 */

use MocaBonita\includes\Path;
use MocaBonita\includes\HTTPMethod;
use MocaBonita\includes\wp\WPAction;
use MocaBonita\includes\wp\WPShortcode;

require_once (plugin_dir_path(__FILE__). 'vendor/autoload.php');

class Indicacao extends MocaBonita\MocaBonita
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
                'Indicação',
                'Indicação',
                'edit_pages',
                'indicacao',
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
        if (isset($_GET['page']) == 'indicacao'):
            $css = [
                plugins_url(Path::PLGCSS . 'bootstrap.min.css'),
                plugins_url(Path::PLGCSS . 'custom.css'),
            ];

            $js = [
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
        WPShortcode::addShortCode('insc-cnpq', $this->todo->getController('indicacao'), 'indicacaoShortcode');
        WPShortcode::addShortCode('insc-fapema', $this->todo->getController('indicacao'), 'indicacaoShortcode');
        WPShortcode::addShortCode('insc-uema', $this->todo->getController('indicacao'), 'indicacaoShortcode');
        WPShortcode::addShortCode('insc-pivic', $this->todo->getController('indicacao'), 'indicacaoShortcode');
        WPShortcode::addShortCode('insc-acoes', $this->todo->getController('indicacao'), 'indicacaoShortcode');
    }

    /**
     * Abstract method to add todo
     */
    public function addTODO()
    {
        $this->insertTODO('\Indicacao\controller\IndicacaoController', 'indicacao');
    }

    /**
     * Abstract method to add actions posts
     */
    public function addActionPosts(){}
}

add_action('plugins_loaded', function (){
    new Indicacao();
});