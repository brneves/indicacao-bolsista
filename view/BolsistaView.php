<?php

namespace Bolsista\view;

use Bolsista\controller\BolsistaController;
use Bolsista\model\Bolsista;

class BolsistaView
{

    private $model;

    public function indexView()
    {
        $this->model = new Bolsista();
        ?>
        <h2>Indicações</h2>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#fapema" aria-controls="fapema" role="tab" data-toggle="tab">PIBIC/FAPEMA</a></li>
            <li role="presentation"><a href="#uema" aria-controls="uema" role="tab" data-toggle="tab">PIBIC/UEMA</a></li>
            <li role="presentation"><a href="#acoes" aria-controls="acoes" role="tab" data-toggle="tab">Ações Afirmativas</a></li>
            <li role="presentation"><a href="#cnpq" aria-controls="cnpq" role="tab" data-toggle="tab">CNPq</a></li>
            <li role="presentation"><a href="#pivic" aria-controls="pivic" role="tab" data-toggle="tab">PIVIC</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="fapema">
                <br>
                <a href="<?= plugin_dir_url(__FILE__) . 'exportar.php?tipo=Bolsista PIBIC/FAPEMA/2019' ?>" class="btn btn-primary" target="_blank">Exportar</a>
                <br>
                <?php
                $data = $this->model->getAll(null, "Bolsista PIBIC/FAPEMA/2019");
                require("inc/table.php");
                ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="uema">
                <br>
                <a href="<?= plugin_dir_url(__FILE__) . 'exportar.php?tipo=Bolsista PIBIC/UEMA' ?>" class="btn btn-primary" target="_blank">Exportar</a>
                <br>
                <?php
                $data = $this->model->getAll(null, "Bolsista PIBIC/UEMA");
                require("inc/table.php");
                ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="acoes">
                <br>
                <a href="<?= plugin_dir_url(__FILE__) . 'exportar.php?tipo=Bolsista PIBIC/Ações Afirmativas' ?>" class="btn btn-primary" target="_blank">Exportar</a>
                <br>
                <?php
                $data = $this->model->getAll(null, "Bolsista PIBIC/Ações Afirmativas");
                require("inc/table.php");
                ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="cnpq">
                <br>
                <a href="<?= plugin_dir_url(__FILE__) . 'exportar.php?tipo=Bolsista PIBIC/CNPq' ?>" class="btn btn-primary" target="_blank">Exportar</a>
                <br>
                <?php
                $data = $this->model->getAll(null, "Bolsista PIBIC/CNPq");
                require("inc/table.php");
                ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="pivic">
                <br>
                <a href="<?= plugin_dir_url(__FILE__) . 'exportar.php?tipo=Bolsista PIVIC' ?>" class="btn btn-primary" target="_blank">Exportar</a>
                <br>
                <?php
                $data = $this->model->getAll(null, "Bolsista PIVIC");
                require_once("inc/table-pivic.php");
                ?>
            </div>
        </div>

        <?php
    }

