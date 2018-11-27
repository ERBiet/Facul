<?php
/**
 * Created by PhpStorm.
 * User: emanuel.resende
 * Date: 26/11/2018
 * Time: 14:23
 */

session_start();

if((!isset ($_SESSION['login'])) and (!isset ($_SESSION['senha'])))
{
    unset($_SESSION['login']);
    unset($_SESSION['senha']);

    session_destroy();
    header('location:index.php');
}
elseif(isset($_GET['login']))
if($_GET['login'] == 'deslogar'){
    session_destroy();
    header('location:../index.php');
}

?>
