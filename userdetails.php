<?php
session_start();
include 'config.php';
$mensagem = '';
$user_id = $_SESSION['user_id'];

//mudar pra return depois
if(!isset($_SESSION['user_id'])){
	echo "você precisa estár logado pra fazer isso";
	header("Refresh:3; uril=location: login.php");
	exit;
}


$sqlUser = "SELECT nome, email, imagem, data_criacao FROM locador WHERE id = $user_id";
$result = mysqli_query($conn, $sqlUser);
$user = mysqli_fetch_assoc($result);
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>detalhe</title>
</head>
<body>
	<header>
		<nav>

		</nav>
	</header>

	<main>
		<div>
			<form action="userdetails.php" method="post" enctype="multipart/form-data">
				<label>alterar nome</label>
				<input type="text" name="name">

				<label>alte email</label>
				<input type="text" name="email">

				<label> alterar senha</label>
				<input type="text" name="password">

				<input type="submit">
			</form>
		</div>
	</main>
	
</body>
</html>