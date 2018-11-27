<?php
/**
 * Created by PhpStorm.
 * User: emanuel.resende
 * Date: 26/11/2018
 * Time: 13:30
 */

include 'Pages/Session.php';
echo '
								<h3 class="text-white">Cadastro</h3>
                                    <form class="form form-group" action="Index.php?opc=I" method="post">
										
										<p>Nome:
										<input type="text" name="nome" size="60">
										</p>
										
										<p>Tipo:
                                        <select class="form-control" name="tipo">
                                            <option class="form-control" selected disabled>Selecione...</option>
                                            <option class="form-control" value="Acompanhamentos">Acompanhamentos</option>
											<option class="form-control" value="Bebidas">Bebidas</option>
											<option class="form-control" value="Sanduiches">Sanduíches</option>
                                            <option class="form-control" value="Sobremesas">Sobremesas</option>
                                        </select></p>

                                        <label for="img">Foto:</label>
                                            <input type="text" id="img" name="img" value="Imagens/Fotos/" size="60">

                                        <p>Valor: R$
                                            <input type="text" name="valor" value="0" size="10">
                                        </p>

                                        <button type="submit" class="btn bg-info text-white mb-4">Cadastrar</button>

                                    </form>
                                ';

?>