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
        <th>Ação</th>
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
            <td><a href="<?= plugins_url('/indicacao-bolsista/view/') . 'comprovante.php?id=' . $indicacao['id']; ?>" target="_blank"><span class="glyphicon glyphicon-file"></span></a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>