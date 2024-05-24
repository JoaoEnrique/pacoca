    var intervalId = 0;
    chat_messages()
    $(document).on('click', '.choose-chat', selectMessage)
    const time = 2000;

    intervalId = setInterval(chat_messages, time);

    function chat_messages(){
        let chat_id = $('#chat_id').val()
        if(chat_id >0)
            getMessage()
        else
            clearMessage()
    }

    function getMessage(){
        let chat_id = $('#chat_id').val()

        $.ajax({
            method: 'GET',
            url: `http://192.168.1.107:8080/api/messages/${chat_id}`,
            success: function(response){
                if($('#chat_id').val() >0){
                    chat_name = "";
                    if(response.members[0].img_account) img_account = response.members[0].img_account; else img_account = "/img/img-account.png";

                    response.members.forEach(function(element){
                        chat_name += `${element.name} `
                    })

                    $("#form-escrever-chat").css('display', 'block')
                    document.getElementById("chat-name").innerHTML = chat_name
                    document.getElementById("chat-img").style.backgroundImage = `url('${img_account}')`

                    messages = '';

                    response.messages.forEach(function(element){
                        if(element.user_id != response.user_id){
                            messages += `
                            <div class="div-text-chat">
                                <div class="text-user-nao-logado">
                                    <p>${element.text}</p>
                                    <p class="data-mensagem">${formatarData(element.created_at)}</p>
                                </div>
                            </div>
                            `
                        }else{
                            messages +=  `
                            <div class="div-text-chat div-text-chat-logado">
                                <div class="text-user-logado">
                                <p>${element.text}</p>
                                <p class="data-mensagem">${formatarData(element.created_at)}</p>
                                </div>
                            </div>
                            `
                        }
                    })

                    $("#chat-conteudo").html(messages)
                    closeLoading()
                }
            }
        })
    }

    function clearMessage(){
        $('#chat_id').val("0")
        clearInterval(intervalId);

        document.getElementById("chat-name").innerHTML = "Paçoca"
        document.getElementById("chat-img").style.backgroundImage = `url('../img/img_account/2.png')`

        $("#form-escrever-chat").css('display', 'none')

        messages = `
            <div class="div-text-chat">
                <div class="text-user-nao-logado">
                    <p>Olá, Esse é um exemplo de chat, agora você pode conversar com quem quiser e com privacidade.</p>
                </div>
            </div>

            <div class="div-text-chat">
                <div class="text-user-nao-logado">
                    <p>Vá até o perfil de um usuário para acessar o chat com ele(a)</p>
                </div>
            </div>

            <div class="div-text-chat">
                <div class="text-user-nao-logado">
                    <p>Usamos criptografia de ponta a ponta.</p>
                </div>
            </div>
        `

        $('#chat_id').val("0")
        $("#chat-conteudo").html(messages)
        closeLoading()
    }

    function loading(){
        document.getElementById("chat-loading").style.display = "flex"
    }

    function closeLoading(){
        document.getElementById("chat-loading").style.display = "none"
    }

    function selectMessage(){
        loading();
        clearInterval(intervalId); // Limpe o intervalo anterior
        $("#chat_id").val(this.getAttribute('data-chat-id'));
        $("#chat-conteudo").html("")
        intervalId = setInterval(chat_messages, time);
    }


    function formatarData(isoDate){
        // Converter para um objeto Date
        const data = new Date(isoDate);

        // Extrair componentes da data
        const dia = String(data.getUTCDate()).padStart(2, '0');
        const mes = String(data.getUTCMonth() + 1).padStart(2, '0'); // Janeiro é 0!
        const ano = data.getUTCFullYear();
        const horas = String(data.getUTCHours()).padStart(2, '0');
        const minutos = String(data.getUTCMinutes()).padStart(2, '0');

        // Formatar a data no padrão desejado
        const dataFormatada = `${dia}/${mes}/${ano} - ${horas}:${minutos}`;

        return dataFormatada; // Saída: 18/05/2024

    }

    document.getElementById('form-chat').addEventListener('submit', async function(event) {
        spinner = `
            <div class="spinner-border text-light" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        `

        $(".button-submit-chat").html(spinner);
        $(".button-submit-chat").attr("disabled", true);

        event.preventDefault(); // Evitar recarregar a página

        const form = event.target;
        const formData = new FormData(form);

        // Coletar dados do formulário
        const data = {
            chat_id: formData.get('chat_id'),
            text: formData.get('text'),
            _token: formData.get('_token') // Token CSRF
        };

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            if (response.ok) {
                const result = await response.json();
                console.log('Mensagem enviada com sucesso:', result);
                // Aqui você pode adicionar o comportamento desejado após o envio bem-sucedido,
                // como limpar o campo de texto ou adicionar a nova mensagem na interface.
                form.reset();
            } else {
                console.error('Erro ao enviar a mensagem:', response.statusText);
            }

            $(".button-submit-chat").html("Enviar");
            $(".button-submit-chat").attr("disabled", false);
        } catch (error) {
            console.error('Erro ao enviar a mensagem:', error);
        }
    });
