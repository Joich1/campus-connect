<?php
session_start();
include 'config.php';


//vai ter foto, depois eu colocar
function rUser($username, $pass){
// colocar pra registrar email, numero, genero +

global $conn;

$hashePass = password_hash($pass, PASSWORD_DEFAULT);
//aqui ta proucurando??? NÇAI LEMBRO :(
$query = "SELECT * FROM user WHERE nome = '$username'";

//cadastras essa
$cUser = mysqli_query($conn, "SELECT * FROM user WHERE nome = '$username' ");
if(mysqli_num_rows($cUser) > 0){
    // teste no h1, mudara depois
    return "<h1 id=''> já tem gente com ese nome"."</h1>";
};
//cadastrar email depois
//$cEmail = mysqli_query($conn,"");


};

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    //vai ter foto, depois eu colocar
    rUser($username, $pass);
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
                <input type="text" name="pass" placeholder="senha"><br>

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