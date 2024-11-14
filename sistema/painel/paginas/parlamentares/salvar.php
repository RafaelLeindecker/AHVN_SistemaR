<?php 
$tabela = 'parlamentares';
require_once("../../../conexao.php");

$nome = $_POST['nome'];
$cargos_publico = $_POST['cargos_publico'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$obs = $_POST['obs'];
$id = $_POST['id'];

if($id == ""){
$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, cargos_publico = '$cargos_publico', telefone = :telefone, email = :email, obs = :obs");
	
}else{
$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, cargos_publico = '$cargos_publico', telefone = :telefone, email = :email, obs = :obs where id = '$id'");
}
$query->bindValue(":nome", "$nome");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":email", "$email");
$query->bindValue(":obs", "$obs");
$query->execute();

echo 'Salvo com Sucesso';
 ?>