<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="login.css?rnd=132">
        <title>Login</title>
    </head>
<div class="wrapper fadeInDown">
    <div id="formContent">
        <br>
        <!-- Icon -->
        <div class="fadeIn first">
            <img src="imgs/Geek_View_Logotipo.png" id="icon" alt="User Icon" />
        </div>
        <div class="loginPopUp">
            <?php
            if(isset($_SESSION['nao_autenticado'])):
            ?>
            <div class="erroLogin">
                <p class="textErroLogin">Usuário ou senha inválidos!</p>
            </div>
            <?php
                endif;
                unset($_SESSION['nao_autenticado']);
            ?>
            <br><br>
            <!-- Login Form -->
            <form action="login.php" method="post">
                <input type="text" id="email" class="fadeIn second" name="email" placeholder="Digite seu email">
                <input type="password" id="senha" class="fadeIn third" name="senha" placeholder="Digite sua senha">
                <input type="submit" class="fadeIn fourth" value="Entrar">
            </form>
            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="register.php">Criar conta</a>
            </div>
        </div>
    </div>
</div>