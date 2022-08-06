<?php
session_start();
include('conexao.php');

if(empty($_POST['email']) || empty($_POST['senha'])) {
    header('Location: index.php');
    exit();
}

$email = mysqli_real_escape_string($conexao, $_POST['email']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$query = "select usuario_id, usuario_email from usuario where usuario_email = '{$email}' and usuario_senha = '{$senha}'";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);
$jej = mysqli_fetch_array($result);

if ($row == 1) {
    $_SESSION['usuario_email'] = $email;
    $_SESSION['usuario_id'] = $jej['usuario_id'];
    header('Location: homepage.php');
    exit();
} else {
    $_SESSION['nao_autenticado'] = true;
    header('Location: index.php');
    exit();
}
?>