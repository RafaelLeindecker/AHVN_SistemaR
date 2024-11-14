document.addEventListener('DOMContentLoaded', function () {
    const cepInput = document.getElementById('cep');
    const enderecoInput = document.getElementById('endereco');
    const bairroInput = document.getElementById('bairro');
    const cidadeInput = document.getElementById('cidade');
    const estadoInput = document.getElementById('estado'); // Novo campo para o estado

    cepInput.addEventListener('keyup', function (event) {
        const cep = event.target.value.replace(/\D/g, '');
        if (cep.length === 8) {
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (!data.erro) {
                        enderecoInput.value = data.logradouro;
                        bairroInput.value = data.bairro;
                        cidadeInput.value = data.localidade;
                        estadoInput.value = data.uf; // Preenche o campo de estado
                    } else {
                        enderecoInput.value = '';
                        bairroInput.value = '';
                        cidadeInput.value = '';
                        estadoInput.value = ''; // Limpa o campo de estado
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar o CEP:', error);
                    enderecoInput.value = '';
                    bairroInput.value = '';
                    cidadeInput.value = '';
                    estadoInput.value = ''; // Limpa o campo de estado
                });
        } else {
            enderecoInput.value = '';
            bairroInput.value = '';
            cidadeInput.value = '';
            estadoInput.value = ''; // Limpa o campo de estado
        }
    });
});
