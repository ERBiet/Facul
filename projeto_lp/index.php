<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="Assets/CSS/CSS.css"/>
</head>

<body>
<!--HamBurger Icon-->
<div class="bars" id="nav-action">
    <span class="bar"> </span>
</div>

<!--Navbar Links-->
<nav id="nav">
    <ul>
        <li class="shape-circle lead circle-one"><a href="Pages/Session.php?login=deslogar">Logoff</a></li>
        <li class="shape-circle lead circle-two"><a href="#">Cadastro</a></li>
        <li class="shape-circle lead circle-three"><a href="#">Autor</a></li>
        <li class="shape-circle lead circle-five"><a href="#" onclick="barClicked()"></a></li>
    </ul>
</nav>

<div class="container bg-container container-fluid text-center border m-4 p-2 w-75 mx-auto">


    <center><a href="index.php?opc=R"><img class="w-75" src="Imagens/logo.png" alt="logo"/></a></center>

    <?php

    include 'DB.php';
    $opc = 'H';
    if (isset($_GET["opc"])) $opc = $_GET["opc"];
    if ($opc == 'H') {
        include 'Pages/Home.php';
    } elseif ($opc == 'O') {
        include 'Pages/Session.php';
        echo "<br /><br />
					<div class='float-left btn-group'>
					<button type='button' class=' btn btn-secondary' onclick=location.replace('Index.php?opc=O&tipo=Sanduiches')>Sanduíches</button>";
        echo "<button type='button' class='btn btn-secondary' onclick=location.replace('Index.php?opc=O&tipo=Acompanhamentos')>Acompanhamentos</button>";
        echo "<button type='button' class='btn btn-secondary' onclick=location.replace('Index.php?opc=O&tipo=Bebidas')>Bebidas</button>";
        echo "<button type='button' class='btn btn-secondary' onclick=location.replace('Index.php?opc=O&tipo=Sobremesas')>Sobremesas</button></div><br/><br/><br />";

        if (isset($_GET["tipo"])) {
            $tipo = $_GET["tipo"];

            $tabela = 'tb_produtos';
            $colunas = array('NOME', 'TIPO', 'FOTO', 'VALOR');
            $campos = implode(', ', $colunas);

            $lista = funSelect($tabela, $campos, NULL);
        }
    } elseif ($opc == 'R') {
        include 'Pages/Restrito.php';
    } elseif ($opc == 'C') {
        include 'Pages/Cadastro.php';
    } else if ($opc == 'I') {
        if (isset($_POST["nome"]) && isset($_POST["tipo"]) && isset($_POST["img"]) && isset($_POST["valor"]) && is_numeric($_POST["valor"])) {
            $tabela = 'tb_produtos';
            $colunas = array('NOME', 'TIPO', 'FOTO', 'VALOR');
            $campos = implode(', ', $colunas);
            $dados = array("'" . $_POST["nome"] . "'", "'" . $_POST["tipo"] . "'", "'" . $_POST["img"] . "'", "'" . $_POST["valor"] . "'");
            $valores = implode(", ", $dados);

            $sucesso = funInsert($tabela, $campos, $valores);

            if ($sucesso == true) {
                echo '
							<br/><br/><br/><div class="bg-info">
							<h5 class="bg-info float-left text-white">Produto Cadastrado com sucesso!</h5>
							<br/></div><br/>
							<a href="Index.php"> <button class="btn bg-info text-white mb-4">Voltar</button> </a>
							';
            } else {
                echo '
							<div class="container mt-4 bg-warning">
								<h5 class="text-bold">ERRO!!! Falha ao registrar as informações</h5>
							</div>

							<a href="Index.php"> <button class="btn bg-info text-white mb-4">Voltar</button> </a>

							';
            }
        } else {
            echo '
						<div class="container mt-4 bg-warning">
							<h5 class="text-bold">ERRO!!! As informações inseridas não são válidas</h5>
						</div>

						<a href="Index.php"> <button class="btn bg-info text-white mb-4">Voltar</button> </a>

						';
        }
    } else if ($opc == 'L') {
        $tabela = 'tb_produtos';
        $colunas = array('ID', 'NOME', 'TIPO', 'FOTO', 'VALOR');
        $campos = implode(', ', $colunas);

        $lista = funSelect($tabela, $campos, NULL);

        echo '

					<div class="bg-secondary text-center text-light mt-5">
						<h3>Produtos Cadastrados</h3>
					</div>

					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col" class="text-center">Nome</th>
								<th scope="col" class="text-center">Tipo</th>
								<th scope="col" class="text-center">Foto</th>
								<th scope="col" class="text-center">Valor</th>
								<th scope="col" class="text-center">Detalhes</th>
							</tr>
						</thead>
						<tbody>';

        for ($i = 0; $i < count($lista); $i++) {
            echo '
						<tr>
							<td class="text-center">' . $lista[$i]["NOME"] . '</td>
							<td class="text-center">' . $lista[$i]["TIPO"] . '</td>
							<td class="text-center">' . $lista[$i]["FOTO"] . '</td>
							<td class="text-center">R$' . $lista[$i]["VALOR"] . ',00</td>
							<td class="text-center"> <a href="Index.php?opc=D&i=' . $lista[$i]["ID"] . '"><img src="Imagens/View.png" alt="detalhes"></a></td>
						</tr>';

        }

        echo '
						</tbody>
					</table>';
    } else if ($opc == 'D') {

        $i = $_GET["i"];
        $colunas = array('NOME', 'TIPO', 'FOTO', 'VALOR');
        $campos = implode(', ', $colunas);

        $produto = funSelect('tb_produtos', $campos, 'WHERE ID = ' . $i . '');

        echo '
						<div class = "bg-primary text-center text-white mt-5">
							<h3>' . $produto[0]['NOME'] . '</h3>
						</div>
						
							
						

						<div class="row text-center mt-4">
							<div class="col">
								<img src="' . $produto[0]['FOTO'] . '" height="100">
							</div>
							<div class="col mt-4">
								<p><b>Tipo: </b>' . $produto[0]['TIPO'] . '</p>
							</div>
							<div class="col mt-4">
								<p><b>Valor: </b>R$' . $produto[0]['VALOR'] . ',00</p>
							</div>
						</div>

						<button class="btn bg-primary text-white mb-4 mt-3" onclick="history.go(-1)">Voltar</button>
					';
    } else if ($opc == 'A') {
        $tabela = 'tb_produtos';
        $colunas = array('ID', 'NOME', 'TIPO', 'FOTO', 'VALOR');
        $campos = implode(', ', $colunas);

        $lista = funSelect($tabela, $campos, NULL);

        echo '

					<div class="bg-secondary text-center text-light mt-5">
						<h3>Produtos Cadastrados</h3>
					</div>

					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col" class="text-center">Nome</th>
								<th scope="col" class="text-center">Tipo</th>
								<th scope="col" class="text-center">Foto</th>
								<th scope="col" class="text-center">Valor</th>
								<th scope="col" class="text-center">Detalhes</th>
							</tr>
						</thead>
						<tbody>';

        for ($i = 0; $i < count($lista); $i++) {
            echo '
						<tr>
							<td class="text-center">' . $lista[$i]["NOME"] . '</td>
							<td class="text-center">' . $lista[$i]["TIPO"] . '</td>
							<td class="text-center">' . $lista[$i]["FOTO"] . '</td>
							<td class="text-center">R$' . $lista[$i]["VALOR"] . ',00</td>
							<td class="text-center"> <a href="Index.php?opc=M&i=' . $lista[$i]["ID"] . '"><img src="Imagens/Modify.png" alt="detalhes"></a></td>
						</tr>';

        }

        echo '
						</tbody>
					</table>';
    } elseif ($opc == 'M') {
        $i = $_GET["i"];
        echo '
					</br></br>
						<div  class="container text-center mt-4">
						<h3 class="bg-secondary text-white">Atualizar</h4>
						<form action="Index.php?opc=U&i=' . $i . '" method="post">
						
					';
        $selecionado = funSelect('tb_produtos', '*', 'WHERE id=' . $i);


        echo '
						<p>Nome:
						<input type="text" name="nome" size="60" value="' . $selecionado[0]['NOME'] . '">
						</p><p>Tipo:';

        if ($selecionado[0]['TIPO'] == 'Acompanhamentos') {
            echo '
								<select name="tipo">
									<option disabled>Selecione...</option>
									<option selected value="Acompanhamentos">Acompanhamentos</option>
									<option value="Bebidas">Bebidas</option>
									<option value="Sanduiches">Sanduíches</option>
									<option value="Sobremesas">Sobremesas</option>
								</select></p>';
        } else if ($selecionado[0]['TIPO'] == 'Bebidas') {
            echo '
									<select name="tipo">
										<option disabled>Selecione...</option>
										<option value="Acompanhamentos">Acompanhamentos</option>
										<option selected value="Bebidas">Bebidas</option>
										<option value="Sanduiches">Sanduíches</option>
										<option value="Sobremesas">Sobremesas</option>
									</select></p>';
        } else if ($selecionado[0]['TIPO'] == 'Sanduiches') {
            echo '
									<select name="tipo">
										<option disabled>Selecione...</option>
										<option value="Acompanhamentos">Acompanhamentos</option>
										<option value="Bebidas">Bebidas</option>
										<option selected value="Sanduiches">Sanduíches</option>
										<option value="Sobremesas">Sobremesas</option>
									</select></p>';
        } else if ($selecionado[0]['TIPO'] == 'Sobremesas') {
            echo '
									<select name="tipo">
										<option disabled>Selecione...</option>
										<option value="Acompanhamentos">Acompanhamentos</option>
										<option value="Bebidas">Bebidas</option>
										<option value="Sanduiches">Sanduíches</option>
										<option selected value="Sobremesas">Sobremesas</option>
									</select></p>';
        }

        echo '<p>Foto:
						<input type="text" name="img" value="' . $selecionado[0]['FOTO'] . '" size="60">
					</p>

					<p>Valor: R$
						<input type="text" name="valor" value="' . $selecionado[0]['VALOR'] . '" size="10">,00
					</p>

					<button type="submit" class="btn bg-info text-white mb-4">Alterar</button>
					<input type="reset" class="btn bg-info text-white mb-4" value="Limpar"/>

					</form>
					</div>
					';
    } else if ($opc == 'U') {
        if (isset($_POST["nome"]) && isset($_POST["tipo"]) && isset($_POST["img"]) && isset($_POST["valor"]) && is_numeric($_POST["valor"])) {
            $tabela = 'tb_produtos';
            $colunas = array('TIPO="' . $_POST["tipo"] . '"', 'NOME="' . $_POST["nome"] . '"', 'FOTO="' . $_POST["img"] . '"', 'VALOR="' . $_POST["valor"] . '"');
            $campos = implode(', ', $colunas);
            $valores = "WHERE ID=" . $_GET['i'];

            $sucesso = funUpdate($tabela, $campos, $valores);

            if ($sucesso == true) {
                echo '<br/><br/>
								<div class="container mt-4 bg-info">
									<h5 class="text-white">Produto atualizado com sucesso!</h5>
								</div>

								<a href="Index.php"> <button class="btn bg-info text-white mb-4">Voltar</button> </a>';
            } else {
                echo '
							<div class="container mt-4 bg-warning">
								<h5 class="text-bold">ERRO!!! Falha ao registrar as informações</h5>
							</div>

							<a href="Index.php"> <button class="btn bg-info text-white mb-4">Voltar</button> </a>

							';
            }
        } else {
            echo '
						<div class="container mt-4 bg-warning">
							<h5 class="text-bold">ERRO!!! As informações inseridas não são válidas</h5>
						</div>

						<a href="Index.php"> <button class="btn bg-info text-white mb-4">Voltar</button> </a>

						';
        }
    } else if ($opc == 'E') {
        $tabela = 'tb_produtos';
        $colunas = array('ID', 'NOME', 'TIPO', 'FOTO', 'VALOR');
        $campos = implode(', ', $colunas);

        $lista = funSelect($tabela, $campos, NULL);

        echo '

					<div class="bg-secondary text-center text-light mt-5">
						<h3>Produtos Cadastrados</h3>
					</div>

					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col" class="text-center">Nome</th>
								<th scope="col" class="text-center">Tipo</th>
								<th scope="col" class="text-center">Foto</th>
								<th scope="col" class="text-center">Valor</th>
								<th scope="col" class="text-center">Detalhes</th>
							</tr>
						</thead>
						<tbody>';

        for ($i = 0; $i < count($lista); $i++) {
            echo '
						<tr>
							<td class="text-center">' . $lista[$i]["NOME"] . '</td>
							<td class="text-center">' . $lista[$i]["TIPO"] . '</td>
							<td class="text-center">' . $lista[$i]["FOTO"] . '</td>
							<td class="text-center">R$' . $lista[$i]["VALOR"] . ',00</td>
							<td class="text-center"> <a href="Index.php?opc=X&i=' . $lista[$i]["ID"] . '"><img src="Imagens/Erase.png" alt="detalhes"></a></td>
						</tr>';

        }

        echo '
						</tbody>
					</table>';
    } else if ($opc == 'X') {
        if (isset($_GET['i'])) {
            $codigo = $_GET['i'];
            $tabela = 'tb_produtos';
            $campos = "where id = " . $codigo;

            if (funDelete($tabela, $campos) == true) {
                echo "<br/><br/><p class='p-2 bg-primary text-white'>Produto excluído com sucesso!</p>";
            } else
                echo "<p class='p-2 bg-warning text-white'>Erro inesperado!</p";
        } else
            echo "<p class='p-2 bg-warning text-white'>Preencha todos os campos corretamente!</p>";

        echo '<a href="Index.php"> <button class="btn bg-primary text-white mb-4">Voltar</button> </a>';
    }


    ?>
</div>


<div class="container m-4 mx-auto">
    <p class="text-center text-secondary">Desenvolvido por <a href="index.php?opc=Author">Emanuel</a></p>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

<script src="Assets/JS/JS.js"></script>
</html>