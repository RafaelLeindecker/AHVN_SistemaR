<?php 
$tabela = 'parlamentares';
require_once("../../../conexao.php");

$query = $pdo->query("SELECT * from $tabela order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
echo <<<HTML
<small>
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Nome</th>	
	<th class="esc">Cargo Público</th>	
	<th class="esc">Telefone</th>	
	<th class="esc">Email</th>	
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];
	$cargos_publico = $res[$i]['cargos_publico'];
	$telefone = $res[$i]['telefone'];
	$email = $res[$i]['email'];	
	$obs = $res[$i]['obs'];	
echo <<<HTML
<tr>
<td>
<input type="checkbox" id="seletor-{$id}" class="form-check-input" onchange="selecionar('{$id}')">
{$nome}
</td>
<td class="esc">{$cargos_publico}</td>
<td class="esc">{$telefone}</td>
<td class="esc">{$email}</td>



<td>
	<big><a href="#" onclick="editar('{$id}','{$nome}','{$cargos_publico}','{$telefone}','{$email}','{$obs}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

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

<big><a href="#" onclick="mostrar('{$nome}', '{$cargos_publico}','{$email}','{$telefone}','{$obs}')" title="Mostrar Dados"><i class="fa fa-info-circle text-primary"></i></a></big>


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
}else{
	echo 'Nenhum registro Cadastrado!';
}
?>



<script type="text/javascript">
	$(document).ready( function () {		
    $('#tabela').DataTable({
    	"language" : {
            //"url" : '//cdn.datatables.net/plug-ins/1.13.2/i18n/pt-BR.json'
        },
        "ordering": false,
		"stateSave": true
    });
} );
</script>

<script type="text/javascript">
	function editar(id, nome, cargos_publico, telefone, email,obs){
		$('#mensagem').text('');
    	$('#titulo_inserir').text('Editar Registro');

    	$('#id').val(id);
    	$('#nome').val(nome);
		$('#cargos_publico').val(cargos_publico);
		$('#telefone').val(telefone);
    	$('#email').val(email);
    	$('#obs').val(obs);
    	$('#modalForm').modal('show');
	}


	function mostrar(nome, cargos_publico, telefone, email,obs){
		    	
    	$('#titulo_dados').text(nome);
		$('#cargos_publico_dados').text(cargos_publico);
		$('#telefone_dados').text(telefone);
    	$('#email_dados').text(email);
    	$('#obs_dados').text(obs);

    	$('#modalDados').modal('show');
	}

	function limparCampos(){
		$('#id').val('');
    	$('#nome').val('');
		$('#cargos_publico').val('');
		$('#telefone').val('');
    	$('#email').val('');
    	$('#obs').val('');
    	$('#ids').val('');
    	$('#btn-deletar').hide();	
	}

	function selecionar(id){

		var ids = $('#ids').val();

		if($('#seletor-'+id).is(":checked") == true){
			var novo_id = ids + id + '-';
			$('#ids').val(novo_id);
		}else{
			var retirar = ids.replace(id + '-', '');
			$('#ids').val(retirar);
		}

		var ids_final = $('#ids').val();
		if(ids_final == ""){
			$('#btn-deletar').hide();
		}else{
			$('#btn-deletar').show();
		}
	}

	function deletarSel(){
		var ids = $('#ids').val();
		var id = ids.split("-");
		
		for(i=0; i<id.length-1; i++){
			excluir(id[i]);			
		}

		limparCampos();
	}


	function arquivo(id, nome){
    $('#id-arquivo').val(id);    
    $('#nome-arquivo').text(nome);
    $('#modalArquivos').modal('show');
    $('#mensagem-arquivo').text(''); 
    listarArquivos();   
}


function reservas(id, nome){
    $('#id-reservas').val(id);    
    $('#nome-reservas').text(nome);
    $('#modalReservas').modal('show');   
    listarReservas();   
}
</script>