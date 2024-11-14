
<!DOCTYPE html>
<html lang="pt=br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar senha | RL Sistemas</title>

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
            <p style="color: #fff;">
                Seja bem vindo, acesse e aproveite todo o conteúdo,
                <br>somos uma equipe de profissionais empenhados em
                <br>trazer o melhor conteúdo direcionado a você usuário. 
            </p>
        </div>

        <form method="post" action="recuperar.php">
            <div class="box-login">
                <h1>Perdeu a sua senha?<br>recupere via email agora</h1>

                <div class="box-account">
                    <h2>insira a sua conta existente</h2>
                  
                    <input type="email" name="email" id="email" placeholder="confirme o seu e-mail">
                    
                    <p style="text-align: justify; padding: 0px 30px 0px 30px;">
                        Um código será enviado para a sua caixa
                        de entrada, copie esse código e cole na
                        próxima tela, cetifique-se de que o seu
                        apelido bem como o e-mail esteja corretos
                        e que seja o mesmo da conta que você deseja
                        recuperar
                    </p>

                    <button>Obter o código</button>
                </div>
            </div>
        </form>
    </div>

    <a href="index.php">
        <div id="bubble">
            <img src="img/user.png" alt="icone-usuário" title="fazer-login">
        </div>
    </a>
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

$(document).ready(() => {
    $('form').submit((event) => {
        event.preventDefault(); // Impede o envio do formulário para a página autenticar.php

        $.ajax({
            type: 'POST',
            url: 'recuperar.php',
            data: $('form').serialize(),
            success: (response) => {
                if (response.includes('Email não cadastrado') || response.includes('Seu acesso foi desativado')) {
                    exibirPopup(response);
                } else {
                    //window.location.href = response;
                    exibirPopup2(response);
                }
            },
            error: (error) => {
                console.error('Erro ao processar a solicitação AJAX:', error);
            }
        });
    });
});
</script>