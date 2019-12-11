<?php
$conexao = new mysqli('localhost','root','','loja');
if(!$conexao){
	echo 'Erro na sua conexao com banco';
}

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
	if($id >0){
		$sql = 'SELECT * FROM categoria WHERE id='.$id;	
	}	
	$res = $GLOBALS['conexao']->query($sql);
	return $res;
}


//produto
//id nome descricao valor fabricante categoria

function cadastrarProduto($nome,$desc,$valor,$fab,$cat){
	$sql ='INSERT INTO produto VALUES(NULL,"'.$nome.'","'.$desc.'",'.$valor.',"'.$fab.'",'.$cat.')';
	$res = $GLOBALS['conexao']->query($sql);
	if($res){
		//SERVE PARA CRIAR DIRETÓRIOS
		mkdir('img/'.$GLOBALS['conexao']->insert_id,0777);
		
		alert("Cadastrado com sucesso");
	}
	else{
		alert("Erro ao cadastrar");
	}
}

function excluirProduto($id){
	$sql ='DELETE FROM produto WHERE id = '.$id;
	$res = $GLOBALS['conexao']->query($sql);
	if($res){
		alert("Excluido com sucesso");
	}
	else{
		alert("Erro ao excluir");
	}
}

function atualizarProduto($id,$nome,$desc,$valor,$fab,$cat){
	$sql ='UPDATE produto SET nome = "'.$nome.'", descricao = "'.$desc.'", valor = '.$valor.', fabricante = "'.$fabricante.'", id_categoria = '.$cat.' WHERE id = '.$id;
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
	if($id >0){
		$sql = 'SELECT * FROM produto WHERE id='.$id;	
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

function cadastrarFoto($produto,$foto){
	$sql = 'INSERT INTO foto VALUES(null,'.$produto.',"'.$foto.'")';
	$res = $GLOBALS['conexao']->query($sql);
	if($res){
		alert("Foto Cadastrada");
	}else{
		alert("Erro ao cadatrar foto");
	}
}
function listarFoto($produto){
	$sql = 'SELECT * FROM foto WHERE id_produto = '.$produto;
	$res = $GLOBALS['conexao']->query($sql);
	return $res;
}

function pesquisarProduto($nome){
	$sql = 'SELECT * FROM produto WHERE nome like "%'.$nome.'%"';
	$res = $GLOBALS['conexao']->query($sql);
	return $res;
}



function alert($msg){
	echo '<script>alert("'.$msg.'");</script>';
}

function vai($pra_onde){
	echo '<script>window.location="'.$pra_onde.'";</script>';	
}