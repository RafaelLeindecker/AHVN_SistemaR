<?php 
$pag = 'jornada';

//verificar se ele tem a permissão de estar nessa página
if(@$jornada == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>


<div class="margin_mobile" style="display: flex; justify-content: space-between; align-items: center;">
    <form method="post" action="rel/servicos_class.php" target="_blank" style="display: flex; align-items: center; flex-grow: 1;">

        <a onclick="inserir()" type="button" class="btn btn-primary" style="margin-right: 10px; flex: 1;">
            <span class="fa fa-plus"></span> Start
        </a>
        
             
        <li class="dropdown head-dpdn2" style="display: inline-block; margin-left: 10px; flex: 1;">		
            <a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle" id="btn-deletar" style="display:none">
                <span class="fa fa-trash-o"></span> Deletar
            </a>
            <ul class="dropdown-menu">
                <li>
                    <div class="notification_desc2">
                        <p>Excluir Selecionados? <a href="#" onclick="deletarSel()"><span class="text-danger">Sim</span></a></p>
                    </div>
                </li>										
            </ul>
        </li>

        <!-- Filtro por Status -->
        <select class="form-control" aria-label="Default select example" name="status-situacao" id="status-situacao" style="flex: 2; margin-left: 10px;"limparDatas();>
            <option value="Aberta">Aberta</option>               
            <option value="Finalizada">Finalizada</option>
            <option value="Todos">Todos</option>
        </select>
        
        <!-- Select de Filtro por Categoria -->       
        <select class="form-control" style="flex: 2; margin-left: 10px;" id="status-jornada" name="status-jornada" onchange="buscar()">
        <option value="Todos">Todos</option>
            <?php 
                $query = $pdo->query("SELECT * from tipos_jornada order by nome asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $linhas = @count($res);
                if($linhas > 0){
                    for($i=0; $i<$linhas; $i++){
            ?>
                <option value='<?php echo $res[$i]['id'] ?>'><?php echo $res[$i]['nome'] ?></option>
            <?php 
                    } 
                } 
            ?>
        </select>

        <!-- Filtros de Data -->
        <div style="display: flex; align-items: center; margin-left: 10px;"limparDatas();>
            <div class="esc" style="margin-right: 5px;">
                <span><small><i title="Data de Vencimento Inicial" class="fa fa-calendar-o"></i></small></span>
            </div>
            <input type="date" class="form-control" name="data-inicial" id="data-inicial" required style="flex: 1; margin-right: 10px;">
            
            <div class="esc" style="margin-right: 5px;">
                <span><small><i title="Data de Vencimento Final" class="fa fa-calendar-o"></i></small></span>
            </div>
            <input type="date" class="form-control" name="data-final" id="data-final" required style="flex: 1;">
        </div>


        <i class="fa fa-search text-primary" style="margin-left: 10px;"></i>
    </form>

    <!-- Botão PDF fixado no lado direito -->
    <button type="submit" style="margin-left: 10px; flex: 1;" class="btn btn-success" onclick="window.open('rel/servicos_class.php', '_blank');">
        <span class="fa fa-file-pdf-o"></span> Relatório
    </button>
</div>
        
<!-- Função Para listar dados -->
<div class="bs-example widget-shadow" style="padding:15px" id="listar"></div>
<input type="hidden" id="ids">


<!-- Modal para Inserção de Dados -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"><span id="titulo_inserir">Inserir Registro</span></h4>
                
                <button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
			<form id="form">
				<div class="modal-body">

					<!-- colaborador -->
					<div class="row">
						<div class="col-md-12">							
							<label>Colaborador</label>
							<select class="form-control sel2" name="funcionario" id="funcionario" style="width:100%">
                            
                            <option value="">Selecione um Colaborador</option>

                            <!-- Consulta PHP para obter os colaboradores -->
								<?php 
								$query = $pdo->query("SELECT * from funcionarios order by nome asc");
								$res = $query->fetchAll(PDO::FETCH_ASSOC);
								$linhas = @count($res);
								if($linhas > 0){
									for($i=0; $i<$linhas; $i++){
								?>
								<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>
								<?php } } else { ?>
								<option value="">Cadastre um colaborador</option>
								<?php } ?>
							</select>									
						</div>			
					
						<div class="col-md-6">							
							<label>Tipo de Jornada</label>
							<select class="form-control sel2" name="tipo_jornada" id="tipo_jornada" style="width:100%">
							
                            <option value="">Selecionar Jornada</option>

								<?php 
								$query = $pdo->query("SELECT * from tipos_jornada order by nome asc");
								$res = $query->fetchAll(PDO::FETCH_ASSOC);
								$linhas = @count($res);
								if($linhas > 0){
									for($i=0; $i<$linhas; $i++){
								?>
								<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>
								<?php } } else { ?>
								<option value="">Cadastre um Tipo de Jornada</option>
								<?php } ?>
							</select>									
						</div>			

						<div class="col-md-6">							
							<label>Setor</label>
							<select class="form-control sel2" name="setor" id="setor" style="width:100%">
							
                            <option value="">Selecionar Setor</option>

								<?php 
								$query = $pdo->query("SELECT * from setor order by nome asc");
								$res = $query->fetchAll(PDO::FETCH_ASSOC);
								$linhas = @count($res);
								if($linhas > 0){
									for($i=0; $i<$linhas; $i++){
								?>
								<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>
								<?php } } else { ?>
								<option value="">Cadastre um Setor</option>
								<?php } ?>
							</select>									
						</div>			

						<div class="col-md-12">							
							<label>Produto</label>
							<select class="form-control sel2" name="produto" id="produto" style="width:100%">
                            
                            <option value="">Selecione um Colaborador</option>

                            <!-- Consulta PHP para obter os colaboradores -->
								<?php 
								$query = $pdo->query("SELECT * from produtos order by nome asc");
								$res = $query->fetchAll(PDO::FETCH_ASSOC);
								$linhas = @count($res);
								if($linhas > 0){
									for($i=0; $i<$linhas; $i++){
								?>
								<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>
								<?php } } else { ?>
								<option value="">Cadastre um Produto</option>
								<?php } ?>
							</select>									
						</div>			
                    
					<!-- Data, Hora -->
					<div class="row">

                    <div class="col-md-4">
                        <label>Data Início</label>
                        <input type="datetime-local" name="hora_inicial" id="hora_inicial" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label>Data Final</label>
                        <input type="datetime-local" name="hora_final" id="hora_final" class="form-control" readonly>
                    </div>	

						<div class="col-md-4">
							<label>Tempo Jornada</label>
							<input type="text" name="tempo" id="tempo" class="form-control" readonly>
						</div>
			
					</div>
					<div class="row">
						<div class="col-md-4">
							<label>KG Total</label>
							<input type="number" name="total_kg" id="total_kg" class="form-control" step="0.01" oninput="calcularPeso()">
						</div>
						<div class="col-md-4">
							<label>KG Tara</label>
							<input type="number" name="kg_tara" id="kg_tara" class="form-control" step="0.01" oninput="calcularPeso()">
						</div>
						<div class="col-md-4">
							<label>KG Roupa</label>
							<input type="number" name="kg_roupa" id="kg_roupa" class="form-control" readonly>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Observação</label>
							<textarea maxlength="255" type="text" class="form-control" name="obs" id="obs"> </textarea>
						</div>
                    </div>

                    <input type="hidden" class="form-control" id="id" name="id">
										
					<br>
					<small><div id="mensagem" align="center"></div></small>
				</div>

				<div class="col text-left">
                    <label id="situacaoLabel"> - </label> <!-- O texto da label-->
                </div>
                <!-- Campo oculto para armazenar o valor da label -->
                <input type="hidden" id="situacao" name="situacao">                
                    <!-- Botões -->
                    <div class="modal-footer">
                        <button type="submit" id="btn-iniciar" class="btn btn-primary">Iniciar</button>
                    </div>
				</div>
			</form>
		</div>
	</div>
</div>


<!-- ModalMostrar -->
<div class="modal fade" id="modalMostrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"><span id=""></span></h4>
                <button id="btn-fechar-dados" type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="margin-top: -5px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" style="margin-top: 0px">

                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>Número: </b></span><span id="id_mostrar"></span>
                    </div>

                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>Situação: </b></span><span id="situacao_mostrar"></span>
                    </div>

                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>Colaborador: </b></span><span id="funcionario_mostrar"></span>
                    </div>               
                  
                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>Produto: </b></span><span id="produto_mostrar"></span>
                    </div>

                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>Hora Inicial: </b></span><span id="hora_inicial_mostrar"></span>
                    </div>

                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>Hora Final: </b></span><span id="hora_final_mostrar"></span>
                    </div>

                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>Tempo: </b></span><span id="tempo_mostrar"></span>
                    </div>

                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>Total kg: </b></span><span id="total_kg_mostrar"></span>
                    </div>

                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>Observações: </b></span><span id="obs_mostrar"></span>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-print" onclick="imprimirModal()">
                            <i class="fa fa-print" style="font-size: 2em;"></i> <!-- Substitua pela classe de ícone desejada -->
                        </button>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal de Alerta -->
<div class="modal fade" id="modalAlerta" tabindex="-1" aria-labelledby="modalAlertaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 300px;"> <!-- Ajusta o tamanho do modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAlertaLabel" style="color: red; font-weight: bold;">Atenção!</h5> <!-- Título em vermelho e negrito -->
            </div>
            <div class="modal-body">
                <p id="alert-message"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="fecharAlerta()">OK</button> <!-- Botão OK em vermelho -->
            </div>
        </div>
    </div>
</div>

<script>
    function imprimirModal() {
        var conteudo = document.getElementById('modalMostrar').innerHTML;
        var janelaImpressao = window.open('', '_blank', 'width=600,height=600');
        janelaImpressao.document.write('<html><head><title>Impressão</title></head><body>');
        janelaImpressao.document.write(conteudo);
        janelaImpressao.document.write('</body></html>');
        janelaImpressao.document.close();
        janelaImpressao.print();
    }
</script>

<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    // Função para ajustar a data e hora no campo datetime-local
    window.onload = function() {
        var now = new Date();
        var year = now.getFullYear();
        var month = (now.getMonth() + 1).toString().padStart(2, '0'); // Ajuste do mês (começa em 0)
        var day = now.getDate().toString().padStart(2, '0');
        var hours = now.getHours().toString().padStart(2, '0');
        var minutes = now.getMinutes().toString().padStart(2, '0');
        
        // Formato adequado para o datetime-local: yyyy-MM-ddTHH:mm
        var currentDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;
        
        // Definir o valor no campo
        document.getElementById('hora_inicial').value = currentDateTime;
    }
</script>


<script>

    // Inicializa o campo de data/hora de início com a data/hora atual ao carregar a página
    document.addEventListener("DOMContentLoaded", function () {
        const now = new Date();
        document.getElementById('hora_inicial').value = formatarDataHoraLocal(now);
    });

    // Função para calcular o peso da roupa
    function calcularPeso() {
        const kgTotal = parseFloat(document.getElementById('total_kg').value) || 0;
        const kgTara = parseFloat(document.getElementById('kg_tara').value) || 0;
        const kgRoupa = kgTotal - kgTara;
        document.getElementById('kg_roupa').value = kgRoupa >= 0 ? kgRoupa.toFixed(2) : 0;
    }

    // Função para alternar entre iniciar e finalizar jornada
    function alternarStatus() {
        const btnIniciar = document.getElementById('btn-iniciar');
        const statusIniciado = btnIniciar.innerText === "Iniciar";
        
        if (statusIniciado) {
            iniciarJornada();
        } else {
            finalizarJornada();
        }
    }

    // Função para iniciar a jornada
    function iniciarJornada() {
        const horaInicial = document.getElementById('hora_inicial');
        const now = new Date();
        horaInicial.value = formatarDataHoraLocal(now);

        const btnIniciar = document.getElementById('btn-iniciar');
        btnIniciar.innerText = "Finalizar Jornada";
        btnIniciar.classList.replace("btn-primary", "btn-danger");
    }

    // Função para finalizar a jornada e calcular o tempo de jornada
    function finalizarJornada() {
        const horaFinal = document.getElementById('hora_final');
        const tempoJornada = document.getElementById('tempo');
        const horaInicial = new Date(document.getElementById('hora_inicial').value);
        const now = new Date();
        
        horaFinal.value = formatarDataHoraLocal(now);

        // Cálculo da duração
        const duracao = now - horaInicial;
        const horas = Math.floor(duracao / 3600000);
        const minutos = Math.floor((duracao % 3600000) / 60000);
        tempoJornada.value = `${horas}h ${minutos}m`;

        // Ajustes no botão
        const btnIniciar = document.getElementById('btn-iniciar');
        btnIniciar.innerText = "Iniciar Jornada";
        btnIniciar.classList.replace("btn-danger", "btn-primary");
    }

    // Função para formatar data e hora no formato local
    function formatarDataHoraLocal(data) {
        const offset = data.getTimezoneOffset() * 60000;
        const localISOTime = new Date(data.getTime() - offset).toISOString().slice(0, 16);
        return localISOTime;
    }
    
</script>

<script type="text/javascript">
	
$(document).ready(function() {
				$('.sel2').select2({
					dropdownParent: $('#modalForm')
				});				

                $('#status-jornada').change(function(){
					//var dataInicial = $('#data-inicial').val();
					//var dataFinal = $('#data-final').val();
					var statusJornada = $('#status-jornada').val();
                    var statusSituacao = $('#status-situacao').val();
					listarBusca(statusJornada, statusSituacao);
				});

                $('#status-situacao').change(function(){
					//var dataInicial = $('#data-inicial').val();
					//var dataFinal = $('#data-final').val();
					var statusJornada = $('#status-jornada').val();
                    var statusSituacao = $('#status-situacao').val();
					listarBusca(statusJornada, statusSituacao);
				});


				$('#data-final, #data-inicial').change(function() {
                    
                    var statusJornada = $('#status-jornada').val();
                    var statusSituacao = $('#status-situacao').val();
                    var dataInicial = $('#data-inicial').val();
                    var dataFinal = $('#data-final').val();
                    
                    // Define 'alterouData' como 'Sim' apenas se ambos os campos de data estiverem preenchidos
                    var alterouData = (dataInicial || dataFinal) ? 'Sim' : '';
                    
                    listarBusca(statusJornada, statusSituacao, dataInicial, dataFinal, alterouData);
                });

                $('#hoje').change(function(){
					//var dataInicial = $('#data-inicial').val();
					//var dataFinal = $('#data-final').val();
					var statusJornada = $('#status-jornada').val();
                    var statusSituacao = $('#status-situacao').val();
                    var hojeAtual = $('#hoje').val();
					listarBusca(statusJornada, statusSituacao, hojeAtual);
				});
				


			});

			function listarBusca(statusJornada, statusSituacao, dataInicial, dataFinal, alterouData, hoje){				
				$.ajax({
					url: 'paginas/' + pag + "/listar.php",
					method: 'POST',
					data: {statusJornada, statusSituacao, dataInicial, dataFinal, alterouData, hoje},
					dataType: "html",

					success:function(result){
						$("#listar").html(result);
					}
				});
			}


			function listarContasHoje(hoje){
				$.ajax({
					url: 'paginas/' + pag + "/listar.php",
					method: 'POST',
					data: {hoje},
					dataType: "html",

					success:function(result){
						$("#listar").html(result);
					}
				});
			}

</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('.sel4').select2({
            dropdownParent: $('#modalBaixar')
        });
    });
    </script>

</body>
</html>