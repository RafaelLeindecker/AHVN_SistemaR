<?php 
$tabela = 'funcionarios';
require_once("../../../conexao.php");

$id = $_POST['id'];
$contrato = $_POST['contrato'];
$admissao = $_POST['admissao'];
$ativos = $_POST['ativos'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$cpf = $_POST['cpf'];
$endereco = $_POST['endereco'];
$obs = $_POST['obs'];
$cargo = $_POST['cargo'];
$turno = $_POST['turno'];
$data1 = $_POST['data1'];
$data2 = $_POST['data2'];


//validar campo desligamento
if (isset($_POST['desligamento'])) {
    $desligamento = $_POST['desligamento'];
} else {
    $desligamento = ''; // Ou defina um valor padrão
}


//validacao cpf ativo
$query = $pdo->query("SELECT * FROM $tabela WHERE cpf = '$cpf'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];

// Verificar se o CPF já está em uso por outro registro
if (@count($res) > 0 && $id != $id_reg) {
    // CPF ATIVO! Verificar se o campo 'ativos' está com o valor 'SIM'
    if ($res[0]['ativos'] === 'Sim') {
        echo 'CPF ATIVO!';
        exit();
    }
}

//validacao contrato único
$query = $pdo->query("SELECT * from $tabela where contrato = '$contrato'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if(@count($res) > 0 and $id != $id_reg){
	
    echo 'Contrato já Cadastrado!';
	exit();
}


if($id == ""){
$query = $pdo->prepare("INSERT INTO $tabela SET contrato = :contrato, admissao = :admissao, ativos = :ativos, nome = :nome, email = :email, telefone = :telefone, cpf = :cpf, endereco = :endereco, obs = :obs, cargo = :cargo, turno = :turno, data1 = :data1, data2 = :data2, desligamento = :desligamento, data = curDate()");
	
}else{
$query = $pdo->prepare("UPDATE $tabela SET  
contrato = :contrato, 
admissao = :admissao, 
ativos = :ativos, 
nome = :nome, 
email = :email, 
telefone = :telefone, 
cpf = :cpf, 
endereco = :endereco, 
obs = :obs, 
cargo = :cargo, 
turno = :turno, 
data1 = :data1, 
data2 = :data2, 
desligamento = :desligamento 
where id = '$id'");
}
$query->bindValue(":contrato", "$contrato");
$query->bindValue(":admissao", "$admissao");
$query->bindValue(":ativos", "$ativos");
$query->bindValue(":nome", "$nome");
$query->bindValue(":email", "$email");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":endereco", "$endereco");
$query->bindValue(":obs", "$obs");
$query->bindValue(":turno", "$turno");
$query->bindValue(":cpf", "$cpf");
$query->bindValue(":cargo", "$cargo");
$query->bindValue(":turno", "$turno");
$query->bindValue(":data1", "$data1");
$query->bindValue(":data2", "$data2");
$query->bindValue(":desligamento", "$desligamento");
$query->execute();

echo 'Salvo com Sucesso';
 ?>