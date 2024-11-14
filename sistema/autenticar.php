<?php 
@session_start();
require_once("conexao.php");
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$senha_crip = md5($senha);
//$senha_crip = password_hash($senha, PASSWORD_DEFAULT);

$query = $pdo->prepare("SELECT * from usuarios where email = :email and senha_crip = :senha");
$query->bindValue(":email", "$usuario");
$query->bindValue(":senha", "$senha_crip");
$query->execute();
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);

if ($linhas > 0) {
    if ($res[0]['ativo'] != 'Sim') {
        echo 'Seu acesso foi desativado!!';
    } else {
        $_SESSION['nome'] = $res[0]['nome'];
        $_SESSION['id'] = $res[0]['id'];
        $_SESSION['nivel'] = $res[0]['nivel'];
        echo 'painel';
    }
} else {
    echo 'Dados Incorretos!!';
}
?>