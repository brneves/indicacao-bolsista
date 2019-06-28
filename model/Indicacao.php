<?php

namespace Indicacao\model;

use MocaBonita\model\ModelWPDB;
use MocaBonita\includes\HTTPMethod;

class Indicacao extends ModelWPDB
{

    public $data;
    public $result;
    protected $table = 'indicacao_bolsista';

    public function getResult()
    {
        return $this->result;
    }

    public function getAll($id = null, $tipo = null)
    {
        if ($id):
            if ($tipo):
                $where = "WHERE id = {$id} AND tipo = '{$tipo}'";
            else:
                $where = "WHERE id = {$id}";
            endif;
        else:
            if ($tipo):
                $where = "WHERE tipo = '{$tipo}'";
            else:
                $where = null;
            endif;
        endif;

        $sql = "SELECT * FROM {$this->table} {$where} ORDER BY nome ASC";

        try {
            return $this->getResultsT(parent::prepare($sql, []), ARRAY_A);
        } catch (\Exception $e) {
            return HTTPMethod::getError($e->getCode(), $e->getMessage());
        }

    }

    public function create($data)
    {
        $this->data = $data;

        $this->data = array_map('strip_tags', $this->data);
        $this->data = array_map('trim', $this->data);

        $idIndicacao = $this->insert($this->table, [
            'nome'                       => $this->data['nome'],
            'cpf'                        => $this->data['cpf'],
            'curso'                      => $this->data['curso'],
            'centro'                     => $this->data['centro'],
            'codigo'                     => $this->data['codigo'],
            'data_nascimento'            => $this->data['data_nascimento'],
            'sexo'                       => $this->data['sexo'],
            'endereco'                   => $this->data['endereco'],
            'bairro'                     => $this->data['bairro'],
            'cep'                        => $this->data['cep'],
            'identidade'                 => $this->data['identidade'],
            'orgao_emissor'              => $this->data['orgao_emissor'],
            'data_emissao'               => $this->data['data_emissao'],
            'fone_residencial'           => $this->data['fone_residencial'],
            'fone_celular'               => $this->data['fone_celular'],
            'email'                      => $this->data['email'],
            'agencia'                    => isset($this->data['agencia']) ? $this->data['agencia'] : '',
            'conta_corrente'             => isset($this->data['conta_corrente']) ? $this->data['conta_corrente'] : '',
            'orientador'                 => $this->data['orientador'],
            'data_nascimento_orientador' => $this->data['data_nascimento_orientador'],
            'titulacao'                  => $this->data['titulacao'],
            'matricula'                  => $this->data['matricula'],
            'cpf_orientador'             => $this->data['cpf_orientador'],
            'centro_orientador'          => $this->data['centro_orientador'],
            'departamento_orientador'    => $this->data['departamento_orientador'],
            'celular_orientador'         => $this->data['celular_orientador'],
            'email_orientador'           => $this->data['email_orientador'],
            'telefone_orientador'        => $this->data['telefone_orientador'],
            'titulo_projeto'             => $this->data['titulo_projeto'],
            'titulo_plano'               => $this->data['titulo_plano'],
            'palavra_chave'              => $this->data['palavra_chave'],
            'tipo'                       => $this->data['tipo'],
            'created_at'                 => date("Y-m-d H:i:s"),
        ],
            [
                '%s', //nome
                '%s', //cpf
                '%s', //curso
                '%s', //centro
                '%s', //codigo
                '%s', //nasc
                '%s', //sexo
                '%s', //endereco
                '%s', //bairro
                '%s', //cep
                '%s', //id
                '%s', //orgao
                '%s', //emissao
                '%s', //dataEm
                '%s', //foneRes
                '%s', //FoneCel
                '%s', //email
                '%s', //agencia
                '%s', //cc
                '%s', //orientador
                '%s', //dataNasc
                '%s', //titulacao
                '%s', //matricula
                '%s', //cpf
                '%s', //centro
                '%s', //departamento
                '%s', //celular
                '%s', //email
                '%s', //telefone
                '%s', //titulo
                '%s', //plano
                '%s', //palavrachave
                '%s', //tipo
                '%s', //created
            ]);

        if ($idIndicacao):
            $this->result = ["Indicação realizada com sucesso!", "alert-success", $idIndicacao];
        else:
            $this->result = ["Não foi possível realizar a indicação!", "alert-warning"];
        endif;

    }


}