<?php
session_start();
include 'config.php';


//vai ter foto, depois eu colocar
function rUser($username, $pass, $photo){
// colocar pra registrar email, numero, genero +

global $conn;

$hashePass = password_hash($pass, PASSWORD_DEFAULT);
$query = "SELECT * FROM user WHERE nome = '$username'";

//cadastras essa
$cUser = mysqli_query($conn, "SELECT * FROM user WHERE nome = '$username' ");
if(mysqli_num_rows($cUser) > 0){
    // teste no h1, mudara depois
    return "<h1 id=''> já tem gente com ese nome"."</h1>";
};
//cadastrar email depois
//$cEmail = mysqli_query($conn,"");


$upload = 'upload/';
$nPhoto = $_FILES['photo']['name'];
$t_name_photo = $_FILES['photo']['tmp_name'];
$pSize = $_FILES['photo']['size'];
$photo_error = $_FILES['photo']['error'];


//colocar echo com html pra puxar dps no css
if($photo_error === 0){
    if($pSize <= 2 * 1024 * 1024){
        $new_name = uniqid('', true) . "." . pathinfo($nPhoto, PATHINFO_EXTENSION);
        $photopath = $upload . $new_name;

        if(move_uploaded_file($t_name_photo, $photopath)){
            $query = "INSERT INTO user (nome, senha, imagem) VALUES ('$username','$pass','$photopath') ";
            if(mysqli_query($conn, $query)){
                // mandar pra login dpois
                header('');
                exit();
            }else{
                echo "Erro ao fazer upload.";
            }
    }
    }else{
    echo 'ERRO! A imagem deve ter no máximo 2 MB.';
}
}else{
    echo '';
    }


}


if(isset($_POST['register'])){
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    //vai ter foto, depois eu colocar
    rUser($username, $pass, $_FILES['photo']);
    header('login.php');

    //mudar pra hashepass dps

};


?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>anu</title>
</head>
<body>
    <header>
        <nav>
        </nav>
    </header>
    
    <main>
        <div>
            <!--LEMBRESSE QUE O "enctype" É PRA INCRIPTAR, RECOLOCR ISSO DEPOIS "multipart/form-data"-->
            <form action="register.php" method="post">
                <h2> cria a conta ai porra</h2>
                <input type="text" name="username" placeholder="nome" required><br>
                <!--mudar type pra password-->
                <input type="text" name="pass" placeholder="senha"><br>
                <input type="file" name="photo" accept="image/*">

                <!--isso é um teste-->
                <input type="checkbox"  >
                <label>Concordo com os termos e condições <a href="test.html">Saiba Mais!</a> </label>
                <button type="submit" name="register">desgraça</button>
            </form>
        </div>
    </main>


    <footer>
        <p>&todos os direitos reservados *teste* </p>
    </footer>
</body>
</html>