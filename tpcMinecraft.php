<?php
session_start();
include('conexao.php');
if(!($_SESSION['usuario_email'])) {
  header('Location: index.php');}
$queryNick = "SELECT * FROM usuario WHERE usuario_email = '{$_SESSION['usuario_email']}'";

$nick = mysqli_query($conexao, $queryNick);

$row = mysqli_fetch_array($nick);

$jooj = "SELECT * FROM postagem";
$resultado = mysqli_query($conexao, $jooj);
$post = mysqli_fetch_array($resultado);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="base.css?rnd=132">
        <link rel="stylesheet" type="text/css" href="topic.css?rnd=132">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
          var popup       = document.createElement('div');
          var acDiv       = document.createElement("div");
          var aUser       = document.createElement("a");
          var userImg     = document.createElement("img");
          var userNick    = document.createElement("p");
          var formLogout  = document.createElement("form");
          var btnLogout   = document.createElement("button");
          var pRank       = document.createElement("p");
          function criaPopup() {
            document.getElementById("userImg").setAttribute("onclick", "");
            document.getElementById("userName").setAttribute("onclick", "");
            document.getElementById("header").appendChild(popup);
            popup.setAttribute("class", "popup");
            popup.style.animation = "popup 1s 1";
            setTimeout(() => {popup.style.height = "175px"; popup.style.width = "300px";
            document.getElementById("userImg").setAttribute("onclick", "destroiPopup()");
            document.getElementById("userName").setAttribute("onclick", "destroiPopup()");
            }, 975);

            
            setTimeout(() => {
              popup.appendChild(acDiv);
              acDiv.appendChild(aUser);
              acDiv.setAttribute('class', 'acDiv');
              aUser.setAttribute('class', 'aUser');
              aUser.setAttribute('href', 'profile.php');

              aUser.appendChild(userImg);
              userImg.setAttribute('class', 'userImg');
              userImg.style.margin = "20px 15px auto 20px";
              userImg.style.float = "left";
              userImg.setAttribute('src', 'imgs/perfil_icon.png');
              aUser.appendChild(userNick);
              userNick.setAttribute('class', 'ppNick');
              userNick.innerHTML = "<?php if(isset($_SESSION['usuario_email'])) {print $row['usuario_nick'];} ?>";
              pRank.innerHTML = "Ranking:   <?php if(isset($_SESSION['usuario_email'])) {print $row['usuario_rank'];} ?>";
              pRank.setAttribute('class', 'rank');
              aUser.appendChild(pRank);
              popup.appendChild(formLogout);
              formLogout.setAttribute('action', 'logout.php');
              formLogout.setAttribute('method', 'POST');
              formLogout.setAttribute('class', 'form');
              formLogout.appendChild(btnLogout);
              btnLogout.setAttribute('class','btnLogout');
              btnLogout.setAttribute('type','submit');
              btnLogout.innerHTML = 'deslogar';
            }, 550);
          }
          function destroiPopup() {
            document.getElementById("userImg").setAttribute("onclick", "");
            document.getElementById("userName").setAttribute("onclick", "");
            popup.style.animation = "noPopup 1s 1";
            aUser.removeChild(userImg, userNick, pRank);
            acDiv.removeChild(aUser);
            formLogout.removeChild(btnLogout);
            popup.removeChild(acDiv,formLogout);
            setTimeout(() => {
            popup.style.width = "10px";
            popup.style.height = "10px";
            document.getElementById("header").removeChild(popup);
            document.getElementById("userImg").setAttribute("onclick", "criaPopup()");
            document.getElementById("userName").setAttribute("onclick", "criaPopup()");
            }, 975);
          }
        
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
        <title>Minecraft</title>
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
                <img src="imgs/perfil_icon.png" id="userImg" class="userImg" onclick="criaPopup()">
                <p id="userName" onclick="criaPopup()"><?php if(isset($_SESSION['usuario_email'])) {print $row['usuario_nick'];} ?></p>
            </div>
        </div>

        <div id="ad1"><img src="https://media.istockphoto.com/vectors/round-shape-colorful-ink-paint-fluids-vector-illustration-isolated-on-vector-id1300578970?k=20&m=1300578970&s=612x612&w=0&h=gRREccjegTwc41__1_mcFikzpUBYSc5texTY1b2njKw=" class="adImg"></div>
        <div id="ad2"><img src="https://media.istockphoto.com/vectors/holiday-sale-banner-50-off-special-offer-ad-discount-promotion-vector-vector-id876158494?k=20&m=876158494&s=612x612&w=0&h=SFSzfJU3J-zkpVop8FzRwjGgm0VqzL0BanG8F3YDkXQ=" class="adImg"></div>
              
          <div class="xaropinho">

          <form action="CPminecraft.php" method="POST" class="container">
        <br>
        <input type="text" name="title" class="inptTitle" placeholder="Escreva um título!"/>

        <br>
        <textarea name="text" class="inptText" placeholder="Poste algo a respeito de Minecraft!"></textarea>
        <br>

        <?php 
          if(isset($_SESSION['noTitle'])):
        ?>
        <div class="aviso">
          <p>ERRO: Você precisa digitar um título!</p>
        </div>
        <?php
          endif;
          unset($_SESSION['noTitle']);
        ?>

        <?php
          if(isset($_SESSION['noText'])):
        ?>
        <div class="aviso">
            <p>ERRO: Você precisa digitar um comentário!</p> 
        </div>
        <?php
          endif;
          unset($_SESSION['noText']);
        ?>

        <button type="submit" class="btn">publicar!</button>

        <?php
          if(isset($_SESSION['postagemFeita'])):
        ?>
        <div class="aviso">
          <p>publicado!</p>
        </div>
        <?php
          endif;
          unset($_SESSION['postagemFeita']);
        ?>

      </form>
      


      <div id="posts">
        <?php 
        $sqlPosts = "SELECT * FROM postagem WHERE topico_id = 3";
        $rPosts = mysqli_query($conexao, $sqlPosts);
        $rowP = mysqli_num_rows($rPosts);
        for($i=0;$i<$rowP; $i++):
        $sqlPost = "SELECT * FROM postagem WHERE  topico_id = 3 LIMIT $i,2";
        $result = mysqli_query($conexao, $sqlPost);
        $joj = mysqli_fetch_array($result);
        $sqlUser = "SELECT usuario_nick FROM usuario WHERE usuario_id = '{$joj['usuario_id']}'";
        $rs = mysqli_query($conexao, $sqlUser);
        $rowUser = mysqli_fetch_array($rs);?>
        
        <div class="post">

          <div class="owner">
            <img class="ownerIcon" src="imgs/perfil_icon.png"/>
            <p class="ownerNick"><?php echo $rowUser['usuario_nick']; ?></p>
            <p class="date"><?php echo $joj['post_date'] ?></p>
          </div>

          <div class="pInf">
            <h1 class="pTitle"><?php echo $joj['post_title']; ?></h1>
            <p class="pText"><?php echo $joj['post_text']; ?></p>
          </div>

          <div class="actions">
          <i style="color: rgb(10, 90, 10);cursor: pointer;"
          <?php if (userLiked($joj['post_id'])): ?>
            class="fa fa-thumbs-up like-btn"
            <?php else: ?>
              class="fa fa-thumbs-o-up like-btn"
            <?php endif ?>
            data-id="<?php echo $joj['post_id'] ?>"></i>
          <span class="likes" style="color: rgb(10, 90, 10);margin-right: 30px;"><?php echo getLikes($joj['post_id']); ?></span>
                

          <i style="color: rgb(134, 10, 10);cursor: pointer;"
            <?php if (userDisliked($joj['post_id'])): ?>
              class="fa fa-thumbs-down dislike-btn" 
            <?php else: ?>
            class="fa fa-thumbs-o-down dislike-btn"
            <?php endif ?>
            data-id="<?php echo $joj['post_id'] ?>"></i>
          <span class="dislikes" style="color: rgb(134, 10, 10);"><?php echo getDislikes($joj['post_id']); ?></span>
          </div>

        </div>
            <?php endfor; ?>
      </div>
          </div>
      <script src="like.js"></script>
    </body>
</html>