    public function updateData($dados)
    {
        $dados = $dados[0];
//        var_dump($dados);

        ?>
        <form action="" method="post">
            <div class="panel panel-primary">
                <div class="panel-body">

                    <input type="hidden" name="id" value="<?= $dados['id']; ?>">

                    <div class="form-group">
                        <label for="nome">Nome completo do(a) bolsista:</label>
                        <input type="text" class="form-control" name="nome" required id="nome" value="<?= $dados['nome']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="cpf">CPF:</label>
                        <input type="number" class="form-control" name="cpf" required id="cpf" value="<?= $dados['cpf']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="curso">Curso de Graduação:</label>
                        <input type="text" class="form-control" name="curso" required id="curso" value="<?= $dados['curso']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="centro">Centro:</label>
                        <input type="text" class="form-control" name="centro" required id="centro" value="<?= $dados['centro']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="codigo">Código do(a) aluno(a):</label>
                        <input type="number" class="form-control" name="codigo" required id="codigo" value="<?= $dados['codigo']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="data_nascimento">Data de nascimento:</label>
                        <input type="date" class="form-control" name="data_nascimento" required id="data_nascimento" value="<?= $dados['data_nascimento']; ?>">
                    </div>

                    <strong>Sexo:</strong> <br>
                    <label class="radio-inline">
                        <input type="radio" name="sexo" value="M" required <?php if ($dados['sexo'] == "M") echo 'checked'; ?>> Masculino
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="sexo" value="F" required <?php if ($dados['sexo'] == "F") echo 'checked'; ?>> Feminino
                    </label>

                    <div class="form-group">
                        <label for="endereco">Endereço:</label>
                        <input type="text" class="form-control" name="endereco" required id="endereco" value="<?= $dados['endereco']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="bairro">Bairro:</label>
                        <input type="text" class="form-control" name="bairro" required id="bairro" value="<?= $dados['bairro']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="cep">CEP:</label>
                        <input type="number" class="form-control" name="cep" required id="cep" value="<?= $dados['cep']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="identidade">Identidade:</label>
                        <input type="number" class="form-control" name="identidade" required id="identidade" value="<?= $dados['identidade']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="orgao_emissor">Órgão Emissor:</label>
                        <input type="text" class="form-control" name="orgao_emissor" required id="orgao_emissor" value="<?= $dados['orgao_emissor']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="data_emissao">Data de emissão do RG:</label>
                        <input type="date" class="form-control" name="data_emissao" required id="data_emissao" value="<?= $dados['data_emissao']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="fone_residencial">Número de telefone residencial:</label>
                        <input type="text" class="form-control" name="fone_residencial" required id="fone_residencial" value="<?= $dados['fone_residencial']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="fone_celular">Número de telefone celular:</label>
                        <input type="text" class="form-control" name="fone_celular" required id="fone_celular" value="<?= $dados['fone_celular']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail do(a) bolsista:</label>
                        <input type="email" class="form-control" name="email" required id="email" value="<?= $dados['email']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="agencia">Agência do Banco do Brasil nº:</label>
                        <input type="text" class="form-control" name="agencia" id="agencia" value="<?= $dados['agencia']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="conta_corrente">Conta corrente nº:</label>
                        <input type="text" class="form-control" name="conta_corrente" id="conta_corrente" value="<?= $dados['conta_corrente']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="orientador">Nome do(a) orientador(a):</label>
                        <input type="text" class="form-control" name="orientador" required id="orientador" value="<?= $dados['orientador']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="data_nascimento_orientador">Data de nascimento:</label>
                        <input type="date" class="form-control" name="data_nascimento_orientador" required id="data_nascimento_orientador" value="<?= $dados['data_nascimento_orientador']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="titulacao">Titulação:</label>
                        <input type="text" class="form-control" name="titulacao" required id="titulacao" value="<?= $dados['titulacao']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="matricula">Matrícula:</label>
                        <input type="text" class="form-control" name="matricula" required id="matricula" value="<?= $dados['matricula']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="cpf_orientador">CPF do(a) orientador(a):</label>
                        <input type="number" class="form-control" name="cpf_orientador" required id="cpf_orientador" value="<?= $dados['cpf_orientador']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="centro_orientador">Centro:</label>
                        <input type="text" class="form-control" name="centro_orientador" required id="centro_orientador" value="<?= $dados['centro_orientador']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="departamento_orientador">Departamento:</label>
                        <input type="text" class="form-control" name="departamento_orientador" required id="departamento_orientador" value="<?= $dados['departamento_orientador']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="celular_orientador">Número de telefone celular:</label>
                        <input type="text" class="form-control" name="celular_orientador" required id="celular_orientador" value="<?= $dados['celular_orientador']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="telefone_orientador">Número de telefone residencial:</label>
                        <input type="text" class="form-control" name="telefone_orientador" id="telefone_orientador" value="<?= $dados['telefone_orientador']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="email_orientador">E-mail do(a) orientador(a):</label>
                        <input type="email" class="form-control" name="email_orientador" required id="email_orientador" value="<?= $dados['email_orientador']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="titulo_projeto">Título do projeto do(a) orientador(a):</label>
                        <input type="text" class="form-control" name="titulo_projeto" required id="titulo_projeto" value="<?= $dados['titulo_projeto']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="titulo_plano">Título do plano de trabalho do(a) bolsista:</label>
                        <input type="text" class="form-control" name="titulo_plano" required id="titulo_plano" value="<?= $dados['titulo_plano']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="palavra_chave">Palavras-chave (no máximo três):</label>
                        <input type="text" class="form-control" name="palavra_chave" required id="palavra_chave" value="<?= $dados['palavra_chave']; ?>">
                    </div>

                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="todo" value="indicacao">
                    <input type="submit" name="enviar" value="Alterar" class="btn btn-primary">

                </div>
            </div>
        </form>
        <?php
    }

    public function fapemaShortcode()
    {
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($post)):
            $inscricao = new BolsistaController();
            $result = $inscricao->create($post);

            echo "<div class='alert {$result[1]}'>{$result[0]}</div>";

            echo "<a href='" . plugin_dir_url(__FILE__) . "comprovante.php?id=" . $result[2] . "' target='_blank' title='Emitir ficha para impressão' class='btn btn-primary fontWhite'>Emitir ficha para impressão</a><br><br>";
        endif;

        ?>
        <form action="" method="post">
            <div class="panel panel-primary">
                <div class="panel-heading">Indicação de Bolsista PIBIC/FAPEMA/2019</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="nome">Nome completo do(a) bolsista:</label>
                        <input type="text" class="form-control" name="nome" required id="nome">
                    </div>

                    <div class="form-group">
                        <label for="cpf">CPF:</label>
                        <input type="number" class="form-control" name="cpf" required id="cpf">
                    </div>

                    <div class="form-group">
                        <label for="curso">Curso de Graduação:</label>
                        <input type="text" class="form-control" name="curso" required id="curso">
                    </div>

                    <div class="form-group">
                        <label for="centro">Centro:</label>
                        <input type="text" class="form-control" name="centro" required id="centro">
                    </div>

                    <div class="form-group">
                        <label for="codigo">Código do(a) aluno(a):</label>
                        <input type="number" class="form-control" name="codigo" required id="codigo">
                    </div>

