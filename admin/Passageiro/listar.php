<h3>Lista de Passageiros</h3>
<a class="btn btn-outline-primary float-right" href="?p=passageiro/salvar">Add</a>
<br><br>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Data de nascimento</th>
            <th scope="col">Data da proxima viagem</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include_once '../class/Passageiro.php';
        $pa = new Passageiro();
        $dados = $pa->listar();

        if (!empty($dados)) {
            foreach ($dados as $mostrar) {
        ?>
                <tr>
                    <td><?= $mostrar["nome"] ?></td>
                    <td><?= $mostrar["data_nascimento"] ?></td>
                    <td><?= $mostrar["data_viagem"] == null ? "Sem viagem marcada" :  $mostrar["data_viagem"] ?></td>
                    <td>
                        <a href="" class="btn btn-primary" title="editar registro">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="?p=passageiro/excluir&id=<?= $mostrar['id'] ?>" class="btn btn-danger" data-confirm="Excluir registro?" title="excluir registro">
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