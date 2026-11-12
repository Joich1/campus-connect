<?php
include 'config.php';
session_start();
$mensagem = ''; 
//mudar pra usuario depois (talvez)
function lUser($email, $pass) {
    global $conn;

    $query = "SELECT * FROM user WHERE email = '$email' ";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $email = mysqli_fetch_assoc($result);
        if (password_verify($pass, $email["senha"])) {
            $_SESSION['user_id'] = $email['id'];
            // depois mandar pro index
            header('location: index.php');
            exit();
        }else{
            return 'Senha incorreta';
        }
    }else{
        return 'Email errado, ou não encontrado';
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $mensagem = lUser($email, $pass);
}


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Connect - Login</title>
    <link rel="shortcut icon" href="./icon/quora.png" type="image/x-icon">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <main>
        <section class="register-shell" aria-label="Login Campus Connect">
            <aside class="register-intro">
                <a class="brand" href="index.php" aria-label="Campus Connect - início">
                    <span class="brand-mark">cc</span>
                    <span>campus<span class="brand-light">connect</span></span>
                </a>

                <div class="intro-copy">
                    <span class="eyebrow">SUA VIDA NO CAMPUS, MAIS PERTO</span>
                    <h1>Bom ter você de volta.</h1>
                    <p>Acesse sua conta para se conectar com sua comunidade e acompanhar o que acontece na faculdade.</p>
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
                <form action="login.php" method="post" class="register-form">
                    <div class="form-heading">
                        <span class="step-tag">BEM-VINDO DE VOLTA</span>
                        <h2 id="titulo">Faça seu login</h2>
                        <p>Entre para continuar conectado à sua faculdade.</p>
                    </div>

                    <?php if ($mensagem !== '') : ?>
                        <div class="register-message" role="alert">
                            <?= htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="input-container">
                        <input type="email" name="email" id="email" autocomplete="email" required>
                        <label for="email" class="label">E-mail</label>
                        <div class="underline"></div>
                    </div>

                    <div class="input-container">
                        <input type="password" name="password" id="password" autocomplete="current-password" required>
                        <label for="password" class="label">Senha</label>
                        <div class="underline"></div>
                    </div>

                    <button type="submit" name="logar" class="primary-button">Entrar <span aria-hidden="true">→</span></button>
                    <p class="login-prompt">Ainda não tem uma conta? <a href="register.php">Cadastre-se</a></p>
                </form>
            </div>
        </section>
    </main>
</body>
</html>