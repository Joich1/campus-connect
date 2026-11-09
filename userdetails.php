<?php
session_start();
include 'config.php';
$mensagem = '';
$user_id = $_SESSION['user_id'];

//mudar pra return depois (passar por htmlt dpois)
if(!isset($_SESSION['user_id'])){
	echo "você precisa estár logado pra fazer isso";
	header("location: login.php");
	exit;
}if($_SERVER['REQUEST_METHOD'] === 'POST'){
	if(isset($_POST['email']) && !empty($_POST['email'])){
		$nEmail = $_POST['email'];
		if(!filter_var($nEmail, FILTER_VALIDATE_EMAIL)){
			echo "Insira um e-mail vállido.";
		}else{
			$sqlEmail = "UPDATE user SET email = '$nEmail' WHERE id = $user_id";
			if(mysqli_query($conn, $sqlEmail)){
				echo "Seu E-mail foi alterado com sucesso.";
			}else{
				echo "Erro ao alterar o E-mail";
			}
		}
	}

	if(isset($_POST['senha']) && !empty($_POST['senha'])){
		$nPass = $_POST['senha'];
		if(strlen($nPass) < 6){
			return "Sua senha tem que ter no mínumo 6 caracteres";
		}else{
			$passHash = password_hash($nPass, PASSWORD_DEFAULT);

			$sqlPass = "UPDATE user SET senha = '$passHash' WHERE id = $user_id";
			if(mysqli_query($conn, $sqlPass)){
				return "Sua senha foi alterada com sucesso";
			}else{
				return "Erro ao alterar a senha.";
			}
		}
	}
}


$sqlUser = "SELECT nome, email, imagem, data_criacao FROM user WHERE id = $user_id";
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
				
				<img id="fperfil" src="foto.jpg" width="100" height="100" alt="preview nova foto">
				<input type="file" id="photo" name="photo" accept="image/*"><br>

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
	
	<script src="./js/main.js"></script>
</body>
</html>