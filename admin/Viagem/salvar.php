<div class="col-sm-12 mb-4">
    <h3 class="text-primary">
        Cadastrar nova Viagem
    </h3>
</div>

<div class="col-sm-12">
    <div class="card shadow">
        <form method="post" name="frmsalvar" id="frmsalvar" class="m-3">
            <div class="form-group">
                <label for="inputText" class="col-sm-2 col-form-label">
                    Data da Viagem
                </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="data" name="data" placeholder="dia/mês/ano" maxlength="10" minlength="8" />
                </div>
            </div>

            <?php
            include_once '../class/Passageiro.php';
            $e = new Passageiro();
            $dadosEquipe = $e->lista_list(null);
            ?>

            <div class="form-group">
                <div class="col-sm-12">
                    <label for="exampleFormControlSelect1">Escolha o passageiro</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="selep">
                        <option selected disabled>Lista de passageiro</option>
                        <?php
                        if (!empty($dadosEquipe)) {
                            foreach ($dadosEquipe as $mostrar) {
                                echo "<option value='$mostrar[0]'>$mostrar[1]</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>



            <?php
            include_once '../class/Onibus.php';
            $e = new Onibus();
            $dadosEquipe = $e->lista_list(null);
            ?>

            <div class="form-group">
                <div class="col-sm-12">
                    <label for="exampleFormControlSelect2">Escolha o Onibus</label>
                    <select class="form-control" id="exampleFormControlSelect2" name="seleo">
                        <option selected disabled>Lista de onibus</option>
                        <?php
                        if (!empty($dadosEquipe)) {
                            foreach ($dadosEquipe as $mostrar) {
                                echo "<option value='$mostrar[0]'>$mostrar[1]</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>


            <div class="form-group row">
                <div class="col-sm-12">
                    <input type="submit" class="btn btn-primary m-3" name="btnsalvar" id="btnsalvar" value="Salvar" />
                    <a class="btn btn-danger" href="?p=viagem/listar"><i class="bi bi-arrow-return-left"></i></a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
if (filter_input(INPUT_POST, 'btnsalvar')) {
    $passageiro = filter_input(INPUT_POST, 'selep');
    $onibus = filter_input(INPUT_POST, 'seleo');
    $data = filter_input(INPUT_POST, 'data');

    include_once '../class/Viagem.php';
    $vi = new Viagem();

    $vi->setId_passageiro($passageiro);
    $vi->setId_onibus($onibus);
    $vi->setData_viagem($data);

    echo '<div class="alert alert-primary mt-3" role="alert">'
        //. $cat->salvar()
        . $vi->crud(0)
        . '</div>';

    
}
 