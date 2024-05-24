<!-- Coloque este código dentro da seção de scripts da sua view -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Função para chamar verifyEmails() a cada segundo
    function chamarVerifyEmails() {
        // Chama a função verifyEmails() usando AJAX
        $.ajax({
            type: 'GET',
            url: '{{ route("verifyEmails") }}', // Substitua 'sua_rota_para_verifyEmails' pela rota correspondente
            success: function(response) {
                // console.log('verifyEmails() chamada com sucesso!');
                console.log(response);
                // Agende a próxima chamada em 1 segundo
                setTimeout(chamarVerifyEmails, 500);
            },
            error: function(xhr, status, error) {
                console.error('Erro ao chamar verifyEmails(): ' + error);
                // Agende a próxima chamada em 1 segundo mesmo em caso de erro
                setTimeout(chamarVerifyEmails, 1000);
            }
        });
    }

    // Chama chamarVerifyEmails() inicialmente para iniciar o ciclo de chamadas
    $(document).ready(function() {
        chamarVerifyEmails();
    });
</script>
