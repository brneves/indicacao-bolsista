<?php

namespace MocaBonita;

use MocaBonita\controller\Controller;
use MocaBonita\controller\HTTPService;
use MocaBonita\includes\TODO;
use MocaBonita\includes\WPAdminAction;
use MocaBonita\includes\wp\WPCode;
use MocaBonita\includes\wp\WPAction;
use MocaBonita\includes\wp\WPMenu;
use MocaBonita\includes\wp\WPShortCode;
use MocaBonita\includes\HTTPMethod;

/**
 * Performs the basic functions of the framework. Receives each request, passes to a controller that treats client requests and respond to them.
 *
 * @author Rômulo Batista
 * @category WordPress
 * @package moca_bonita\controller
 * @copyright Copyright (c) 2015-2016 Núcleo de Tecnologia da Informação - NTI, Universidade Estadual do Maranhão - UEMA
 */
abstract class MocaBonita extends HTTPService {

    /**
     * WPMenu object
     *
     * @var object
     */
    protected $wpMenu;

    /**
     * WPCode object
     *
     * @var object
     */
    protected $wpCode;

    /**
     * WPAdminAction object
     *
     * @var object
     */
    protected $action;

    /**
     * TODO object
     *
     * @var object
     */
    protected $todo;

    /**
     * WPShortCode object
     *
     * @var object
     */
    protected $sc;

    /**
     * Class constructor
     *
     */
    public function __construct() {
        parent::__construct();
        $this->wpMenu = new WPMenu();
        $this->wpCode = new WPCode();
        $this->action = WPAdminAction::singleton();
        $this->todo = new TODO();
        $this->sc = new WPShortCode();
        $this->mainAction();
    }

    /**
     * Abstract method to add menu
     *
     */
    abstract public function addMenu();

    /**
     * Abstract method to add links (style and javascript ones)
     *
     */
    abstract public function addLinks();

    /**
     * Abstract method to add wp shortcodes
     *
     */
    abstract public function addShortcode();

    /**
     * Abstract method to add actions posts
     *
     */
    abstract public function addActionPosts();

    /**
     * Abstract method to add todo
     *
     */
    abstract public function addTODO();

    /**
     * Sets the main action to this object
     *
     */
    protected function mainAction() {
        WPAction::addAction('moca_bonita', $this, 'doAction');
    }

    /**
     * process ajax request
     *
     */
    protected function ajaxRequestAction() {
        if (defined('DOING_AJAX') && DOING_AJAX)
            WPAction::doAction('moca_bonita');
    }

    /**
     * Callback for all the actions to be taken
     *
     */
    public function doAction() {
        $res = null;

        if ($this->isGET()) {
            if (isset($this->qs['page'])) {
                $controllerObject = $this->todo->getController($this->qs['page']);

                if ($controllerObject instanceof Controller)
                    $res = $controllerObject->getRequest($this->qs);
                else
                    $res = HTTPMethod::getError(HTTPMethod::REQUEST_UNAVAIABLE);
            }
        } elseif (isset($this->content['todo'])) {
            $controllerObject = $this->todo->getController($this->content['todo']);

            if ($controllerObject instanceof Controller) {
                if ($this->isPOST())
                    $res = $controllerObject->postRequest($this->content);
                elseif ($this->isPUT())
                    $res = $controllerObject->putRequest($this->content);
                elseif ($this->isDELETE())
                    $res = $controllerObject->deleteRequest($this->content);
                else
                    $res = HTTPMethod::getError(HTTPMethod::NOT_IMPLEMENTED);
            } else
                $res = HTTPMethod::getError(HTTPMethod::REQUEST_UNAVAIABLE);
        } else {
            $res = HTTPMethod::getError(HTTPMethod::NOT_IMPLEMENTED);
        }

        $this->sendMessage($res);
    }

    /**
     * Add menu items to wp admin page
     *
     * @param array $wpMenuItems The menu items array
     * @param array $wpMenuItems The submenu items array
     */
    public function addMenuItem($wpMenuItems, $wpMenuSubItems) {
        $this->wpMenu->setMenuItems($wpMenuItems);
        $this->wpMenu->setMenuSubItems($wpMenuSubItems);
        WPAction::addAction('admin_menu', $this, 'insertMenuItems');
    }

    /**
     * Add menu callback method
     *
     */
    public function insertMenuItems() {
        if (is_admin()) {
            $this->wpMenu->addMenu();
            $this->wpMenu->addSubMenu();
        }
    }

    /**
     * Insert style files to wp
     *
     * @param array $css An array containing the style files
     */
    public function insertCSS($css) {
        $this->wpCode->addStyle($css);
    }

    /**
     * Insert javascript files to wp
     *
     * @param array $js An array containing the javascript files
     */
    public function insertJS($js) {
        $this->wpCode->addJS($js);
    }

    /**
     * Insert shortcode to wp
     *
     * @param array $shortCode The shortcode name
     * @param array $object The object that will treat the shortcode
     * @param array $method The callback method
     */
    public function insertShortCode($shortCode, $object, $method) {
        $this->shortCode($shortCode, $object, $method);
    }

    /**
     * Remove menu items
     *
     */
    public function removeMenuItems() {
        $this->wpMenu->freeMenuItems();
    }

    /**
     * Remove submenu items
     *
     */
    public function removeSubMenuItems() {
        $this->wpMenu->freeSubMenuItems();
    }

    /**
     * Generate action posts
     *
     * @param array $actions An array containing all actions to be taken
     */
    public function generateActionPosts($actions = []) {
        $this->action->addActions($actions, $this);
    }

    /**
     * Relates the todo to a controller
     *
     * @param string $controller The name of the controller
     * @param string $todo The todo
     */
    public function insertTODO($controller, $todo) {
        $this->todo->addTODO($controller, $todo);
    }

    /**
     * Remove todo
     * @param string $controller The name of the controller
     * @param string $todo The todo
     */
    public function removeTODO($controller, $todo) {
        $this->todo->removeTODO($controller, $todo);
    }

}
