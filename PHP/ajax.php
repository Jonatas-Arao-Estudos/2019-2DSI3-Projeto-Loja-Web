<?php
include('funcoes.php');
if($_POST){
    switch($_GET['acao']){
        case 'listarProduto':
            $id = $_POST['id'];
                $consulta = ListarProduto($id);
                while($produto = $consulta->fetch_array()){
                    $registros = array(
                    'produto' => array(
                        'id' => $produto['id'],
                        'id_categoria' => $produto['id_categoria'],
                        'nome' => utf8_encode($produto['nome']),
                        'valor' => $produto['valor'],
                        'fabricante' => utf8_encode($produto['fabricante']),
                        'descricao' => utf8_encode($produto['descricao'])
                    ));
                }
            echo json_encode($registros);
        break;

        case 'listarCategoria':
            $id = $_POST['id'];
                $consulta = ListarCategoria($id);
                while($categoria = $consulta->fetch_array()){
                    $registros = array(
                    'categoria' => array(
                        'id' => utf8_encode($categoria['id']),
                        'nome' => utf8_encode($categoria['nome'])
                    ));
                }
            echo json_encode($registros);
        break;
    }
}