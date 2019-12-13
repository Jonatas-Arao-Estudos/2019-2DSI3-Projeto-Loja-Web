<?php
	include('funcoes.php');
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
            <a class="navbar-brand" href="#">Projeto Loja</a>
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
                    echo '<h1>'.$cat['nome'].'</h1>';
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
                echo '
                <div class="col-lg-3 col-md-4 col-6 mt-3" id="pdt'.$pdt['id'].'">
                    <div class="card border-0 shadow product-card">
                        <img src="https://www.layoutit.com/img/people-q-c-600-200-1.jpg" class="card-img">
                        <div class="card-img-overlay h-100 d-flex flex-column justify-content-end text-center">
                            <div class="bg-white p-3 rounded">
                                <h5 class="card-title card-title-overlay">'.$pdt['nome'].' - <span
                                        class="badge badge-secondary">R$ '.$pdt['valor'].'</span></h5>
                                <button type="button" class="btn btn-outline-secondary" data-toggle="modal"
                                    data-target="#modalProduto">Ver Mais</button>
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
                    <h5 class="modal-title" id="modalProdutoLabel">Nome do Produto - <span
                            class="badge badge-secondary">Preço</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-light">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="img-thumbnail shadow">
                                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="img/3/250px-Star_Wars_Episódio_III_A_Vingança_dos_Sith.jpg"
                                                class="d-block w-100">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="img/3/wp3054761.jpg" class="d-block w-100">
                                        </div>
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
                            <p><span class="h5">Fabricante: </span>s</p>
                            <p><span class="h5">Descrição: </span>s</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal"
                        data-target="#modalModFoto">Adicionar Foto</button>
                    <form method="post">
                        <input type="hidden" name="id" value="1">
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal"
                        data-target="#modalModProduto">Editar</button>
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
                    <form id="frmCategoria" action="categoria.php" method="POST">
                        <fieldset>
                            <div class="form-group">
                                <label for="categoriaNome">Nome</label>
                                <input class="form-control shadow" type="text" name="categoriaNome" value="">
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Salvar</button>
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
                                <select class="form-control shadow" name="produtoCategoria"></select>
                            </div>

                            <div class="form-group">
                                <label for="produtoNome">Nome</label>
                                <input class="form-control shadow" type="text" name="produtoNome" value="">
                            </div>

                            <div class="form-group">
                                <label for="produtoDescricao">Descrição</label>
                                <textarea class="form-control shadow" name="produtoDescricao"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="produtoValor">Valor</label>
                                <input class="form-control shadow" type="number" name="produtoValor" value="" step=0.01>
                            </div>

                            <div class="form-group">
                                <label for="produtoFabricante">Fabricante</label>
                                <input class="form-control shadow" type="text" name="produtoFabricante" value="">
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Salvar</button>
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
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="produtoFoto" name="produtoFoto">
                                    <label class="custom-file-label" for="produtoFoto">Selecione a Foto</label>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Salvar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>