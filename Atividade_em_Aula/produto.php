<style>
table tr:hover{
	background-color: blue;
	color:white;
}

</style>
<?php
include("funcoes.php");

	 if(isset($_POST['id'])){
		atualizarProduto($_POST['id'],$_POST['produto']);
	}
	else if(isset($_POST['produto'])){
		cadastrarProduto($_POST['produto'],$_POST['descricao'],$_POST['valor'],$_POST['fabricante'],$_POST['categoria']);
	}	

	if(isset($_GET['editar'])){
		$registro = listarProduto($_GET['editar']);
		$c = $registro->fetch_array();
	}
?>
<form action="produto.php" method="post">
	Categoria: 	<select name="categoria">
					<?php
						$todos = listarCategoria(0);
						while($c = $todos->fetch_array()){
							echo '<option value='.$c['id'].'>'.$c['nome'].'</option>';
						}
					?>
				</select><br>
	<?php
		$nome = '';
		if(isset($_GET['editar'])){
			echo '<input type="hidden" name="id" value="'.$c['id'].'">';
			$nome = $c['nome'];
		}
	?>
	Produto: <input type="text" name="produto" value="<?php echo $nome;?>"><br>
	Descricao: <textarea name="descricao" value="<?php echo $descricao;?>"></textarea><br>
	Valor: <input type="number" step="0.01" name="valor" value="<?php echo $valor;?>"><br>
	Fabricante: <input type="text" name="fabricante" value="<?php echo $fabricante;?>"><br>
	<br>
	<input type="submit" value="Cadastrar">
</form>
<table>
	<tr>
		<td>#</td>
		<td>Produto</td>
		<td>Controles</td>
	</tr>
<?php
	//if(isset($_GET['listar'])){
		$registros = listarProduto(0);
		while($cat = $registros->fetch_array()){
			echo '<tr><td>'.$cat['id'].'</td><td>'.$cat['nome'].'</td>';
			echo '<td><a href="?excluir='.$cat['id'].'"><button>Excluir</button></a>';
			echo '<a href="?editar='.$cat['id'].'"><button>Editar</button></a>';
			echo '<a href="galeria.php?id='.$cat['id'].'"><button>Galeria</button></a></td></tr>';
		}
	//}
	if(isset($_GET['excluir'])){
		excluirProduto($_GET['excluir']);
		vai("categoria.php?listar");
	}
?>
</table>