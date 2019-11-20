<?php
	include("funcoes.php");
	if(isset($_POST['id'])){
		atualizarProduto($_POST['id'],$_POST['nome'],$_POST['descricao'],$_POST['valor'],$_POST['fabricante'],$_POST['categoria']);
		vai("produto.php?listar");
	}
	else if(isset($_POST['nome'])){
		cadastrarProduto($_POST['nome'],$_POST['descricao'],$_POST['valor'],$_POST['fabricante'],$_POST['categoria']);
		vai("produto.php?listar");
	}
	if(isset($_GET['editar'])){
		$registros = listarProduto($_GET['editar']);
		$d = $registros->fetch_array();
	}
	includeHeader("Produto");
?>

<section class="container mt-5">
	<div class="row">
		<div class="col-md-5 mx-auto my-auto shadow p-5 bg-blue-grey-darken-3 text-light rounded-lg">
			<form action="produto.php" method="POST">
				<fieldset>
					<?php
						$textoBotao = 'Cadastrar';
						$nome = '';
						$descricao = '';
						$valor = '';
						$fabricante = '';
						$categoria = '';
						if(isset($_GET['editar'])){
							echo '<input type="hidden" name="id" value="'.$d['id'].'">';
							$nome = $d['nome'];
							$descricao = $d['descricao'];
							$valor = $d['valor'];
							$fabricante = $d['fabricante'];
							$categoria = $d['id_categoria'];
							$textoBotao = 'Editar';
						}
					?>
					<div class="form-group">
						<label for="categoria">Categoria</label>
						<select class="form-control shadow" name="categoria">
							<?php
								$todos = listarCategoria(0);
								while($c = $todos->fetch_array()){
									if($c['categoria'] == $categoria){
										echo '<option value="'.$c['id'].'" selected>'.$c['nome'].'</option>';
									}
									else{
									echo '<option value="'.$c['id'].'">'.$c['nome'].'</option>';
									}
								}
							?>
						</select>
					</div>
					
					<div class="form-group">
						<label for="nome">Nome</label>
						<input class="form-control shadow" type="text" name="nome" value="<?php echo $nome; ?>">
					</div>

					<div class="form-group">
						<label for="descricao">Descricao</label>
						<textarea class="form-control shadow" name="descricao"><?php echo $descricao; ?></textarea> 
					</div>

					<div class="form-group">
						<label for="valor">Valor</label>
						<input class="form-control shadow" type="number" name="valor" value="<?php echo $valor; ?>" step=0.01>
					</div>

					<div class="form-group">
						<label for="fabricante">Fabricante</label>
						<input class="form-control shadow" type="text" name="fabricante" value="<?php echo $fabricante; ?>">
					</div>

					<div class="form-row">
						<input class="btn btn-outline-light rounded-pill mx-auto shadow" type="submit" value="<?php echo $textoBotao; ?>">
					</div>
				</fieldset>
			</form>
		</div>
		<?php
				if(isset($_GET['listar'])){
					if(mysqli_num_rows(listarProduto(0)) > 0){
						echo '
						<div class="col-md-6 mx-auto my-auto shadow p-3 bg-blue-grey-darken-3 text-light rounded-lg">
							<table class="table table-striped table-dark rounded-lg shadow">
								<thead>
									<tr>
										<th scope="col">Id</th>
										<th scope="col">Nome</th>
										<th scope="col">Descrição</th>
										<th scope="col">Valor</th>
										<th scope="col">Fabricante</th>
										<th scope="col">Ação</th>
									</tr>
								</thead>
								<tbody>
						';
						$registros = listarProduto(0);
						while ($pdt = $registros->fetch_array()) {
							echo '
							<tr>
								<th scope="row">'.$pdt['id'].'</th>
								<td>'.$pdt['nome'].'</td>
								<td>'.$pdt['descricao'].'</td>
								<td>'.$pdt['valor'].'</td>
								<td>'.$pdt['fabricante'].'</td>
								<td>
									<a href="?excluir='.$pdt['id'].'"><button class="btn btn-outline-light rounded-pill shadow"><i class="fas fa-trash"></i></button></a>
									<a href="?editar='.$pdt['id'].'"><button class="btn btn-outline-light rounded-pill shadow"><i class="fas fa-edit"></i></button></a>
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
							<p>Cadastre seu primeiro produto no formulário ao lado</p>
						</div>
						';
					}
				}
				else if(isset($_GET['excluir'])){
					excluirProduto($_GET['excluir']);
					vai("produto.php?listar");
				}
			?>
	</div>
</section>

<?php
	include("footer.php");
?>