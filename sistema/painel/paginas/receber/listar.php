<?php 
require_once("../../../conexao.php");
$tabela = 'plano_trabalho';
$data_atual = date('Y-m-d');

$total_valor = 0;
$total_valorF = 0;
$total_pendentes = 0;
$total_pendentesF = 0;
$total_pagas = 0;
$total_pagasF = 0;

$dataInicial = @$_POST['dataInicial'];
$dataFinal = @$_POST['dataFinal'];
$status = @$_POST['status'];
$alterou_data = @$_POST['alterou_data'];
$vencidas = @$_POST['vencidas'];
$hoje = @$_POST['hoje'];
$amanha = @$_POST['amanha'];


//PEGAR O TOTAL DE PLANOS PENDENTES
$query = $pdo->query("SELECT * from $tabela where data_ent = ''");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
	if($total_reg > 0){
		for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
			$total_pendentes += $res[$i]['valor_plano'];
			$total_pendentesF = number_format($total_pendentes, 2, ',', '.');
	}
}


//PEGAR O TOTAL DE PLANOS PAGOS
$query = $pdo->query("SELECT * from $tabela where data_ent != ''");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
		$total_pagas += $res[$i]['valor_plano'];
		$total_pagasF = number_format($total_pagas, 2, ',', '.');
}}


$data_hoje = date('Y-m-d');
$data_amanha = date('Y/m/d', strtotime("+1 days",strtotime($data_hoje)));



if($status != '' && $status != 'Todos'){
	//echo "Valor de status no if aqui: $status <br>"; // Exibe o valor de $status
	$query = $pdo->query("SELECT * from $tabela where situacao = '$status' order by id desc ");
}
elseif($status == 'Todos'){
	//echo "entrou no todos: $status <br>"; // Exibe o valor de $status
	$query = $pdo->query("SELECT * from $tabela order by id desc");
}
else{
	//echo "Valor de status no else : $status <br>"; // Exibe o valor de $status
	$query = $pdo->query("SELECT * from $tabela WHERE situacao != 'Finalizado' order by id desc ");
}



echo <<<HTML
<small>
HTML;

$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
	<table class="table table-hover" id="tabela">
		<thead> 
			<tr> 				
				<th></th>
				<th class="esc">Nº Recurso</th>
				<th class="esc">Unidade</th>
				<th class="esc">Parlamentar</th>	
				<th class="esc">Valor</th>			 
				<th class="esc">Situação</th> 								
				<th>Plano</th>
				<th>Termo</th>				
				<th>Ações</th>
			</tr> 
		</thead> 
		<tbody> 
HTML;
for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
$id = $res[$i]['id'];

$unidades =$res[$i]['unidades'];
$tipos_recursos =$res[$i]['tipos_recursos'];
$finalidade =$res[$i]['finalidade'];
$parlamentar =$res[$i]['parlamentar'];
$numero_recurso =$res[$i]['numero_recurso'];
$valor_plano =$res[$i]['valor_plano'];
$situacao =$res[$i]['situacao'];
$banco =$res[$i]['banco'];
$agencia =$res[$i]['agencia'];
$conta =$res[$i]['conta'];
$usuario_lanc =$res[$i]['usuario_lanc'];
$data_cad =$res[$i]['data_cad'];
$data_ent =$res[$i]['data_ent'];
$data_venc =$res[$i]['data_venc'];
$data_fim =$res[$i]['data_fim'];
$descricao =$res[$i]['descricao'];
$saldo_recurso =$res[$i]['saldo_recurso'];
$anexo_plano =$res[$i]['anexo_plano'];
$anexo_termo =$res[$i]['anexo_termo'];


//extensão do arquivo
$ext = pathinfo($anexo_plano, PATHINFO_EXTENSION);
if($ext == 'pdf'){
	$tumb_arquivo = 'pdf.png';
}else if($ext == 'rar' || $ext == 'zip'){
	$tumb_arquivo = 'rar.png';
}else if($ext == 'doc' || $ext == 'docx' || $ext == 'txt'){
	$tumb_arquivo = 'word.png';
}else if($ext == 'xlsx' || $ext == 'xlsm' || $ext == 'xls'){
	$tumb_arquivo = 'excel.png';
}else if($ext == 'xml'){
	$tumb_arquivo = 'xml.png';
}else{
	$tumb_arquivo = $anexo_plano;
}

$data_lancF = implode('/', array_reverse(explode('-', $data_cad)));
$data_vencF = implode('/', array_reverse(explode('-', $data_venc)));
$data_pgtoF = implode('/', array_reverse(explode('-', $data_ent)));
$valorF = number_format($valor_plano, 2, ',', '.');

$query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario_lanc'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_usu_lanc = $res2[0]['nome'];
}else{
	$nome_usu_lanc = 'Sem Usuário';
}

