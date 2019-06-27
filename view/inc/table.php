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
            <td><?= date("d/m/Y H:i", strtotime($indicacao['palavra_chave'])); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>