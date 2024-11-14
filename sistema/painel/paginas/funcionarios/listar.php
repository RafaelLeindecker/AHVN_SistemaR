<?php
$tabela = 'funcionarios';
require_once("../../../conexao.php");

$query = $pdo->query("SELECT * from $tabela order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if ($linhas > 0) {
	echo <<<HTML
<small>
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Contrato</th>	
	<th class="esc">Nome</th>	
	<th class="esc"></th>	
	<th class="esc">Cargo</th>	
	<th class="esc">Turno</th>	
	<th class="esc">Ativo</th>
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

	for ($i = 0; $i < $linhas; $i++) {
		$id = $res[$i]['id'];
		$contrato = $res[$i]['contrato'];
		$admissao = $res[$i]['admissao'];
		$ativos = $res[$i]['ativos'];
		$nome = $res[$i]['nome'];
		$cpf = $res[$i]['cpf'];
		$telefone = $res[$i]['telefone'];
		$email = $res[$i]['email'];
		$cargo = $res[$i]['cargo'];
		$turno = $res[$i]['turno'];
		$endereco = $res[$i]['endereco'];
		$obs = $res[$i]['obs'];
		$data1 = $res[$i]['data1'];
		$data2 = $res[$i]['data2'];
		$desligamento = $res[$i]['desligamento'];

		$data = $res[$i]['data'];

		$dataF = implode('/', array_reverse(explode('-', $data)));



		echo <<<HTML
<tr>
<td>
<input type="checkbox" id="seletor-{$id}" class="form-check-input" onchange="selecionar('{$id}')">
{$contrato}
</td>
<td class="esc">{$nome}</td>
<td class="esc"></td>
<td class="esc">{$cargo}</td>
<td class="esc">{$turno}</td>
<td class="esc">{$ativos}</td>
<td>
	<big><a href="#" onclick="editar('{$id}','{$contrato}','{$admissao}','{$ativos}','{$nome}','{$cpf}','{$telefone}','{$email}','{$cargo}','{$turno}','{$endereco}','{$obs}', '{$data1}','{$data2}','{$desligamento}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

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

<big><a href="#" onclick="mostrar('{$contrato}', '{$admissao}',
 '{$ativos}', '{$nome}', '{$cpf}', '{$telefone}','{$email}', 
 '{$cargo}','{$turno}','{$endereco}','{$obs}', '{$data1}','{$data2}','{$desligamento}', 
 '{$dataF}')" 
 
 title="Mostrar Dados"><i class="fa fa-info-circle text-primary"></i></a></big>


<big><a href="#" onclick="arquivo('{$id}', '{$nome}')" title="Inserir / Ver Arquivos"><i class="fa fa-file-o " style="color:#22146e"></i></a></big>

<big><a href="#" onclick="reservas('{$id}', '{$nome}')" title="Ver Reservas"><i class="fa fa-calendar" style="color:#827878"></i></a></big>


</td>
</tr>
HTML;
	}


	echo <<<HTML
</tbody>
<small><div align="center" id="mensagem-excluir"></div></small>
</table>
HTML;
} else {
	echo 'Nenhum registro Cadastrado!';
}
?>



<script type="text/javascript">
$(document).ready(function() {
    $('#tabela').DataTable({
        "language": {
            //"url" : '//cdn.datatables.net/plug-ins/1.13.2/i18n/pt-BR.json'
        },
        "ordering": false,
        "stateSave": true
    });
});
</script>

<script type="text/javascript">
function editar(id, contrato, admissao, ativos, nome, cpf, telefone, email, cargo, turno, endereco, obs, data1, data2,
    desligamento) {
    $('#mensagem').text('');
    $('#titulo_inserir').text('Editar Registro');
    $('#id').val(id);
    $('#contrato').val(contrato);
    $('#admissao').val(admissao);
    $('#ativos').val(ativos);
    $('#nome').val(nome);
    $('#cpf').val(cpf);
    $('#telefone').val(telefone);
    $('#email').val(email);
    $('#cargo').val(cargo).change();
    $('#turno').val(turno).change();
    $('#endereco').val(endereco);
    $('#obs').val(obs);
    $('#data1').val(data1);
    $('#data2').val(data2);
    $('#desligamento').val(desligamento);

    $('#modalForm').modal('show');
}


function mostrar(contrato, admissao, ativos, nome, cpf, telefone, email, cargo, turno, endereco, obs, data1, data2,
    desligamento, data) {

    $('#contrato_dados').text(contrato);
    $('#admissao_dados').text(admissao);
    $('#ativos_dados').text(ativos);
    $('#nome_dados').text(nome);
    $('#cpf_dados').text(cpf);
    $('#telefone_dados').text(telefone);
    $('#email_dados').text(email);
    $('#cargo_dados').text(cargo);
    $('#turno_dados').text(turno);
    $('#endereco_dados').text(endereco);
    $('#obs_dados').text(obs);
    $('#data1_dados').text(data1);
    $('#data2_dados').text(data2);
    $('#desligamento_dados').text(desligamento);
    $('#data_dados').text(data);

    $('#modalDados').modal('show');
}

function limparCampos() {
    $('#id').val('');
    $('#contrato').val('');
    $('#admissao').val('');
    $('#ativos').val('');
    $('#nome').val('');
    $('#cpf').val('');
    $('#telefone').val('');
    $('#cargo').val('');
    $('#turno').val('');
    $('#email').val('');
    $('#endereco').val('');
    $('#obs').val('');
    $('#data1').val('');
    $('#data2').val('');
    $('#desligamento').val('');

    $('#ids').val('');
    $('#btn-deletar').hide();
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
        $('#btn-deletar').hide();
    } else {
        $('#btn-deletar').show();
    }
}

function deletarSel() {
    var ids = $('#ids').val();
    var id = ids.split("-");

    for (i = 0; i < id.length - 1; i++) {
        excluir(id[i]);
    }

    limparCampos();
}

function arquivo(id, nome) {
    $('#id-arquivo').val(id);
    $('#nome-arquivo').text(nome);
    $('#modalArquivos').modal('show');
    $('#mensagem-arquivo').text('');
    listarArquivos();
}

function reservas(id, nome) {
    $('#id-reservas').val(id);
    $('#nome-reservas').text(nome);
    $('#modalReservas').modal('show');
    listarReservas();
}
</script>