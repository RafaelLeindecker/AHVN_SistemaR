<?php 
$tabela = 'tiposrecursos';
require_once("../../../conexao.php");


$id = $_POST['id'];

$query2 = $pdo->query("SELECT * FROM entrada_recursos where id_tiposrecursos = '$id'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$total_reg2 = @count($res2);
if($total_reg2 > 0){
	echo 'Não é possível excluir o registro, pois existem recursos relacionados a ele primeiro exclua os recursos e depois exclua esse tipo!';
	exit();
}

$pdo->query("DELETE FROM $tabela WHERE id = '$id' ");
echo 'Excluído com Sucesso';
?>