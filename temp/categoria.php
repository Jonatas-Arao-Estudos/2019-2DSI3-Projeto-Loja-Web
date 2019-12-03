<?php
include("funcoes.php");

	 if(isset($_POST['id'])){
		atualizarCategoria($_POST['id'],$_POST['cat']);
	}
	else if(isset($_POST['cat'])){
		cadastrarCategoria($_POST['cat']);
	}	

	if(isset($_GET['editar'])){
		$registro = listarCategoria($_GET['editar']);
		$c = $registro->fetch_array();
	}
?>
<form action="categoria.php" method="post">
	<?php
		$nome = '';
		if(isset($_GET['editar'])){
			echo '<input type="hidden" name="id" value="'.$c['id'].'">';
			$nome = $c['nome'];
		}
	?>
	Nova Categoria: <input type="text" name="cat" value="<?php echo $nome;?>">
	<br>
	<input type="submit" value="Cadastrar">
</form>
<?php
	//if(isset($_GET['listar'])){
		$registros = listarCategoria(0);
		while($cat = $registros->fetch_array()){
			echo '<br>'.$cat['id'].' '.$cat['nome'];
			echo '<a href="?excluir='.$cat['id'].'"><button>Excluir</button></a>';
			echo '<a href="?editar='.$cat['id'].'"><button>Editar</button></a>';
		}
	//}
	if(isset($_GET['excluir'])){
		excluirCategoria($_GET['excluir']);
		vai("categoria.php?listar");
	}
?>