<?php
require_once("../../conexao.php");


$filtro_data = $_POST['filtro_data'];
$dataInicial = $_POST['dataInicial'];
$dataFinal = $_POST['dataFinal'];
$status_situacao = $_POST['status_situacao'];
$status_jornada = $_POST['status_jornada'];
$funcionario= urlencode($_POST['funcionario']);
$setor= urlencode($_POST['setor']);


//AlIMENTAR OS DADOS NO RELATORIO
$html = utf8_encode(file_get_contents($url_sistema."sistema/painel/rel/jornada.php"));




//CARREGAR DOMPDF
require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

header("Content-Transfer-Encoding: binary");
header("Content-Type: image/png");

//INICIALIZAR A CLASSE DO DOMPDF
$options = new Options();
$options->set('isRemoteEnabled', TRUE);
$pdf = new DOMPDF($options);

// Definir o tamanho do papel e a orientação (usando setPaper em vez de set_paper)
$pdf->setPaper('A4', 'portrait');

// Carregar o conteúdo HTML
$pdf->loadHtml($html);

// Renderizar o PDF
$pdf->render();

// Enviar o PDF para o navegador
$pdf->stream('documento.pdf', ['Attachment' => 0]);

//NOMEAR O PDF GERADO
$pdf->stream(
	'rouparia.pdf',
	array("Attachment" => false)
);



 ?>