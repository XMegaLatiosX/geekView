<?php
define('HOST', '127.0.0.1');
define('USUARIO', 'root');
define('SENHA', '');
define('DB', 'GeekViewdb');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possivel se conectar');

$sqli = "SELECT usuario_id FROM usuario WHERE usuario_id = '{$_SESSION['usuario_id']}'";
$resultaa = mysqli_query($conexao, $sqli);
$lep = mysqli_fetch_array($resultaa);
$user_id = $_SESSION['usuario_id'];

if (isset($_POST['action'])) {
  $post_id = $_POST['post_id'];
  $action = $_POST['action'];
  switch ($action) {
  	case 'like':
         $sql="INSERT INTO rating_info (usuario_id, post_id, rating_action) VALUES ('{$user_id}', '{$post_id}', 'like') ON DUPLICATE KEY UPDATE rating_action='like'";
         break;
  	case 'dislike':
          $sql="INSERT INTO rating_info (usuario_id, post_id, rating_action) VALUES ('{$user_id}', '{$post_id}', 'dislike') ON DUPLICATE KEY UPDATE rating_action='dislike'";
         break;
  	case 'unlike':
	      $sql="DELETE FROM rating_info WHERE usuario_id = '{$user_id}' AND post_id = '{$post_id}'";
	      break;
  	case 'undislike':
      	  $sql="DELETE FROM rating_info WHERE usuario_id = '{$user_id}' AND post_id = '{$post_id}'";
      break;
  	default:
  		break;
  }

  // execute query to effect changes in the database ...
  mysqli_query($conexao, $sql);
  echo getRating($post_id);
  exit(0);
}

// Get total number of likes for a particular post
function getLikes($id) {
  global $conexao;
  $sql = "SELECT COUNT(*) FROM rating_info WHERE post_id = '{$id}' AND rating_action = 'like'";
  $rs = mysqli_query($conexao, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

// Get total number of dislikes for a particular post
function getDislikes($id) {
  global $conexao;
  $sql = "SELECT COUNT(*) FROM rating_info WHERE post_id = '{$id}' AND rating_action = 'dislike'";
  $rs = mysqli_query($conexao, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

// Get total number of likes and dislikes for a particular post
function getRating($id) {
  global $conexao;
  $rating = array();
  $likes_query = "SELECT COUNT(*) FROM rating_info WHERE post_id = '{$id}' AND rating_action = 'like'";
  $dislikes_query = "SELECT COUNT(*) FROM rating_info	WHERE post_id = '{$id}' AND rating_action = 'dislike'";
  $likes_rs = mysqli_query($conexao, $likes_query);
  $dislikes_rs = mysqli_query($conexao, $dislikes_query);
  $likes = mysqli_fetch_array($likes_rs);
  $dislikes = mysqli_fetch_array($dislikes_rs);
  $rating = [
  	'likes' => $likes[0],
  	'dislikes' => $dislikes[0]
  ];
  return json_encode($rating);
}

// Check if user already likes post or not
function userLiked($post_id) {
  global $conexao;
  global $user_id;
  $sql = "SELECT * FROM rating_info WHERE usuario_id = '{$user_id}' AND post_id = '{$post_id}' AND rating_action = 'like'";
  $result = mysqli_query($conexao, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}

// Check if user already dislikes post or not
function userDisliked($post_id){
  global $conexao;
  global $user_id;
  $sql = "SELECT * FROM rating_info WHERE usuario_id = '{$user_id}' AND post_id = '{$post_id}' AND rating_action = 'dislike'";
  $result = mysqli_query($conexao, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}
?>