<?php
session_start();
include("conexao.php");
$sql = $pdo->query("SELECT * FROM conversa");
foreach ($sql->fetchAll() as $key) {
	echo "<h3>".$key['conversa_msg_date']."</h3>";
	echo "<h5>".$key['conversa_msgs']."</h5>";
}
?>
