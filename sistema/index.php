<?php
require_once("conexao.php");

$query = $pdo->query("SELECT * from usuarios");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
$senha = '123';
$senha_crip = md5($senha);

if ($linhas == 0) {
    $pdo->query("INSERT INTO usuarios SET nome = '$nome_sistema', email = '$email_sistema', senha = '$senha', senha_crip = '$senha_crip', nivel = 'Administrador', ativo = 'Sim', foto = 'sem-foto.jpg', telefone = '$telefone_sistema', data = curDate() ");
}

?>


<!DOCTYPE html>
<html lang="pt=br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login |  RL Sistemas</title>

    <!--CSS-->
    <link rel="stylesheet" href="css/styleNovo.css">
    <link rel="stylesheet" href="css/media.css">

    <!--JS & jQuery-->
    <script type="text/javascript" src="js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>
<body>
    <div id="container">
        <div class="banner">
            <img src="img/login.png" alt="imagem-login">
            <p style="color: #fff; font-weight: 400;">
                Seja bem vindo, acesse e aproveite todo o conteúdo,
                <br>somos uma equipe de profissionais empenhados em
                <br>trazer o melhor conteúdo direcionado a você, usuário. 
            </p>
        </div>

        <form method="post" action="autenticar.php">
            <div class="box-login">
                <h1>
                    Olá!<br>
                    Seja bem vindo de volta.
                </h1>

                <div class="box">
                    <h2>faça o seu login agora</h2>                    
                    
                    <input type="email" name="usuario" id="usuario" placeholder="e-mail">
                    <input type="password" name="senha" id="senha" placeholder="password">           
                    <button type="submit">Login</button>                             
                
                    <a href="password.php">
                        <p>Esqueceu a sua senha?</p>
                    </a>

                    <a href="account.php">
                        <p>Criar uma conta</p>
                    </a>

                    <div class="social">
                        <img src="img/facebook.png" alt="facebook">
                        <img src="img/google.png" alt="google">
                        <img src="img/twitter.png" alt="twitter">
                        <img src="img/github.png" alt="github">
                    </div>
                </div>
          </div>
        </form>
    </div>
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

$(document).ready(() => {
    $('form').submit((event) => {
        event.preventDefault(); // Impede o envio do formulário para a página autenticar.php

        $.ajax({
            type: 'POST',
            url: 'autenticar.php',
            data: $('form').serialize(),
            success: (response) => {
                if (response.includes('Dados Incorretos') || response.includes('Seu acesso foi desativado')) {
                    exibirPopup(response);
                } else {
                    window.location.href = response;
                }
            },
            error: (error) => {
                console.error('Erro ao processar a solicitação AJAX:', error);
            }
        });
    });
});
</script>