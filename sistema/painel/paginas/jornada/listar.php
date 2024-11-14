<?php
require_once("../../../conexao.php");
$tabela = 'jornadas';
$data_atual = date('Y-m-d');
$statusJornadaID = @$_POST['statusJornada'];
$statusJornada = 'Todos';
$statusSituacao = @$_POST['statusSituacao'];
$total_kg = @$_POST['total_kg'];
$total_kg_ajuste = @$_POST['total_kg_ajuste'];
$dataInicial = @$_POST['dataInicial'];
$dataFinal = @$_POST['dataFinal'];
$alterouData = @$_POST['alterouData'];
$total_valor = 0;
$total_valorF = 0;
$total_pendentes = 0;
$total_pendentesF = 0;
$total_pagas = 0;
$total_pagasF = 0;
$hojeAtual = @$_POST['hoje'];

// Consulta para buscar o nome com base no ID da jornada
$query = $pdo->query("SELECT nome FROM tipos_jornada WHERE id = '$statusJornadaID'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

// Verifica se algum registro foi encontrado
if (count($res) > 0) {
    $statusJornada = $res[0]['nome'];
    
} 

// PEGAR O TOTAL DAS CONTAS A PAGAR PENDENTES
$query = $pdo->query("SELECT * FROM $tabela WHERE situacao = '$statusSituacao' ORDER BY id DESC");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = count($res);
if ($total_reg > 0) {
    foreach ($res as $item) {
        $total_valor += $item['total_kg'];
    }
    $total_valorF = number_format($total_valor, 2, ',', '.');
}

// Definir as datas
$data_hoje = date('Y-m-d');
$data_amanha = date('Y-m-d', strtotime("+1 day", strtotime($data_hoje)));

// Verificações de depuração
echo "Filtros Recebidos: <br>";
echo "Alterou Data: $alterouData <br>";
echo "Data Inicial: $dataInicial <br>";
echo "Data Final: $dataFinal <br>";
echo "Status Jornada: $statusJornada <br>";
echo "Status Situação: $statusSituacao <br>";
echo "Hoje: $hojeAtual <br>";

	// Consulta principal com base nas condições de data, status e vencimento
	if ($alterouData === 'Sim') {
		$query = $pdo->query("SELECT * FROM $tabela 
    WHERE (
        (hora_inicial BETWEEN '$dataInicial' AND '$dataFinal') 
        OR (hora_final BETWEEN '$dataInicial' AND '$dataFinal')
        OR (hora_inicial >= '$dataInicial' AND hora_final <= '$dataFinal')
    )
    AND situacao = '$statusSituacao' 
    AND tipo_jornada = '$statusJornadaID' 
    ORDER BY id DESC");
		echo "Primeira Linha: Filtro por data e status jornada.<br>";

	} elseif ($statusSituacao == 'Todos' && $statusJornada == 'Todos') {
		// Caso o status seja 'Finalizada' e não tenha alterado a data
		$query = $pdo->query("SELECT * FROM $tabela 
							ORDER BY id DESC");
		echo "Segunda Linha: Filtro por Todos.<br>";

	}elseif ($statusSituacao == 'Todos' && $statusJornada == 'Abastecimento') {
		// Caso o status seja 'Finalizada' e não tenha alterado a data
		$query = $pdo->query("SELECT * FROM $tabela 
							WHERE  tipo_jornada = '$statusJornadaID' 
							ORDER BY id DESC");
		echo "Terceira Linha: Filtro por status Coletas finalizadas .<br>";

	}elseif ($statusSituacao == 'Todos'  && $statusJornada = 'Coleta') {
		// Caso o status seja 'Finalizada' e não tenha alterado a data
		$query = $pdo->query("SELECT * FROM $tabela 
							WHERE tipo_jornada  = '$statusJornadaID'
							ORDER BY id DESC");
		echo "Quarta Linha: Filtro por status Aberta.<br>";

	} elseif ($statusSituacao == 'Aberta' && $statusJornadaID != 'Todos') {
		// Caso o status seja 'Finalizada' e não tenha alterado a data
		$query = $pdo->query("SELECT * FROM $tabela 
							WHERE situacao = 'Aberta' 
							AND tipo_jornada = '$statusJornadaID' 
							ORDER BY id DESC");
		echo "Quinta Linha: Filtro por status Aberta.<br>";

	} elseif ($statusSituacao == 'Aberta') {
		// Caso o status seja 'Finalizada' e não tenha alterado a data
		$query = $pdo->query("SELECT * FROM $tabela 
							WHERE situacao = 'Aberta'
							ORDER BY id DESC");
		echo "Sexta Linha: Filtro por status Aberta.<br>";

	}elseif ($statusSituacao == 'Finalizada' && $statusJornadaID != 'Todos') {
		// Caso o status seja 'Finalizada' e não tenha alterado a data
		$query = $pdo->query("SELECT * FROM $tabela 
							WHERE situacao = 'Finalizada' 
							AND tipo_jornada = '$statusJornadaID' 
							ORDER BY id DESC");
		echo "Setima Linha: Filtro por status Aberta.<br>";

	} elseif ($statusSituacao == 'Finalizada') {
		// Caso o status seja 'Finalizada' e não tenha alterado a data
		$query = $pdo->query("SELECT * FROM $tabela 
							WHERE situacao = 'Finalizada'
							ORDER BY id DESC");
		echo "Oitava Linha: Filtro por status Aberta.<br>";

	} elseif ($hojeAtual === 'Hoje') {

		// Caso o vencimento seja 'Hoje'
		$query = $pdo->query("SELECT * FROM $tabela 
							WHERE data_inicial= CURDATE() 
							AND situacao = 'Aberta' 
							ORDER BY id DESC");
		echo "Nona Linha: Filtro por vencimento hoje.<br>";

	} elseif ($statusSituacao === '') {
		// Caso o status seja '%Todos%' e situação seja 'Aberta'
		$query = $pdo->query("SELECT * FROM $tabela 
							WHERE situacao = 'Aberta' 
							ORDER BY id DESC");
		echo "decima Linha: Filtro por todos com situação aberta.<br>";

	} else {
		// Caso padrão quando nenhuma condição específica é atendida
		$query = $pdo->query("SELECT * FROM $tabela 
							WHERE situacao = 'Aberta' 
							ORDER BY id DESC");
		echo "ultima Linha: Entrou na condição padrão.<br>";
	}


echo <<<HTML
<small>
HTML;

$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if ($total_reg > 0) {
	echo <<<HTML
	<table class="table table-hover" id="tabela">
		<thead> 
			<tr> 				
				<th></th>
				<th class="esc">Nº</th>
				<th class="esc">Início</th>
				<th class="esc">Situação</th>
				<th class="esc">Colaborador</th>
				<th class="esc">Jornada</th>
				<th class="esc">Setor</th>											 
				<th class="esc">Total Kg</th> 								
							
				<th>Ações</th>
			</tr> 
		</thead> 
		<tbody> 
HTML;

	for ($i = 0; $i < $total_reg; $i++) {
		foreach ($res[$i] as $key => $value) {
		}

		$id = $res[$i]['id'];
		$situacao = $res[$i]['situacao'];
		$funcionario = $res[$i]['funcionario'];
		$tipo_jornada = $res[$i]['tipo_jornada'];
		$setor = $res[$i]['setor'];
		$produto = $res[$i]['produto'];
		$hora_inicial = $res[$i]['hora_inicial'];
		$hora_final = $res[$i]['hora_final'];
		$tempo = $res[$i]['tempo'];
		$total_kg = $res[$i]['total_kg'];
		$obs = $res[$i]['obs'];

		$query2 = $pdo->query("SELECT * FROM funcionarios where id = '$funcionario'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$total_reg2 = @count($res2);
		if ($total_reg2 > 0) {
			$nome_funcionarios = $res2[0]['nome'];
		} else {
			$nome_funcionarios = 'Sem Referência!';
		}

		$query2 = $pdo->query("SELECT * FROM tipos_jornada where id = '$tipo_jornada'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$total_reg2 = @count($res2);
		if ($total_reg2 > 0) {
			$nome_tipo_jornada = $res2[0]['nome'];
		} else {
			$nome_tipo_jornada = 'Sem Referência!';
		}

		$query2 = $pdo->query("SELECT * FROM setor where id = '$setor'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$total_reg2 = @count($res2);
		if ($total_reg2 > 0) {
			$nome_setor = $res2[0]['nome'];
		} else {
			$nome_setor = 'Sem Referência!';
		}

		if ($situacao == 'Finalizada') {
			$classe_pago = 'verde';
			$ocultar = '';
		} else {
			$classe_pago = 'text-danger';
			$ocultar = '';
		}

		echo <<<HTML
<tr> 
    <td>
        <input type="checkbox" id="seletor-{$id}" class="form-check-input" onchange="selecionar('{$id}')">
        <i class="fa fa-square {$classe_pago} mr-1"></i>
    </td> 
    
    <td class="esc" style="width: 5%;">{$id}</td>
    <td class="esc" style="width: 15%;">{$hora_inicial}</td>
    <td class="esc" style="width: 15%;">{$situacao}</td>
    <td class="esc" style="width: 15%;">{$nome_funcionarios}</td>
    <td class="esc" style="width: 10%;">{$nome_tipo_jornada}</td>
    <td class="esc" style="width: 15%;">{$nome_setor}</td>
    <td class="esc" style="width: 10%;">{$total_kg}</td>
    <td style="width: 10%;">
		
        <big><a href="#" onclick="editar(
            '{$id}',
            '{$situacao}',
            '{$funcionario}',
            '{$tipo_jornada}',
            '{$setor}',
            '{$produto}',
            '{$hora_inicial}',
            '{$hora_final}',
            '{$tempo}',
            '{$total_kg}',
            '{$obs}'
        )" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>
    
		
		<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
		</li>

    
		<big><a href="#" onclick="mostrar(
			'{$id}',
            '{$situacao}',
            '{$funcionario}',
            '{$tipo_jornada}',
            '{$setor}',
            '{$produto}',
            '{$hora_inicial}',
            '{$hora_final}',
            '{$tempo}',
            '{$total_kg}',
            '{$obs}'
		)" title="Mostrar Dados"><i class="fa fa-info-circle text-primary"></i></a></big>
        
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <big><i class="fa fa-check-square" style="color:#079934"></i></big>
        </a>
    </td>
</tr>
HTML;
	}

	echo <<<HTML
				</tbody> 
				<small><div align="center" id="mensagem-excluir"></div></small>
			</table>
			<div align="right" style="margin-top: 10px"> 
			<span>Pesados: <span class="text-danger">{$total_kg_ajuste}</span></span> 
			<span style="margin-left: 35px">Total de kilos: <span class="verde">{$total_kg_ajuste}</span></span> 
			</div>
		</small>
		HTML;
} else {
	echo 'Não possui nenhum recurso com essa situação!';
}

?>


<script type="text/javascript">
	$(document).ready(function() {
		$('#tabela').DataTable({
			"ordering": false,
			"stateSave": true,
		});
		$('#tabela_filter label input').focus();
		$('#total_itens').text('R$ <?= $total_kg_ajuste ?>');
	});


	function editar(
		id,
		situacao,
		funcionario,
		tipo_jornada,
		setor,
		produto,
		hora_inicial,
		hora_final,
		tempo,
		total_kg,
		obs

	) {

		$('#mensagem').text('');
		$('#titulo_inserir').text('Editar Registro');
		$('#id').val(id);
		$('#situacao').val(situacao);
		$('#funcionario').val(funcionario);
		$('#tipo_jornada').val(tipo_jornada);
		$('#setor').val(setor);
		$('#produto').val(produto);
		$('#hora_inicial').val(hora_inicial);
		$('#hora_final').val(hora_final);
		$('#tempo').val(tempo);
		$('#total_kg').val(total_kg);
		$('#obs').val(obs);

		// Atualizar o conteúdo do label 'situacaoLabel'
		$('#situacaoLabel').text(situacao);

		// Configurações do botão e label de situação
		const situacaoLabel = $('#situacaoLabel');
		const botaoAcao = $('#btn-acao');

		if (situacao === '-') {
			situacaoLabel.text('-').css('color', 'black');
			botaoAcao.text('Iniciar').removeClass('btn-danger').addClass('btn-primary').show();
		} else if (situacao === 'Aberta') {
			situacaoLabel.text('Aberta').css('color', 'green');
			botaoAcao.text('Finalizar').removeClass('btn-primary').addClass('btn-danger').show();
		} else if (situacao === 'Finalizada') {
			situacaoLabel.text('Finalizada').css('color', 'red');
			btnIniciar.style.display = "none"; // Oculta o botão
		}
		$('#modalForm').modal('show');


	}


	function mostrar(
		id,
		situacao,
		funcionario,
		tipo_jornada,
		setor,
		produto,
		hora_inicial,
		hora_final,
		tempo,
		total_kg,
		obs) {

		$('#id_mostrar').text(id);
		$('#situacao_mostrar').text(situacao);
		$('#funcionario_mostrar').text(funcionario);
		$('#tipo_jornada_mostrar').text(tipo_jornada);
		$('#setor_mostrar').text(setor);
		$('#produto_mostrar').text(produto);
		$('#hora_inicial_mostrar').text(hora_inicial);
		$('#hora_final_mostrar').text(hora_final);
		$('#tempo_mostrar').text(tempo);
		$('#total_kg_mostrar').text(total_kg);
		$('#obs_mostrar').text(obs);

		$('#modalMostrar').modal('show');
	}



	function limparCampos() {

		$('#id').val('');
		$('#situacao').val('').change();
		$('#funcionario').val('').change();
		$('#tipo_jornada').val('').change();
		$('#setor').val('').change();
		$('#produto').val('').change();
		$('#hora_inicial').val('').change();
		$('#hora_final').val('').change();
		$('#tempo').val('').change();
		$('#total_kg').val('').change();
		$('#obs').val('').change();


		$('#ids').val('');
		$('#div_botoes').hide();

	}


	function arquivo(id, nome) {
		$('#id-arquivo').val(id);
		$('#nome-arquivo').text(nome);
		$('#modalArquivos').modal('show');
		$('#mensagem-arquivo').text('');
		listarArquivos();
	}


	function selecionar(id) {

		var ids = $('#ids').val();

		if ($('#seletor-' + id).is(":checked") == true) {
			var novo_id = ids + id + '-';
			$('#ids').val(novo_id);
		} else {
			var retirar = ids.replace(id + '-', '');
			$('#ids').val(retirar);
		}

		var ids_final = $('#ids').val();
		if (ids_final == "") {
			$('#div_botoes').hide();
		} else {
			$('#div_botoes').show();
		}
	}

	function deletarSel() {
		var ids = $('#ids').val();
		var id = ids.split("-");

		for (i = 0; i < id.length - 1; i++) {
			excluir_conta(id[i]);
		}

		limparCampos();
	}

	function baixarSel() {
		var ids = $('#ids').val();
		var id = ids.split("-");

		for (i = 0; i < id.length - 1; i++) {
			baixar_conta(id[i]);
		}

		limparCampos();
	}
</script>