<?php
	include("funcoes.php");
	if(isset($_POST['id'])){
		atualizarCategoria($_POST['id'],$_POST['nome']);
		vai("categoria.php?listar");
	}
	else if(isset($_POST['nome'])){
		cadastrarCategoria($_POST['nome']);
		vai("categoria.php?listar");
	}
	if(isset($_GET['editar'])){
		$registros = listarCategoria($_GET['editar']);
		$c = $registros->fetch_array();
	}
	includeHeader("Categoria");
?>

<section class="container mt-5">
	<div class="row">
		<div class="col-md-5 mx-auto my-auto shadow p-5 bg-blue-grey-darken-3 text-light rounded-lg">
			<form action="categoria.php" method="POST">
				<fieldset>
					<?php
					$nome = '';
					$textoBotao = 'Cadastrar';
					$textoLabel = 'Nova Categoria';
					if(isset($_GET['editar'])){
						echo '<input type="hidden" name="id" value="'.$c['id'].'">';
						$nome = $c['nome'];
						$textoBotao = 'Atualizar';
						$textoLabel = 'Editar Categoria';
					}
					?>
					<div class="form-group">
						<label for="nome"><?php echo $textoLabel; ?></label>
						<input class="form-control shadow" type="text" name="nome" value="<?php echo $nome; ?>">
					</div>
					<div class="form-row">
						<input class="btn btn-outline-light rounded-pill mx-auto shadow" type="submit"
							value="<?php echo $textoBotao; ?>">
					</div>
				</fieldset>
			</form>
		</div>

		<?php
				if(isset($_GET['listar'])){
					if(mysqli_num_rows(listarCategoria(0)) > 0){
						echo '
						<div class="col-md-5 mx-auto my-auto shadow p-3 bg-blue-grey-darken-3 text-light rounded-lg">
							<table class="table table-striped table-dark rounded-lg shadow">
								<thead>
									<tr>
										<th scope="col">Id</th>
										<th scope="col">Nome</th>
										<th scope="col">Ação</th>
									</tr>
								</thead>
								<tbody>
						';
						$registros = listarCategoria(0);
						while ($cat = $registros->fetch_array()) {
							echo '
							<tr>
								<th scope="row">'.$cat['id'].'</th>
								<td>'.$cat['nome'].'</td>
								<td>
									<a href="?excluir='.$cat['id'].'"><button class="btn btn-outline-light rounded-pill shadow"><i class="fas fa-trash"></i></button></a>
									<a href="?editar='.$cat['id'].'"><button class="btn btn-outline-light rounded-pill shadow"><i class="fas fa-edit"></i></button></a>
								</td>
							</tr>
							';
						}
						echo '
								</tbody>
							</table>
						</div>
						';
					}
					else{
						echo '
						<div class="col-md-6 mx-auto my-auto shadow p-5 bg-blue-grey-darken-3 text-light rounded-lg text-center">
							<h3>Nada para Listar</h3>
							<p>Cadastre sua primeira categoria no formulário ao lado</p>
						</div>
						';
					}
				}
				else if(isset($_GET['excluir'])){
					excluirCategoria($_GET['excluir']);
					vai("categoria.php?listar");
				}
			?>
	</div>
</section>

<?php
	include("footer.php");
?>