<?php
$conexao = new mysqli('localhost','root','usbw','loja');
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

function listarCategoria(){
	$sql = 'SELECT * FROM categoria ORDER BY nome ASC';
	$res = $GLOBALS['conexao']->query($sql);
	return $res;
}

function alert($msg){
	echo '<script>alert("'.$msg.'");</script>';
}