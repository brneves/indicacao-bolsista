<?php

require_once("../vendor/dompdf/dompdf_config.inc.php");

class Exportar
{

    private $tipo;
    private $conn;
    private $data;
    private $table = 'indicacao_bolsista';

    public function __construct()
    {
        $this->connect();
        $this->tipo = filter_input(INPUT_GET, 'tipo', FILTER_DEFAULT);
        $this->getData();
        $this->gerarPlanilha();
    }

    public function connect()
    {
        $this->conn = new PDO("mysql:host=localhost;dbname=ppg", "root", "");
        //$this->conn = new PDO("mysql:host=localhost;dbname=ppg", "ppg", "ppg.12qwaszx");
    }

    public function getData()
    {
        $this->data = $this->conn->query("SELECT * FROM {$this->table} WHERE tipo = '{$this->tipo}'");
        $this->data = $this->data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function gerarPlanilha()
    {

        $tabela = '
            <table border="0">
                <tr>
                    <td>Nome completo do(a) bolsista</td>
                    <td>CPF</td>
                    <td>Curso de gradua&ccedil;&atilde;o</td>
                    <td>Centro</td>
                    <td>C&oacute;digo do(a) aluno(a)</td>
                    <td>Data de nascimento</td>
                    <td>Sexo</td>
                    <td>Endere&ccedil;o</td>
                    <td>Bairro</td>
                    <td>CEP</td>
                    <td>Identidade</td>
                    <td>&Oacute;rg&atilde;o Emissor</td>
                    <td>Data de emiss&atilde;o do RG</td>
                    <td>Telefone residencial</td>
                    <td>Telefone celular</td>
                    <td>E-mail do(a) bolsista</td>
                    <td>Ag&ecirc;ncia do Banco do Brasil nº</td>
                    <td>Conta corrente nº</td>
                    <td>Nome do(a) orientador(a)</td>
                    <td>Data de nascimento</td>
                    <td>Titula&ccedil;&atilde;o</td>
                    <td>Matr&iacute;cula</td>
                    <td>CPF do(a) orientador(a)</td>
                    <td>Centro</td>
                    <td>Departamento</td>
                    <td>Telefone Residencial</td>
                    <td>Telefone Celular</td>
                    <td>E-mail do(a) orientador(a)</td>
                    <td>T&iacute;tulo do projeto do(a) orientador(a)</td>
                    <td>T&iacute;tulo do plano de trabalho do(a) bolsista</td>
                    <td>Palavras-chave</td>
                </tr>            
        ';
        foreach ($this->data as $indicacao):

        $indicacao['sexo'] = $indicacao['sexo'] == "F" ? "Feminino" : "Masculino";

        $tabela .= '<tr>
                        <td>' . $indicacao['nome'] . '</td>
                        <td>' . $indicacao['cpf'] . '</td>
                        <td>' . $indicacao['curso'] . '</td>
                        <td>' . $indicacao['centro'] . '</td>
                        <td>' . $indicacao['codigo'] . '</td>
                        <td>' . date("d/m/Y", strtotime($indicacao['data_nascimento'])) . '</td>
                        <td>' . $indicacao['sexo'] . '</td>
                        <td>' . $indicacao['endereco'] . '</td>
                        <td>' . $indicacao['bairro'] . '</td>
                        <td>' . $indicacao['cep'] . '</td>
                        <td>' . $indicacao['identidade'] . '</td>
                        <td>' . $indicacao['orgao_emissor'] . '</td>
                        <td>' . date("d/m/Y", strtotime($indicacao['data_emissao'])) . '</td>
                        <td>' . $indicacao['fone_residencial'] . '</td>
                        <td>' . $indicacao['fone_celular'] . '</td>                    
                        <td>' . $indicacao['email'] . '</td>                   
                        <td>' . $indicacao['agencia'] . '</td>                    
                        <td>' . $indicacao['conta_corrente'] . '</td>                    
                        <td>' . $indicacao['orientador'] . '</td>                    
                        <td>' . date("d/m/Y", strtotime($indicacao['data_nascimento_orientador'])) . '</td>                   
                        <td>' . $indicacao['titulacao'] . '</td>                    
                        <td>' . $indicacao['matricula'] . '</td>                    
                        <td>' . $indicacao['cpf_orientador'] . '</td>                    
                        <td>' . $indicacao['centro_orientador'] . '</td>                    
                        <td>' . $indicacao['departamento_orientador'] . '</td>                    
                        <td>' . $indicacao['celular_orientador'] . '</td>                    
                        <td>' . $indicacao['telefone_orientador'] . '</td>                    
                        <td>' . $indicacao['email_orientador'] . '</td>                   
                        <td>' . $indicacao['titulo_projeto'] . '</td>
                        <td>' . $indicacao['titulo_plano'] . '</td>
                        <td>' . $indicacao['palavra_chave'] . '</td>
                    </tr>
            ';
        endforeach;
        $tabela .= "</table>";

        $arquivo = $indicacao['tipo'] . '.xls';

        header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header ("Cache-Control: no-cache, must-revalidate");
        header ("Pragma: no-cache");
        header ("Content-type: application/x-msexcel");
        header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
        header ("Content-Description: PHP Generated Data" );
        echo $tabela;
        exit;
    }

}

new Exportar();