                    <div class="form-group">
                        <label for="data_nascimento">Data de nascimento:</label>
                        <input type="date" class="form-control" name="data_nascimento" required id="data_nascimento">
                    </div>

                    <strong>Sexo:</strong> <br>
                    <label class="radio-inline">
                        <input type="radio" name="sexo" value="M" required> Masculino
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="sexo" value="F" required> Feminino
                    </label>

                    <div class="form-group">
                        <label for="endereco">Endereço:</label>
                        <input type="text" class="form-control" name="endereco" required id="endereco">
                    </div>

                    <div class="form-group">
                        <label for="bairro">Bairro:</label>
                        <input type="text" class="form-control" name="bairro" required id="bairro">
                    </div>

                    <div class="form-group">
                        <label for="cep">CEP:</label>
                        <input type="number" class="form-control" name="cep" required id="cep">
                    </div>

                    <div class="form-group">
                        <label for="identidade">Identidade:</label>
                        <input type="number" class="form-control" name="identidade" required id="identidade">
                    </div>

                    <div class="form-group">
                        <label for="orgao_emissor">Órgão Emissor:</label>
                        <input type="text" class="form-control" name="orgao_emissor" required id="orgao_emissor">
                    </div>

                    <div class="form-group">
                        <label for="data_emissao">Data de emissão do RG:</label>
                        <input type="date" class="form-control" name="data_emissao" required id="data_emissao">
                    </div>

                    <div class="form-group">
                        <label for="fone_residencial">Número de telefone residencial:</label>
                        <input type="text" class="form-control" name="fone_residencial" required id="fone_residencial">
                    </div>

                    <div class="form-group">
                        <label for="fone_celular">Número de telefone celular:</label>
                        <input type="text" class="form-control" name="fone_celular" required id="fone_celular">
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail do(a) bolsista:</label>
                        <input type="email" class="form-control" name="email" required id="email">
                    </div>

                    <div class="form-group">
                        <label for="agencia">Agência do Banco do Brasil nº:</label>
                        <input type="text" class="form-control" name="agencia" required id="agencia">
                    </div>

                    <div class="form-group">
                        <label for="conta_corrente">Conta corrente nº:</label>
                        <input type="text" class="form-control" name="conta_corrente" required id="conta_corrente">
                    </div>

                    <div class="form-group">
                        <label for="orientador">Nome do(a) orientador(a):</label>
                        <input type="text" class="form-control" name="orientador" required id="orientador">
                    </div>

                    <div class="form-group">
                        <label for="data_nascimento_orientador">Data de nascimento:</label>
                        <input type="date" class="form-control" name="data_nascimento_orientador" required id="data_nascimento_orientador">
                    </div>

                    <div class="form-group">
                        <label for="titulacao">Titulação:</label>
                        <input type="text" class="form-control" name="titulacao" required id="titulacao">
                    </div>

                    <div class="form-group">
                        <label for="matricula">Matrícula:</label>
                        <input type="text" class="form-control" name="matricula" required id="matricula">
                    </div>

                    <div class="form-group">
                        <label for="cpf_orientador">CPF do(a) orientador(a):</label>
                        <input type="number" class="form-control" name="cpf_orientador" required id="cpf_orientador">
                    </div>

                    <div class="form-group">
                        <label for="centro_orientador">Centro:</label>
                        <input type="text" class="form-control" name="centro_orientador" required id="centro_orientador">
                    </div>

                    <div class="form-group">
                        <label for="departamento_orientador">Departamento:</label>
                        <input type="text" class="form-control" name="departamento_orientador" required id="departamento_orientador">
                    </div>

                    <div class="form-group">
                        <label for="celular_orientador">Número de telefone celular:</label>
                        <input type="text" class="form-control" name="celular_orientador" required id="celular_orientador">
                    </div>

                    <div class="form-group">
                        <label for="telefone_orientador">Número de telefone residencial:</label>
                        <input type="text" class="form-control" name="telefone_orientador" id="telefone_orientador">
                    </div>

                    <div class="form-group">
                        <label for="email_orientador">E-mail do(a) orientador(a):</label>
                        <input type="email" class="form-control" name="email_orientador" required id="email_orientador">
                    </div>

                    <div class="form-group">
                        <label for="titulo_projeto">Título do projeto do(a) orientador(a):</label>
                        <input type="text" class="form-control" name="titulo_projeto" required id="titulo_projeto">
                    </div>

                    <div class="form-group">
                        <label for="titulo_plano">Título do plano de trabalho do(a) bolsista:</label>
                        <input type="text" class="form-control" name="titulo_plano" required id="titulo_plano">
                    </div>

                    <div class="form-group">
                        <label for="palavra_chave">Palavras-chave (no máximo três):</label>
                        <input type="text" class="form-control" name="palavra_chave" required id="palavra_chave">
                    </div>

                    <input type="hidden" name="tipo" value="Bolsista PIBIC/FAPEMA/2019">

                    <input type="submit" name="enviar" value="Enviar" class="btn btn-primary">

