<?php
session_start();
include("conexao.php");

$nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
$nick = mysqli_real_escape_string($conexao, trim($_POST['nick']));
$email = mysqli_real_escape_string($conexao, trim($_POST['email']));
$senha = mysqli_real_escape_string($conexao, trim($_POST['senha']));
$checkSenha = mysqli_real_escape_string($conexao, $_POST['checkSenha']);

$sql = "select count(*) as total from usuario where usuario_email = '$email'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);

if($row['total'] == 1) {
    $_SESSION['usuario_existe'] = true;
    header('Location: register.php');
    exit;
}

$sql = "INSERT INTO usuario (usuario_nome, usuario_nick, usuario_email, usuario_senha, usuario_data_de_entrada, usuario_rank) VALUES ('$nome', '$nick', '$email', '$senha', NOW(), 0)";

if($conexao->query($sql) === TRUE) {
    $_SESSION['status_cadastro'] = true;
}

$conexao->close();
$_SESSION['nick'] = "'$nick'";

header('Location: index.php');
exit;
?>