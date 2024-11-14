<?php 
require_once("conexao.php");
session_start();

// Verificar se o token existe no banco de dados
function verificaToken($token) {
    global $pdo;

    $query = $pdo->prepare("SELECT * FROM usuarios WHERE token = :token");
    $query->bindParam(":token", $token);
    $query->execute();
    $res = $query->fetch(PDO::FETCH_ASSOC);

    return $res; // Retorna os dados do usuário se o token for encontrado, ou false se não for encontrado
}

// Exemplo de uso
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $usuario = verificaToken($token);

    if ($usuario) {
        // Token válido, faça algo com os dados do usuário, por exemplo:
        echo 'Token válido. ID do usuário: ' . $usuario['id'];
    } else {
        echo 'Token inválido ou expirado.';
    }
} else {
    echo 'Token não encontrado.';
};

?>


