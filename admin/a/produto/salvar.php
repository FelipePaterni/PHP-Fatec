<?php
$id = filter_input(INPUT_GET, 'id');

<<<<<<< Updated upstream
include_once '../class/Categoria.php';
$cat = new Categoria();
$titulo = "Cadastrar";
if(isset($id)){
    $cat->setId($id);
    $dados = $cat->listar($id);
    foreach ($dados as $mostrar) {
        $nome = $mostrar['nome'];
        $descricao = $mostrar['descricao'];
    }
    $titulo = "Editar";
}

?>
<div class="col-sm-12 mb-4">
    <h3 class="text-primary">
        <?= $titulo ?> Categoria  
=======
include_once '../class/Produto.php';
$prod = new Produto();
$titulo = "Cadastrar";
?>
<div class="col-sm-12 mb-4">
    <h3 class="text-primary">
        <?= $titulo ?> Produto  
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
                    <input type="text" class="form-control" id="txtnome" name="txtnome" placeholder="Digite seu nome" maxlength="50" minlength="3" value="<?= isset($id) ? $nome : "" ?>" />
                </div>
            </div>           

            <div class="form-group">
                <label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label">Descrição</label>
                <div class="col-sm-12">
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="txtdescricao" placeholder="Sua descrição aqui"><?= isset($id) ? $descricao : "" ?></textarea>
=======
                    <input type="text" class="form-control" id="txtnome" name="txtnome" placeholder="Digite seu nome" maxlength="50" minlength="3" value="" />
                </div>
            </div>           
            <div class="form-group">
                <label for="inputText" class="col-sm-2 col-form-label">
                    Estoque
                </label>
                <div class="col-sm-12">
                    <input type="number" class="form-control" id="txtestoque" name="txtestoque" max="200" min="0" value="" />
                </div>
            </div>           
            <div class="form-group">
                <label for="inputText" class="col-sm-2 col-form-label">
                    Valor unitário
                </label>
                <div class="col-sm-12">
                    <input type="number" step="0.5" class="form-control" id="txtvalor" name="txtvalor" max="10000" min="0" value="" />
                </div>
            </div>    

            <?php
            include_once '../class/Categoria.php';
            $cat = new Categoria();
            $dadosCat = $cat->listar(NULL);
            ?>

            <div class="form-group">
                <div class="col-sm-12">
                    <label for="exampleFormControlSelect1">Escolha a categoria</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="selcategoria">
                        <option selected disabled>Lista de categorias</option>
                        <?php
                        if (!empty($dadosCat)) {
                            foreach ($dadosCat as $mostrar) {
                                echo '<option value=""></option>';
                            }
                        }
                        ?>
                    </select>
>>>>>>> Stashed changes
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12">
                    <input type="submit" 
<<<<<<< Updated upstream
                           class="btn btn-<?= isset($id) ? "success" : "primary" ?> m-3" 
                           name="<?= isset($id) ? "btneditar" : "btnsalvar" ?>" 
                           id="<?= isset($id) ? "btneditar" : "btnsalvar" ?>" 
                           value="<?= isset($id) ? "Editar" : "Salvar" ?>" />
                    <a class="btn btn-danger" href="?p=categoria/listar"><i class="bi bi-arrow-return-left"></i></a>
=======
                           class="btn btn-primary m-3" 
                           name="btnsalvar" 
                           id="btnsalvar" 
                           value="Salvar" />
                    <a class="btn btn-danger" href="?p=produto/listar"><i class="bi bi-arrow-return-left"></i></a>
>>>>>>> Stashed changes
                </div>
            </div>            
        </form>
    </div>
</div>
<?php
if (filter_input(INPUT_POST, 'btnsalvar')) {
    $nome = filter_input(INPUT_POST, 'txtnome');
<<<<<<< Updated upstream
    $descricao = filter_input(INPUT_POST, 'txtdescricao');

    $cat->setId(null);
    $cat->setNome($nome);
    $cat->setDescricao($descricao);

    echo '<div class="alert alert-primary mt-3" role="alert">'
    //. $cat->salvar()
    . $cat->crud(0)
    . '</div>';
}
if (filter_input(INPUT_POST, 'btneditar')) {
    $nome = filter_input(INPUT_POST, 'txtnome');
    $descricao = filter_input(INPUT_POST, 'txtdescricao');

    $cat->setNome($nome);
    $cat->setDescricao($descricao);

    echo '<div class="alert alert-primary mt-3" role="alert">'
    //. $cat->salvar()
    . $cat->crud(1)
    . '</div>';
}
=======
    $estoque = filter_input(INPUT_POST, 'txtestoque');
    $valor = filter_input(INPUT_POST, 'txtvalor');
    $id_categoria = filter_input(INPUT_POST, 'selcategoria');

    $prod->setId(null);
    $prod->setNome(mb_strtoupper($nome));
    $prod->setEstoque($estoque);
    $prod->setValor_unit($valor);
    $prod->setId_categoria($id_categoria);

    echo '<div class="alert alert-primary mt-3" role="alert">'
    //. $cat->salvar()
    . $prod->crud(0)
    . '</div>';
}
    
>>>>>>> Stashed changes
