<?php 
$tabela = 'fornecedores';
require_once("../../../conexao.php");

$razaoSocial = $_POST['razaoSocial'];
$cnpj = $_POST['cnpj'];
$telefone = $_POST['telefone'];
$nomeContato = $_POST['nomeContato'];
$celular = $_POST['celular'];
$email = $_POST['email'];
$cep = $_POST['cep'];
$endereco = $_POST['endereco'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$numero = $_POST['numero'];
$complemento = $_POST['complemento'];
$id = $_POST['id'];


//validacao cpf ativo
$query = $pdo->query("SELECT * FROM $tabela WHERE cnpj = '$cnpj'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];


//validacao CNPJ único
$query = $pdo->query("SELECT * from $tabela where cnpj = '$cnpj'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if(@count($res) > 0 and $id != $id_reg){
	echo 'CNPJ já Cadastrado!';
	exit();
}

if($id == ""){
$query = $pdo->prepare("INSERT INTO $tabela SET 
razaoSocial = :razaoSocial,
cnpj = :cnpj,
telefone = :telefone,
nomeContato = :nomeContato,
celular = :celular,
email = :email,
cep = :cep,
endereco = :endereco,
bairro = :bairro,
cidade = :cidade,
estado = :estado,
numero = :numero,
complemento = :complemento,
data = curDate() ");
	
}else{
$query = $pdo->prepare("UPDATE $tabela SET 
razaoSocial = :razaoSocial,
cnpj = :cnpj,
telefone = :telefone,
nomeContato = :nomeContato,
celular = :celular,
email = :email,
cep = :cep,
endereco = :endereco,
bairro = :bairro,
cidade = :cidade,
estado = :estado,
numero = :numero,
complemento = :complemento
where id ='$id'");
}
$query->bindValue(":razaoSocial", "$razaoSocial");
$query->bindValue(":cnpj", "$cnpj");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":nomeContato", "$nomeContato");
$query->bindValue(":celular", "$celular");
$query->bindValue(":email", "$email");
$query->bindValue(":cep", "$cep");
$query->bindValue(":endereco", "$endereco");
$query->bindValue(":bairro", "$bairro");
$query->bindValue(":cidade", "$cidade");
$query->bindValue(":estado", "$estado");
$query->bindValue(":numero", "$numero");
$query->bindValue(":complemento", "$complemento");

$query->execute();


echo 'Salvo com Sucesso';
 ?>