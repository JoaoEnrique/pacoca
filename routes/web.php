<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ChatController;
// use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\ApiController;

use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Messages\MailMessage;
use App\Mail\AbrirTamplateEmail;

// Enviar email de redefinição de senha

use App\Notifications\NotificationEmail;
use App\Mail\ExampleEmail;
use App\Models\User; // Certifique-se de ajustar o namespace conforme sua estrutura de pastas.
// routes/web.php ou routes/api.php

use App\Http\Controllers\VisitasController;


Route::get('/gerenciar-visita', [VisitasController::class, 'gerenciarVisita']);
Route::post('/verify-email-server', [VerificationController::class, 'enviarEmailVerificacao']);
Route::get('/verify-email-server/{hash}', [VerificationController::class, 'verifyEmailsHash']);
Route::get('/view-verify-email-server', [VerificationController::class, 'viewVerifyEmails']); //
Route::get('/has-verify-email-server', [VerificationController::class, 'VerifyEmails'])->name('verifyEmails');
Route::get('/enviar-email-teste', [VerificationController::class, 'enviarEmailTeste'])->name('enviarEmailTeste');
Route::get('/verify-email-wrong', function(){
    return view("errors.confirmation_email_wrong");
});

Route::get('/sobre', function(){
    return view('about');
});//feed



Route::post('/passwords/reset', [UserController::class, 'resetPasswordEmail'])->name('password-email');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('/enviar-verificacao-email', [VerificationController::class, 'enviarEmailVerificacao'])->name('enviar.verificacao.email');


