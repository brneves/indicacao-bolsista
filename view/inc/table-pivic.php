<table class="table table-striped">
    <thead>
    <tr>
        <th>Bolsista</th>
        <th>Curso</th>
        <th>Centro</th>
        <th>Orientador</th>
        <th>Título do projeto</th>
        <th>Título do plano</th>
        <th>Palavras-chave</th>
        <th>Data Cadastro</th>
        <th width="150px">Ação</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $indicacao): ?>
        <tr>
            <td><?= $indicacao['nome'] . "<br><small>" . $indicacao['cpf'] . "</small>"; ?></td>
            <td><?= $indicacao['curso']; ?></td>
            <td><?= $indicacao['centro']; ?></td>
            <td><?= $indicacao['orientador'] . "<br><small>". $indicacao['cpf_orientador'] ."</small>"; ?></td>
            <td><?= $indicacao['titulo_projeto']; ?></td>
            <td><?= $indicacao['titulo_plano']; ?></td>
            <td><?= $indicacao['palavra_chave']; ?></td>
            <td><?= date("d/m/Y H:i", strtotime($indicacao['created_at'])); ?></td>
            <td>
                <a href="<?= plugins_url('/indicacao-bolsista/view/') . 'comprovante.php?id=' . $indicacao['id']; ?>" target="_blank" class="btn btn-success"><span class="glyphicon glyphicon-file"></span></a>
                <a href="<?= admin_url('admin.php?page=indicacao&id=') . $indicacao['id']; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
                <a href="<?= admin_url('admin.php?page=indicacao&del=') . $indicacao['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>