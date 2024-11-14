<?php 
$tabela = 'plano_trabalho';
require_once("../../../conexao.php");
@session_start();
$id_usuario = @$_SESSION['id'];

$id = $_POST['id'];
//$usuario_lanc =$_POST['usuario_lanc'];
$unidades =$_POST['unidades'];
$tipos_recursos =$_POST['tipos_recursos'];
$finalidade =$_POST['finalidade'];
$parlamentar =$_POST['parlamentar'];
$numero_recurso =$_POST['numero_recurso'];
$valor_plano =$_POST['valor_plano'];
// Remove o "R$" e espaços em branco antes e depois
$valor_plano = trim(str_replace("R$", "", $valor_plano));
// Remove pontos de milhares e substitui vírgulas por pontos para notação decimal
$valor_plano = str_replace('.', '', $valor_plano);
$situacao =$_POST['situacao'];
$banco =$_POST['banco'];
$agencia =$_POST['agencia'];
$conta =$_POST['conta'];
$data_cad =$_POST['data_cad'];
$data_ent =$_POST['data_ent'];
$data_venc =$_POST['data_venc'];

if(isset($_POST['data_fim'])) {
    $data_fim = $_POST['data_fim'];

} else {
    $data_fim = null; // Ou qualquer valor padrão que faça sentido para o seu caso
}

$descricao =$_POST['descricao'];

$saldo_recurso =$_POST['saldo_recurso'];
// Remove o "R$" e espaços em branco antes e depois
$saldo_recurso = trim(str_replace("R$", "", $saldo_recurso));
// Remove pontos de milhares e substitui vírgulas por pontos para notação decimal
$saldo_recurso = str_replace('.', '', $saldo_recurso);

/*
if($descricao == "" and $hospede == ""){
	echo 'Escolha um Hóspede ou insira uma descrição!';
	exit();
}

if($descricao == "" and $hospede != ""){
	$query = $pdo->query("SELECT * FROM hospedes where id = '$hospede'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$nome_hospede = $res[0]['nome'];
	$descricao = $nome_hospede;
}
*/


$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$foto = $res[0]['anexo_plano'];
}else{
	$foto = 'sem-foto.png';
}

$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$foto1 = $res[0]['anexo_termo'];
}else{
	$foto1 = 'sem-foto.png';
}


//SCRIPT PARA SUBIR ARQUIVO ANEXO PLANO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['anexo_plano']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);
$caminho = '../../images/contas/' .$nome_img;

$imagem_temp = @$_FILES['anexo_plano']['tmp_name']; 

if(@$_FILES['anexo_plano']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'webp' or $ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif' or $ext == 'pdf' or $ext == 'rar' or $ext == 'zip' or $ext == 'doc' or $ext == 'docx' or $ext == 'txt' or $ext == 'xlsx' or $ext == 'xlsm' or $ext == 'xls' or $ext == 'xml' ){  

		if (@$_FILES['anexo_plano']['name'] != ""){

			//EXCLUO A FOTO ANTERIOR
			if($foto != "sem-foto.png"){
				@unlink('../../images/contas/'.$foto);
			}

			$foto = $nome_img;
		}

		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}

//SCRIPT PARA SUBIR ARQUIVO ANEXO TERMO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['anexo_termo']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);
$caminho = '../../images/contas/' .$nome_img;

$imagem_temp = @$_FILES['anexo_termo']['tmp_name']; 

if(@$_FILES['anexo_termo']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'webp' or $ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif' or $ext == 'pdf' or $ext == 'rar' or $ext == 'zip' or $ext == 'doc' or $ext == 'docx' or $ext == 'txt' or $ext == 'xlsx' or $ext == 'xlsm' or $ext == 'xls' or $ext == 'xml' ){  

		if (@$_FILES['anexo_termo']['name'] != ""){

			//EXCLUO A FOTO ANTERIOR
			if($foto1 != "sem-foto.png"){
				@unlink('../../images/contas/'.$foto1);
			}

			$foto1 = $nome_img;
		}

		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}
//validacao numero_recurso único
$query = $pdo->query("SELECT * from $tabela where numero_recurso = '$numero_recurso'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if(@count($res) > 0 and $id != $id_reg){
	echo 'Número Recurso já Cadastrado!';
	exit();
}

if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET 

	unidades = :unidades,
	tipos_recursos =  :tipos_recursos,
	finalidade =  :finalidade,
	usuario_lanc =  '$id_usuario',
	parlamentar =  :parlamentar,
	numero_recurso =  :numero_recurso,
	valor_plano =  :valor_plano,
	situacao =  :situacao,
	banco =  :banco,
	agencia =  :agencia,
	conta =  :conta,
	data_cad =  :data_cad,
	data_ent =  :data_ent,
	data_venc =  :data_venc,
	data_fim =  :data_fim,
	descricao =  :descricao,
	anexo_plano =  '$foto',
	anexo_termo =  '$foto1',
	saldo_recurso =  :saldo_recurso
	");

}else{
	$query = $pdo->prepare("UPDATE $tabela SET
	unidades = :unidades,
	tipos_recursos =  :tipos_recursos,
	finalidade =  :finalidade,
	usuario_lanc =  '$id_usuario',
	parlamentar =  :parlamentar,
	numero_recurso =  :numero_recurso,
	valor_plano =  :valor_plano,
	situacao =  :situacao,
	banco =  :banco,
	agencia =  :agencia,
	conta =  :conta,
	data_cad =  :data_cad,
	data_ent =  :data_ent,
	data_venc =  :data_venc,
	data_fim =  :data_fim,
	descricao =  :descricao,
	anexo_plano =  '$foto',
	anexo_termo =  '$foto1',
	saldo_recurso =  :saldo_recurso 
	where id = '$id'");
		
}

$query->bindValue(":unidades", "$unidades");
$query->bindValue(":tipos_recursos", "$tipos_recursos");
$query->bindValue(":finalidade", "$finalidade");
$query->bindValue(":parlamentar", "$parlamentar");
$query->bindValue(":numero_recurso", "$numero_recurso");
$query->bindValue(":valor_plano", "$valor_plano");
$query->bindValue(":situacao", "$situacao");
$query->bindValue(":banco", "$banco");
$query->bindValue(":agencia", "$agencia");
$query->bindValue(":conta", "$conta");
$query->bindValue(":data_cad", "$data_cad");
$query->bindValue(":data_ent", "$data_ent");
$query->bindValue(":data_venc", "$data_venc");
$query->bindValue(":data_fim", "$data_fim");
$query->bindValue(":descricao", "$descricao");
$query->bindValue(":saldo_recurso", "$saldo_recurso");

$query->execute();

// Verificação de erros após a execução da query
if (!$query) {
    echo "\nPDO::errorInfo():\n";
    print_r($pdo->errorInfo());
} else {
    echo 'Salvo com Sucesso';
}

// echo 'Salvo com Sucesso'; 

?>