/*
$query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario_pgto'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_usu_pgto = $res2[0]['nome'];
}else{
	$nome_usu_pgto = 'Sem Usuário';
}
*/

//$nome_pessoa = $parlamentar;
$tipo_pessoa = 'Pessoa';
$pix_pessoa = 'Sem Registro';

/*
$query2 = $pdo->query("SELECT * FROM parlamentar where parlamentar = '$parlamentar'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome = $res2[0]['nome'];	
	$pix_pessoa = 'Não Cadastrado!';
	$cargo = 'Cargo';
}
*/

		if($situacao == 'Finalizado'){
			$classe_pago = 'verde';
			$ocultar = '';
			
		}else{
			$classe_pago = 'text-danger';
			$ocultar = '';
			
		}

		echo <<<HTML
			<tr> 
				<td>
				<input type="checkbox" id="seletor-{$id}" class="form-check-input" onchange="selecionar('{$id}')">
				<i class="fa fa-square {$classe_pago} mr-1"></i> </td> 
				
				<td class="esc" style="width: 5%;">{$numero_recurso}</td>
				<td class="esc" style="width: 20%;">{$unidades}</td>
				<td class="esc" style="width: 15%;">{$parlamentar}</td>
				<td class="esc" style="width: 10%;">{$valorF}</td>
				<td class="esc" style="width: 10%;">{$situacao}</td>
				<td style="width: 10%;">
				<a href="images/contas/{$anexo_plano}" target="_blank"><img src="images/contas/{$tumb_arquivo}" width="30px" height="30px"></a></td>
				
				<td><a href="images/contas/{$anexo_termo}" target="_blank"><img src="images/contas/{$tumb_arquivo}" width="30px" height="30px"></a></td>
				<td>
					<big><a class="{$ocultar}" href="#" onclick="editar(
					'{$id}',
					'{$unidades}',
					'{$tipos_recursos}',						
					'{$parlamentar}', 
					'{$numero_recurso}',
					'{$valor_plano}',
					'{$situacao}',
					'{$banco}',
					'{$agencia}',
					'{$conta}',
					'{$finalidade}',
					'{$usuario_lanc}',
					'{$data_cad}',
					'{$anexo_plano}',
					'{$data_ent}',
					'{$data_venc}',
					'{$data_fim}',
					'{$descricao}',
					'{$anexo_termo}',
					'{$saldo_recurso}')"

					title="Editar Dados"><i class="fa fa-edit text-primary "></i></a></big>

				
		<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Exclusão? <a href="#" onclick="excluir_conta('{$id}', '{$descricao}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
		</li>


		<big><a href="#" onclick="mostrar(
			

			'{$unidades}',
			'{$tipos_recursos}',						
			'{$parlamentar}', 
			'{$numero_recurso}',
			'{$valor_plano}',
			'{$situacao}',
			'{$banco}',
			'{$agencia}',
			'{$conta}',
			'{$finalidade}',
			'{$usuario_lanc}',
			'{$data_cad}',
			'{$anexo_plano}',
			'{$data_ent}',
			'{$data_venc}',
			'{$data_fim}',
			'{$descricao}',
			'{$anexo_termo}',
			'{$saldo_recurso}')"

			title="Ver Dados"><i class="fa fa-info-circle text-primary"></i></a></big>

						
		<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a class="{$ocultar}" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-check-square" style="color:#079934"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Baixa? <a href="#" onclick="baixar_conta('{$id}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
		</li>				
					

					<big><a href="#" onclick="arquivo('{$id}', '{$descricao}')" title="Inserir / Ver Arquivos"><i class="fa fa-file-o " style="color:#22146e"></i></a></big>
				</td>  
			</tr> 
		HTML;
}
		echo <<<HTML
				</tbody> 
				<small><div align="center" id="mensagem-excluir"></div></small>
			</table>
			<div align="right" style="margin-top: 10px"> 
			<span>À Receber: <span class="text-danger">{$total_pendentesF}</span></span> 
			<span style="margin-left: 35px">Total Recebido: <span class="verde">{$total_pagasF}</span></span> 
			</div>
		</small>
		HTML;
}else{
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
    $('#total_itens').text('R$ <?=$total_pendentesF?>');
});


