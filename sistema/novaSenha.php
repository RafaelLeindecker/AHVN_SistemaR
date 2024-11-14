<?php 
session_start();
require_once("conexao.php");

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
        if(isset($_POST['nova_senha']) && isset($_POST['confirmar_senha'])) {
            $novaSenha = $_POST['nova_senha'];
            $confirmarSenha = $_POST['confirmar_senha'];
            $senha_crip = md5($novaSenha);
            //$senha_crip = password_hash($senha, PASSWORD_DEFAULT); // Utiliza password_hash para criar o hash seguro da senha
            
            if($novaSenha === $confirmarSenha) {
                //Hash da nova senha
                $hashedPassword = md5($novaSenha);
                //$hashedPassword = password_hash($novaSenha, PASSWORD_DEFAULT);
                $userId = $usuario['id'];
                //$userId = $res[0]['id'];

               

                // Atualiza a senha no banco de dados
                $updateSenhaQuery = $pdo->prepare("UPDATE usuarios SET senha = :senha, senha_crip = '$senha_crip', token = NULL WHERE id = :id");
                $updateSenhaQuery->bindParam(":senha", $hashedPassword);
                $updateSenhaQuery->bindParam(":senha", $novaSenha);
                $updateSenhaQuery->bindParam(":id", $userId);
                $updateSenhaQuery->execute();
                
                // Limpa a variável de sessão do token
                unset($_SESSION['token']);

                echo 'Senha Atualizada !!';
                header("Location: index.php");
                
                
            } else {
                echo 'As senhas não coincidem.';
            }
        }
    } else {
        //echo 'Token inválido ou expirado.';
        // Token inválido, redireciona para a página de redefinição de senha
        header("Location: tokeninvalido.php");
        exit();
    }
} else {
    echo 'Token não encontrado.';
    header("Location: tokennaoencontrado.php");
    exit();
};
?>

<!DOCTYPE html>
<html lang="pt=br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha | RL Sistemas</title>

    <!--CSS-->
    <link rel="stylesheet" href="css/styleNovo.css">
    <link rel="stylesheet" href="css/media.css">

    <!--JS & jQuery-->
    <script type="text/javascript" src="js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>
    <form method="post" action="">
        <div id="container">
            <div class="banner">
                <img src="img/login.png" alt="imagem-login">
                <p style="color: #fff;">
                    Seja bem vindo, acesse e aproveite todo o conteúdo,
                    <br>somos uma equipe de profissionais empenhados em
                    <br>trazer o melhor conteúdo direcionado a você usuário. 
                </p>
            </div>

            <div class="box-login">
                <h1>Junte-se a nós, novamente <br>Redefina sua senha!</h1>

                <div class="box-account">
                    <h2>informe sua nova senha</h2>                
                    <input type="password" name="nova_senha" id="nova_senha" placeholder="senha" required>
                    <input type="password" name="confirmar_senha" id="confirmar_senha" placeholder="confirmar a senha" required>

                    <button type="submit" id="atualizarSenha">Atualizar</button>

                </div>
            </div>
        </div>

        <a href="index.php">
            <div id="bubble">
                <img src="img/user.png" alt="icone-usuário" title="fazer-login">
            </div>
        </a>

        <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("atualizarSenha").addEventListener("click", function() {
            const novaSenha = document.getElementById("nova_senha").value;
            const confirmarSenha = document.getElementById("confirmar_senha").value;

            if (novaSenha !== '' && confirmarSenha !== '') {
                const formData = new FormData(document.querySelector('form'));

                fetch('redefinir_senha.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.senhaAtualizada === true) {
                        exibirPopup("Senha atualizada com sucesso!");
                    } else {
                        alert('Houve um problema ao atualizar a senha.');
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                });
            } else {
                alert('Por favor, preencha todos os campos de senha.');
            }
        });
    });

    function exibirPopup(mensagem) {
        // Coloque aqui o código para exibir o popup com a mensagem desejada
        // Certifique-se de que a função exibirPopup está definida corretamente
        // e que o código do popup esteja funcionando corretamente.
        // Por exemplo:
        alert(mensagem); // Este é um exemplo simples, você deve substituir por sua própria função de exibição de popup.
    }
</script>

    </form>    
</body>
</html>



<script>
    
// Função para criar e exibir o pop-up
function exibirPopup(mensagem) {
    const div = $('<div>').attr('style', `
        position: absolute;
        width: 30%;
        height: 200px;
        border-radius: 10px;
        background: #fff; 
        color: #3d3d3d;
        -webkit-box-shadow: 0px 0px 6px -1px #000000; 
        box-shadow: 0px 0px 6px -1px #000000;
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
        align-items: center;
    `);

    
    $(div).addClass('termo');

    $(div).append(mensagem);

    $(div).append(
        $('<button>Ok</button>').click(() => {
            div.hide();
        })
    );

    $('body').append(div);
}

function exibirPopup2(mensagem) {
    const div = $('<div>').attr('style', `
        position: absolute;
        width: 30%;
        height: 200px;
        border-radius: 10px;
        background: #fff; 
        color: #3d3d3d;
        -webkit-box-shadow: 0px 0px 6px -1px #000000; 
        box-shadow: 0px 0px 6px -1px #000000;
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
        align-items: center;
    `);

    
    $(div).addClass('termo');

    $(div).append(mensagem);

    $(div).append(
    $('<button>Ok</button>').click(() => {
        // Redirecionar para index.php
        window.location.href = 'index.php';
    })
);

    $('body').append(div);
}