                </div>
            </div>
        </form>
        <?php
    }

    public function uemaShortcode()
    {
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($post)):
            $inscricao = new BolsistaController();
            $result = $inscricao->create($post);

            echo "<div class='alert {$result[1]}'>{$result[0]}</div>";

            echo "<a href='" . plugin_dir_url(__FILE__) . "comprovante.php?id=" . $result[2] . "' target='_blank' title='Emitir ficha para impressão' class='btn btn-primary fontWhite'>Emitir ficha para impressão</a><br><br>";
        endif;

        ?>
        <form action="" method="post">
            <div class="panel panel-primary">
                <div class="panel-heading">Indicação de Bolsista PIBIC/UEMA</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="nome">Nome completo do(a) bolsista:</label>
                        <input type="text" class="form-control" name="nome" required id="nome">
                    </div>

                    <div class="form-group">
                        <label for="cpf">CPF:</label>
                        <input type="number" class="form-control" name="cpf" required id="cpf">
                    </div>

                    <div class="form-group">
                        <label for="curso">Curso de Graduação:</label>
                        <input type="text" class="form-control" name="curso" required id="curso">
                    </div>

                    <div class="form-group">
                        <label for="centro">Centro:</label>
                        <input type="text" class="form-control" name="centro" required id="centro">
                    </div>

                    <div class="form-group">
                        <label for="codigo">Código do(a) aluno(a):</label>
                        <input type="number" class="form-control" name="codigo" required id="codigo">
                    </div>

                    <div class="form-group">
                        <label for="data_nascimento">Data de nascimento:</label>
                        <input type="date" class="form-control" name="data_nascimento" required id="data_nascimento">
                    </div>

                    <strong>Sexo:</strong> <br>
                    <label class="radio-inline">
                        <input type="radio" name="sexo" value="M" required> Masculino
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="sexo" value="F" required> Feminino
                    </label>

                    <div class="form-group">
                        <label for="endereco">Endereço:</label>
                        <input type="text" class="form-control" name="endereco" required id="endereco">
                    </div>

                    <div class="form-group">
                        <label for="bairro">Bairro:</label>
                        <input type="text" class="form-control" name="bairro" required id="bairro">
                    </div>

                    <div class="form-group">
                        <label for="cep">CEP:</label>
                        <input type="number" class="form-control" name="cep" required id="cep">
                    </div>

                    <div class="form-group">
                        <label for="identidade">Identidade:</label>
                        <input type="number" class="form-control" name="identidade" required id="identidade">
                    </div>

                    <div class="form-group">
                        <label for="orgao_emissor">Órgão Emissor:</label>
                        <input type="text" class="form-control" name="orgao_emissor" required id="orgao_emissor">
                    </div>

                    <div class="form-group">
                        <label for="data_emissao">Data de emissão do RG:</label>
                        <input type="date" class="form-control" name="data_emissao" required id="data_emissao">
                    </div>

                    <div class="form-group">
                        <label for="fone_residencial">Número de telefone residencial:</label>
                        <input type="text" class="form-control" name="fone_residencial" required id="fone_residencial">
                    </div>

                    <div class="form-group">
                        <label for="fone_celular">Número de telefone celular:</label>
                        <input type="text" class="form-control" name="fone_celular" required id="fone_celular">
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail do(a) bolsista:</label>
                        <input type="email" class="form-control" name="email" required id="email">
                    </div>

                    <div class="form-group">
                        <label for="agencia">Agência do Banco do Brasil nº:</label>
                        <input type="text" class="form-control" name="agencia" required id="agencia">
                    </div>

                    <div class="form-group">
                        <label for="conta_corrente">Conta corrente nº:</label>
                        <input type="text" class="form-control" name="conta_corrente" required id="conta_corrente">
                    </div>

                    <div class="form-group">
                        <label for="orientador">Nome do(a) orientador(a):</label>
                        <input type="text" class="form-control" name="orientador" required id="orientador">
                    </div>

                    <div class="form-group">
                        <label for="data_nascimento_orientador">Data de nascimento:</label>
                        <input type="date" class="form-control" name="data_nascimento_orientador" required id="data_nascimento_orientador">
                    </div>

                    <div class="form-group">
                        <label for="titulacao">Titulação:</label>
                        <input type="text" class="form-control" name="titulacao" required id="titulacao">
                    </div>

                    <div class="form-group">
                        <label for="matricula">Matrícula:</label>
                        <input type="text" class="form-control" name="matricula" required id="matricula">
                    </div>

                    <div class="form-group">
                        <label for="cpf_orientador">CPF do(a) orientador(a):</label>
                        <input type="number" class="form-control" name="cpf_orientador" required id="cpf_orientador">
                    </div>

                    <div class="form-group">
                        <label for="centro_orientador">Centro:</label>
                        <input type="text" class="form-control" name="centro_orientador" required id="centro_orientador">
                    </div>

                    <div class="form-group">
                        <label for="departamento_orientador">Departamento:</label>
                        <input type="text" class="form-control" name="departamento_orientador" required id="departamento_orientador">
                    </div>

                    <div class="form-group">
                        <label for="celular_orientador">Número de telefone celular:</label>
                        <input type="text" class="form-control" name="celular_orientador" required id="celular_orientador">
                    </div>

                    <div class="form-group">
                        <label for="telefone_orientador">Número de telefone residencial:</label>
                        <input type="text" class="form-control" name="telefone_orientador" id="telefone_orientador">
                    </div>

                    <div class="form-group">
                        <label for="email_orientador">E-mail do(a) orientador(a):</label>
                        <input type="email" class="form-control" name="email_orientador" required id="email_orientador">
                    </div>

                    <div class="form-group">
                        <label for="titulo_projeto">Título do projeto do(a) orientador(a):</label>
                        <input type="text" class="form-control" name="titulo_projeto" required id="titulo_projeto">
                    </div>

                    <div class="form-group">
                        <label for="titulo_plano">Título do plano de trabalho do(a) bolsista:</label>
                        <input type="text" class="form-control" name="titulo_plano" required id="titulo_plano">
                    </div>

                    <div class="form-group">
                        <label for="palavra_chave">Palavras-chave (no máximo três):</label>
                        <input type="text" class="form-control" name="palavra_chave" required id="palavra_chave">
                    </div>

                    <input type="hidden" name="tipo" value="Bolsista PIBIC/UEMA">

                    <input type="submit" name="enviar" value="Enviar" class="btn btn-primary">

                </div>
            </div>
        </form>
        <?php
    }

    public function acoesShortcode()
    {
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($post)):
            $inscricao = new BolsistaController();
            $result = $inscricao->create($post);

            echo "<div class='alert {$result[1]}'>{$result[0]}</div>";

            echo "<a href='" . plugin_dir_url(__FILE__) . "comprovante.php?id=" . $result[2] . "' target='_blank' title='Emitir ficha para impressão' class='btn btn-primary fontWhite'>Emitir ficha para impressão</a><br><br>";
        endif;

        ?>
        <form action="" method="post">
            <div class="panel panel-primary">
                <div class="panel-heading">Indicação de Bolsista PIBIC/Ações Afirmativas</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="nome">Nome completo do(a) bolsista:</label>
                        <input type="text" class="form-control" name="nome" required id="nome">
                    </div>

                    <div class="form-group">
                        <label for="cpf">CPF:</label>
                        <input type="number" class="form-control" name="cpf" required id="cpf">
                    </div>

                    <div class="form-group">
                        <label for="curso">Curso de Graduação:</label>
                        <input type="text" class="form-control" name="curso" required id="curso">
                    </div>

                    <div class="form-group">
                        <label for="centro">Centro:</label>
                        <input type="text" class="form-control" name="centro" required id="centro">
                    </div>

                    <div class="form-group">
                        <label for="codigo">Código do(a) aluno(a):</label>
                        <input type="number" class="form-control" name="codigo" required id="codigo">
                    </div>

                    <div class="form-group">
                        <label for="data_nascimento">Data de nascimento:</label>
                        <input type="date" class="form-control" name="data_nascimento" required id="data_nascimento">
                    </div>

                    <strong>Sexo:</strong> <br>
                    <label class="radio-inline">
                        <input type="radio" name="sexo" value="M" required> Masculino
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="sexo" value="F" required> Feminino
                    </label>

                    <div class="form-group">
                        <label for="endereco">Endereço:</label>
                        <input type="text" class="form-control" name="endereco" required id="endereco">
                    </div>

                    <div class="form-group">
                        <label for="bairro">Bairro:</label>
                        <input type="text" class="form-control" name="bairro" required id="bairro">
                    </div>

                    <div class="form-group">
                        <label for="cep">CEP:</label>
                        <input type="number" class="form-control" name="cep" required id="cep">
                    </div>

                    <div class="form-group">
                        <label for="identidade">Identidade:</label>
                        <input type="number" class="form-control" name="identidade" required id="identidade">
                    </div>

                    <div class="form-group">
                        <label for="orgao_emissor">Órgão Emissor:</label>
                        <input type="text" class="form-control" name="orgao_emissor" required id="orgao_emissor">
                    </div>

                    <div class="form-group">
                        <label for="data_emissao">Data de emissão do RG:</label>
                        <input type="date" class="form-control" name="data_emissao" required id="data_emissao">
                    </div>

                    <div class="form-group">
                        <label for="fone_residencial">Número de telefone residencial:</label>
                        <input type="text" class="form-control" name="fone_residencial" required id="fone_residencial">
                    </div>

                    <div class="form-group">
                        <label for="fone_celular">Número de telefone celular:</label>
                        <input type="text" class="form-control" name="fone_celular" required id="fone_celular">
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail do(a) bolsista:</label>
                        <input type="email" class="form-control" name="email" required id="email">
                    </div>

                    <div class="form-group">
                        <label for="agencia">Agência do Banco do Brasil nº:</label>
                        <input type="text" class="form-control" name="agencia" required id="agencia">
                    </div>

                    <div class="form-group">
                        <label for="conta_corrente">Conta corrente nº:</label>
                        <input type="text" class="form-control" name="conta_corrente" required id="conta_corrente">
                    </div>

                    <div class="form-group">
                        <label for="orientador">Nome do(a) orientador(a):</label>
                        <input type="text" class="form-control" name="orientador" required id="orientador">
                    </div>

                    <div class="form-group">
                        <label for="data_nascimento_orientador">Data de nascimento:</label>
                        <input type="date" class="form-control" name="data_nascimento_orientador" required id="data_nascimento_orientador">
                    </div>

                    <div class="form-group">
                        <label for="titulacao">Titulação:</label>
                        <input type="text" class="form-control" name="titulacao" required id="titulacao">
                    </div>

                    <div class="form-group">
                        <label for="matricula">Matrícula:</label>
                        <input type="text" class="form-control" name="matricula" required id="matricula">
                    </div>

                    <div class="form-group">
                        <label for="cpf_orientador">CPF do(a) orientador(a):</label>
                        <input type="number" class="form-control" name="cpf_orientador" required id="cpf_orientador">
                    </div>

                    <div class="form-group">
                        <label for="centro_orientador">Centro:</label>
                        <input type="text" class="form-control" name="centro_orientador" required id="centro_orientador">
                    </div>

                    <div class="form-group">
                        <label for="departamento_orientador">Departamento:</label>
                        <input type="text" class="form-control" name="departamento_orientador" required id="departamento_orientador">
                    </div>

                    <div class="form-group">
                        <label for="celular_orientador">Número de telefone celular:</label>
                        <input type="text" class="form-control" name="celular_orientador" required id="celular_orientador">
                    </div>

                    <div class="form-group">
                        <label for="telefone_orientador">Número de telefone residencial:</label>
                        <input type="text" class="form-control" name="telefone_orientador" id="telefone_orientador">
                    </div>

                    <div class="form-group">
                        <label for="email_orientador">E-mail do(a) orientador(a):</label>
                        <input type="email" class="form-control" name="email_orientador" required id="email_orientador">
                    </div>

                    <div class="form-group">
                        <label for="titulo_projeto">Título do projeto do(a) orientador(a):</label>
                        <input type="text" class="form-control" name="titulo_projeto" required id="titulo_projeto">
                    </div>

                    <div class="form-group">
                        <label for="titulo_plano">Título do plano de trabalho do(a) bolsista:</label>
                        <input type="text" class="form-control" name="titulo_plano" required id="titulo_plano">
                    </div>

                    <div class="form-group">
                        <label for="palavra_chave">Palavras-chave (no máximo três):</label>
                        <input type="text" class="form-control" name="palavra_chave" required id="palavra_chave">
                    </div>

                    <input type="hidden" name="tipo" value="Bolsista PIBIC/Ações Afirmativas">

                    <input type="submit" name="enviar" value="Enviar" class="btn btn-primary">

                </div>
            </div>
        </form>
        <?php
    }

    public function cnpqShortcode()
    {
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($post)):
            $inscricao = new BolsistaController();
            $result = $inscricao->create($post);

            echo "<div class='alert {$result[1]}'>{$result[0]}</div>";

            echo "<a href='" . plugin_dir_url(__FILE__) . "comprovante.php?id=" . $result[2] . "' target='_blank' title='Emitir ficha para impressão' class='btn btn-primary fontWhite'>Emitir ficha para impressão</a><br><br>";
        endif;

        ?>
        <form action="" method="post">
            <div class="panel panel-primary">
                <div class="panel-heading">Indicação de Bolsista PIBIC/CNPq</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="nome">Nome completo do(a) bolsista:</label>
                        <input type="text" class="form-control" name="nome" required id="nome">
                    </div>

                    <div class="form-group">
                        <label for="cpf">CPF:</label>
                        <input type="number" class="form-control" name="cpf" required id="cpf">
                    </div>

                    <div class="form-group">
                        <label for="curso">Curso de Graduação:</label>
                        <input type="text" class="form-control" name="curso" required id="curso">
                    </div>

                    <div class="form-group">
                        <label for="centro">Centro:</label>
                        <input type="text" class="form-control" name="centro" required id="centro">
                    </div>

                    <div class="form-group">
                        <label for="codigo">Código do(a) aluno(a):</label>
                        <input type="number" class="form-control" name="codigo" required id="codigo">
                    </div>

                    <div class="form-group">
                        <label for="data_nascimento">Data de nascimento:</label>
                        <input type="date" class="form-control" name="data_nascimento" required id="data_nascimento">
                    </div>

                    <strong>Sexo:</strong> <br>
                    <label class="radio-inline">
                        <input type="radio" name="sexo" value="M" required> Masculino
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="sexo" value="F" required> Feminino
                    </label>

                    <div class="form-group">
                        <label for="endereco">Endereço:</label>
                        <input type="text" class="form-control" name="endereco" required id="endereco">
                    </div>

                    <div class="form-group">
                        <label for="bairro">Bairro:</label>
                        <input type="text" class="form-control" name="bairro" required id="bairro">
                    </div>

                    <div class="form-group">
                        <label for="cep">CEP:</label>
                        <input type="number" class="form-control" name="cep" required id="cep">
                    </div>

                    <div class="form-group">
                        <label for="identidade">Identidade:</label>
                        <input type="number" class="form-control" name="identidade" required id="identidade">
                    </div>

                    <div class="form-group">
                        <label for="orgao_emissor">Órgão Emissor:</label>
                        <input type="text" class="form-control" name="orgao_emissor" required id="orgao_emissor">
                    </div>

                    <div class="form-group">
                        <label for="data_emissao">Data de emissão do RG:</label>
                        <input type="date" class="form-control" name="data_emissao" required id="data_emissao">
                    </div>

                    <div class="form-group">
                        <label for="fone_residencial">Número de telefone residencial:</label>
                        <input type="text" class="form-control" name="fone_residencial" required id="fone_residencial">
                    </div>

                    <div class="form-group">
                        <label for="fone_celular">Número de telefone celular:</label>
                        <input type="text" class="form-control" name="fone_celular" required id="fone_celular">
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail do(a) bolsista:</label>
                        <input type="email" class="form-control" name="email" required id="email">
                    </div>

                    <div class="form-group">
                        <label for="agencia">Agência do Banco do Brasil nº:</label>
                        <input type="text" class="form-control" name="agencia" required id="agencia">
                    </div>

                    <div class="form-group">
                        <label for="conta_corrente">Conta corrente nº:</label>
                        <input type="text" class="form-control" name="conta_corrente" required id="conta_corrente">
                    </div>

                    <div class="form-group">
                        <label for="orientador">Nome do(a) orientador(a):</label>
                        <input type="text" class="form-control" name="orientador" required id="orientador">
                    </div>

                    <div class="form-group">
                        <label for="data_nascimento_orientador">Data de nascimento:</label>
                        <input type="date" class="form-control" name="data_nascimento_orientador" required id="data_nascimento_orientador">
                    </div>

                    <div class="form-group">
                        <label for="titulacao">Titulação:</label>
                        <input type="text" class="form-control" name="titulacao" required id="titulacao">
                    </div>

                    <div class="form-group">
                        <label for="matricula">Matrícula:</label>
                        <input type="text" class="form-control" name="matricula" required id="matricula">
                    </div>

                    <div class="form-group">
                        <label for="cpf_orientador">CPF do(a) orientador(a):</label>
                        <input type="number" class="form-control" name="cpf_orientador" required id="cpf_orientador">
                    </div>

                    <div class="form-group">
                        <label for="centro_orientador">Centro:</label>
                        <input type="text" class="form-control" name="centro_orientador" required id="centro_orientador">
                    </div>

                    <div class="form-group">
                        <label for="departamento_orientador">Departamento:</label>
                        <input type="text" class="form-control" name="departamento_orientador" required id="departamento_orientador">
                    </div>

                    <div class="form-group">
                        <label for="celular_orientador">Número de telefone celular:</label>
                        <input type="text" class="form-control" name="celular_orientador" required id="celular_orientador">
                    </div>

                    <div class="form-group">
                        <label for="telefone_orientador">Número de telefone residencial:</label>
                        <input type="text" class="form-control" name="telefone_orientador" id="telefone_orientador">
                    </div>

                    <div class="form-group">
                        <label for="email_orientador">E-mail do(a) orientador(a):</label>
                        <input type="email" class="form-control" name="email_orientador" required id="email_orientador">
                    </div>

                    <div class="form-group">
                        <label for="titulo_projeto">Título do projeto do(a) orientador(a):</label>
                        <input type="text" class="form-control" name="titulo_projeto" required id="titulo_projeto">
                    </div>

                    <div class="form-group">
                        <label for="titulo_plano">Título do plano de trabalho do(a) bolsista:</label>
                        <input type="text" class="form-control" name="titulo_plano" required id="titulo_plano">
                    </div>

                    <div class="form-group">
                        <label for="palavra_chave">Palavras-chave (no máximo três):</label>
                        <input type="text" class="form-control" name="palavra_chave" required id="palavra_chave">
                    </div>

                    <input type="hidden" name="tipo" value="Bolsista PIBIC/CNPq">

                    <input type="submit" name="enviar" value="Enviar" class="btn btn-primary">

                </div>
            </div>
        </form>
        <?php
    }

    public function pivicShortcode()
    {
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($post)):
            $inscricao = new BolsistaController();
            $result = $inscricao->create($post);

            echo "<div class='alert {$result[1]}'>{$result[0]}</div>";

            echo "<a href='" . plugin_dir_url(__FILE__) . "comprovante.php?id=" . $result[2] . "' target='_blank' title='Emitir ficha para impressão' class='btn btn-primary fontWhite'>Emitir ficha para impressão</a><br><br>";
        endif;

        ?>
        <form action="" method="post">
            <div class="panel panel-primary">
                <div class="panel-heading">Indicação de Bolsista PIVIC</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="nome">Nome completo do(a) bolsista:</label>
                        <input type="text" class="form-control" name="nome" required id="nome">
                    </div>

                    <div class="form-group">
                        <label for="cpf">CPF:</label>
                        <input type="number" class="form-control" name="cpf" required id="cpf">
                    </div>

                    <div class="form-group">
                        <label for="curso">Curso de Graduação:</label>
                        <input type="text" class="form-control" name="curso" required id="curso">
                    </div>

                    <div class="form-group">
                        <label for="centro">Centro:</label>
                        <input type="text" class="form-control" name="centro" required id="centro">
                    </div>

                    <div class="form-group">
                        <label for="codigo">Código do(a) aluno(a):</label>
                        <input type="number" class="form-control" name="codigo" required id="codigo">
                    </div>

                    <div class="form-group">
                        <label for="data_nascimento">Data de nascimento:</label>
                        <input type="date" class="form-control" name="data_nascimento" required id="data_nascimento">
                    </div>

                    <strong>Sexo:</strong> <br>
                    <label class="radio-inline">
                        <input type="radio" name="sexo" value="M" required> Masculino
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="sexo" value="F" required> Feminino
                    </label>

                    <div class="form-group">
                        <label for="endereco">Endereço:</label>
                        <input type="text" class="form-control" name="endereco" required id="endereco">
                    </div>

                    <div class="form-group">
                        <label for="bairro">Bairro:</label>
                        <input type="text" class="form-control" name="bairro" required id="bairro">
                    </div>

                    <div class="form-group">
                        <label for="cep">CEP:</label>
                        <input type="number" class="form-control" name="cep" required id="cep">
                    </div>

                    <div class="form-group">
                        <label for="identidade">Identidade:</label>
                        <input type="number" class="form-control" name="identidade" required id="identidade">
                    </div>

                    <div class="form-group">
                        <label for="orgao_emissor">Órgão Emissor:</label>
                        <input type="text" class="form-control" name="orgao_emissor" required id="orgao_emissor">
                    </div>

                    <div class="form-group">
                        <label for="data_emissao">Data de emissão do RG:</label>
                        <input type="date" class="form-control" name="data_emissao" required id="data_emissao">
                    </div>

                    <div class="form-group">
                        <label for="fone_residencial">Número de telefone residencial:</label>
                        <input type="text" class="form-control" name="fone_residencial" required id="fone_residencial">
                    </div>

                    <div class="form-group">
                        <label for="fone_celular">Número de telefone celular:</label>
                        <input type="text" class="form-control" name="fone_celular" required id="fone_celular">
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail do(a) bolsista:</label>
                        <input type="email" class="form-control" name="email" required id="email">
                    </div>

                    <div class="form-group">
                        <label for="orientador">Nome do(a) orientador(a):</label>
                        <input type="text" class="form-control" name="orientador" required id="orientador">
                    </div>

                    <div class="form-group">
                        <label for="data_nascimento_orientador">Data de nascimento:</label>
                        <input type="date" class="form-control" name="data_nascimento_orientador" required id="data_nascimento_orientador">
                    </div>

                    <div class="form-group">
                        <label for="titulacao">Titulação:</label>
                        <input type="text" class="form-control" name="titulacao" required id="titulacao">
                    </div>

                    <div class="form-group">
                        <label for="matricula">Matrícula:</label>
                        <input type="text" class="form-control" name="matricula" required id="matricula">
                    </div>

                    <div class="form-group">
                        <label for="cpf_orientador">CPF do(a) orientador(a):</label>
                        <input type="number" class="form-control" name="cpf_orientador" required id="cpf_orientador">
                    </div>

                    <div class="form-group">
                        <label for="centro_orientador">Centro:</label>
                        <input type="text" class="form-control" name="centro_orientador" required id="centro_orientador">
                    </div>

                    <div class="form-group">
                        <label for="departamento_orientador">Departamento:</label>
                        <input type="text" class="form-control" name="departamento_orientador" required id="departamento_orientador">
                    </div>

                    <div class="form-group">
                        <label for="celular_orientador">Número de telefone celular:</label>
                        <input type="text" class="form-control" name="celular_orientador" required id="celular_orientador">
                    </div>

                    <div class="form-group">
                        <label for="telefone_orientador">Número de telefone residencial:</label>
                        <input type="text" class="form-control" name="telefone_orientador" id="telefone_orientador">
                    </div>

                    <div class="form-group">
                        <label for="email_orientador">E-mail do(a) orientador(a):</label>
                        <input type="email" class="form-control" name="email_orientador" required id="email_orientador">
                    </div>

                    <div class="form-group">
                        <label for="titulo_projeto">Título do projeto do(a) orientador(a):</label>
                        <input type="text" class="form-control" name="titulo_projeto" required id="titulo_projeto">
                    </div>

                    <div class="form-group">
                        <label for="titulo_plano">Título do plano de trabalho do(a) bolsista:</label>
                        <input type="text" class="form-control" name="titulo_plano" required id="titulo_plano">
                    </div>

                    <div class="form-group">
                        <label for="palavra_chave">Palavras-chave (no máximo três):</label>
                        <input type="text" class="form-control" name="palavra_chave" required id="palavra_chave">
                    </div>

                    <input type="hidden" name="tipo" value="Bolsista PIVIC">

                    <input type="submit" name="enviar" value="Enviar" class="btn btn-primary">

                </div>
            </div>
        </form>
        <?php
    }
}