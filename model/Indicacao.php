<?php

namespace Indicacao\model;

use MocaBonita\model\ModelWPDB;
use MocaBonita\includes\HTTPMethod;

class Indicacao extends ModelWPDB
{

    public $data;
    public $result;
    private $table = 'indicacao_bolsista';

    public function getResult()
    {
        return $this->result;
    }

    public function getAll($id)
    {
        $sql = "";

        try{
            return $this->getResultsT(parent::prepare($sql, []), ARRAY_A);
        } catch (\Exception $e){
            return HTTPMethod::getError($e->getCode(), $e->getMessage());
        }

    }
}