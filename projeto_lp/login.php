<?php
/**
 * Created by PhpStorm.
 * User: emanuel.resende
 * Date: 26/11/2018
 * Time: 13:38
 */

session_start();

$user = $_POST['user'];
$pass = $_POST['pass'];

$pdo = new PDO("mysql:host=localhost;dbname=db_automoveis", "aluno", "aluno");

$validar_login= $pdo->query("SELECT * FROM usuarios WHERE email = :email and senha = :senha");
$validar_login = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email and senha = :senha");

$validar_login->bindValue(":email", $user);
$validar_login->bindValue(":senha", md5($pass));

$validar_login->execute();

if($validar_login->rowCount()==1){
    $_SESSION['login'] = $user;
    $_SESSION['senha'] = $pass;
    echo "<script>alert('Bem Vindo!');
          top.location.href='index.php?opc=R';
          </script>";
}
else{
    unset($_SESSION['login']);
    unset($_SESSION['senha']);

    echo "<script>alert('Usuarios Ou Senha Incorretos!');
          top.location.href='index.php?opc=H';
          </script>";
}

?>