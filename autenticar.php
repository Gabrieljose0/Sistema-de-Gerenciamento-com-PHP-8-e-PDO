<?php 

require_once("conexao/conexao.php");
@session_start();


$usuario = $_POST['usuario'];
$senha = $_POST['senha'];


$query = $pdo->prepare("SELECT * FROM usuarios WHERE email =:email AND senha =:senha");
$query->bindValue(":email", $usuario);
$query->bindValue(":senha", $senha);
$query->execute();


$result = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = count($result);



echo $total_reg;

//CRIAR VARIÁVEIS DE SESSÃO

$_SESSION['nome_usuario'] = $result[0] ['nome'];
$_SESSION['nivel_usuario'] = $result[0] ['nivel'];  


$nivel = $result[0] ['nivel'];

//Verificar se o select trouxe um registro e se esse registro possui permissão de acessar o sistema
if($total_reg > 0) {

    if( $nivel == "Administrador" ){
        echo "<script language='javascript'> window.location ='painel-adm' </script>";
    }
    elseif($nivel == "Cliente"){
        echo "<script language='javascript'> window.location ='painel-visita' </script>";
    }

}
else{
    echo "<script laguage='javascript'> window.alert('USUÁRIO NÃO EXISTE') </script>";
    echo "<script language='javascript'> window.location ='index.php' </script>";
}


?>