// Route::get('/verify-email', [EmailVerificationController::class, 'showVerificationForm'])->name('verification.notice');
// Route::get('/verify-email/{id}/{hash}', [EmailVerificationController::class, 'verifyEmail'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::get('/send-multiple-emails', function () {
    $emailArray = [
        'jebsantosalves@gmail.com',
        'alandelimasilva51@gmail.com',
        'amandabispo037@gmail.com',
        'cg70136@gmail.com',
        'andreimatias97@gmail.com',
        'beatrizapvallemartins@gmail.com',
        'bibicless@gmail.com',
        'faresende914@gmail.com',
        'bruno2004sa@gmail.com',
        'danieldesouzarufino@gmail.com',
        'jean.roberto927@gmail.com',
        'eliel.a.m.godoy@gmail.com',
        'erick.p781@outlook.com',
        'bigol2109@outlook.com',
        'gl3492860@gmail.com',
        'giovanas.franca01@gmail.com',
        'giovannadasilva280500@gmail.com',
        'vanessafigueiredogr@gmail.com',
        'guscadnerd@gmail.com',
        'jajpsa225@gmail.com',
        'raildee@hotmail.com',
        'juanfariasbr@gmail.com',
        'dojeitoj@gmail.com',
        'vilmasilva201019@hotmail.com',
        'pereira.l.c4137@gmail.com',
        'maraparecida.almeida@gmail.com',
        'werlang.mariaeduarda@gmail.com',
        'mariane.souza030405@gmail.com',
        'nana090605@gmail.com',
        'santossilva.7400@gmail.com',
        'raafel.xp500@gmail.com',
        'raissa1501santos@gmail.com',
        'raphaelgarciaalves3@gmail.com',
        'sjandoza18@gmail.com',
        'luis@lualdyreintegracao.com.br',
        'vektromboni@gmail.com',
        'victor25032006@gmail.com',
        'alan.silva397@etec.sp.gov.br',
        'amanda.batista71@etec.sp.gov.br',
        'ana.oliveira1610@etec.sp.gov.br',
        'andrei.matias@etec.sp.gov.br',
        'beatriz.martins108@etec.sp.gov.br',
        'bianca.silva1152@etec.sp.gov.br',
        'bruno.rezende01@etec.sp.gov.br',
        'bruno.portugal01@etec.sp.gov.br',
        'daniel.rufino6@etec.sp.gov.br',
        'danilo.rodrigues108@etec.sp.gov.br',
        'edward.silva4@etec.sp.gov.br',
        'eliel.godoy@etec.sp.gov.br',
        'erick.bastos2@etec.sp.gov.br',
        'gabriel.mendes88@etec.sp.gov.br',
        'gabriel.freire01@etec.sp.gov.br',
        'giovana.franca4@etec.sp.gov.br',
        'giovanna.silva548@etec.sp.gov.br',
        'guilherme.pereira361@etec.sp.gov.br',
        'gustavo.cruz90@etec.sp.gov.br',
        'henrique.machado34@etec.sp.gov.br',
        'joao.alves254@etec.sp.gov.br',
        'joao.cabral14@etec.sp.gov.br',
        'joao.rodrigues328@etec.sp.gov.br',
        'juan.rocha5@etec.sp.gov.br',
        'julia.goncalves83@etec.sp.gov.br',
        'julio.neves2@etec.sp.gov.br',
        'lucas.carvalho269@etec.sp.gov.br',
        'marcela.almeida17@etec.sp.gov.br',
        'maria.werlang@etec.sp.gov.br',
        'mariane.souza22@etec.sp.gov.br',
        'nair.sousa@etec.sp.gov.br',
        'paulo.silva1449@etec.sp.gov.br',
        'rafael.silva2103@etec.sp.gov.br',
        'raissa.ramos4@etec.sp.gov.br',
        'raphael.silva297@etec.sp.gov.br',
        'sarah.laurindo@etec.sp.gov.br',
        'tamiris.carvalho5@etec.sp.gov.br',
        'victor.cardoso36@etec.sp.gov.br',
        'victor.roma@etec.sp.gov.br',
        "ana.mb236@gmail.com",
        "ajlimaa12@gmail.com",
        "analuisaaugusto046@gmail.com",
        "marister22@hotmail.com",
        "gustavodiasdsc@gmail.com",
        "robertofecap@hotmail.com",
        "elaine-cabral@hotmail.com",
        "maraparecida.almeida@gmail.com",
        "tamirisromano718@gmail.com",
    ];

    $emailArray = [
        "alan.silva138@fatec.sp.gov.br",
    "beatriz.martins13@fatec.sp.gov.br",
    "victor.cardoso8@fatec.sp.gov.br",
    "daniel.rufino01@fatec.sp.gov.br",
    "bruno.portugal01@fatec.sp.gov.br",
    "edward.silva@fatec.sp.gov.br",
    "henrique.machado3@fatec.sp.gov.br",
    "natasha.alves@fatec.sp.gov.br",
    "nair.sousa@fatec.sp.gov.br",
    "sarah.laurindo@fatec.sp.gov.br",
    "gabriel.germano@fatec.sp.gov.br",
    "melissa.conceicao01@fatec.sp.gov.br",
    "bruno.rezende@fatec.sp.gov.br",
    "kayky.sousa@fatec.sp.gov.br",
    "tamiris.carvalho01@fatec.sp.gov.br",
    "erick.bastos@fatec.sp.gov.br",
    "raissa.ramos2@fatec.sp.gov.br",
    "giovana.franca01@fatec.sp.gov.br",
    "joao.rodrigues94@fatec.sp.gov.br",
    "gustavo.siqueira14@fatec.sp.gov.br",
    "gabriel.alves70@fatec.sp.gov.br",
    "victor.roma@fatec.sp.gov.br",
    "lucas.carvalho84@fatec.sp.gov.br",
    "guilherme.paula24@fatec.sp.gov.br",
    "yann.casanova@fatec.sp.gov.br",
    "marcela.almeida3@fatec.sp.gov.br",
    "gabriel.freire4@fatec.sp.gov.br",
    "gabriel.mendes19@fatec.sp.gov.br",
    "gabriel.mendes19@fatec.sp.gov.br",
    "paulo.silva498@fatec.sp.gov.br",
    "eliel.godoy01@fatec.sp.gov.br",
    "ana.val@fatec.sp.gov.br",
    "joao.cabral01@fatec.sp.gov.br",
    "rafael.silva744@fatec.sp.gov.br",
    "maria.werlang@fatec.sp.gov.br",
    "juan.rocha01@fatec.sp.gov.br",
    "giovanna.silva90@fatec.sp.gov.br",
    "danilo.rodrigues24@fatec.sp.gov.br",
    "carolina.lima3@fatec.sp.gov.br",
    "julio.neves01@fatec.sp.gov.br",
    "ana.batista12@fatec.sp.gov.br",
    "mariane.souza6@fatec.sp.gov.br",
    "bianca.silva142@fatec.sp.gov.br",
    "ana.oliveira277@fatec.sp.gov.br",
    "julia.goncalves6@fatec.sp.gov.br",
    "natan.rezende@fatec.sp.gov.br",
    "marcos.santos227@fatec.sp.gov.br"
    ];

    $emailArray = [
        // 'smartjoboficial@gmail.com',
        // 'domingaspatricia014@gmail.com',
        // 'marta0967@gmail.com',
        // 'ra-fa0605@hotmail.com',
        // 'tania.fernandez@gmail.com',
        // 'viincoder@gmail.com',
        'jebsantosalves@gmail.com',
        // 'maria.correia36@etec.sp.gov.br',
        // 'maria.correia37@etec.sp.gov.br',
        // 'joao.alves254@etec.sp.gov.br',
        // 'jajpsa225@gmail.com',
        // 'msc2005eduarda@gmail.com',
    ];

    $emailController = new EmailController(); // Instancie o controlador

    foreach ($emailArray as $email) {
        Notification::route('mail', $email)
            ->notify(new NotificationEmail());

    }

    return "E-mails enviados com sucesso!";
});


