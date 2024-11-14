<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

require_once("conexao.php");
session_start();


if(isset($_POST['email'])) {
  $email = $_POST['email'];

  $query = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
  $query->bindValue(":email", $email);
  $query->execute();
  $res = $query->fetchAll(PDO::FETCH_ASSOC);
  $linhas = count($res);

  
  if ($linhas > 0) {
    if ($res[0]['ativo'] != 'Sim') {
      echo 'Seu acesso foi desativado!!';
    } else {
      $token = bin2hex(random_bytes(32)); // Gera um token aleatório

      // Armazena o token no banco de dados
      $userId = $res[0]['id'];
      $updateTokenQuery = $pdo->prepare("UPDATE usuarios SET token = :token WHERE id = :id");
      $updateTokenQuery->bindParam(":token", $token);
      $updateTokenQuery->bindParam(":id", $userId);
      $updateTokenQuery->execute();

      // Envio do e-mail com o link para redefinição de senha
      $link = "http://localhost/AHVN-Projeto/sistema/novasenha.php?token=" . $token; // Substitua com o seu domínio e caminho do arquivo de redefinição de senha
      $nomeUsuario = $res[0]['nome'];

      // Cria uma nova instância da classe PHPMailer
     // require_once("../vendor/phpmailer/src/PHPMailer.php");
      //require_once("../vendor/phpmailer/src/SMTP.php");
	  
      $mail = new PHPMailer();
	  

      // Configura as configurações do servidor de e-mail
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER; //teste de debyg
      $mail->CharSet = 'UTF-8';
      $mail->isSMTP();
      $mail->Host = 'smtp.office365.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'testeleindecker@outlook.com';
      $mail->Password = 'leafar1986';
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port = 587;


      // Define o remetente
      $mail->setFrom("testeleindecker@outlook.com", "RL Sistemas");

      // Define o destinatário
      $mail->addAddress($email, $nomeUsuario);

      // Define o assunto
      $mail->Subject = "Redefinição de Senha";

      // Define a mensagem
      $mail->Body = "Olá, $nomeUsuario,

      para redefinir sua senha, clique no link a seguir:
      $link

      Atenciosamente,
      Equipe do Sistema";

      // Envia o e-mail
      if ($mail->send()) {
        echo "Um link para recuperação de senha foi enviado para o email cadastrado.";
      } else {
        echo "Erro ao enviar e-mail: " . $mail->ErrorInfo;
      }
    }
  } else {
    echo 'Email não cadastrado!';
  }
}
?>
