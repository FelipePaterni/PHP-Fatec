<div class="col-sm-12 mb-4">
    <h3 class="text-primary">
        Cadastrar Passageiro
    </h3>
</div>

<div class="col-sm-12">
    <div class="card shadow">
        <form method="post" name="frmsalvar" id="frmsalvar" class="m-3">
            <div class="form-group">
                <label for="inputText" class="col-sm-2 col-form-label">
                    Nome Passageiro
                </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtnome" name="txtnome" placeholder="Digite seu nome" maxlength="50" minlength="3" />
                </div>
            </div>

            <div class="form-group">
                <label for="inputText" class="col-sm-2 col-form-label">
                    Data de nascimento
                </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtnome" name="txtdata" placeholder="dia/mês/ano" maxlength="10" minlength="8" />
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12">
                    <input type="submit" class="btn btn-primary m-3" name="btnsalvar" id="btnsalvar" value="Salvar" />
                    <a class="btn btn-danger" href="?p=passageiro/listar"><i class="bi bi-arrow-return-left"></i></a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
if (filter_input(INPUT_POST, 'btnsalvar')) {
    $nome = filter_input(INPUT_POST, 'txtnome');
    $data = filter_input(INPUT_POST, "txtdata");

    include_once '../class/Passageiro.php';

    $pa = new Passageiro();

    $pa->setId(null);
    $pa->setNome($nome);
    $pa->setData_nascimento($data);

    echo '<div class="alert alert-primary mt-3" role="alert">'
        //. $cat->salvar()
        . $pa->crud(0)
        . '</div>';

    echo '<meta http-equiv="refresh" content="0.1;URL=?p=passageiro/listar">';
}
