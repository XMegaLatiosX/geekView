<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Chat-Simples</title>
	<script type="text/javascript">
		function ajax(){
			var req = new XMLHttpRequest();
			req.onreadystatechange = function(){
				if (req.readyState == 4 && req.status == 200) {
						document.getElementById('chat').innerHTML = req.responseText;
				}
			}
			req.open('GET', 'chat2.php', true);
			req.send();
		}
	
		setInterval(function(){ajax();}, 1000);

	</script>
</head>
<body onload="ajax();">
<div id="chat">


</div>
	<form method="post" action="chat.php">
		<input type="text" name="mensagem" placeholder="mensagem">
		<input type="submit" value="Enviar">
	</form>
	<?php
		include("conexao.php");
		if(isset($_POST['mensagem'])){
			$mensagem = $_POST['mensagem'];
			$date = date("y-m-d");
			$sql = $pdo->query("INSERT INTO conversa SET conversa_msg_date= '$date' , conversa_msgs= '$mensagem' , ");
		}
	?>

</body>
</html>