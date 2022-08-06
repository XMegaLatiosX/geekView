<?php
session_start();
include('conexao.php');
if(isset($_SESSION['usuario_email'])) {
$queryNick = "SELECT * FROM usuario WHERE usuario_email = '{$_SESSION['usuario_email']}'";

$nick = mysqli_query($conexao, $queryNick);

$row1 = mysqli_fetch_array($nick);}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="base.css">
        <link rel="stylesheet" type="text/css" href="profile.css">
        <link rel="shortcut icon" href="#">
        <script>
        function openSidebar() {
            document.getElementById("sidebar").style.animation = "sidebar 1s 1";
            
            setTimeout(() => {
            document.getElementById("sidebar").style.left = "0px";
          }, 975);
        }
        
        function closeSidebar() {
            document.getElementById("sidebar").style.animation = "Csidebar 1s 1";
            
            setTimeout(() => {
            document.getElementById("sidebar").style.left = "-300px";
          }, 975);
          }
        </script>
        <title><?php echo $row1['usuario_nick'];?></title>
    </head>
    <body>
    <div id="header" class="header">

      <div id="sidebar">
          <button class="btnCSidebar" onclick="closeSidebar()">☰</button>
          <a class="sidebaritem" href="homepage.php">Início</a>
          <a class="sidebaritem" href="profile.php">Perfil</a>
          <a class="sidebaritem" href="logout.php">Deslogar</a>
          <div class="RPdiv" onclick="window.location.href = 'homepage.php';">
              <img src="imgs/Geek_View_Logotipo.png" class="RPlogotipo">
              <p class="RPgeekview" >GeekView</p>
          </div>
      </div>

      <button class="btnSidebar" onclick="openSidebar()">☰</button>

            <img src="imgs/Geek_View_Logotipo.png" class="logotipo">
            <div id="userInf">
                <img src="imgs/perfil_icon.png" id="userImg" class="userImg">
                <p id="userName"><?php if(isset($_SESSION['usuario_email'])) {print $row1['usuario_nick'];} ?></p>
            </div>
        </div>
        <div class="userDiv">

          <img src="imgs/perfil_icon.png" class="pUserImg">
          <p class="userNick"><?php if(isset($_SESSION['usuario_email'])) {print $row1['usuario_nick'];} ?></p>
          <p class="dtUser">Conta criada dia: <?php echo $row1['usuario_data_de_entrada'] ?></p>
          <p class="nPost">
            <?php 
              $sql = "SELECT * FROM postagem WHERE usuario_id = '{$row1['usuario_id']}'";
              $result = mysqli_query($conexao, $sql);
              $row = mysqli_num_rows($result);
              echo $row;
            ?> postagens!
          </p>
          <p class="ppRank">Ranking:<?php echo $row1['usuario_rank']?></p>
          <button onclick="window.location.href = 'logout.php'" class="btnLogout">Deslogar</button>
        </div>
        <div class="postagens">
            <h1 class="h1">Suas postagens</h1>
            <?php 
            $sql = "SELECT * FROM postagem where usuario_id = '{$row1['usuario_id']}'";
            $result = mysqli_query($conexao, $sql);
            $row = mysqli_num_rows($result);
            
            for($i=0;$i<$row;$i++):
            $sql = "SELECT * FROM postagem WHERE usuario_id = '{$row1['usuario_id']}' LIMIT $i,2";
            $result = mysqli_query($conexao, $sql);
            $posts = mysqli_fetch_array($result);?>
                <div class="post">

                <div class="owner" id="owner" name="joj<?php echo $posts['post_id'] ?>">
                    <img class="ownerIcon" src="imgs/perfil_icon.png"/>
                    <p class="ownerNick"><?php echo $row1['usuario_nick']; ?></p>
                    <p class="date"><?php echo $posts['post_date'] ?></p>
                </div>

                <div class="pInf">
                    <h1 class="pTitle"><?php echo $posts['post_title']; ?></h1>
                    <p class="pText"><?php echo $posts['post_text']; ?></p>
                    <a href="<?php 
                        if($posts['topico_id']== 1) {
                          echo "tpcRoblos.php";
                        } else if($posts['topico_id']== 2) {
                          echo "tpcPokemon.php";
                        } else if($posts['topico_id']== 3) {
                          echo "tpcMinecraft.php";
                        } else if($posts['topico_id']== 4) {
                          echo "tpcDemonSlayer.php";
                        } else if($posts['topico_id']== 5) {
                          echo "tpcTransformice.php";
                        }
                      ?>"
                     class="tpc">
                      <?php 
                        if($posts['topico_id']== 1) {
                          echo "(Roblox)";
                        } else if($posts['topico_id']== 2) {
                          echo "(Pokémon)";
                        } else if($posts['topico_id']== 3) {
                          echo "(Minecraft)";
                        } else if($posts['topico_id']== 4) {
                          echo "(Demon Slayer)";
                        } else {
                          echo "(transformice)";
                        }
                      ?>
                    </a>
                </div>

                </div>
            <?php endfor ?>
        </div>
    </body>
</html>