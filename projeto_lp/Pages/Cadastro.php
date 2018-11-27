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
                                        <select class="form-control w-50" name="tipo">
                                            <option selected disabled>Selecione...</option>
                                            <option value="Acompanhamentos">Acompanhamentos</option>
											<option value="Bebidas">Bebidas</option>
											<option value="Sanduiches">Sanduíches</option>
                                            <option value="Sobremesas">Sobremesas</option>
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