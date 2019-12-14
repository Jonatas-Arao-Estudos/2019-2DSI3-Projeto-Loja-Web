<?php
include('funcoes.php');

if($_POST){
	$destino = 'img/'.$_POST['produto'].'/'.$_FILES['foto']['name'];
	
	if(move_uploaded_file($_FILES['foto']['tmp_name'], $destino)){
		cadastrarFoto($_POST['produto'],$destino);
		echo 'Tipo: '.$_FILES['foto']['type'];
		echo '<br>Tamanho: '.$_FILES['foto']['size'];
		echo '<br>Nome: '.$_FILES['foto']['name'];
	}
}
?>
<form action="galeria.php?id=<?php echo $_GET['id'];?>" method="post" enctype="multipart/form-data">
	<input type="hidden" name="produto" value="<?php echo $_GET['id'];?>">
	Enviar Foto:
	<input type="file" name="foto">
	<input type="submit" value="Enviar">
</form>
<hr>
<?php
	if(isset($_GET['id'])){
		$galeria = listarFoto($_GET['id']);
		while($foto = $galeria->fetch_array()){
			echo '<img src="'.$foto['foto'].'" width="100px"><br>';
		}
	}
?>