<?php 
$tabela = 'jornadas';
require_once("../../../conexao.php");


$funcionario = $_POST['funcionario'];
$tipo_jornada = $_POST['tipo_jornada'];
$setor = $_POST['setor'];
$produto = $_POST['produto'];
$hora_inicial = date('Y-m-d H:i:s'); // Define a hora inicial com a data e hora do servidor
$hora_final = $_POST['hora_final'];
$total_kg = $_POST['total_kg'];
$obs = $_POST['obs'];
$id = $_POST['id'];
$tempo = $_POST['tempo'];
$situacao = "Aberta"; // Define a situação como "Fechada"


if($id == "" ){
	//echo 'id Vazio!';
}else{
	//echo 'id não Vazio!';
	$situacao = "Finalizada"; // Define a situação como "Fechada"
	$hora_final = date('Y-m-d H:i:s'); // Define a hora inicial com a data e hora do servidor
	$tempo = $_POST['tempo'];
}

 

// Verificação para depuração

//echo 'Hora Inicial: ' . $hora_inicial . '<br>';
//echo 'Hora Final: ' . $hora_final . '<br>';
//print_r($_POST);


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


if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET 

	situacao = :situacao,
	funcionario = :funcionario,
	tipo_jornada = :tipo_jornada,
	setor = :setor,
	produto = :produto,
	hora_inicial = :hora_inicial,
	hora_final = :hora_final,
	tempo = :tempo,
	total_kg = :total_kg,
	obs = :obs
	");

}else{
	$query = $pdo->prepare("UPDATE $tabela SET
	
	situacao = :situacao,
	funcionario = :funcionario,
	tipo_jornada = :tipo_jornada,
	setor = :setor,
	produto = :produto,
	hora_inicial = :hora_inicial,
	hora_final = :hora_final,
	tempo = :tempo,
	total_kg = :total_kg,
	obs = :obs

	where id = '$id'");
		
}


$query->bindValue(":situacao", "$situacao");
$query->bindValue(":funcionario", "$funcionario");
$query->bindValue(":tipo_jornada", "$tipo_jornada");
$query->bindValue(":setor", "$setor");
$query->bindValue(":produto", "$produto");
$query->bindValue(":hora_inicial", "$hora_inicial");
$query->bindValue(":hora_final", "$hora_final");
$query->bindValue(":tempo", "$tempo");
$query->bindValue(":total_kg", "$total_kg");
$query->bindValue(":obs", "$obs");

$query->execute();
// Verificação de erros após a execução da query
if (!$query) {
    echo "\nPDO::errorInfo():\n";
    print_r($pdo->errorInfo());
	echo $stmt->queryString;
} else {
    echo 'Salvo com Sucesso';
}

// Adicionar mensagem de debug antes de executar a query
//echo $id == "" ? "Inserindo nova jornada" : "Atualizando jornada existente";

//echo 'Salvo com Sucesso'; 

?>