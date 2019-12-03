<!DOCTYPE html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Minha Loja</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>
  <body>
	<?php
		include('funcoes.php');
	?>

    <div class="container-fluid">

	<div class="row mt-3">

		<div class="col-md-3">
			<div class="row">
				<form class="form-control">
					<input class="form-control mr-sm-2" type="text"> 
					<button class="btn btn-primary btn-large my-2 my-sm-0" type="submit">
						Pesquisar
					</button>
				</form>
			</div>
			<hr>			
				<div id="card-145598">
					<?php
						$todas = listarCategoria(0);
						while($c = $todas->fetch_array()){
							$link = '?cat='.$c['id'];
							echo '<div class="card">
									<div class="card-header">
									<a class="card-link" href="'.$link.'">
										 '.$c['nome'].'
										 </a>
									</div>
								</div>';
						}
					?>
									
				</div>
		</div>
		<div class="col-md-9">
			<div class="row">
				<?php
				$c = isset($_GET['cat']) ? $_GET['cat'] : 0;
				$todos = listarProdutoCategoria($c);
				$x = 0;
				//paginacao
				$total = $todos->num_rows;		//total de itens
				$pp = 6; 						//qtd por página
				$paginas = ceil($total / $pp);  //definimos toral de páginas

				//definindo o padrão de exibição da página 1
				$atual = isset($_GET['p']) ? $_GET['p'] : 1;
				//conta que determina a regra de consulta sql
				$inicio = ($atual - 1) * $pp;

				$sql = "SELECT * FROM produto";
				$sql .= isset($_GET['cat']) ? "WHERE id_categoria =".$c : "";
				$sql .= "LIMIT $inicio,$pp";
				$res = $GLOBALS['conexao']->query($sql);

				while($p = $res->fetch_array()){
					echo '<div class="col-md-4">
						<div class="card">
							<img class="card-img-top" alt="Bootstrap Thumbnail First" src="https://www.layoutit.com/img/people-q-c-600-200-1.jpg">
							<div class="card-block">
								<h5 class="card-title">
									'.$p['nome'].'
								</h5>
								<p class="card-text">
									R$'.$p['valor'].'							</p>
								<p>
									<a class="btn btn-primary" href="#">Ver	</a>
								</p>
							</div>
						</div>
					</div>';
					$x++;
					if($x % 3 == 0){
						echo '</div><div class="row">';
					}
				}
				?>				
				</div>
				<br>
				
					<nav class="row">
					<ul class="pagination mx-auto">
						<?php
						for($i = 1; $i <= $paginas; $i++){
							echo '
							<li class="page-item">
								<a class="page-link" href="?p='.$i.'">'.$i.'</a>
							</li>';
						}
						?>
					</ul>
					</nav>
			</div>
		</div>
	</div>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>