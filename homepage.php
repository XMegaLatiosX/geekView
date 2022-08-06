<?php
session_start();
include('conexao.php');
if(!($_SESSION['usuario_email'])) {
  header('Location: index.php');}
$queryNick = "SELECT * FROM usuario WHERE usuario_email = '{$_SESSION['usuario_email']}'";

$nick = mysqli_query($conexao, $queryNick);

$row = mysqli_fetch_array($nick);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="base.css?rnd=132">
        <link rel="stylesheet" type="text/css" href="Homepage.css?rnd=132">
        <script>
          var popup         = document.createElement('div');
          var acDiv         = document.createElement("div");
          var aUser         = document.createElement("a");
          var userImg       = document.createElement("img");
          var userNick      = document.createElement("p");
          var formLogout    = document.createElement("form");
          var btnLogout     = document.createElement("button");
          var pRank         = document.createElement("p");
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
        <title>GeekView</title>
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
            
        <div id="topicos">

            <div id="roblos" class="topico" onclick="window.location.href = 'tpcRoblos.php';">
                <img src="imgs/roblos.png" class="imgs">
                <div class="topicTitle"><h1 class="titulo">Roblos</h1></div>
                <p id="desc" class="topicDesc">Uma plataforma de criação de jogos, com uma imensa variedade de jogos feitos pelos mais diversos criadores</p>
            </div>

            <div id="pokemon" class="topico" onclick="window.location.href = 'tpcPokemon.php';">
                <img src="imgs/pokemon.png" class="imgs">
                <div class="topicTitle"><h1 class="titulo">pokemon</h1></div>
                <p id="desc" class="topicDesc">Um anime que conta a história de Ash Ketchum, um jovem treinador de pokemons em busca de aventuras ao redor do mundo</p>
            </div>

            <div id="gow5" class="topico" onclick="window.location.href = 'tpcMinecraft.php';">
                <img src="https://images-na.ssl-images-amazon.com/images/I/418cEZfh8-L.jpg" class="imgs">
                <div class="topicTitle"><h1 class="titulo">Minecraft</h1></div>
                <p id="desc" class="topicDesc">Um jogo quadrado de construção e aventura, onde a sua imaginação é o limite!</p>
            </div>

            <div id="gow5" class="topico" onclick="window.location.href = 'tpcDemonSlayer.php';">
                <img src="https://img.quizur.com/f/img61a56626f250f6.00167720.png?lastEdited=1638232989" class="imgs">
                <div class="topicTitle"><h1 class="titulo">Demon Slayer</h1></div>
                <p id="desc" class="topicDesc">Um anime que conta a história de Tanjiro Kamado, que vive uma viagem em busca da salvação da sua irmã Nezuko que foi transformada por demônios</p>
            </div>

            <div id="gow5" class="topico" onclick="window.location.href = 'tpcTransformice.php';">
                <img src="imgs/mice.png" class="imgs">
                <div class="topicTitle"><h1 class="titulo">Transformice</h1></div>
                <p id="desc" class="topicDesc">Um jogo de plataforma 2d onde você é um rato em busca de seu queijo</p>
            </div>

        </div>
    </body>
</html>