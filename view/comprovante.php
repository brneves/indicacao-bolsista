<?php

require_once("../vendor/dompdf/dompdf_config.inc.php");

class Comprovante
{

    private $id;
    private $conn;
    private $data;
    private $table = 'indicacao_bolsista';

    public function __construct()
    {
        $this->connect();
        $this->id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $this->getData();
        $this->gerarCertificado();
    }

    public function connect()
    {
        //$this->conn = new PDO("mysql:host=localhost;dbname=ppg", "root", "");
        $this->conn = new PDO("mysql:host=localhost;dbname=ppg", "ppg", "ppg.12qwaszx");
    }

    public function getData()
    {
        $data = $this->conn->query("SELECT * FROM {$this->table} WHERE id = {$this->id}");
        $this->data = $data->fetch(PDO::FETCH_ASSOC);
    }

    public function gerarCertificado()
    {

//        var_dump($this->data);
        $this->data['sexo'] = $this->data['sexo'] == "F" ? "Feminino" : "Masculino";

        $agencia = '<tr>
                        <td><strong>Agência do Banco do Brasil nº: </strong></td>
                        <td>' . $this->data['agencia'] . '</td>
                    </tr>
                    <tr>
                        <td><strong>Conta corrente nº: </strong></td>
                        <td>' . $this->data['conta_corrente'] . '</td>
                    </tr>';

        if($this->data['tipo'] == "Bolsista PIBIC/FAPEMA/2019"):
            $img = "fapema.jpg";
        endif;
        if($this->data['tipo'] == "Bolsista PIBIC/UEMA"):
            $img = "uema.jpg";
        endif;
        if($this->data['tipo'] == "Bolsista PIBIC/Ações Afirmativas"):
            $this->data['tipo'] = "Bolsista PIBIC/Acoes Afirmativas";
            $img = "acoes.jpg";
        endif;
        if($this->data['tipo'] == "Bolsista PIBIC/CPNq"):
            $img = "cnpq.jpg";
        endif;
        if($this->data['tipo'] == "Bolsista PIVIC"):
            $img = "pivic.jpg";
            $agencia = null;
        endif;

        header('Content-Type: text/html; charset=utf-8');
        $dompdf = new DOMPDF();
        $dompdf->load_html('
            <!DOCTYPE html>
            <html lang="pt-br">
            <head>
                <meta charset="ISO-8859-1">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <style>
                table {
                      width: 100%;
                    }
                    table {
                      border-collapse: collapse;
                    }
                    
                    table, th, td {
                      border: 1px solid black;
                    }
                    h3 { margin: 0px !important; }
                    tr:nth-child(even) {background-color: #f2f2f2;}
                </style>
                <title>Indicação ' . $this->data['tipo'] . '</title>
            </head>
            <body>
            <div class="container-fluid">
            <img src="'. $_SERVER['DOCUMENT_ROOT'] .'/wp-content/plugins/indicacao-bolsista/images/'. $img .'" alt="'. $this->data['tipo'] .'" width="200px">
            <h3>Indicação ' . utf8_encode($this->data['tipo']) . '</h3>
            <table class="table table-bordered table-striped">
                    <tr>
                        <td><strong>Nome completo do(a) bolsista:</strong></td>
                        <td>' . utf8_encode($this->data['nome']) . '</td>
                    </tr>
                    <tr>
                        <td><strong>CPF: </strong></td>
                        <td>' . utf8_encode($this->data['cpf']) . '</td>
                    </tr>
                    <tr>
                        <td><strong>Curso de Graduação: </strong></td>
                        <td>' . utf8_encode($this->data['curso']) . '</td>
                    </tr>
                    <tr>
                        <td><strong>Centro: </strong></td>
                        <td>' . utf8_encode($this->data['centro']) . '</td>
                    </tr>
                    <tr>
                        <td><strong>Código do(a) aluno(a): </strong></td>
                        <td>' . utf8_encode($this->data['codigo']) . '</td>
                    </tr>
                    <tr>
                        <td><strong>Data de nascimento: </strong></td>
                        <td>' . date("d/m/Y", strtotime($this->data['data_nascimento'])) . '</td>
                    </tr>
                    <tr>
                        <td><strong>Sexo: </strong></td>
                        <td>' . utf8_encode($this->data['sexo']) . '</td>
                    </tr>
                    <tr>
                        <td><strong>Endereço: </strong></td>
                        <td>' . utf8_encode($this->data['endereco']) . '</td>
                    </tr>
                    <tr>
                        <td><strong>Bairro: </strong></td>
                        <td>' . utf8_encode($this->data['bairro']) . '</td>
                    </tr>
                    <tr>
                        <td><strong>CEP: </strong></td>
                        <td>' . $this->data['cep'] . '</td>
                    </tr>
                    <tr>
                        <td><strong>Identidade: </strong></td>
                        <td>' . $this->data['identidade'] . '</td>
                    </tr>
                    <tr>
                        <td><strong>Órgão Emissor: </strong></td>
                        <td>' . utf8_encode($this->data['orgao_emissor']) . '</td>
                    </tr>
                    <tr>
                        <td><strong>Data de emissão do RG:</strong></td>
                        <td>' . date("d/m/Y", strtotime($this->data['data_emissao'])) . '</td>
                    </tr>
                    <tr>
                        <td><strong>Número de telefone residencial: </strong></td>
                        <td>' . $this->data['fone_residencial'] . '</td>
                    </tr>
                    <tr>
                        <td><strong>Número de telefone celular: </strong></td>
                        <td>' . $this->data['fone_celular'] . '</td>
                    </tr>
                    <tr>
                        <td><strong>E-mail do(a) bolsista: </strong></td>
                        <td>' . $this->data['email'] . '</td>
                    </tr>
                    '. $agencia .'
                    <tr>
                        <td><strong>Nome do(a) orientador(a):</strong></td>
                        <td>' . utf8_encode($this->data['orientador']) . '</td>
                    </tr>
                    <tr>
                        <td><strong>Data de nascimento: </strong></td>
                        <td>' . date("d/m/Y", strtotime($this->data['data_nascimento_orientador'])) . '</td>
                    </tr>
                    <tr>
                        <td><strong>Titulação: </strong></td>
                        <td>' . utf8_encode($this->data['titulacao']) . '</td>
                    </tr>
                    <tr>
                        <td><strong>Matrícula: </strong></td>
                        <td>' . $this->data['matricula'] . '</td>
                    </tr>
                    <tr>
                        <td><strong>CPF do(a) orientador(a): </strong></td>
                        <td>' . $this->data['cpf_orientador'] . '</td>
                    </tr>
                    <tr>
                        <td><strong>Centro: </strong></td>
                        <td>' . utf8_encode($this->data['centro_orientador']) . '</td>
                    </tr>
                    <tr>
                        <td><strong>Departamento: </strong></td>
                        <td>' . utf8_encode($this->data['departamento_orientador']) . '</td>
                    </tr>
                    <tr>
                        <td><strong>Número de telefone celular: </strong></td>
                        <td>' . $this->data['celular_orientador'] . '</td>
                    </tr>
                    <tr>
                        <td><strong>Número de telefone residencial: </strong></td>
                        <td>' . $this->data['telefone_orientador'] . '</td>
                    </tr>
                    <tr>
                        <td><strong>E-mail do(a) orientador(a): </strong></td>
                        <td>' . $this->data['email_orientador'] . '</td>
                    </tr>
                    <tr>
                        <td><strong>Título do projeto do(a) orientador(a): </strong></td>
                        <td>' . utf8_encode($this->data['titulo_projeto']) . '</td>
                    </tr>
                    <tr>
                        <td><strong>Título do plano de trabalho do(a) bolsista: </strong></td>
                        <td>' . utf8_encode($this->data['titulo_plano']) . '</td>
                    </tr>
                    <tr>
                        <td><strong>Palavras-chave (no máximo três): </strong></td>
                        <td>' . utf8_encode($this->data['palavra_chave']) . '</td>
                    </tr>
            </table>
            <br>
            <p style="text-align: center">________________________________________________ <br>Assinatura do(a) Bolsista</p>
            <p style="text-align: center">________________________________________________ <br>Assinatura do(a) Orientador(a)</p>
            <p style="text-align: center"><strong>CP/PPG/UEMA</strong></p>
            <p><small>Cidade Universitária Paulo VI, Av. Lourenço Vieira da Silva, nº 1000 - Bairro: Jardim São Cristovão<br>CEP 65055-310 – São Luís/MA. FONE: (98) 2016-8100. </small></p>
            </div>
            </body>
        </html>
        ');

        $dompdf->set_paper("A4");
        $dompdf->render();
        $dompdf->stream("ficha-indicacao-bolsista.pdf", ["Attachment" => false]);
    }

}

new Comprovante();
