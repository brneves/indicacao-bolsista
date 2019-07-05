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
                if ($get['id']) :
                    return $this->view->updateData($this->model->getAll($get['id']));
                elseif($get['del']):
                    $this->model->delete($get['del']);
                    return $this->view->indexView();
                else:
                    return $this->view->indexView();
                endif;
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
        switch ($post['action']):
            case 'update':
                $this->altera($post);
                return $this->view->indexView();
                break;
        endswitch;
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

    public function altera($data)
    {
        $this->model->altera($data);
        return $this->model->getResult();
    }


}