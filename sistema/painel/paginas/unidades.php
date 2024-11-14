<?php
$pag = 'unidades';

//verificar se ele tem a permissão de estar nessa página
if (@$unidades == 'ocultar') {
    echo "<script>window.location='../index.php'</script>";
    exit();
}
?>

<div class="margin_mobile">

    <div class="esc" style="float:left; margin-right:10px"><span><small><i title="Filtrar por Status"
                    class="bi bi-search"></i></small></span></div>
    <div class="esc" style="float:left; margin-right:20px">
        <select class="form-control" aria-label="Default select example" name="status-busca" id="status-busca">
            <option value="">Todas</option>
            <option value="nome">Nome</option>
            <option value="Ativos">Ativos</option>

        </select>
    </div>

    <a onclick="inserir()" type="button" class="btn btn-primary"><span class="fa fa-plus"></span> Adicionar</a>



    <li class="dropdown head-dpdn2" style="display: inline-block;">
        <a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle" id="btn-deletar"
            style="display:none"><span class="fa fa-trash-o"></span> Deletar</a>

        <ul class="dropdown-menu">
            <li>
                <div class="notification_desc2">
                    <p>Excluir Selecionados? <a href="#" onclick="deletarSel()"><span class="text-danger">Sim</span></a>
                    </p>
                </div>
            </li>
        </ul>
    </li>
</div>

<div class="bs-example widget-shadow" style="padding:15px" id="listar">

</div>


<input type="hidden" id="ids">

<!-- Modal Perfil -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"><span id="titulo_inserir"></span></h4>
                <button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="margin-top: -25px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form">
                <div class="modal-body">


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Razão Social</label>
                                <input type="text" class="form-control" name="razaoSocial" id="razaoSocial">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>CNPJ</label>
                                <input type="cnpj" class="form-control" name="cnpj" id="cnpj" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label>Telefone comercial</label>
                            <input type="text" class="form-control" id="telefone" name="telefone" required>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <label>Nome contato</label>
                            <input type="text" class="form-control" id="nomeContato" name="nomeContato" required>
                        </div>

                        <div class="col-md-3">
                            <label>Celular</label>
                            <input type="text" class="form-control" id="celular" name="celular" required>
                        </div>

                        <div class="col-md-5">
                            <label>E-mail</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-2">
                            <label>CEP</label>
                            <input type="text" class="form-control" name="cep" id="cep" maxlength="9"
                                placeholder="Digite o CEP">
                        </div>

                        <script src="js/cep.js"></script>

                        <div class="col-md-4">
                            <label>Endereço</label>
                            <input type="text" class="form-control" name="endereco" id="endereco">
                        </div>

                        <div class="col-md-2">
                            <label for="bairro">Bairro:</label>
                            <input type="text" class="form-control" name="bairro" id="bairro">
                        </div>

                        <div class="col-md-3">
                            <label for="cidade">Cidade:</label>
                            <input type="text" class="form-control" name="cidade" id="cidade">
                        </div>

                        <div class="col-md-1">
                            <label>Estado:</label>
                            <input type="text" class="form-control" name="estado" id="estado">
                        </div>

                    </div>



                    <div class="row">

                        <div class="col-md-2">
                            <label>Nº:</label>
                            <input type="text" class="form-control" name="numero" id="numero">
                        </div>

                        <div class="col-md-10">
                            <label>Complememto:</label>
                            <input type="text" class="form-control" name="complemento" id="complemento">
                        </div>

                    </div>


                    <input type="hidden" class="form-control" id="id" name="id">

                    <br>
                    <small>
                        <div id="mensagem" align="center"></div>
                    </small>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>

            </form>
        </div>
    </div>
</div>



