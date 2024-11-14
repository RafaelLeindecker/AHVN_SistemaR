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
<html>

<head>
    <title><?php echo $nome_sistema ?></title>
    <link rel="stylesheet" type="text/css" href="css/styleLogin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/sem-foto.jpg" > <!-- Icone da aba da página -->
 
    
    

    <style>
       body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to bottom, #222, #444); /* Degradê escuro */
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff; /* Cor do texto */
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.8); /* Fundo branco semi-transparente */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            padding: 20px;
            width: 300px;
            text-align: center;
        }

        .login-container h2 {
            color: #333;
        }

        .login-form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .form-group button:hover {
            background-color: #45a049;
        }

        .logo {
            max-width: 80%;
            height: auto;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    
    <div class="login-container">
        <img src="lr.png" alt="Logotipo LR" class="logo">
        <h2>LOGIN</h2>
        <form method="post" action="autenticar.php" class="login-form">
            <div class="form-group">
                <label for="username" >Usuário:</label>
                <input type="email" name="usuario" placeholder="Seu Email" required>
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" name="senha" placeholder="Senha" required>
            </div>
            <div class="form-group">
                <button type="submit">Entrar</button>
            </div>
            <!-- Adicione o link para recuperação de login por e-mail -->
            <a href="#" id="forgot-password-link">Esqueceu a senha?</a>
        </form>
    </div>



   

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // Obter referências aos elementos do DOM
        var forgotPasswordLink = document.getElementById('forgot-password-link');
        var modal = document.getElementById('forgot-password-modal');
        var closeButton = document.getElementsByClassName('close')[0];

        // Abrir o modal quando o link for clicado
        forgotPasswordLink.addEventListener('click', function(event) {
            event.preventDefault();
            modal.style.display = 'block';
        });

        // Fechar o modal quando o usuário clicar no botão "Fechar" ou fora do modal
        closeButton.addEventListener('click', function() {
            modal.style.display = 'none';
        });

        window.addEventListener('click', function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
                // Limpar o campo de e-mail do modal se o usuário clicar fora do modal
                document.querySelector('#forgot-password-modal input[name="email"]').value = '';
            }
        });
    </script>

    <?php
    if (isset($_POST['email'])) {
        // Conexão com o banco de dados
        require_once("conexao.php");

        // Verifica se o email existe no banco de dados
        $email = $_POST['email'];
        $query = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Enviar o email com as instruções para cadastrar uma nova senha            
            require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
            require 'vendor/phpmailer/phpmailer/src/SMTP.php';

            // Configurações do servidor de email
            //$mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Substitua pelo servidor SMTP desejado
            $mail->SMTPAuth = true;
            $mail->Username = 'testeleindecker@gmail.com'; // Substitua pelo seu endereço de email
            $mail->Password = 'leafar1986'; // Substitua pela senha do seu email
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Configurações do email
            $mail->setFrom('testeleindecker@gmail.com', 'Rafael Leindecker'); // Substitua pelo seu endereço de email e nome
            $mail->addAddress($email); // Endereço de email do destinatário
            $mail->isHTML(true);
            $mail->Subject = 'Recuperação de senha';
            $mail->Body = 'Olá, você solicitou a recuperação de senha. Siga as instruções para cadastrar uma nova senha...';

            echo "<script>alert('Um email foi enviado para o endereço informado com as instruções para cadastrar uma nova senha.');</script>";
            // Envio do email

        } else {
            echo "<script>alert('O email informado não está cadastrado.');</script>";
        }
    }
    ?>

</body>

</html>