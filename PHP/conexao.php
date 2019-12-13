
<?php
$conexao = new mysqli('localhost','root','','loja');
if(!$conexao){
	echo 'Erro na sua conexao com banco';
};