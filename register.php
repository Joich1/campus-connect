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
    return "Esse nome de usuário não está disponível.";
};

$cEmail = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email' ");
if(mysqli_num_rows($cEmail) > 0){
    return "Já existe uma conta cadastrada com esse e-mail.";
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
                }
            }else{
                return "Erro ao fazer upload.";
            }
        }else{
            return "ERRO! A imagem deve ter no máximo 2 MB.";
        }
    }else{
        return "Envie uma foto para concluir o cadastro.";
    }
}


if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $mensagem = rUser($username, $pass, $email, $_FILES['photo']);
};
?>


<!DOCTYPE html>
<!--colocar databs nas outras paginas-->
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Connect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <main>
        <section class="register-shell" aria-label="Cadastro Campus Connect">
            <aside class="register-intro">
                <a class="brand" href="index.php" aria-label="Campus Connect - início">
                    <span class="brand-mark">cc</span>
                    <span>campus<span class="brand-light">connect</span></span>
                </a>

                <div class="intro-copy">
                    <span class="eyebrow">SUA VIDA NO CAMPUS, MAIS PERTO</span>
                    <h1>As melhores conexões começam aqui.</h1>
                    <p>Encontre sua comunidade, compartilhe ideias e faça parte do que acontece na faculdade.</p>
                </div>

                <div class="community-card" aria-hidden="true">
                    <span class="community-dot"></span>
                    <div>
                        <strong>Seu campus. Sua comunidade.</strong>
                        <span>Um espaço feito para você.</span>
                    </div>
                    <span class="community-arrow">↗</span>
                </div>
                <span class="intro-orbit orbit-one"></span>
                <span class="intro-orbit orbit-two"></span>
            </aside>

            <div class="register-content">
                <form action="register.php" method="post" enctype="multipart/form-data" class="register-form">
                    <div class="form-heading">
                        <span class="step-tag">PASSO 1 DE 2</span>
                        <h2 id="titulo">Crie sua conta</h2>
                        <p>Entre para a comunidade da sua faculdade.</p>
                    </div>

                    <?php if ($mensagem !== '') : ?>
                        <div class="register-message" role="alert">
                            <?= htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                    <?php endif; ?>

                    <div id="etapa1" class="register-stage">
                        <div class="input-container">
                            <input type="text" name="username" id="username" autocomplete="username" required>
                            <label for="username" class="label">Nome de usuário</label>
                            <div class="underline"></div>
                        </div>

                        <div class="input-container">
                            <input type="password" name="pass" id="pass" autocomplete="new-password" required>
                            <label for="pass" class="label">Senha</label>
                            <div class="underline"></div>
                        </div>

                        <div class="input-container">
                            <input type="email" name="email" id="email" autocomplete="email" required>
                            <label for="email" class="label">E-mail</label>
                            <div class="underline"></div>
                        </div>

                        <div class="terms-row">
                            <input type="checkbox" id="terms" required>
                            <label for="terms">Concordo com os <a href="test.html">termos e condições</a></label>
                        </div>

                        <button type="button" id="btnProximo" class="primary-button">Continuar <span aria-hidden="true">→</span></button>
                        <p class="login-prompt">Já tem uma conta? <a href="login.php">Fazer login</a></p>
                    </div>

                    <div id="etapa2" class="register-stage photo-stage" hidden>
                        <p class="photo-hint">Adicione uma foto para que seus colegas reconheçam você.</p>
                        <label for="fInput" class="photo-upload">
                            <span class="upload-icon" aria-hidden="true">↑</span>
                            <strong>Escolha uma foto</strong>
                            <span>JPG ou PNG · até 2 MB</span>
                            <input type="file" name="photo" accept="image/*" id="fInput" required>
                        </label>
                        <div id="preview" class="photo-preview">
                            <img src="#" alt="Prévia da foto escolhida" id="fPreview" width="100" height="100">
                        </div>

                        <div class="stage-actions">
                            <button type="button" id="btnVoltar" class="secondary-button">Voltar</button>
                            <button type="submit" name="register" class="primary-button">Criar conta <span aria-hidden="true">→</span></button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <script src="main.js"></script>
</body>
</html>