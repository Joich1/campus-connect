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
        //if (password_verify($pass, $email["senha"])) {
        if ($pass === $email["senha"]) {
            $_SESSION['user_id'] = $email['id'];
            // depois mandar pro index
            header('location: index.html');
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
    <title>Una - Login</title>
    <link rel="shortcut icon" href="./icon/quora.png" type="image/x-icon">
</head>
<body>
    <header>
        <nav>

        </nav>
    </header>
<!--colocar o return pra mostrar ai porra-->
    <main>
        <div>
            <form action="login.php" method="post">
                <h2>loga ai</h2>
                email
                <input type="text" name="email">
                senha
                <input type="text" name="password">
                <button type="submit" name="logar">Logar</button><br>

                não possui uma conta? cadastre aqui
                <a href="register.php">Cadastrar</a>
            </form>
        </div>
    </main>
</body>
</html>