function editar(
	id,
    unidades,
    tipos_recursos,	
    parlamentar,
	numero_recurso,
	valor_plano,  
    situacao,
    banco,
    agencia,
    conta,
	finalidade,
    usuario_lanc,
    data_cad,
	anexo_plano,
    data_ent,
    data_venc,
    data_fim,
	descricao,		    
    anexo_termo,
	saldo_recurso					
    ) {

    $('#mensagem').text('');
    $('#titulo_inserir').text('Editar Registro');
    $('#id').val(id);
    $('#unidades').val(unidades).change();
    $('#tipos_recursos').val(tipos_recursos).change();
    $('#finalidade').val(finalidade).change();
    $('#usuario_lanc').val(usuario_lanc).change();
    $('#parlamentar').val(parlamentar).change();
    $('#numero_recurso').val(numero_recurso);
    $('#valor_plano').val(valor_plano);
    $('#situacao').val(situacao).change();
    $('#banco').val(banco);
    $('#agencia').val(agencia);
    $('#conta').val(conta);
    $('#data_cad').val(data_cad);
    $('#data_ent').val(data_ent);
	$('#data_venc').val(data_venc);
    $('#data_fim').val(data_fim);
    $('#descricao').val(descricao);
	$('#saldo_recurso').val(saldo_recurso);
    $('#anexo_plano').val('');
    $('#anexo_termo').val('');
    

    $('#modalForm').modal('show');



    resultado = anexo_plano.split(".", 2);

    if (resultado[1] === 'pdf') {
        $('#target').attr('src', "images/pdf.png");
        return;
    } else if (resultado[1] === 'rar' || resultado[1] === 'zip') {
        $('#target').attr('src', "images/rar.png");
        return;
    } else if (resultado[1] === 'doc' || resultado[1] === 'docx') {
        $('#target').attr('src', "images/word.png");
        return;
    } else if (resultado[1] === 'xlsx' || resultado[1] === 'xlsm' || resultado[1] === 'xls') {
        $('#target').attr('src', "images/excel.png");
        return;
    } else if (resultado[1] === 'xml') {
        $('#target').attr('src', "images/xml.png");
        return;
    } else {
        $('#target').attr('src', 'images/contas/' + anexo_plano);
    }

    resultado2 = anexo_termo.split(".", 2);

    if (resultado2[1] === 'pdf') {
        $('#target').attr('src', "images/pdf.png");
        return;
    } else if (resultado2[1] === 'rar' || resultado2[1] === 'zip') {
        $('#target').attr('src', "images/rar.png");
        return;
    } else if (resultado2[1] === 'doc' || resultado2[1] === 'docx') {
        $('#target').attr('src', "images/word.png");
        return;
    } else if (resultado2[1] === 'xlsx' || resultado2[1] === 'xlsm' || resultado2[1] === 'xls') {
        $('#target').attr('src', "images/excel.png");
        return;
    } else if (resultado2[1] === 'xml') {
        $('#target').attr('src', "images/xml.png");
        return;
    } else {
        $('#target').attr('src', 'images/contas/' + anexo_termo);
    }

}


function mostrar(
	
    unidades,
    tipos_recursos,	
    parlamentar,
	numero_recurso,
	valor_plano,  
    situacao,
    banco,
    agencia,
    conta,
	finalidade,
    usuario_lanc,
    data_cad,
	anexo_plano,
    data_ent,
    data_venc,
    data_fim,
	descricao,		    
    anexo_termo,
	saldo_recurso	
) {
	
	$('#unidades_dados').text(unidades);
    $('#tipos_recursos_dados').text(tipos_recursos);
	$('#parlamentar_dados').text(parlamentar);
    $('#numero_recurso_dados').text(numero_recurso);
    $('#valor_plano_dados').text(valor_plano);
	$('#situacao_dados').text(situacao);
	$('#banco_dados').text(banco);
	$('#agencia_dados').text(agencia);
	$('#conta_dados').text(conta);
	$('#finalidade_dados').text(finalidade);
	$('#usuario_lanc_dados').text(usuario_lanc);
	$('#data_cad_dados').text(data_cad);
    $('#anexo_plano_dados').text(anexo_plano);
	$('#data_ent_dados').text(data_ent);
	$('#data_venc_dados').text(data_venc);
	$('#data_fim_dados').text(data_fim);
	$('#descricao_dados').text(descricao);
	$('#anexo_termo_dados').text(anexo_termo);
	$('#saldo_recurso_dados').text(saldo_recurso);  
	
    $('#modalDados').modal('show');
}



function limparCampos() {

	$('#id').val('');
    $('#unidades').val('').change();
    $('#tipos_recursos').val('').change();
    $('#finalidade').val('').change();
    $('#usuario_lanc').val('').change();
    $('#parlamentar').val('').change();
    $('#numero_recurso').val('');
    $('#valor_plano').val('');
    $('#situacao').val('').change();
    $('#banco').val('');
    $('#agencia').val('');
    $('#conta').val('');
    $('#data_cad').val('');
    $('#data_ent').val('');
	$('#data_venc').val('');
    $('#data_fim').val('');
    $('#descricao').val('');
	$('#saldo_recurso').val('');
    $('#anexo_plano').val('');
	$('#target').attr('src', 'images/contas/sem-foto.png');
    $('#anexo_termo').val('');
	$('#target').attr('src', 'images/contas/sem-foto.png');

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