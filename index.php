<?php
session_start();
include 'config.php';
    global $conn;

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $sqlUser = "SELECT nome, email, imagem FROM user WHERE id = $user_id";
    $result = mysqli_query($conn,$sqlUser);
    $user = mysqli_fetch_assoc($result);
    $pfp = $user['imagem'];

}else{
    $pfp = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQFWeVHKfPKt_07dWbdfP_WhEy6rs1v_ttPlpPXstag0A&s=10';
}



?>


<!DOCTYPE html>
<!--DATA BS THEME, PRA TER BOTÃO DE MUDAR O TEMA, NÃO ESQUECER!!!!!-->
<html lang="pt-BR" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XD</title>
    <link rel="shortcut icon" href="./icon/quora.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./css/main.css">
</head>
<header>
    <nav class="d-flex align-items-center text-center">

        <a href="userdetails.html" class="dropdown-toggle d-flex align-items-center" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
             <img style="border-radius: 100%" height="50px" widht="50px" src="<?php echo htmlspecialchars($pfp); ?>" alt="">
            </a> 
    </nav>
</header>

<main>
    <div>
        <a class="" href="register.php">criar conta</a>
        <a href="logout.php">deslogar</a>
    </div>
</main>
</body>
</html>