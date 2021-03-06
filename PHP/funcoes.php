<?php
include("conexao.php");

//Funções para Banco de Dados

//Categorias
function cadastrarCategoria($nome){
	$sql ='INSERT INTO categoria VALUES(NULL,"'.$nome.'")';
	$res = $GLOBALS['conexao']->query($sql);
	if($res){
		alert("Cadastrado com sucesso");
	}
	else{
		alert("Erro ao cadastrar");
	}
}

function excluirCategoria($id){
	$sql ='DELETE FROM categoria WHERE id = '.$id;
	$res = $GLOBALS['conexao']->query($sql);
	if($res){
		alert("Excluido com sucesso");
	}
	else{
		alert("Erro ao excluir");
	}
}

function atualizarCategoria($id,$nome){
	$sql ='UPDATE categoria SET nome = "'.$nome.'" WHERE id = '.$id;
	$res = $GLOBALS['conexao']->query($sql);
	if($res){
		alert("Atualizado com sucesso");
	}
	else{
		alert("Erro ao atualizar");
	}
}

function listarCategoria($id){
	$sql = 'SELECT * FROM categoria ORDER BY nome ASC';
	if($id > 0){
		$sql = 'SELECT * FROM categoria WHERE id ='.$id;
	}
	$res = $GLOBALS['conexao']->query($sql);
	return $res;
}

//Produto
function cadastrarProduto($nome,$descricao,$valor,$fabricante,$categoria){
	$sql ='INSERT INTO produto VALUES(NULL,"'.$nome.'","'.$descricao.'","'.$valor.'","'.$fabricante.'","'.$categoria.'")';
	$res = $GLOBALS['conexao']->query($sql);
	if($res){
		//Serve para criar diretório
		mkdir('img/'.$GLOBALS['conexao']->insert_id,0777,true);
		alert("Cadastrado com sucesso");
	}
	else{
		alert("Erro ao cadastrar");
	}
}

function excluirProduto($id){
	$consulta = ListarFoto($id);
	$sql ='DELETE FROM produto WHERE id = '.$id;
	$res = $GLOBALS['conexao']->query($sql);
	if($res){
		while($foto = $consulta->fetch_array()){
			unlink($foto['foto']);
		}
		rmdir('img/'.$id);
		alert("Excluido com sucesso");
	}
	else{
		alert("Erro ao excluir");
	}
}

function atualizarProduto($id,$nome,$descricao,$valor,$fabricante,$categoria){
	$sql ='UPDATE produto SET nome = "'.$nome.'" , descricao = "'.$descricao.'" , valor = "'.$valor.'" , fabricante = "'.$fabricante.'" , id_categoria = "'.$categoria.'" WHERE id = '.$id;
	$res = $GLOBALS['conexao']->query($sql);
	if($res){
		alert("Atualizado com sucesso");
	}
	else{
		alert("Erro ao atualizar");
	}
}

function listarProduto($id){
	$sql = 'SELECT * FROM produto ORDER BY nome ASC';
	if($id > 0){
		$sql = 'SELECT * FROM produto WHERE id ='.$id;
	}
	$res = $GLOBALS['conexao']->query($sql);
	return $res;
}

function listarProdutoCategoria($categoria){
	$sql = 'SELECT * FROM produto WHERE id_categoria = '.$categoria.' ORDER BY nome ASC';
	if($categoria <=0){
		$sql = 'SELECT * FROM produto  ORDER BY nome ASC';	
	}	
	$res = $GLOBALS['conexao']->query($sql);
	return $res;
}
//Foto
function cadastrarFoto($produto,$foto){
	$sql = 'INSERT INTO foto VALUES(null,'.$produto.',"'.$foto.'")';
	$res = $GLOBALS['conexao']->query($sql);
	if($res){
		alert("Foto Cadastrada");
	}else{
		alert("Erro ao cadastrar foto");
	}
}

function listarFoto($produto){
	$sql = 'SELECT * FROM foto WHERE id_produto ='.$produto;
	$res = $GLOBALS['conexao']->query($sql);
	return $res;
}

function pesquisarProduto($nome){
	$sql = 'SELECT * FROM produto WHERE nome like "%'.$nome.'%"';
	$res = $GLOBALS['conexao']->query($sql);
	return $res;
}

function paginacao($pp, $res , $sql, $paginaAtual){
	$total = $res->num_rows;		//total de itens
	$paginas = ceil($total / $pp);  //definimos toral de páginas
	//definindo o padrão de exibição da página 1
	$atual = isset($paginaAtual) ? $paginaAtual : 1;
	//conta que determina a regra de consulta sql
	$inicio = ($atual - 1) * $pp;
	$sql .= " LIMIT $inicio,$pp";
	$resPag = $GLOBALS['conexao']->query($sql);
	$paginas = isset($_GET['q']) ? ceil(($res->num_rows)/$pp) : $paginas;

	return array(
		"paginas" => $paginas ,
		"res" => $resPag
	);
}

function alert($msg){
	echo '<script>alert("'.$msg.'");</script>';
}

function vai($pra_onde){
	echo '<script>window.location="'.$pra_onde.'";</script>';	
}