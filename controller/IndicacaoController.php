<?php

namespace Indicacao\controller;

use Indicacao\model\Indicacao;
use Indicacao\view\IndicacaoView;
use MocaBonita\controller\Controller;

class IndicacaoController implements Controller
{

    private $view;
    private $model;

    /**
     * IndicacaoController constructor.
     * @param $view
     */
    public function __construct()
    {
        $this->view = new IndicacaoView();
        $this->model = new Indicacao();
    }


    /**
     * Treats the GET request
     *
     * @param array $get The GET array
     */
    public function getRequest(array $get)
    {
        switch ($get['page']):
            case 'indicacao':
                return $this->view->indexView();
                break;
        endswitch;
    }

    /**
     * Treats the POST request
     *
     * @param array $post The POST array
     */
    public function postRequest(array $post)
    {
    }

    /**
     * Treats the PUT request
     *
     * @param array $put The PUT array
     */
    public function putRequest(array $put)
    {
    }

    /**
     * Treats the DELETE request
     *
     * @param array $delete The DELETE array
     */
    public function deleteRequest(array $delete)
    {
    }

    public function cnpqShortcode()
    {
        return $this->view->cnpqShortcode();
    }

    public function fapemaShortcode()
    {
        return $this->view->fapemaShortcode();
    }

    public function uemaShortcode()
    {
        return $this->view->uemaShortcode();
    }

    public function pivicShortcode()
    {
        return $this->view->pivicShortcode();
    }

    public function acoesShortcode()
    {
        return $this->view->acoesShortcode();
    }

    public function create($data)
    {
        $this->model->create($data);
        return $this->model->getResult();
    }

}