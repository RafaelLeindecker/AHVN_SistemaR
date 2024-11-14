<?php 
$tabela = 'unidades';
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
	<th>Unidades</th>	
	<th class="esc">Telefone</th>	
	<th class="esc">Email</th>			
	<th class="esc">Cadastrado</th>
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$razaoSocial = $res[$i]['razaoSocial'];
	$cnpj = $res[$i]['cnpj'];
	$telefone = $res[$i]['telefone'];
	$nomeContato = $res[$i]['nomeContato'];
	$celular = $res[$i]['celular'];
	$email = $res[$i]['email'];
	$cep = $res[$i]['cep'];
	$endereco = $res[$i]['endereco'];
	$bairro = $res[$i]['bairro'];
	$cidade = $res[$i]['cidade'];
	$email = $res[$i]['email'];	
	$estado = $res[$i]['estado'];
	$numero = $res[$i]['numero'];
	$complemento = $res[$i]['complemento'];	
	$data = $res[$i]['data'];
 
	$dataF = implode('/', array_reverse(explode('-', $data)));

	
echo <<<HTML
<tr>
<td>
<input type="checkbox" id="seletor-{$id}" class="form-check-input" onchange="selecionar('{$id}')">
{$razaoSocial}
</td>
<td class="esc">{$telefone}</td>
<td class="esc">{$email}</td>
<td class="esc">{$dataF}</td>
<td>
	<big><a href="#" onclick="editar(
		'{$id}',
		'{$razaoSocial}',
		'{$cnpj}',
		'{$telefone}',
		'{$nomeContato}',
		'{$celular}',
		'{$email}',
		'{$cep}',
		'{$endereco}',
		'{$bairro}',
		'{$cidade}',
		'{$estado}',
		'{$numero}',
		'{$complemento}'
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

<big><a href="#" onclick="mostrar('{$razaoSocial}','{$cnpj}','{$telefone}','{$nomeContato}','{$celular}','{$email}','{$cep}','{$endereco}','{$bairro}','{$cidade}','{$estado}','{$numero}','{$complemento}')" title="Mostrar Dados"><i class="fa fa-info-circle text-primary"></i></a></big>

<big><a href="#" onclick="arquivo('{$id}', '{$razaoSocial}')" title="Inserir / Ver Arquivos"><i class="fa fa-file-o " style="color:#22146e"></i></a></big>

<big><a href="#" onclick="reservas('{$id}', '{$razaoSocial}')" title="Ver Contratos"><i class="fa fa-calendar" style="color:#827878"></i></a></big>

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
	function editar(id, razaoSocial, cnpj, telefone, nomeContato, celular, email, cep, endereco, bairro, cidade, estado, numero, complemento){
		$('#mensagem').text('');
    	$('#titulo_inserir').text('Editar Registro');

    	$('#id').val(id);
    	$('#razaoSocial').val(razaoSocial);
		$('#cnpj').val(cnpj);
		$('#telefone').val(telefone);
		$('#nomeContato').val(nomeContato);
		$('#celular').val(celular);
		$('#email').val(email);
		$('#cep').val(cep);
		$('#endereco').val(endereco);
    	$('#bairro').val(bairro);
    	$('#cidade').val(cidade);
		$('#estado').val(estado);
    	$('#numero').val(numero);
		$('#complemento').val(complemento);
		
    	$('#modalForm').modal('show');
	}


	function mostrar(razaoSocial, cnpj, telefone, nomeContato, celular, email, cep, endereco, bairro,  cidade, estado, numero, complemento){
		    	
    	$('#razaoSocial_dados').text(razaoSocial);
    	$('#cnpj_dados').text(cnpj);
    	$('#telefone_dados').text(telefone);
    	$('#nomeContato_dados').text(nomeContato);    	
    	$('#celular_dados').text(celular);
    	$('#email_dados').text(email);
		$('#cep_dados').text(cep);
		$('#endereco_dados').text(endereco);
		$('#bairro_dados').text(bairro);
		$('#cidade_dados').text(cidade);
		$('#estado_dados').text(estado);
		$('#numero_dados').text(numero);
		$('#complemento_dados').text(complemento);
    	    	

    	$('#modalDados').modal('show');
	}

	function limparCampos(){
		$('#id').val('');
    	$('#razaoSocial').val('');
		$('#cnpj').val('');
		$('#telefone').val('');
		$('#nomeContato').val('');
		$('#celular').val('');
		$('#email').val('');
		$('#cep').val('');
		$('#endereco').val('');
    	$('#bairro').val('');
    	$('#cidade').val('');
		$('#estado').val('');
    	$('#numero').val('');
		$('#complemento').val('');	
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