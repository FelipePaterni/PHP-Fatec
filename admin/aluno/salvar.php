<div class="col-sm-12 mb-4">
    <h3 class="text-primary">
        Cadastrar Aluno  
    </h3>  
</div>

<div class="col-sm-12">
    <div class="card shadow">
        <form method="post" name="frmsalvar" id="frmsalvar" class="m-3">
            <div class="form-group">
                <label for="inputText" class="col-sm-2 col-form-label">
                    Nome
                </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtnome" name="txtnome" placeholder="Digite seu nome" maxlength="50" minlength="3" />
                </div>
            </div>    
            
            <div class="form-group">
                <label for="inputText" class="col-sm-2 col-form-label">
                    E-mail
                </label>
                <div class="col-sm-12">
                    <input type="email" class="form-control" id="txtemail" name="txtemail" placeholder="Digite seu email" maxlength="50" minlength="3" />
                </div>
            </div> 

            <div class="form-group row">
                <div class="col-sm-12">
                    <input type="submit" class="btn btn-primary m-3" name="btnsalvar" id="btnsalvar" value="Salvar" />
                    <a class="btn btn-danger" href="?p=aluno/listar"><i class="bi bi-arrow-return-left"></i></a>
                </div>
            </div>            
        </form>
    </div>
</div>
<?php
if (filter_input(INPUT_POST, 'btnsalvar')) {
    $nome = filter_input(INPUT_POST, 'txtnome');
    $email = filter_input(INPUT_POST, 'txtemail');

    include_once '../class/Aluno.php';
    $al = new Aluno();

    $al->setId(null);
    $al->setNome($nome);
    $al->setEmail($email);

    echo '<div class="alert alert-primary mt-3" role="alert">'
    //. $cat->salvar()
    . $al->crud(0)
    . '</div>';
}
