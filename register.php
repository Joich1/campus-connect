<?php
session_start();
include 'config.php';
$mensagem = ''; //colocar return nos lugares do echoo

function rUser($username, $pass, $email, $photo){
global $conn;

$hashePass = password_hash($pass, PASSWORD_DEFAULT);
$query = "SELECT * FROM user WHERE nome = '$username'";

$cUser = mysqli_query($conn, "SELECT * FROM user WHERE nome = '$username' ");
if(mysqli_num_rows($cUser) > 0){
    // mudar id pra puxar css
    return "<h1 id='existente'> Esse Usuário não está disponivél"."</h1>";
};

$cEmail = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email' ");
if(mysqli_num_rows($cEmail) > 0){
    return "já existe esse email";
};

$upload = 'uploads/';
$nPhoto = $_FILES['photo']['name'];
$tmpnamephoto = $_FILES['photo']['tmp_name'];
$pSize = $_FILES['photo']['size'];
$photo_error = $_FILES['photo']['error'];


//colocar echo com html pra puxar dps no css
if($photo_error === 0){
    if($pSize <= 2 * 1024 * 1024){
        $new_name = uniqid('', true) . "." . pathinfo($nPhoto, PATHINFO_EXTENSION);
        $photopath = $upload . $new_name;

        if(move_uploaded_file($tmpnamephoto, $photopath)){
            $query = "INSERT INTO user (nome, email, senha, imagem) VALUES ('$username','$email', '$hashePass','$photopath') ";
            if(mysqli_query($conn, $query)){
                header('location:login.php');
                exit();
                }else{
                    return "Tente novamente mais tarde.";
                    return false;
                }
            }else{
                return "Erro ao fazer upload.";
            }
        }else{
            return "ERRO! A imagem deve ter no máximo 2 MB.";
        }
    }else{
        return "";
    }
}


if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    rUser($username, $pass, $email, $_FILES['photo']);
    header('location: login.php');
};
?>


<!DOCTYPE html>
<!--colocar databs nas outras paginas-->
<html lang="pt-BR" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>anu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<!--puxar css depois aqui!-->
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <header>
        <nav>
        </nav>
    </header>
    
    <main>
        <div>
            <form action="register.php" method="post" enctype="multipart/form-data">
                <h2 id="titulo"> cria a conta ai</h2>
                <div id="etapa1">
                    <div class="input-container">
                        <input type="text" name="username" id="input" required="">
                        <label for="input" class="label">Usuário</label>
                        <div class="underline"></div>
                    </div>

                    <div class="input-container">
                        <input type="password" name="pass" id="input" required="">
                        <label for="input" class="label">Senha</label>
                        <div class="underline"></div>
                    </div>

                    <div class="input-container">
                        <input type="email" name="email" id="input" required="">
                        <label for="input" class="label">Email</label>
                        <div class="underline"></div>
                    </div>

                    <input type="checkbox"  >
                    <label>Concordo com os termos e condições <a href="test.html">Saiba Mais!</a> </label><br>

                    <button type="button" id="btnProximo">Próximo</button>
                        <label>Já tem conta?</label><a href="login.php">Logar</a>

                <div id="etapa2" hidden>
                        <input type="file" name="photo" accept="image/*" id="fInput">
                        <div id="preview">
                            <img src="#" alt="previa da foto" id="fPreview" width="100" height="100">
                        </div>

                        <button type="button" id="btnVoltar">Voltar</button>
                        <button type="submit" name="register">Registrar</button>
                </div> 
            </form>
        </div>
    </main>


    <footer>
        <p>&todos os direitos reservados *teste* </p>
    </footer>
    
    <script src="main.js"></script>
</body>
</html>