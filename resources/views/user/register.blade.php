{{-- 
    "PRA QUE SERVE
    TANTO CÓDIGO
    SE A VIDA
    NÃO É PROGRAMADA
    E AS MELHORES COISAS
    NÃO TEM LÓGICA". 
    Algúem (algum ano)
--}}

@extends('layouts.main')
@section('title', 'Paçoca')

@section('content')
<div class="container-login">
    <div class="row row-login"  style="height: 100%">
        <div class="col col-form-register">
          <h2 class="titulo-register">Criar Conta</h2>
            <form class="form-register row" method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Nome --}}
                    <div class="col-md-6 col-sm-6 mb-3">
                        <label for="name" class="col-md-4 label-register text-md-right">{{ __('Nome') }}</label>

                        <div class="col">
                            <input id="name" type="text" class="input-login form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Nome de usuário --}}
                    <div class="col-md-6 col-sm-6 mb-3">
                        <label for="user_name" class="col-md-4 label-register text-md-right">{{ __('Nome de usuário') }}</label>

                        <div class="input-group mb-3">
                            <span class="input-group-text" style="border: 0;">@</span>

                            <input id="user_name" type="text" class="input-login form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name') }}" autocomplete="off">

                            @error('user_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="col-md-12  mb-3">
                        <label for="email" class="col-md-4 label-register text-md-right">{{ __('Email') }}</label>

                        <div class="col">
                            <input id="email" type="email" class="input-login form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Senha --}}
                    <div class="col-md-6">
                        <label for="password" class="col-md-4 label-register text-md-right">{{ __('Senha') }}</label>

                        <div class="col" style="position: relative">
                            <input id="password" type="password" class="input-login form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" name="password" autocomplete="current-password">
                            {{-- IMAGEM DE VER SENHA --}}
                            <img class="view-password" id="view-password" src="{{asset('img/eye.svg')}}" onclick="showPassword()" srcset="">
                        </div>

                        @error('password')
                            <span class="invalid-feedback" role="alert" style="display: block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Confirmar Senha --}}
                    <div class="col-md-6  mb-3">
                        <label for="password-confirm" class="col-md-4 label-register text-md-right">{{ __('Confirmar Senha') }}</label>

                        <div class="col" style="position: relative">
                            <input id="password-confirm" type="password" class="input-login form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" autocomplete="new-password">
                            {{-- IMAGEM DE VER SENHA --}}
                            <img class="view-password" id="view-password-confirm" src="{{asset('img/eye.svg')}}" onclick="showPasswordConfirm()" srcset="">
                        </div>
                    </div>

                    

                    <div class="col mb-3">
                        <input required class="form-check-input" type="checkbox" {{ old('checkbox') ? 'checked' : '' }} name="termos"  id="termos">
                        
                        <label class="form-check-label" for="termos">
                            Concordo com os
                            <input type="button" data-bs-toggle="modal" data-bs-target="#modal-termos-de-uso" style="background: transparent; border: 0; color: blue; text-decoration: underline" value="termos de uso"/> e a
                            <input type="button" data-bs-toggle="modal" data-bs-target="#modal-politicas-de-privacidade" style="background: transparent; border: 0; color: blue; text-decoration: underline" value="politica de privacidade"/>
                            do Paçoca
                        </label>

                        @error('termos')
                            <span class="invalid-feedback" role="alert" style="display: block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
    
                    {{-- Criar Conta --}}
                    <div class="form-group mt-5">
                        <div class="col link-criar-conta">
                            <button type="submit" class="btn btn-login">
                                {{ __('Criar Conta') }}
                            </button>

                            <a class="link-criar-conta" href="{{route('login')}}">Já tem uma conta? Faça Login</a>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Esqueci minha senha') }}
                                </a>
                            @endif
                        </div>
                    </div>
                        
                </form>
        </div>

        <script>
            //BOTÃO PARA MOSTRAR SENHA    
            function showPassword() {//Botao de olho para mostrar e esconder a senha (pagina entrar)
                var senha = document.querySelector("#password");
                var imgShow = document.querySelector("#view-password");
                if (senha.type === "password") {
                senha.type = "text";
                imgShow.src = "../img/eye-off.svg"
                } else {
                senha.type = "password";
                imgShow.src = "../img/eye.svg"
                }
            }

            function showPasswordConfirm() {//Botao de olho para mostrar e esconder a senha (pagina entrar)
                var senha = document.querySelector("#password-confirm");
                var imgShow = document.querySelector("#view-password-confirm");
                if (senha.type === "password") {
                senha.type = "text";
                imgShow.src = "../img/eye-off.svg"
                } else {
                senha.type = "password";
                imgShow.src = "../img/eye.svg"
                }
            }

        </script>

        {{-- Logo --}}
        <div class="col col-img-register">
            <img class="img-logo-login" src="../img/pacoca.png" height="400">
        </div>

    </div>
  </div>

  <!-- MODAL DE TERMOS DE USO -->
  <div class="modal fade" style="overflow: hidden" id="modal-termos-de-uso" tabindex="-1" aria-labelledby="modal-termos-de-uso" aria-hidden="true">
            
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modal-termos-de-uso">Termos de uso</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="max-height: 80vh!important; overflow: auto">
            <p>Data de vigência: 07/03/2024</p>

            <p>Bem-vindo à Paçoca! Ao utilizar nossa plataforma, você concorda com os seguintes Termos de Uso. Certifique-se de ler atentamente antes de prosseguir.</p>
            
            <h5>1. Aceitação dos Termos </h5>
            
            <p>Ao acessar ou utilizar a Paçoca, você concorda em cumprir estes Termos de Uso e todas as leis e regulamentos aplicáveis. Se você não concordar com algum termo ou condição, solicitamos que não utilize nossa plataforma.</p>
            
            <h5>2. Uso da Plataforma</h5>
            
            <h6>2.1 Cadastro:</h6>
            <p>Você é responsável por fornecer informações precisas e atualizadas durante o processo de registro. Manter a confidencialidade de suas credenciais de conta é de sua responsabilidade.</p>
            
            <h5>2.2 Comportamento do Usuário:</h5>
            <p>Ao utilizar a Paçoca, compromete-se a não violar direitos de terceiros, divulgar conteúdo inadequado, praticar atividades ilegais ou prejudicar a experiência de outros usuários.</p>
            
            <h5>3. Conteúdo do Usuário
            
            <h5>3.1 Propriedade:</h5>
            <p>Você mantém a propriedade dos conteúdos que compartilha na Paçoca. Ao fornecer conteúdo, concede-nos uma licença não exclusiva para usá-lo de acordo com os propósitos da plataforma.</p>
            
            <h5>3.2 Conteúdo Proibido:</h5>
            <p>É proibido publicar conteúdo que seja difamatório, obsceno, ilegal, discriminatório, ameaçador ou que viole os direitos de propriedade intelectual de terceiros.</p>
            
            <h5>4. Responsabilidades e Garantias</h5>
            
            <p>Você é responsável por suas ações na Paçoca. Não garantimos que a plataforma será livre de interrupções ou erros, e reservamo-nos o direito de suspender ou encerrar contas que violem estes Termos de Uso.</p>
            
            <h5>5. Privacidade e Segurança</h5>
            
            <p>Ao utilizar a Paçoca, concorda com nossa <a href data-bs-toggle="modal" data-bs-target="#modal-politicas-de-privacidade">Política de Privacidade.</a></p>
            
            <h5>6. Modificações nos Termos de Uso</h5>
            
            <p>Reservamo-nos o direito de modificar estes Termos de Uso a qualquer momento. Notificaremos os usuários sobre alterações significativas, e o uso contínuo da plataforma após as mudanças implica na aceitação dos novos termos.</p>
            
            <h5>7. Encerramento da Conta</h5>
            
            <p>Você pode encerrar sua conta a qualquer momento. Reservamo-nos o direito de encerrar contas que violem estes Termos de Uso.</p>
            
            <h5>8. Contato</h5>
            
            <p>Para entrar em contato conosco em relação a estes Termos de Uso, utilize pacoca150723@gmail.com.</p>
            
            <p>Agradecemos por escolher a Paçoca. Divirta-se, respeite os demais usuários e contribua para uma comunidade positiva!</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="button" data-bs-dismiss="modal" id="btnCheck" class="btn btn-blue">Aceitar</button>
        </div>
        </div>
    </div>
</div>

{{-- MODAL DE POLITICAS SE PRIVACIDADE --}}
<div class="modal fade" style="overflow: hidden" id="modal-politicas-de-privacidade" tabindex="-1" aria-labelledby="modal-politicas-de-privacidade" aria-hidden="true">
            
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modal-politicas-de-privacidade">Política de Privacidade da Paçoca</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="max-height: 80vh!important; overflow: auto">
            Data de vigência: 07/03/2024

            <h5>1. Introdução</h5>

            <p>Bem-vindo ao Paçoca! Estamos comprometidos em proteger a sua privacidade e queremos garantir que você compreenda como coletamos, usamos, compartilhamos e protegemos as suas informações. Ao utilizar nossa plataforma, você concorda com os termos desta Política de Privacidade.</p>

            <h5>2. Informações Coletadas</h5>

            <h5>2.1 Informações Pessoais:</h5>
            <p>Coletamos informações pessoais fornecidas por você durante o processo de registro, como nome, endereço de e-mail, data de nascimento e outras informações necessárias para a criação da sua conta.</p>

            <h5>2.2 Informações de Uso:</h5>
            <p>Registramos automaticamente informações sobre como você interage com a plataforma, incluindo suas atividades, conteúdo visualizado, dispositivos utilizados, endereços IP e localização aproximada.</p>

            <h5>3. Uso de Informações</h5>

            <p>Utilizamos suas informações para personalizar a sua experiência na Paçoca, fornecer conteúdos relevantes, melhorar nossos serviços, prevenir fraudes e garantir a segurança da comunidade.</p>

            <h5>4. Compartilhamento de Informações</h5>

            <p>Não vendemos suas informações pessoais. Compartilhamos dados apenas conforme necessário para prestadores de serviços terceirizados que nos auxiliam na operação da plataforma, cumprimento de obrigações legais e proteção dos direitos e segurança da comunidade.</p>

            <h5>5. Controle e Acesso às Suas Informações</h5>

            <p>Você tem o direito de acessar, corrigir ou excluir suas informações pessoais. Disponibilizamos ferramentas em nossa plataforma para que você possa gerenciar suas preferências de privacidade.</p>

            <h5>6. Segurança das Informações</h5>

            <p>Implementamos medidas de segurança para proteger suas informações contra acesso não autorizado, alteração, divulgação ou destruição.</p>

            <h5>7. Alterações na Política de Privacidade</h5>

            <p>Reservamo-nos o direito de atualizar esta Política de Privacidade periodicamente. Notificaremos os usuários sobre mudanças significativas, e a continuação do uso da plataforma após as alterações implica na aceitação das novas condições.</p>

            <h5>8. Contato</h5>

            <p>Se tiver dúvidas ou preocupações sobre esta Política de Privacidade, entre em contato conosco através de [e-mail de contato].</p>

            <p>Ao utilizar a [Nome da Sua Rede Social], você concorda com os termos descritos nesta Política de Privacidade. Obrigado por fazer parte da nossa comunidade!</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="button" data-bs-dismiss="modal" id="btnCheck" class="btn btn-blue">Aceitar</button>
        </div>
        </div>
    </div>
</div>

<script>
    
            
            // Obtém referências aos elementos HTML
            const checkbox = document.getElementById('termos');
            const btnCheck = document.getElementById('btnCheck');

            // Adiciona um evento de clique ao botão
            btnCheck.addEventListener('click', function() {
                // Altera o estado de marcação do checkbox ao clicar no botão
                checkbox.checked = true;
            });
</script>

@endsection
