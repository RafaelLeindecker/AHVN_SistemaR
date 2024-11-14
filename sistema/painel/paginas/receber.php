<?php 
$pag = 'receber';

//verificar se ele tem a permissão de estar nessa página
if(@$receber == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>

<div class="row">
    <div class="col-md-10">

        <div style="float:left; margin-right:35px">
            <button onclick="inserir()" type="button" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus"
                    aria-hidden="true"></i>Novo Plano</button>
        </div>

        
        <div class="esc" style="float:left; margin-right:10px"><span><small><i title="Filtrar por Status"
                        class="bi bi-search"></i></small></span></div>
        <div class="esc" style="float:left; margin-right:20px">
            <select class="form-control" aria-label="Default select example" name="status-busca" id="status-busca">
                
                <option value="">Em Aberto</option>
                <option value="Todos">Todos</option>
                <option value="Aguardando Aceite">Aguardando Aceite</option>
                <option value="Aguardando Recurso">Aguardando Recurso</option>
                <option value="Processo De Compra">Processo de Compra</option>
                <option value="Finalizado">Finalizado</option>
                <option value="Rejeitado">Rejeitado</option>

            </select>
        </div>
 


    </div>

    <div align="right" class="col-md-2">
        <small><i class="fa fa-usd verde"></i> <span class="black">Recursos à Receber: <span class="text-danger"
                    id="total_itens"></span></span></small>
    </div>

    
</div>


<div id="div_botoes" style="display:none">
    <li class="dropdown head-dpdn2" style="display:inline-block;">
        <a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle" id="btn-deletar" style=""><span
                class="fa fa-trash-o"></span> Deletar</a>

        <ul class="dropdown-menu">
            <li>
                <div class="notification_desc2">
                    <p>Excluir Selecionados? <a href="#" onclick="deletarSel()"><span class="text-danger">Sim</span></a>
                    </p>
                </div>
            </li>
        </ul>
    </li>

    <li class="dropdown head-dpdn2" style="display: inline-block; margin-left: 20px">
        <a href="#" data-toggle="dropdown" class="btn btn-success dropdown-toggle" id="btn-baixar" style=""><span
                class="fa fa-check-square"></span> Baixar</a>

        <ul class="dropdown-menu">
            <li>
                <div class="notification_desc2">
                    <p>Baixar Selecionados? <a href="#" onclick="baixarSel()"><span class="verde">Sim</span></a></p>
                </div>
            </li>
        </ul>
    </li>
</div>

<div class="bs-example widget-shadow" style="padding:15px" id="listar">

</div>


<input type="hidden" id="ids">

<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"><span id="titulo_inserir"></span></h4>
                <button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="form-contas">
                <div class="modal-body">

                    <div class="row">

                    <div class="col-md-12">
                            <div class="form-group">
                                <label>Unidade</label>
                                <select class="form-control sel2" name="unidades" id="unidades"
                                    style="width:100%;" required>

                                    <option value="">Selecionar Unidade</option>

                                    <?php 
									$query = $pdo->query("SELECT * FROM unidades order by razaoSocial asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}

											?>
                                    <option value="<?php echo $res[$i]['razaoSocial'] ?>"><?php echo $res[$i]['razaoSocial'] ?></option>

                                    <?php } ?>

                                </select>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <label>Origem do Recurso</label>
                            <select class="form-control" name="tipos_recursos" id="tipos_recursos" required>
                                <option value="">Selecione o Recurso</option>
                                <?php
                                $query = $pdo->query("SELECT * from tipos_recursos order by nome asc");
                                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                                $linhas = @count($res);
                                if ($linhas > 0) {
                                    for ($i = 0; $i < $linhas; $i++) {
                                ?>
                                <option value="<?php echo $res[$i]['nome'] ?>"><?php echo $res[$i]['nome'] ?></option>
                                <?php }
                                } else { ?>
                                <option value="">Cadastre um Recurso</option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>Finalidade</label>
                            <select class="form-control" name="finalidade" id="finalidade">
                            <option value="">Selecione a finalidade</option>
                                <option value="Custeio">Corrente/Custeio</option>
                                <option value="Investimento">Capital/Investimento</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Parlamentar</label>
                                <select class="form-control sel2" name="parlamentar" id="parlamentar"
                                    style="width:100%;">

                                    <option value="">Selecionar Parlamentar</option>

                                    <?php 
									$query = $pdo->query("SELECT * FROM parlamentares order by nome asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}

											?>
                                    <option value="<?php echo $res[$i]['nome'] ?>"><?php echo $res[$i]['nome'] ?></option>

                                    <?php } ?>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Nº do Recurso</label>
                                <input type="text" class="form-control" name="numero_recurso" id="numero_recurso"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Valor do Plano de Trabalho</label>
                                <input type="text" class="form-control valor-moeda" name="valor_plano" id="valor_plano"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label>Situação</label>
                            <select class="form-control" name="situacao" id="situacao" onchange="toggledata_fim()">
                                <option value="Aguardando Aceite">Aguardando Aceite</option>
                                <option value="Aguardando Recurso">Aguardando Recurso</option>
                                <option value="Processo De Compra">Processo de Compra</option>
                                <option value="Prestação de Contas">Prestação de Contas</option>
                                <option value="Finalizado">Finalizado</option>
                                <option value="Rejeitado">Rejeitado</option>

								</select>
                        </div>


                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Banco</label>
                                <input type="text" class="form-control" name="banco" id="banco">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Agência</label>
                                <input type="text" class="form-control" name="agencia" id="agencia">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Conta Corrente</label>
                                <input type="text" class="form-control" name="conta" id="conta">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Data Cadastrado</label>
                                <input type="date" class="form-control" name="data_cad" id="data_cad" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Data Entrada Recurso</label>                               
                                <input type="date" class="form-control" name="data_ent" id="data_ent" onchange="handleDataEntChange()">
                            </div>
                        </div>
                                           

                        <div class="col-md-3">
                            <label>Data Vencimento</label>
                            <input type="date" class="form-control" name="data_venc" id="data_venc" value="" readonly >
                        </div>                            
                                                  
                        <div class="col-md-3">
                            <label>Data Finalizada</label>
                            <input type="date" class="form-control" name="data_fim" id="data_fim" required disabled>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Descrição do Plano de Trabalho</label>
                                <textarea maxlength="255" type="text" class="form-control" name="descricao" id="descricao"> </textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Anexar Plano de Trabalho</label>
                                <input class="form-control" type="file" name="anexo_plano" onChange="carregarImg();"
                                    id="anexo_plano">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="divImg">
                                <img src="images/contas/sem-foto.png" width="70px" id="target">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Anexar Termo de Fomento</label>
                                <input class="form-control" type="file" name="anexo_termo" onChange="carregarImg();"
                                    id="anexo_termo">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="divImg">
                                <img src="images/contas/sem-foto.png" width="70px" id="target">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Saldo da Emenda</label>
                                <input type="text" class="form-control valor-moeda" name="saldo_recurso" id="saldo_recurso" disabled required >
                            </div>
                        </div>


                    </div>

                    <br>
                    <input type="hidden" name="id" id="id">
                    <small>
                        <div id="mensagem" align="center" class="mt-3"></div>
                    </small>

                </div>


                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>



            </form>

        </div>
    </div>
</div>

<!-- Modal Dados -->
<div class="modal fade" id="modalDados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"><span id="titulo_inserir"></span></h4>
                <button id="btn-fechar-dados" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -5px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" style="margin-top: 0px">
                                       
                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>Unidades: </b></span><span id="unidades_dados"></span>
                    </div>
                    <div class="col-md-12" style="margin-bottom: 5px">
                       <span><b>Tipo Recurso: </b></span><span id="tipos_recursos_dados"></span>
                    </div> 
                    <div class="col-md-12" style="margin-bottom: 5px">
                       <span><b>Parlamentar: </b></span><span id="parlamentar_dados"></span>
                    </div>
                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>Número do Recurso: </b></span><span id="numero_recurso_dados"></span>
                    </div>
                    <div class="col-md-12" style="margin-bottom: 5px">
                       <span><b>Valor do Plano: </b></span><span id="valor_plano_dados"></span>
                    </div> 
                    <div class="col-md-12" style="margin-bottom: 5px">
                       <span><b>Situação: </b></span><span id="situacao_dados"></span>
                    </div>
                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>Banco: </b></span><span id="banco_dados"></span>
                    </div>
                    <div class="col-md-12" style="margin-bottom: 5px">
                       <span><b>Agência: </b></span><span id="agencia_dados"></span>
                    </div> 
                    <div class="col-md-12" style="margin-bottom: 5px">
                       <span><b>Contas: </b></span><span id="conta_dados"></span>
                    </div>
                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>Finalidade: </b></span><span id="finalidade_dados"></span>
                    </div>
                    <div class="col-md-12" style="margin-bottom: 5px">
                       <span><b>Data Cadastrada: </b></span><span id="data_cad_dados"></span>
                    </div>
                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>Data Entrada Recurso: </b></span><span id="data_ent_dados"></span>
                    </div>
                    <div class="col-md-12" style="margin-bottom: 5px">
                       <span><b>Data Vencimento recurso: </b></span><span id="data_venc_dados"></span>
                    </div> 
                    <div class="col-md-12" style="margin-bottom: 5px">
                       <span><b>Data Finalizada: </b></span><span id="data_fim_dados"></span>
                    </div>
                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>Descrição do Recurso: </b></span><span id="descricao_dados"></span>
                    </div>
                    <div class="col-md-12" style="margin-bottom: 5px">
                       <span><b>Saldo Recurso: </b></span><span id="saldo_recurso_dados"></span>
                    </div> 
                
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-print" onclick="imprimirModal()">
                    <i class="fa fa-print" style="font-size: 2em;"></i> <!-- Substitua pela classe de ícone desejada -->
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .modal-footer {
        position: relative;
    }

    .btn-print {
        position: absolute;
        bottom: 10px; /* Ajuste a distância do fundo conforme necessário */
        right: 10px; /* Ajuste a distância da direita conforme necessário */
    }
</style>


<!-- Modal Arquivos -->
<div class="modal fade" id="modalArquivos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="tituloModal">Gestão de Arquivos - <span id="nome-arquivo"> </span></h4>
                <button id="btn-fechar-arquivos" type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-arquivos" method="post">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Arquivo</label>
                                <input class="form-control" type="file" name="arquivo_conta"
                                    onChange="carregarImgArquivos();" id="arquivo_conta">
                            </div>
                        </div>
                        <div class="col-md-4" style="margin-top:-10px">
                            <div id="divImgArquivos">
                                <img src="images/arquivos/sem-foto.png" width="60px" id="target-arquivos">
                            </div>
                        </div>

                    </div>

                    <div class="row" style="margin-top:-40px">
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="nome-arq" id="nome-arq"
                                placeholder="Nome do Arquivo * " required>
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Inserir</button>
                        </div>
                    </div>

                    <hr>

                    <small>
                        <div id="listar-arquivos"></div>
                    </small>

                    <br>
                    <small>
                        <div align="center" id="mensagem-arquivo"></div>
                    </small>

                    <input type="hidden" class="form-control" name="id-arquivo" id="id-arquivo">


                </div>
            </form>
        </div>
    </div>


    <script type="text/javascript"> var pag = "<?=$pag?>" </script><script src="js/ajax.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('.sel2').select2({
            dropdownParent: $('#modalForm')
        });

        $('#data-inicial').change(function() {
            var dataInicial = $('#data-inicial').val();
            var dataFinal = $('#data-final').val();
            var status = $('#status-busca').val();
            var alterou_data = 'Sim';
            listarBusca(dataInicial, dataFinal, status, alterou_data);

        });

        $('#data-final').change(function() {
            var dataInicial = $('#data-inicial').val();
            var dataFinal = $('#data-final').val();
            var status = $('#status-busca').val();
            var alterou_data = 'Sim';
            listarBusca(dataInicial, dataFinal, status, alterou_data);
        });

        $('#status-busca').change(function() {
            var dataInicial = $('#data-inicial').val();
            var dataFinal = $('#data-final').val();
            var status = $('#status-busca').val();
            listarBusca(dataInicial, dataFinal, status);
        });


    });
    </script>


    <script type="text/javascript">
    $(document).ready(function() {
        $('.sel3').select2({
            dropdownParent: $('#modalParcelar')
        });
    });
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('.sel4').select2({
            dropdownParent: $('#modalBaixar')
        });
    });
    </script>


