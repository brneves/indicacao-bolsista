<?php

namespace MocaBonita\controller;

use MocaBonita\includes\json\JSONService;

/**
* Service to treat request/response requests.
*
* @author Rômulo Batista
* @category WordPress
* @package moca_bonita\controller
* @copyright Copyright (c) 2015-2016 Núcleo de Tecnologia da Informação - NTI, Universidade Estadual do Maranhão - UEMA
*/

abstract class HTTPService {
    /**
    * Query string
    *
    * @var string
    */
    protected $qs;
    /**
    * POST, PUT or DELETE content body
    *
    * @var array
    */
    protected $content;
    /**
    * HTTP request method
    *
    * @var string
    */
    protected $requestMethod;
    /**
    * JSONService object
    *
    * @var object
    */
    protected $json;

    /**
    * Class constructor
    *
    */
    public function __construct(){
        $this->json = new JSONService();
        $this->getRequest();
    }

    /**
    * Get the request from client
    *
    */
    public function getRequest(){
        if($this->isGET())
            $this->qs = $_GET;

        if($this->isPOST()){
            $post = file_get_contents('php://input');

            if($this->isJSON($post))
                $_POST = json_decode($post, true);

            $this->content = $_POST;
        }

        if($this->isPUT()){
            $put = file_get_contents("php://input");

            if($this->isJSON($put))
                $this->content = $this->json->decode($put);
            else
                $this->content = $put;
        }

        if($this->isDELETE()){
            $delete = file_get_contents("php://input");

            if($this->isJSON($delete))
                $this->content = $this->json->decode($delete);
            else
                $this->content = $delete;
        }
    }

    /**
    * Set the request method
    *
    */
    public function setRequestMethod(){
        if(isset($_REQUEST))
            $this->request = $_REQUEST;
    }

    /**
    * Check if it's a GET method
    *
    * @return True if the method is GET, false if it's not
    */
    public function isGET(){
        if($_SERVER['REQUEST_METHOD'] === 'GET')
            return true;

        return false;
    }

    /**
    * Check if it's a POST method
    *
    * @return True if the method is POST, false if it's not
    */
    public function isPOST(){
        if($_SERVER['REQUEST_METHOD'] === 'POST')
            return true;

        return false;
    }

    /**
    * Check if it's a PUT method
    *
    * @return True if the method is PUT, false if it's not
    */
    public function isPUT(){
        if($_SERVER['REQUEST_METHOD'] === 'PUT')
            return true;

        return false;
    }

    /**
    * Check if it's a DELETE method
    *
    * @return True if the method is DELETE, false if it's not
    */
    public function isDELETE(){
        if($_SERVER['REQUEST_METHOD'] === 'DELETE')
            return true;

        return false;
    }

    /**
    * Check if something was requested
    *
    * @return True if something was requested, false if was not
    */
    public function isREQUEST(){
        if(isset($this->request))
            return true;

        return false;
    }

    /**
    * Check if the string is in JSON format
    *
    * @param string $str A string
    * @return True if the method is GET, false if it's not
    */
    public function isJSON($str){
        return $this->json->isJSON($str);
    }

    /**
    * Send the message back to the client
    *
    * @param array or string $msg The response message
    * @return A message in JSON or TEXT
    */
    public function sendMessage($msg){
        if(is_array($msg)){
            $responseSuccess = function($code) use (&$msg){
                return [
                    'meta' => ['code' => $code],
                    'data' => $msg,
                ];
            };

            $responseError = function() use (&$msg){
                return [
                    'meta' => [
                        'code'          => $msg['http_method']['code'],
                        'error_message' => $msg['http_method']['error_message'],
                    ],
                ];
            };

            if($this->isGET())
                return $this->json->sendJSON(isset($msg['http_method']) ? $responseError() : $responseSuccess(200));

            elseif($this->isPOST() || $this->isPUT())
                return $this->json->sendJSON(isset($msg['http_method']) ? $responseError() : $responseSuccess(201));

            elseif($this->isDELETE())
                return $this->json->sendJSON(isset($msg['http_method']) ? $responseError() : $responseSuccess(204));

            else
                return $this->json->sendJSON($msg);
        }
    }

}
