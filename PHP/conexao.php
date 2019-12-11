<?php
$conexao = new mysqli('localhost','root','usbw','loja');
if(!$conexao){
	echo 'Erro na sua conexao com banco';
};