<!-- Modal Dados -->
<div class="modal fade" id="modalDados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"><span id=""></span></h4>
                <button id="btn-fechar-dados" type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="margin-top: -5px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" style="margin-top: 0px">

                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>NOME RAZÃO SOCIAL: </b></span><span id="razaoSocial_dados"></span>
                    </div>

                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>CNPJ: </b></span><span id="cnpj_dados"></span>
                    </div>

                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>Telefone: </b></span><span id="telefone_dados"></span>
                    </div>

                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>Nome Contato: </b></span><span id="nomeContato_dados"></span>
                    </div>

                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>Celular Contato: </b></span><span id="celular_dados"></span>
                    </div>

                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>E-mail: </b></span><span id="email_dados"></span>
                    </div>

                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>CEP: </b></span><span id="cep_dados"></span>
                    </div>

                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>Endereço: </b></span><span id="endereco_dados"></span>
                    </div>

                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>Bairro: </b></span><span id="bairro_dados"></span>
                    </div>

                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>Cidade: </b></span><span id="cidade_dados"></span>
                    </div>

                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>Estado: </b></span><span id="estado_dados"></span>
                    </div>

                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>Nº: </b></span><span id="numero_dados"></span>
                    </div>

                    <div class="col-md-12" style="margin-bottom: 5px">
                        <span><b>Complemento: </b></span><span id="complemento_dados"></span>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- bloquear mouse compo datas -->
<style>
.non-interactable {
    pointer-events: none;
}
</style>

<!-- Modal Arquivos -->
<div class="modal fade" id="modalArquivos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="tituloModal">Gestão de Arquivos - <span id="nome-arquivo"> </span></h4>
                <button id="btn-fechar-arquivos" type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-arquivos" method="post">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Arquivo</label>
                                <input class="form-control" type="file" name="arquivo_conta"
                                    onChange="carregarImgArquivos();" id="arquivo_conta">
                            </div>
                        </div>
                        <div class="col-md-4" style="margin-top:-10px">
                            <div id="divImgArquivos">
                                <img src="images/arquivos/sem-foto.png" width="60px" id="target-arquivos">
                            </div>
                        </div>

                    </div>

                    <div class="row" style="margin-top:-40px">
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="nome-arq" id="nome-arq"
                                placeholder="Nome do Arquivo * " required>
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Inserir</button>
                        </div>
                    </div>

                    <hr>

                    <small>
                        <div id="listar-arquivos"></div>
                    </small>

                    <br>
                    <small>
                        <div align="center" id="mensagem-arquivo"></div>
                    </small>

                    <input type="hidden" class="form-control" name="id-arquivo" id="id-arquivo">

                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Reservas -->
<div class="modal fade" id="modalReservas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="tituloModal">Férias - <span id="nome-reservas"> </span></h4>
                <button id="btn-fechar-reservas" type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <small>
                    <div id="listar-reservas"></div>
                </small>
                <input type="hidden" class="form-control" name="id-reservas" id="id-reservas">
            </div>

        </div>
    </div>
</div>



<script type="text/javascript">
var pag = "<?=$pag?>"
</script>
<script src="js/ajax.js"></script>



<script type="text/javascript">
function carregarImgArquivos() {
    var target = document.getElementById('target-arquivos');
    var file = document.querySelector("#arquivo_conta").files[0];

    var arquivo = file['name'];
    resultado = arquivo.split(".", 2);


    if (resultado[1] === 'pdf') {
        $('#target-arquivos').attr('src', "images/pdf.png");
        return;
    }

    if (resultado[1] === 'rar' || resultado[1] === 'zip') {
        $('#target-arquivos').attr('src', "images/rar.png");
        return;
    }

    if (resultado[1] === 'doc' || resultado[1] === 'docx') {
        $('#target-arquivos').attr('src', "images/word.png");
        return;
    }

    if (resultado[1] === 'xlsx' || resultado[1] === 'xlsm' || resultado[1] === 'xls') {
        $('#target-arquivos').attr('src', "images/excel.png");
        return;
    }


    if (resultado[1] === 'xml') {
        $('#target-arquivos').attr('src', "images/xml.png");
        return;
    }

    var reader = new FileReader();

    reader.onloadend = function() {
        target.src = reader.result;
    };

    if (file) {
        reader.readAsDataURL(file);

    } else {
        target.src = "";
    }
}
</script>




