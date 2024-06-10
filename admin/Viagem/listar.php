<h3>Lista de viagens</h3>
<a class="btn btn-outline-primary float-right" href="?p=viagem/salvar">Add</a>
<br><br>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Data da viagem</th>
            <th scope="col">Passageiros</th>
            <th scope="col">Onibus</th>
            <th scope="col">Destino</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include_once '../class/Viagem.php';
        $vi = new Viagem();
        $dados = $vi->listar();

        if (!empty($dados)) {
            foreach ($dados as $mostrar) {
        ?>
                <tr>
                    <td><?= $mostrar["data_viagem"] ?></td>
                    <td><?= $mostrar["nome"] ?></td>
                    <td><?= $mostrar["modelo"] ?></td>
                    <td><?= $mostrar["destino"] ?></td>
                    <td>
                        <a href="" class="btn btn-primary" title="editar registro">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="?p=viagem/excluir&id=<?= $mostrar['id'] ?>" class="btn btn-danger" data-confirm="Excluir registro?" title="excluir registro">
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