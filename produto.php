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
?>
<form action="produto.php" method="POST">
	<?php
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
		}
	?>
	<label for="categoria">Categoria:</label>
	<select name="categoria">
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
	</select><br>
	<label for="nome">Nome:</label>
	<input type="text" name="nome" value=""><br>
	<label for="descricao">Descricao:</label><br>
	<textarea name="descricao"></textarea> <br>
	<label for="valor">Valor:</label>
	<input type="number" name="valor" value="" step=0.01><br>
	<label for="fabricante">Fabricante:</label>
	<input type="text" name="fabricante" value=""><br>
	<input type="submit" value="Enviar">
</form>
<?php
	if(isset($_GET['listar'])){
		$registros = listarProduto(0);
		while ($pro = $registros->fetch_array()) {
			echo '<br>'.$pro['id'].' '.$pro['nome'];
			echo ' <a href="?excluir='.$pro['id'].'"><button>Excluir</button></a>';
			echo ' <a href="?editar='.$pro['id'].'"><button>Editar</button></a>';
		}
	}
	else if(isset($_GET['excluir'])){
		excluirProduto($_GET['excluir']);
		vai("produto.php?listar");
	}
?>