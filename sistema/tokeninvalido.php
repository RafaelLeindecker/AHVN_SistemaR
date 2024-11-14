
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
            <img src="img/tokenInvalido.png" alt="imagem-login">
            <p style="color: #fff;">                         
            </p>
        </div>

        <form method="post" action="password.php">
            <div class="box-login">
                <h1>o token associado à sua conta <br>não é mais válido ou expirou.</h1>

                <div class="box-account">
                    <h2>Solicite um novo código</h2>
                    <?php /*   <input type="text" name="username" id="username" placeholder="apelido">
                                <input type="email" name="email" id="email" placeholder="e-mail">
                    */?>

                   
                    
                    <p style="text-align: justify; padding: 0px 30px 0px 30px;">
                    Lembramos que esta medida é parte de nossos esforços contínuos para 
                    proteger sua conta e informações pessoais.
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