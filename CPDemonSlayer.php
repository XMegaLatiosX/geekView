<?php
session_start();
include('conexao.php');


if(!$_SESSION['usuario_email']){
  $_SESSION['nao_autenticado'] = true;
  header('Location: tpcDemonSlayer.php');
  exit(); 
}
if(empty($_POST['title'])) {
  $_SESSION['noTitle'] = true;
  header('Location: tpcDemonSlayer.php');
  exit();
}
if(empty($_POST['text'])) {
  $_SESSION['noText'] = true;
  header('Location: tpcDemonSlayer.php');
  exit();
}

$title = mysqli_real_escape_string($conexao, $_POST['title']);
$text = mysqli_real_escape_string($conexao, $_POST['text']); 

$sql = "INSERT INTO postagem (topico_id, usuario_id, post_title, post_text, post_date) VALUES (4,'{$_SESSION['usuario_id']}', '$title', '$text', NOW())";

if($conexao->query($sql) === TRUE) {
  $_SESSION['postagemFeita'] = true;
  $sql11 = "SELECT usuario_rank FROM usuario WHERE usuario_email = '{$_SESSION['usuario_email']}'";
  $ha = mysqli_query($conexao, $sql11);
  $he = mysqli_fetch_array($ha);
  $rankA = $he['usuario_rank'] + 100;
  $_SESSION['jerson'] = $rankA;
  $sql = "UPDATE usuario SET `usuario_rank` = '{$rankA}' WHERE usuario_email = '{$_SESSION['usuario_email']}'";
  $result = mysqli_query($conexao, $sql);
  $row = mysqli_fetch_array($result);
}

$conexao->close();

header('Location: tpcDemonSlayer.php');
exit;
?>