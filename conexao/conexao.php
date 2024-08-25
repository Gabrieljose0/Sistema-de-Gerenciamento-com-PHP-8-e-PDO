<?php 

include_once('config.php');

//DEFINIR DATA E HORA COM BASE NO LOCAL SELECIONADO
date_default_timezone_set('America/Sao_Paulo');




try {
    $pdo = new PDO("mysql:dbname=$banco;host=$servidor","$user","$senha");
  
} catch (Exception $e /* $e é a variável que contém a exceção, nesse caso de conexão, contém o erro */) {
    
    echo "Erro ao tentar Conectar no Banco de Dados" . $e;
}

  
?>
