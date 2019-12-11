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
                            <a class="dropdown-item" href="#">Categoria 1</a>
                        </div>
                    </li>
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#modalModCategoria">Adicionar
                        Categoria</a>
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#modalModProduto">Adicionar
                        Produto</a>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" aria-label="Search">
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Pesquisar</button>
                </form>
            </div>
        </div>
    </nav>

    <section class="container mt-4">
        <div>
            <h1>Todos os Produtos</h1>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-4 col-6 mt-3">
                <div class="card border-0 shadow product-card">
                    <img src="img/3/250px-Star_Wars_Episódio_III_A_Vingança_dos_Sith.jpg" class="card-img">
                    <div class="card-img-overlay h-100 d-flex flex-column justify-content-end text-center">
                        <div class="bg-white p-3 rounded">
                            <h5 class="card-title card-title-overlay">Produto - <span
                                    class="badge badge-secondary">Preço</span></h5>
                            <button type="button" class="btn btn-outline-secondary" data-toggle="modal"
                                data-target="#modalProduto">Ver Mais</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row py-3">
            <nav class="mx-auto" aria-label="Page navigation example">
                <ul class="pagination shadow">
                    <li class="page-item">
                        <a class="page-link text-secondary" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link text-secondary" href="#">1</a></li>
                    <li class="page-item"><a class="page-link text-secondary" href="#">2</a></li>
                    <li class="page-item"><a class="page-link text-secondary" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link text-secondary" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
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
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Excluir</button>
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
                    <form action="categoria.php" method="POST">
                        <fieldset>
                            <div class="form-group">
                                <label for="nome">Adicionar Categoria</label>
                                <input class="form-control shadow" type="text" name="nome" value="">
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
                    <form method="POST">
                        <fieldset>
                            <div class="form-group">
                                <label for="categoria">Categoria</label>
                                <select class="form-control shadow" name="categoria"></select>
                            </div>

                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input class="form-control shadow" type="text" name="nome" value="">
                            </div>

                            <div class="form-group">
                                <label for="descricao">Descrição</label>
                                <textarea class="form-control shadow" name="descricao"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="valor">Valor</label>
                                <input class="form-control shadow" type="number" name="valor" value="" step=0.01>
                            </div>

                            <div class="form-group">
                                <label for="fabricante">Fabricante</label>
                                <input class="form-control shadow" type="text" name="fabricante" value="">
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
                    <form method="POST" enctype="multipart/form-data">
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