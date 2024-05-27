$(document).ready(function() {


    
    var imageUpload = ""
    // Carregar imagem do post depois de carregar a pagina
    $('.col-img-post[data-img!=""]').each(function (index, elem) {
        $(elem).css('background', 'url('+$(elem).data('img')+')')
    });

    $(document).on('click', '.button-like', do_like) // CURTIR POST
    $(document).on('click', '.button-comment', open_comment)// ABRIR CAMPO DE COMENTARIO
    $(document).on('submit', '.form-comment', comment); // COMENTAR
    $(document).on('click', '.follow-user', follow_user); // SEGUIR USUÁRIO
    $(document).on('click', '.delete-post', delete_post); // APAGAR POST
    $(document).on('click', '.delete-comment', delete_comment); // APAGAR COMENTARIO
    $(document).on('submit', '.form-edit-post', edit_post); // COMENTAR
    $(document).on('click', '.open-notification', open_notification) // ABRIR NOTIFICACAO
    $(document).on('submit', '#form-open-loading', open_loading) // SPINNER DE CARREGAMENTO AO CLICAR P/ VERIFICAR EMAIL
    $(document).on('click', '.open-loading', open_loading) // SPINNER DE CARREGAMENTO AO CLICAR P/ VERIFICAR EMAIL
    $(document).on('click', '.btn-edit-email', edit_email) // SPINNER DE CARREGAMENTO AO CLICAR P/ VERIFICAR EMAIL

    function open_loading() {
        $('.show-spinner').css("display", "block")
        $('#form-open-loading').css("display", "none")
    }

    image_upload()
    video_upload()

    // CURTIR POST
    function do_like(){
        var id = $(this).data('id-post');
        var divLike = $(".div-like-" + id);

        var iconLike = $(this);

        $.ajax({
            url: '/like',
            data: 'id_post=' + id,
            method: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function(data){
                console.log(data.message);

                iconLike.remove()
                switch (data.message){
                    case 'likeSuccess':
                        iconLike.remove()
                        divLike.prepend(`
                            <div data-id-post="${id}" class="button-like col col-like div-like-{{$post->id}}" >
                                <svg style="color:red" xmlns="http://www.w3.org/2000/svg" height="25" width="25" class="icon-reaction-post" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                </svg>
                            </div>
                        `)

                        //Atualiza curtidas
                        $('#curtida-'+ id).html(parseInt($('#curtida-'+ id).html()) + 1);

                        if(data.subject)
                            sendEmailNotification(data.email_notification, data.subject, data.text, data.link1, data.link2);

                        break

                    case 'deslikeSuccess':
                        iconLike.remove()
                        divLike.prepend(`
                            <div data-id-post="${id}" class="button-like col col-like div-like-{{$post->id}}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" class="icon-reaction-post" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                </svg>
                            </div>
                        `)
                        // $(divLike[0]).css({color: 'black'})

                        //Atualiza curtidas
                        $('#curtida-'+ id).html(parseInt($('#curtida-'+ id).html()) - 1);
                        break
                }

            },error: function(err){
                console.log(err);
            }
        });

    }

    // Função para enviar notificação por e-mail
    function sendEmailNotification(email_notification, subject, text, link1, link2) {
        $.ajax({
            url: '/send-email-notification',
            data: {
                'email': email_notification,
                'subject': subject,
                'text': text,
                'link1': link1,
                'link2': link2
            },
            method: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                console.log(data);
            },
            error: function (err) {
                console.log(err);
            }
        });
    }

    function edit_email(){
        var formulario = document.getElementById("form-edit-email");
        formulario.submit();
    }



    // ABRIR NOTIFICAÇÃO
    function open_notification(){
        var id = $(this).data('id-notification');

        $.ajax({
            url: '/open-notification',
            data: 'id_notification=' + id,
            method: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function(data){
                switch (data.message){

                    case 'openSuccess':

                        break

                    case 'openDanger':

                        break
                }

            }
        });

    }

    // ABRIR CAMPO DE COMENTARIO
    function open_comment(){
        var id = $(this).data('id-post');

        var displayComment = $('#row-comment-' + id).css('display');

        if(displayComment == "flex"){
            $('#row-comment-'+ id).css({display: 'none'});
        }else{
            $('#row-comment-'+ id).css({display: 'flex'});
        }
    }

    // COMENTAR
    function comment(event) {
        event.preventDefault(); // Impede o envio padrão do formulário

        var form = $(this); // Obtém o formulário atual
        var url = form.attr('action'); // Obtém o URL do atributo 'action' do formulário


        var idPost = form.find('input[name="id_post"]').val();
        var name = form.find('input[name="name"]').val();
        var textPost = form.find('textarea[name="comment"]').val();
        var img_account = form.find('input[name="img_account"]').val();

        // Definir o texto de exemplo
        // Expressões regulares
        let padraoLink = /(https?:\/\/[^\s]+)/;
        let padraoTagUser = /(@[^\s]+)/;

        // Formatando como link se houver link
        let textoFormatado = textPost.replace(padraoLink, function (url) {
            return `<a href='${url}' target='_blank' style='word-wrap: break-word;'>${url}</a>`;
        });

        // Link se o usuário marcar outro
        textoFormatado = textoFormatado.replace(padraoTagUser, function (match) {
            let username = match.slice(1); // Remover o "@" do início do nome de usuário
            return `<a href='/${username}' style='word-wrap: break-word;'>${match}</a>`;
        });

        var newComment = `
        <div class="row" style="margin-top:10px">

            <div class="col-1 img-account-likes img-account-search" style="background-image: url('${img_account}')!important">
            </div>

            <div class="col">
                <div class="comment-text">
                    <h1 style="font-size: 17px; margin-bottom: -5px">${name}</h2>
                    <p class="date-comment"> - Agora</p>
                    <p class="text-comment text-comment-{{$user_comment->id}}">
                        ${textoFormatado}
                    </p>
                </div>
            </div>
        </div>
    `;

        $.ajax({
        url: url,
        method: 'POST',
        dataType: 'json',
        data: form.serialize(), // Pega todos os dados do formulário
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        success: function(data) {

            $('#comentarios-'+ idPost).html(parseInt($('#comentarios-'+ idPost).html()) + 1);
            $('.row-novo-comentario-'+ idPost).css({display: 'flex'})
            $('#text-novo-comentario-'+ idPost).html(textoFormatado)
            // console.log(newComment)
            $('.modal-body-'+ idPost).append(newComment)

            if(data.subject)
                sendEmailNotification(data.email_notification, data.subject, data.text, data.link1, data.link2);

        },

        error: function(err) {
            console.log(err);
        }
        });
    }

    // SEGUE USUARIO
    function follow_user(event){
        event.preventDefault(); // Impede o envio padrão do formulário
        numeroSeuidor = $('#numero-seguidor').html();
        idUser = $(this).data('user')

        $.ajax({
            url: '/follow-user',
            dataType: 'JSON',
            method: 'POST',
            data: 'id_user=' + idUser,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function(ret){
                console.log(ret.message)
                if(ret.message == "follow"){
                    $('.follow-user-' + idUser).removeClass('btn-blue')
                    $('.follow-user-' + idUser).addClass('btn-gray')
                    $('.follow-user-' + idUser).html("Deixar de Seguir")
                    $('#numero-seguidor').html(parseInt(numeroSeuidor) + 1);
                    // console.log(numeroSeuidor)
                    if(ret.subject)
                        sendEmailNotification(ret.email_notification, ret.subject, ret.text, ret.link1, ret.link2);
                }else{
                    $('.follow-user-' + idUser).removeClass('btn-gray')
                    $('.follow-user-' + idUser).addClass('btn-blue')
                    $('.follow-user-' + idUser).html("Seguir")
                    $('#numero-seguidor').html(parseInt(numeroSeuidor) - 1);
                }
            }, error(err){
                console.log(err);
            }
        });
    }

    // APAGA POST
    function delete_post(event){
        if (confirm('Tem certeza que deseja excluir o post? Não é possível recuperar essa ação')) {
            event.preventDefault(); // Impede o envio padrão do formulário
            id = $(this).data('post')
            $.ajax({
                url: '/delete-post',
                dataType: 'JSON',
                method: 'POST',
                data: 'id_post=' + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success: function(ret){
                    console.log(ret.message)
                    if(ret.message == "delete"){
                        $('.card-post-' + id).remove()
                    }
                }
            });
        }
    }

    // APAGA COMENTARIO
    function delete_comment(event){
        event.preventDefault(); // Impede o envio padrão do formulário
        id = $(this).data('comment')
        idPost = $(this).data('post')
        $.ajax({
            url: '/delete-comment',
            dataType: 'JSON',
            method: 'POST',
            data: 'id_comment=' + id,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function(ret){
                console.log(ret.message)
                if(ret.message == "delete"){
                    $('.card-comment-' + id).remove()
                    $('#comentarios-'+ idPost).html(parseInt($('#comentarios-'+ idPost).html()) - 1);
                }
            }
        });
    }

    // EDITA POST
    function edit_post(event){
        event.preventDefault(); // Impede o envio padrão do formulário
        var form = $(this);
        var idPost = form.find('input[name="id_post"]').val();
        var textPost = form.find('textarea[name="text_update"]').val();

        // Definir o texto de exemplo
        // Expressões regulares
        let padraoLink = /(https?:\/\/[^\s]+)/;
        let padraoTagUser = /(@[^\s]+)/;

        // Formatando como link se houver link
        let textoFormatado = textPost.replace(padraoLink, function (url) {
            return `<a href='${url}' target='_blank' style='word-wrap: break-word;'>${url}</a>`;
        });

        // Link se o usuário marcar outro
        textoFormatado = textoFormatado.replace(padraoTagUser, function (match) {
            let username = match.slice(1); // Remover o "@" do início do nome de usuário
            return `<a href='/${username}' style='word-wrap: break-word;'>${match}</a>`;
        });


        $.ajax({
            url: '/edit-post',
            dataType: 'JSON',
            method: 'POST',
            data: form.serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function(ret){
                if(ret.message == "edit"){
                    // $('#text-post-'+ idPost).html(textoFormatado)
                    window.location.href = "/post/" + idPost
                }
            },
            error: function(err) {
                console.log(err);
            }
        });
    }

    // PREVIEW DA IMAGEM
    function image_upload(){
        // PREVIEW DA IMAGEM DO POST
        // Get the input file element
        imageUpload = document.getElementById('img');


        if(imageUpload){
            // Listen for changes in the input file
            imageUpload.addEventListener('change', function() {
            // Get the selected file
            const file = this.files[0];

            // Check if a file is selected
            if (file) {
                // Create a FileReader object
                const reader = new FileReader();

                // Set up the reader to load the image
                reader.onload = function(e) {
                // Create an image element
                //   const img = document.createElement('img');

                // Set the source of the image to the loaded file
                //   img.src = e.target.result;
                // Append the image to the preview container
                const previewContainer = document.querySelector('.label-img');
                previewContainer.style.display = "block";
                previewContainer.style.backgroundImage = "url('" + e.target.result + "')";
                previewContainer.style.backgroundSize = "cover";
                //   previewContainer.appendChild(img);
                };

                // Read the selected file as a Data URL
                reader.readAsDataURL(file);
            }
            });
        }
    }

    // PREVIEW DO VIDEO
    function video_upload(){
        // PREVIEW DA IMAGEM DO POST
        // Get the input file element
        imageUpload = document.getElementById('video');


        if(imageUpload){
            // Listen for changes in the input file
            imageUpload.addEventListener('change', function() {
            // Get the selected file
            const file = this.files[0];

            // Check if a file is selected
            if (file) {
                // Create a FileReader object
                const reader = new FileReader();

                // Set up the reader to load the image
                reader.onload = function(e) {
                // Create an image element
                //   const img = document.createElement('img');

                // Set the source of the image to the loaded file
                //   img.src = e.target.result;
                // Append the image to the preview container
                const previewContainer = document.querySelector('.label-video');
                const videoPost = document.querySelector('.video-post');
                previewContainer.style.display = 'block';
                videoPost.src = e.target.result;
                //   previewContainer.appendChild(img);
                };

                // Read the selected file as a Data URL
                reader.readAsDataURL(file);
            }
            });
        }
    }

    // function add_img(){
    //     alert('aas')
    //     // Seleciona o elemento cujo conteúdo você deseja modificar.
    //     var minhaDiv = document.getElementById("icon-add-img");

    //     // Cria um novo elemento <p> para o novo conteúdo.
    //     var newImage = `
    //         <input type="file" class="d-nosne" name="img[]" id="img[]" accept="image/*">
    //         <label class="label-img label-img" for="img[]"></label>
    //     `
    //     // Adiciona o novo elemento <p> após o elemento existente <p>.
    //     minhaDiv.insertAdjacentHTML('beforeend',newImage);
    // }
});