Auth::routes(['verify' => true]);

//USUARIO LOGADO
Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');//sair da conta
    Route::get('/', [PostsController::class, 'feed'])->name('feed');//feed
    Route::post('/like', [PostsController::class, 'like']);//dar like
    Route::post('/comment', [PostsController::class, 'comment']);//dar like
    Route::post('/follow-user', [UserController::class, 'follow_user']);//dar like
    Route::post('/post', [PostsController::class, 'post']);//publicar

    Route::get('/edit', [NavigationController::class, 'edit']);//view editar
    Route::post('/edit-info', [UserController::class, 'editInfo']);//editar informações pessoais
    Route::post('/edit-email', [UserController::class, 'editEmail']);//editar email
    Route::post('/edit-password', [UserController::class, 'editPassword']);//editar senha

    Route::post('/delete-post', [PostsController::class, 'delete']);//apagar post
    Route::post('/edit-post', [PostsController::class, 'edit']);//editar post
    Route::post('/edit-image-account', [UserController::class, 'edit_image']);//editar post


    Route::post('/delete-comment', [PostsController::class, 'delete_comment']);//apagar comentario

    Route::get('/notification', [NotificationController::class, 'notification']);// VIEW das notificações
    Route::get('/set-notification', [NotificationController::class, 'setNotification']);//editar post
    Route::post('/open-notification', [NotificationController::class, 'opeNotification']);//ABRIR NOTIFICAÇÃO

    // Route::get('/chat/{user_name}', [ChatController::class, 'opeChats']);//chats
    Route::get('/chat/{id}', [ChatController::class, 'newChat'])->name('chat.new');//chats
    Route::get('/chat', [ChatController::class, 'index'])->name('chat');//chats
    Route::post('/send-message-chat', [ChatController::class, 'sendMessage']);//chats
});

//USUARIO NÃO LOGADO
Route::group(['middleware' => 'guest'], function () {
    // Login
    Route::get('/login', [NavigationController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'login']);

    // Criar conta
    Route::get('/register', [NavigationController::class, "register"])->name("register");
    Route::post('/register', [UserController::class, "store"]);

});


Route::get('/404', [NavigationController::class, 'page_not_found'])->name('404');//pagina nao encontrada
Route::get('/search', [UserController::class, "search"])->name("search");
Route::get('/{user_name}', [UserController::class, "account"])->name("account");
Route::get('/post/{post_id}', [PostsController::class, "view_post"])->name("view_post");
Route::get('/search-username/{username}', [UserController::class, 'searchByUsername']);


Route::get('/notification/{subject}/{text}/{link1}', function (string $subject, string $text, string $link1) {
    return view('mail.notification', ['subject' => $subject, 'text'=> $text, 'link1' => $link1]);
});

Route::post('/send-email-notification', [EmailController::class, "sendEmailnotification"]);


Route::get('/api/messages/{chat_id}', [ApiController::class, "messagesByChatId"]);

