<?php
/**
 * Created by PhpStorm.
 * User: emanuel.resende
 * Date: 26/11/2018
 * Time: 13:43
 */

include 'Pages/Session.php';
echo "<br /><br />
					<div class='mx-auto btn-group'>
					<button type='button' class=' btn btn-secondary' onclick=location.replace('Index.php?opc=C')>Cadastrar</button>";
echo "<button type='button' class='btn btn-secondary' onclick=location.replace('Index.php?opc=A')>Alterar</button>";
echo "<button type='button' class='btn btn-secondary' onclick=location.replace('Index.php?opc=E')>Excluir</button>";
echo "<button type='button' class='btn btn-secondary' onclick=location.replace('Index.php?opc=L')>Listar</button></div><br/><br />";
?>