<script type="text/javascript">
$("#form-arquivos").submit(function() {
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'paginas/' + pag + "/arquivos.php",
        type: 'POST',
        data: formData,

        success: function(mensagem) {
            $('#mensagem-arquivo').text('');
            $('#mensagem-arquivo').removeClass()
            if (mensagem.trim() == "Inserido com Sucesso") {
                //$('#btn-fechar-arquivos').click();
                $('#nome-arq').val('');
                $('#arquivo_conta').val('');
                $('#target-arquivos').attr('src', 'images/arquivos/sem-foto.png');
                listarArquivos();
            } else {
                $('#mensagem-arquivo').addClass('text-danger')
                $('#mensagem-arquivo').text(mensagem)
            }

        },

        cache: false,
        contentType: false,
        processData: false,

    });

});
</script>

<script type="text/javascript">
function listarArquivos() {
    var id = $('#id-arquivo').val();
    $.ajax({
        url: 'paginas/' + pag + "/listar-arquivos.php",
        method: 'POST',
        data: {
            id
        },
        dataType: "text",

        success: function(result) {
            $("#listar-arquivos").html(result);
        }
    });
}
</script>


<script type="text/javascript">
function listarReservas() {
    var id = $('#id-reservas').val();
    $.ajax({
        url: 'paginas/' + pag + "/listar-reservas.php",
        method: 'POST',
        data: {
            id
        },
        dataType: "text",

        success: function(result) {
            $("#listar-reservas").html(result);
        }
    });
}
</script>


<script>
// Obtém referências para os campos de data
const admissaoInput = $('#admissao');
const data1Input = $('#data1');
const data2Input = $('#data2');

// Adiciona um listener de mudança (change) ao campo "admissao"
admissaoInput.on('change', function() {
    recalcularDatas();
});

// Função para recalcular as datas com base na admissão
function recalcularDatas() {
    const dataAdmissao = parseDate(admissaoInput.val());

    // Verifica se a data de admissao é válida
    if (!isNaN(dataAdmissao.getTime())) {
        const dataData1 = new Date(dataAdmissao.getTime() + (45 - 1) * 24 * 60 * 60 * 1000);
        const dataData2 = new Date(dataAdmissao.getTime() + (90 - 1) * 24 * 60 * 60 * 1000);

        data1Input.val(formatDate(dataData1));
        data2Input.val(formatDate(dataData2));
    }
}

// Função para converter a data do formato "dd/mm/aaaa" para um objeto Date
function parseDate(dateString) {
    const parts = dateString.split('-');
    const year = parseInt(parts[0]);
    const month = parseInt(parts[1]) - 1;
    const day = parseInt(parts[2]);

    return new Date(year, month, day);
}

// Função para formatar a data no formato "dd/mm/aaaa"
function formatDate(date) {
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();
    return `${year}-${month}-${day}`;
}

// Função para ativar o campo desligamento
function toggleDesligamento() {
    var ativoSelect = document.getElementById("ativos");
    var desligamentoInput = document.getElementById("desligamento");

    if (ativoSelect.value === "Não") {
        desligamentoInput.disabled = false; // Habilitar o campo desligamento
    } else {
        desligamentoInput.disabled = true; // Desabilitar o campo desligamento
        desligamentoInput.value = ""; // Limpar o campo desligamento
    }

}

// Limpar campos quando o modal é fechado
$('#modalForm').on('hidden.bs.modal', function() {
    // Seletor dos campos que deseja limpar
    $('#contrato, #admissao, #ativos, #nome, #cpf, #telefone, #email, #cargo, #turno, #endereco, #obs, #data1, #data2, #desligamento, #id')
        .val('');

});

// Função para limpar os campos do modal
function limparCamposDoModal() {
    // Seletor dos campos que deseja limpar
    $('#contrato, #admissao, #ativos, #nome, #cpf, #telefone, #email, #cargo, #turno, #endereco, #obs, #data1, #data2, #desligamento, #id')
        .val('');


}
// Função para executar a limpeza dos campos do modal quando a página carregar
window.onload = function() {
    limparCamposDoModal();
};
</script>