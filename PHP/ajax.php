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

        case 'listarFoto':
            $id = $_POST['id'];
            $consulta = ListarFoto($id);
            $registros = array(
                'fotos'=>array()
            );
            if($consulta->num_rows >0){
                $i = 0;
                while($foto = $consulta->fetch_array()){
                    $registros['fotos'][$i] = array(
                        'id_produto' => $foto['id_produto'],
                        'url' => $foto['foto']
                    );
                    $i++;
                }
            }else{
                $registros['fotos'][0] = array(
                    'id_produto' => $id,
                    'url' =>"https://www.layoutit.com/img/people-q-c-600-200-1.jpg"
                );
            }
            echo json_encode($registros);
        break;
    }
}