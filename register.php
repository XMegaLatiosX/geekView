<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="register.css?rnd=132">
        <title>Cadastro</title>
    </head>
<div class="wrapper fadeInDown">
    <div id="formContent">
        <br>
        <!-- Icon -->
        <div class="fadeIn first">
            <!-- <img src="imgs/Geek_View_Logotipo.png" id="icon" alt="User Icon"/> -->
            <h1>Cadastro</h1>
        </div>
        <div class="registroScreen">
            <?php
            if(isset($_SESSION['usuario_existe'])):
            ?>
            <div class="emailUsado">
                <p>Esse email já está sendo usado! D:</p>
            </div>
            <?php
                endif;
                unset($_SESSION['usuario_existe']);
            ?>
            <!-- Login Form -->
            <form action="checkRegister.php" method="post">
                <input type="text" id="nome" class="fadeIn second" name="nome" placeholder="Digite seu nome">
                <input type="text" id="nick" class="fadeIn third" name="nick" placeholder="Digite seu nickname">
                <input type="text" id="email" class="fadeIn second" name="email" placeholder="Digite seu email">
                <input type="password" id="senha" class="fadeIn second" name="senha" placeholder="Digite sua senha">
                <input type="password" name="checkSenha" id="checkSenha" class="fadeIn second" placeholder="Confirme sua senha"/>
                <input type="submit" class="fadeIn fourth" value="Cadastrar">
            </form>
            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="login.php">Fazer login</a>
            </div>
        </div>
    </div>
</div>