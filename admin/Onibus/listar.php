<h3>Lista de Onibus</h3>
<a class="btn btn-outline-primary float-right" href="?p=onibus/salvar">Add</a>
<br><br>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Modelo</th>
            <th scope="col">Lugares Disponiveis</th>
            <th scope="col">Destino</th>
            <th scope="col">Data da proxima viagem</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include_once '../class/Onibus.php';
        $on = new Onibus();
        $dados = $on->listar();

        if (!empty($dados)) {
            foreach ($dados as $mostrar) {
        ?>
                <tr>
                    <td><?= $mostrar["modelo"] ?></td>
                    <td><?= $mostrar["lugares"] ?></td>
                    <td><?= $mostrar["destino"] ?></td>
                    <td><?= $mostrar["data_viagem"] == null ? "Sem viagem marcada" :  $mostrar["data_viagem"] ?></td>
                    <td>
                        <a href="" class="btn btn-primary" title="editar registro">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="?p=onibus/excluir&id=<?= $mostrar['id'] ?>" class="btn btn-danger" data-confirm="Excluir registro?" title="excluir registro">
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