<script>
    function imprimirModal() {
        var conteudo = document.getElementById('modalDados').innerHTML;
        var janelaImpressao = window.open('', '_blank', 'width=600,height=600');
        janelaImpressao.document.write('<html><head><title>Impressão</title></head><body>');
        janelaImpressao.document.write(conteudo);
        janelaImpressao.document.write('</body></html>');
        janelaImpressao.document.close();
        janelaImpressao.print();
    }
</script>


    <script type="text/javascript">
    function listarBusca(dataInicial, dataFinal, status, alterou_data) {
        $.ajax({
            url: 'paginas/' + pag + "/listar.php",
            method: 'POST',
            data: {
                dataInicial,
                dataFinal,
                status,
                alterou_data
            },
            dataType: "html",

            success: function(result) {
                $("#listar").html(result);
            }
        });
    }



    function listarContasVencidas(vencidas) {

        $.ajax({
            url: 'paginas/' + pag + "/listar.php",
            method: 'POST',
            data: {
                vencidas
            },
            dataType: "html",

            success: function(result) {
                $("#listar").html(result);
            }
        });
    }


    function listarContasHoje(hoje) {
        $.ajax({
            url: 'paginas/' + pag + "/listar.php",
            method: 'POST',
            data: {
                hoje
            },
            dataType: "html",

            success: function(result) {
                $("#listar").html(result);
            }
        });
    }


    function listarContasAmanha(amanha) {
        $.ajax({
            url: 'paginas/' + pag + "/listar.php",
            method: 'POST',
            data: {
                amanha
            },
            dataType: "html",

            success: function(result) {
                $("#listar").html(result);
            }
        });
    }
    </script>


    <script type="text/javascript">
    function carregarImg() {
        var target = document.getElementById('target');
        var file = document.querySelector("#arquivo").files[0];

        var arquivo = file['name'];
        resultado = arquivo.split(".", 2);


        if (resultado[1] === 'pdf') {
            $('#target').attr('src', "images/pdf.png");
            return;
        }

        if (resultado[1] === 'rar' || resultado[1] === 'zip') {
            $('#target').attr('src', "images/rar.png");
            return;
        }

        if (resultado[1] === 'doc' || resultado[1] === 'docx') {
            $('#target').attr('src', "images/word.png");
            return;
        }

        if (resultado[1] === 'xlsx' || resultado[1] === 'xlsm' || resultado[1] === 'xls') {
            $('#target').attr('src', "images/excel.png");
            return;
        }


        if (resultado[1] === 'xml') {
            $('#target').attr('src', "images/xml.png");
            return;
        }

        var reader = new FileReader();

        reader.onloadend = function() {
            target.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);

        } else {
            target.src = "";
        }
    }
    </script>



    <script type="text/javascript">
    function carregarImgArquivos() {
        var target = document.getElementById('target-arquivos');
        var file = document.querySelector("#arquivo_conta").files[0];

        var arquivo = file['name'];
        resultado = arquivo.split(".", 2);


        if (resultado[1] === 'pdf') {
            $('#target-arquivos').attr('src', "images/pdf.png");
            return;
        }

        if (resultado[1] === 'rar' || resultado[1] === 'zip') {
            $('#target-arquivos').attr('src', "images/rar.png");
            return;
        }

        if (resultado[1] === 'doc' || resultado[1] === 'docx') {
            $('#target-arquivos').attr('src', "images/word.png");
            return;
        }

        if (resultado[1] === 'xlsx' || resultado[1] === 'xlsm' || resultado[1] === 'xls') {
            $('#target-arquivos').attr('src', "images/excel.png");
            return;
        }


        if (resultado[1] === 'xml') {
            $('#target-arquivos').attr('src', "images/xml.png");
            return;
        }

        var reader = new FileReader();

        reader.onloadend = function() {
            target.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);

        } else {
            target.src = "";
        }
    }
    </script>




    <script type="text/javascript">
    $("#form-contas").submit(function() {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: 'paginas/' + pag + "/inserir.php",
            type: 'POST',
            data: formData,

            success: function(mensagem) {

                $('#mensagem').text('');
                $('#mensagem').removeClass()
                if (mensagem.trim() == "Salvo com Sucesso") {
                    $('#btn-fechar').click();
                    var dataInicial = $('#data-inicial').val();
                    var dataFinal = $('#data-final').val();
                    var status = $('#status-busca').val();
                    var alterou_data = 'Sim';
                    listarBusca(dataInicial, dataFinal, status, alterou_data);
                } else {
                    $('#mensagem').addClass('text-danger')
                    $('#mensagem').text(mensagem)
                }

            },

            cache: false,
            contentType: false,
            processData: false,

        });

    });
    </script>


    <script type="text/javascript">
    function excluir_conta(id) {
        $('#mensagem-excluir').text('Excluindo...')

        $.ajax({
            url: 'paginas/' + pag + "/excluir.php",
            method: 'POST',
            data: {
                id
            },
            dataType: "html",

            success: function(mensagem) {

                if (mensagem.trim() == "Excluído com Sucesso") {

                    var dataInicial = $('#data-inicial').val();
                    var dataFinal = $('#data-final').val();
                    var status = $('#status-busca').val();
                    var alterou_data = 'Sim';
                    listarBusca(dataInicial, dataFinal, status, alterou_data);
                } else {
                    $('#mensagem-excluir').addClass('text-danger')
                    $('#mensagem-excluir').text(mensagem)
                }
            }
        });
    }




    function baixar_conta(id) {
        $('#mensagem-excluir').text('Baixando...')

        $.ajax({
            url: 'paginas/' + pag + "/baixar.php",
            method: 'POST',
            data: {
                id
            },
            dataType: "html",

            success: function(mensagem) {

                if (mensagem.trim() == "Baixado com Sucesso") {

                    var dataInicial = $('#data-inicial').val();
                    var dataFinal = $('#data-final').val();
                    var status = $('#status-busca').val();
                    var alterou_data = 'Sim';
                    listarBusca(dataInicial, dataFinal, status, alterou_data);
                } else {
                    $('#mensagem-excluir').addClass('text-danger')
                    $('#mensagem-excluir').text(mensagem)
                }
            }
        });
    }
    
    </script>





    <script type="text/javascript">
    $("#form-arquivos").submit(function() {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: 'paginas/' + pag + "/arquivos.php",
            type: 'POST',
            data: formData,

            success: function(mensagem) {
                $('#mensagem-arquivo').text('');
                $('#mensagem-arquivo').removeClass()
                if (mensagem.trim() == "Inserido com Sucesso") {
                    //$('#btn-fechar-arquivos').click();
                    $('#nome-arq').val('');
                    $('#arquivo_conta').val('');
                    $('#target-arquivos').attr('src', 'images/arquivos/sem-foto.png');
                    listarArquivos();
                } else {
                    $('#mensagem-arquivo').addClass('text-danger')
                    $('#mensagem-arquivo').text(mensagem)
                }

            },

            cache: false,
            contentType: false,
            processData: false,

        });

    });
    </script>

    <script type="text/javascript">
    function listarArquivos() {
        var id = $('#id-arquivo').val();
        $.ajax({
            url: 'paginas/' + pag + "/listar-arquivos.php",
            method: 'POST',
            data: {
                id
            },
            dataType: "text",

            success: function(result) {
                $("#listar-arquivos").html(result);
            }
        });
    }

    $(document).ready(function() {
        $('#saldo_recurso').on('focus', function() {
        // Quando o campo recebe foco (clicado), limpa o valor e exibe apenas "R$ ".
        $(this).val('R$ ');
    });

    $('#saldo_recurso').on('blur', function() {
        var unformattedValue = $(this).val().replace(/[^\d,.]/g, ''); // Remove caracteres não numéricos, exceto vírgulas e pontos.

        // Remove todas as vírgulas e pontos, exceto a primeira.
        unformattedValue = unformattedValue.replace(/[,\.](?=.*[,\.])/g, '');

        // Substitui a vírgula por ponto para garantir que seja um número válido.
        unformattedValue = unformattedValue.replace(',', '.');

        // Converte o valor em um número de ponto flutuante.
        var floatValue = parseFloat(unformattedValue) || 0;

        // Formata o valor como moeda brasileira com a sigla "R$".
        var formattedValue = 'R$ ' + floatValue.toLocaleString('pt-BR', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });

        $(this).val(formattedValue);
    });

        // Adiciona automaticamente "R$0,00" ao campo quando ele é carregado.
        $('.valor-moeda').val('R$0,00');


        // Adiciona "R$0,00" ao campo "saldo_recurso" somente se o campo for clicado.
        $('#saldo_recurso').on('click', function() {
        if ($(this).val() === '') {
            $(this).val('R$0,00');
        }
        
    });

    });



    
    // Obtém referências para os campos de data
    const data_entInput = $('#data_ent');
    const data_vecInput = $('#data_vec');
    const data_fimInput = $('#data2');

    // Adiciona um listener de mudança (change) ao campo "data_ent"
    data_entInput.on('change', function() {
        recalcularDatas();
    });

    
    // Função para converter a data do formato "dd/mm/aaaa" para um objeto Date
    function parseDate(dateString) {
        const parts = dateString.split('-');
        const year = parseInt(parts[0]);
        const month = parseInt(parts[1]) - 1;
        const day = parseInt(parts[2]);

        return new Date(year, month, day);
    }

    // Função para formatar a data no formato "dd/mm/aaaa"
    function formatDate(date) {
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();
        return `${year}-${month}-${day}`;
    }

    // Função para ativar o campo data_fim
    function toggledata_fim() {
        
        var situacaoSelect = document.getElementById("situacao");
        var data_fimInput = document.getElementById("data_fim");
        console.log("Valor do situacaoSelect: " + situacaoSelect.value);
        if (situacaoSelect.value === "Finalizado") {
            data_fimInput.disabled = false; // Habilitar o campo data_fim
            data_fimInput.value = ""; // Limpar o campo data_fim
        } else {
            data_fimInput.disabled = true; // Desabilitar o campo data_fim
            data_fimInput.value = ""; // Limpar o campo data_fim
        }
    }
    
 // Função para lidar com a alteração do campo data_ent
 function handleDataEntChange() {
        var data_entInput = document.getElementById("data_ent");
        var data_vencInput = document.getElementById("data_venc");
        var saldo_recursoInput = document.getElementById("saldo_recurso");

        // Verifique se o campo data_ent está vazio
        if (data_entInput.value === "") {
            // Limpar o campo data_venc
            data_vencInput.value = "";

            // Desabilitar o campo saldo_recurso
            saldo_recursoInput.disabled = true;
            // Remover a obrigatoriedade do campo saldo_recurso
            saldo_recursoInput.removeAttribute("required");

        } else {
            // Caso contrário, habilite o campo saldo_recurso
            saldo_recursoInput.disabled = false;
            // Adicionar a obrigatoriedade do campo saldo_recurso
            saldo_recursoInput.setAttribute("required", "required");

            // Recalcule a data em data_venc
            recalcularDatas();
        }
    }

    // Função para recalcular as datas com base na admissão
    function recalcularDatas() {
        var data_entInput = document.getElementById("data_ent");
        var data_vencInput = document.getElementById("data_venc");

        const datadata_ent = parseDate(data_entInput.value);

        // Verifica se a data de data_ent é válida
        if (!isNaN(datadata_ent.getTime())) {
            const datadata_vec = new Date(datadata_ent.getTime() + (365 - 1) * 24 * 60 * 60 * 1000);
            data_vencInput.value = formatDate(datadata_vec);
        }
    }

    // Função para converter a data do formato "aaaa-mm-dd" para um objeto Date
    function parseDate(dateString) {
        const parts = dateString.split('-');
        const year = parseInt(parts[0]);
        const month = parseInt(parts[1]) - 1;
        const day = parseInt(parts[2]);

        return new Date(year, month, day);
    }

    // Função para formatar a data no formato "aaaa-mm-dd"
    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    
</script>
