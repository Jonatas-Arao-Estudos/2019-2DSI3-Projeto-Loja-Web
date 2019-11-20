<?php
include("funcoes.php");
	if(isset($_POST['id'])){
		atualizarProduto($_POST['id'],$_POST['nome'],$_POST['']);
		vai("produto.php?listar");
	}
	else if(isset($_POST['cat'])){
		cadastrarProduto($_POST['cat']);
		vai("produto.php?listar");
	}
	if(isset($_GET['editar'])){
		$registros = listarProduto($_GET['editar']);
		$c = $registros->fetch_array();
	}
?>
<form action="produto.php" method="POST">
	<label for="categoria">Categoria:</label>
	<select name="categoria">
		<?php
			$todos = listarCategoria(0);
			while($c = $todos->fetch_array()){
				echo '<option value="'.$c['id'].'">'.$c['nome'].'</option>';
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
		while ($cat = $registros->fetch_array()) {
			echo '<br>'.$cat['id'].' '.$cat['nome'];
			echo ' <a href="?excluir='.$cat['id'].'"><button>Excluir</button></a>';
			echo ' <a href="?editar='.$cat['id'].'"><button>Editar</button></a>';
		}
	}
	else if(isset($_GET['excluir'])){
		excluirProduto($_GET['excluir']);
		vai("produto.php?listar");
	}
?>