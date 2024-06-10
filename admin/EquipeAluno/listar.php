<h3>Lista de EquipeAlunos</h3>
<a class="btn btn-outline-primary float-right" href="?p=EquipeAluno/salvar">Add</a>
<br><br>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">EquipeAluno</th>
            <th scope="col">Categoria</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include_once '../class/EquipeAluno.php';
        $p = new EquipeAluno();
        $dados = $p->listar(NULL);

        if (!empty($dados)) {
            foreach ($dados as $mostrar) {
                ?>
                <tr>
                    <th scope="row"><?= $mostrar[0] ?></th>
                    <td><?= $mostrar[1] ?></td>
                    <td><?= $mostrar[2] ?></td>
                    <td>
                        <a href="?p=EquipeAluno/salvar&id=<?= $mostrar[0] ?>" class="btn btn-primary" title="editar registro">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="?p=EquipeAluno/excluir&id=<?= $mostrar[0] ?>" class="btn btn-danger" data-confirm="Excluir registro?" title="excluir registro">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr> 
                <?php
            }
        }
        ?>
    </tbody>
</table>
