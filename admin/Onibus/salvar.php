<div class="col-sm-12 mb-4">
    <h3 class="text-primary">
        Cadastrar Onibus
    </h3>
</div>

<div class="col-sm-12">
    <div class="card shadow">
        <form method="post" name="frmsalvar" id="frmsalvar" class="m-3">
            <div class="form-group">
                <label for="inputText" class="col-sm-2 col-form-label">
                    Modelo do Onibus
                </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtmodelo" name="txtmodelo" placeholder="Digite o nome do modelo" maxlength="100" minlength="3" />
                </div>
            </div>



            <div class="form-group">
                <label for="inputText" class="col-sm-2 col-form-label">
                    Destino
                </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtdestino" name="txtdestino" placeholder="Digite o destino" maxlength="100" minlength="8" />
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12">
                    <input type="submit" class="btn btn-primary m-3" name="btnsalvar" id="btnsalvar" value="Salvar" />
                    <a class="btn btn-danger" href="?p=onibus/listar"><i class="bi bi-arrow-return-left"></i></a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
if (filter_input(INPUT_POST, 'btnsalvar')) {
    $modelo = filter_input(INPUT_POST, 'txtmodelo');
    $destino = filter_input(INPUT_POST, "txtdestino");

    include_once '../class/Onibus.php';

    $pa = new Onibus();

    $pa->setId(null);
    $pa->setModelo($modelo);
    $pa->setLugares(44);
    $pa->setDestino($destino);

    echo '<div class="alert alert-primary mt-3" role="alert">'
        //. $cat->salvar()
        . $pa->crud(0)
        . '</div>';

    echo '<meta http-equiv="refresh" content="0.1;URL=?p=onibus/listar">';
}
