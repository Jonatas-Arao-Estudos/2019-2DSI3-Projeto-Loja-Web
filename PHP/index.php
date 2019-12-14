<?php
    include('funcoes.php');
    if(isset($_POST['produtoId'])){
        atualizarProduto($_POST['produtoId'],$_POST['produtoNome'],$_POST['produtoDescricao'],$_POST['produtoValor'],$_POST['produtoFabricante'],$_POST['produtoCategoria']);
        vai("index.php");
	}
	else if(isset($_POST['produtoNome'])){
        cadastrarProduto($_POST['produtoNome'],$_POST['produtoNome'],$_POST['produtoDescricao'],$_POST['produtoValor'],$_POST['produtoFabricante'],$_POST['produtoCategoria']);
        vai("index.php");
    }	
    if(isset($_GET['excluirProduto'])){
        excluirProduto($_GET['excluirProduto']);
        vai("index.php");
    }
    if(isset($_POST['categoriaId'])){
		atualizarCategoria($_POST['categoriaId'],$_POST['categoriaNome']);
	}
	else if(isset($_POST['categoriaNome'])){
		cadastrarCategoria($_POST['categoriaNome']);
    }
    if(isset($_GET['excluirCategoria'])){
		excluirCategoria($_GET['excluirCategoria']);
		vai("index.php");
    }	
    if($_POST){
        $formatosPermitidos = array("png", "jpeg", "jpg", "gif","PNG", "JPEG", "JPG", "GIF");
        $extensao = pathinfo($_FILES['produtoFoto']['name'], PATHINFO_EXTENSION);

        if(in_array($extensao, $formatosPermitidos)){
            $destino = 'img/'.$_POST['nomeFotoId'].'/'.$_FILES['produtoFoto']['name'];
            if(move_uploaded_file($_FILES['produtoFoto']['tmp_name'], $destino)){
                cadastrarFoto($_POST['nomeFotoId'],$destino);
                vai("index.php");
            }else{
                mkdir('img/'.$_POST['nomeFotoId'],0777,true);
                if(move_uploaded_file($_FILES['produtoFoto']['tmp_name'], $destino)){
                    cadastrarFoto($_POST['nomeFotoId'],$destino);
                    vai("index.php");
                }
            }
        }else{
            alert("Formato Inválido");
        }
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Loja</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body class="bg-blue-grey-lighten-5">
    <nav class="navbar navbar-expand-lg navbar-dark bg-blue-grey-darken-3 shadow">
        <div class="container">
            <a class="navbar-brand" href="index.php">Projeto Loja</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categorias
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                            <?php
                            $categorias = listarCategoria(0);
                            while($cat = $categorias->fetch_array()){
                                echo '
                                <a class="dropdown-item" href="?categoria='.$cat['id'].'">'.$cat['nome'].'</a>
                                ';
                            }
                        ?>

                        </div>
                    </li>
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#modalModCategoria">Adicionar
                        Categoria</a>
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#modalModProduto">Adicionar
                        Produto</a>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" name="pesquisa" type="search" aria-label="Search">
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Pesquisar</button>
                </form>
            </div>
        </div>
    </nav>

    <section class="container mt-4">
        <div>

            <?php
                if(isset($_GET['categoria'])){
                    $cat = listarCategoria($_GET['categoria'])->fetch_array();
                    echo '
                    <h1>
                        '.$cat['nome'].' - 
                        <a class="btn btn-danger shadow" href="?excluirCategoria='.$cat['id'].'">Excluir Categoria</a> -
                        <button class="btn btn-primary shadow" href="#" data-toggle="modal" data-target="#modalModCategoria" data-id='.$cat['id'].'>Editar Categoria</button>
                    </h1>
                    ';
                }
                elseif(isset($_GET['pesquisa'])){
                    echo '<h1>Resultados de: '.$_GET['pesquisa'].'</h1>';
                }
                else{
                    echo '<h1>Todos os Produtos</h1>';
                }    
            ?>

        </div>

        <div class="row">

            <?php
            $categoriaAtual = isset($_GET['categoria']) ? $_GET['categoria'] : 0;
            $pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : null;
            $produtosPorPagina = 8;
            $produtos = listarProdutoCategoria($categoriaAtual);
            $sql =  "SELECT * FROM produto";
            $sql .= $categoriaAtual > 0 ? ' WHERE id_categoria ='.$categoriaAtual : '';
            $sql .= $pesquisa != null ? ' WHERE nome LIKE "%'.$pesquisa.'%"' : '';
            $sql .= ' ORDER BY nome ASC';
            $produtos = ($categoriaAtual > 0) || ($pesquisa != null) ? $GLOBALS['conexao']->query($sql) : $produtos;
            $paginaAtual = isset($_GET['paginaAtual']) ? $_GET['paginaAtual'] : 1;

            $registros = paginacao($produtosPorPagina,$produtos,$sql,$paginaAtual);

            while($pdt = $registros['res']->fetch_array()){
                $fotoProduto = listarFoto($pdt['id']);
                if($fotoProduto->num_rows > 0){
                    $foto = $fotoProduto->fetch_array();
                    $urlFoto = $foto['foto'];
                }else{
                    $urlFoto = "https://www.layoutit.com/img/people-q-c-600-200-1.jpg";
                }

                echo '
                <div class="col-lg-3 col-md-4 col-6 mt-3" id="pdt'.$pdt['id'].'">
                    <div class="card border-0 shadow product-card">
                        <img src="'.$urlFoto.'" class="card-img">
                        <div class="card-img-overlay h-100 d-flex flex-column justify-content-end text-center">
                            <div class="bg-alfa p-3 rounded">
                                <h5 class="card-title card-title-overlay">'.utf8_encode($pdt['nome']).' - <span
                                        class="badge badge-secondary">R$ '.utf8_encode($pdt['valor']).'</span></h5>
                                <button type="button" class="btn btn-outline-dark" data-toggle="modal"
                                    data-target="#modalProduto" data-id='.utf8_encode($pdt['id']).'>Ver Mais</button>
                            </div>
                        </div>
                    </div>
                </div>
                ';
            }
        ?>

        </div>

        <div class="row py-3">
            <nav class="mx-auto" aria-label="Page navigation example">
                <ul class="pagination shadow">
                    <?php
                        $paginaAtual = isset($_GET['paginaAtual']) ? $_GET['paginaAtual'] : 1;
                        $anterior = $paginaAtual > 1 ? $paginaAtual - 1 : 0;
                        $proximo = $paginaAtual < $registros['paginas'] ? $paginaAtual + 1 : 0;
                        $link = '?';
                        $link .= $categoriaAtual > 0 ? 'categoria='.$categoriaAtual.'&' : '';
                        $link .= $pesquisa != null ? 'pesquisa='.$pesquisa.'&' : '';

                        if($anterior != 0){
                            echo '
                            <li class="page-item">
                                <a class="page-link text-secondary" href="'.$link.'paginaAtual='.$anterior.'" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            ';
                        }
                        for($i = 1; $i <= $registros['paginas']; $i++){
                            $indicador = $paginaAtual == $i ? 'bg-dark text-light' : 'text-secondary';
                            echo '<li class="page-item"><a class="page-link '.$indicador.'" href="'.$link.'paginaAtual='.$i.'">'.$i.'</a></li>';
                        }
                        if($proximo != 0){
                            echo '   
                            <li class="page-item">
                                <a class="page-link text-secondary" href="'.$link.'paginaAtual='.$proximo.'" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                            ';
                        } 
                    ?>
                </ul>
            </nav>
        </div>
    </section>

    <!-- Modal de Produto -->
    <div class="modal fade" id="modalProduto" tabindex="-1" role="dialog" aria-labelledby="modalProdutoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content bg-blue-grey-darken-3 text-light shadow">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProdutoLabel"><span id="modalNomeProduto">Nome do Produto</span> - <span
                            class="badge badge-secondary" id="modalPrecoProduto">Preço</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-light">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="img-thumbnail shadow">
                                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                                    <div class="carousel-inner" id="carouselProduto">
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleFade" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleFade" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <p><span class="h5">Fabricante: </span><span id="modalFabricanteProduto"></span></p>
                            <p><span class="h5">Descrição: </span><span id="modalDescricaoProduto"></span></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span id="modalFotoProduto"></span>
                    <a id="modalExcluirProduto"><button type="button" class="btn btn-danger">Excluir</button></a>
                    <span id="modalEditarProduto"></span>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Modificar Categoria -->
    <div class="modal fade" id="modalModCategoria" tabindex="-1" role="dialog" aria-labelledby="modalModCategoriaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-blue-grey-darken-3 text-light shadow">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalModCategoriaLabel">Adicionar Categoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-light">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmCategoria" method="POST">
                        <fieldset>
                            <div class="form-group">
                                <label for="categoriaNome">Nome</label>
                                <input class="form-control shadow" type="text" name="categoriaNome" id="categoriaNome" value="">
                            </div>
                            <div id="categoriaID"></div>
                        </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Modificar Produto -->
    <div class="modal fade" id="modalModProduto" tabindex="-1" role="dialog" aria-labelledby="modalModProdutoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-blue-grey-darken-3 text-light shadow">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalModProdutoLabel">Adicionar Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-light">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmProduto" method="POST">
                        <fieldset>
                            <div class="form-group">
                                <label for="produtoCategoria">Categoria</label>
                                <select class="form-control shadow" name="produtoCategoria" id="produtoCategoria">
                                    <?php
                                       $categorias = listarCategoria(0);
                                       while($cat = $categorias->fetch_array()){
                                           echo '
                                           <option value='.$cat['id'].'>'.$cat['nome'].'</option>
                                           ';
                                       }
                                    ?>
                                </select>
                            </div>

                            <div id="produtoID"></div>

                            <div class="form-group">
                                <label for="produtoNome">Nome</label>
                                <input class="form-control shadow" type="text" name="produtoNome" id="produtoNome">
                            </div>

                            <div class="form-group">
                                <label for="produtoDescricao">Descrição</label>
                                <textarea class="form-control shadow" name="produtoDescricao" id="produtoDescricao"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="produtoValor">Valor</label>
                                <input class="form-control shadow" type="number" name="produtoValor" id="produtoValor" step=0.01>
                            </div>

                            <div class="form-group">
                                <label for="produtoFabricante">Fabricante</label>
                                <input class="form-control shadow" type="text" name="produtoFabricante" id="produtoFabricante">
                            </div>
                        </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Modificar Foto -->
    <div class="modal fade" id="modalModFoto" tabindex="-1" role="dialog" aria-labelledby="modalModFotoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-blue-grey-darken-3 text-light shadow">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalModFotoLabel">Adicionar foto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-light">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmFotoProduto" method="POST" enctype="multipart/form-data">
                        <fieldset>
                            <div id="nomeFotoID"></div>
                            <div class="form-group">
                                <input type="file" class="form-control" id="produtoFoto" name="produtoFoto" accept="image/*">
                            </div>
                        </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#modalProduto').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var modal = $(this);
            var parametros = {
                    "id": id
                    };
            $.ajax({
                    type: "post",
                    url:"ajax.php?acao=listarProduto",
                    data: parametros,
                    dataType: "json",
                    success: function(data){      
                        modal.find('#modalFotoProduto').html('<button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#modalModFoto" data-id='+data.produto.id+'>Adicionar Foto</button>')
                        modal.find('#modalExcluirProduto').attr("href", "?excluirProduto="+data.produto.id);
                        modal.find('#modalEditarProduto').html('<button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#modalModProduto" data-id='+data.produto.id+'>Editar</button>');
                        modal.find('#modalNomeProduto').text(data.produto.nome);
                        modal.find('#modalPrecoProduto').text("R$ "+data.produto.valor);
                        modal.find('#modalFabricanteProduto').text(data.produto.fabricante);
                        modal.find('#modalDescricaoProduto').text(data.produto.descricao);
                    }
                });
                $.ajax({
                    type: "post",
                    url:"ajax.php?acao=listarFoto",
                    data: parametros,
                    dataType: "json",
                    success: function(data){
                        $carousel = "";
                        $.each(data.fotos,function(i,dados){
                            if(i == 0){
                                $carousel += '<div class="carousel-item active"><img src="'+dados.url+'" class="d-block w-100"> </div>';
                            }else{
                                $carousel += '<div class="carousel-item"><img src="'+dados.url+'" class="d-block w-100"> </div>';
                            }
                        });
                        $('#carouselProduto').html($carousel);
                    }
                });
            
        });
        $('#modalModProduto').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var modal = $(this); 
            if(id != undefined){
                var parametros = {
                    "id": id
                    };
                $.ajax({
                    type: "post",
                    url:"ajax.php?acao=listarProduto",
                    data: parametros,
                    dataType: "json",
                    success: function(data){
                        modal.find('#frmProduto #produtoID').html('<input type="hidden" name="produtoId" value="'+data.produto.id+'">');
                        modal.find('#produtoCategoria option[value='+ data.produto.id_categoria +']').attr({ selected : "selected" });
                        modal.find('#produtoNome').val(data.produto.nome);
                        modal.find('#produtoValor').val(data.produto.valor);
                        modal.find('#produtoFabricante').val(data.produto.fabricante);
                        modal.find('#produtoDescricao').val(data.produto.descricao);
                    }
                });
            }else{
                modal.find('#frmProduto #produtoID').html(null);
                modal.find('#produtoCategoria option[value=1]').attr({ selected : "selected" });
                modal.find('#produtoNome').val(null);
                modal.find('#produtoValor').val(null);
                modal.find('#produtoFabricante').val(null);
                modal.find('#produtoDescricao').val(null);
            }           
        });
        $('#modalModCategoria').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var modal = $(this); 
            if(id != undefined){
                var parametros = {
                    "id": id
                    };
                $.ajax({
                    type: "post",
                    url:"ajax.php?acao=listarCategoria",
                    data: parametros,
                    dataType: "json",
                    success: function(data){
                        modal.find('#frmCategoria #categoriaID').html('<input type="hidden" name="categoriaId" value="'+data.categoria.id+'">');
                        modal.find('#categoriaNome').val(data.categoria.nome);
                    }
                });
            }else{
                modal.find('#frmCategoria #categoriaID').html(null);
                modal.find('#categoriaNome').val(null);
            }           
        });
        $('#modalModFoto').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var modal = $(this);         
            modal.find('#frmFotoProduto #nomeFotoID').html('<input type="hidden" name="nomeFotoId" value="'+id+'">');
        });
    </script>
</body>

</html>