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
        // TODO: Implement getRequest() method.
    }

    /**
     * Treats the POST request
     *
     * @param array $post The POST array
     */
    public function postRequest(array $post)
    {
        // TODO: Implement postRequest() method.
    }

    /**
     * Treats the PUT request
     *
     * @param array $put The PUT array
     */
    public function putRequest(array $put)
    {
        // TODO: Implement putRequest() method.
    }

    /**
     * Treats the DELETE request
     *
     * @param array $delete The DELETE array
     */
    public function deleteRequest(array $delete)
    {
        // TODO: Implement deleteRequest() method.
    }
}