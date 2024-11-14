<!DOCTYPE html>
<html lang="pt=br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar conta |  RL Sistemas</title>

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

        <div class="box-login">
            <h1>Junte-se a nós,<br>Crie hoje a sua conta!</h1>

            <div class="box-account">
                <h2>informe seus dados</h2>
                <input type="text" name="username" id="username" placeholder="apelido">
                <input type="email" name="email" id="email" placeholder="e-mail">
                <input type="email" name="cmail" id="cmail" placeholder="confirmar o e-mail">
                <input type="password" name="password" id="password" placeholder="senha">
                <input type="password" name="cpassword" id="cpassword" placeholder="confirmar a senha">

                <div class="check">
                    <input type="checkbox" name="termo" id="termo" style="width: 13px; height: 13px;">
                    <label for="termos" style="color: #3d3d3d;">li e aceito os termos</label>
                </div>
    
                <button>Criar conta</button>
            </div>
        </div>
    </div>

    <a href="index.php">
        <div id="bubble">
            <img src="img/user.png" alt="icone-usuário" title="fazer-login">
        </div>
    </a>

    <script>
        $('#termo').click(() => {
            const div = $('<div>').attr('style',`
                position: absolute;
                width: 65%;
                height: 420px;
                border-radius: 10px;
                background: #fff; 

                color: #3d3d3d;

                -webkit-box-shadow: 0px 0px 6px -1px #000000; 
                box-shadow: 0px 0px 6px -1px #000000;

                display: flex;
                flex-direction: column;
                justify-content: space-evenly;
                align-items: center;
            `)

            $(div).addClass('termo')

            $(div).append(`Eu entendo e aceitos os termos impostos pela plataforma...`)

            $(div).append(
                $('<button>Ok</button>').click(() => {
                    div.hide()
                })
            )
            
            $('body').append(div)
        })
    </script>
    
</body>
</html>