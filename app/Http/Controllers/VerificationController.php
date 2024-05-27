<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str; // Importe a classe Str
use App\Models\User;
use App\Notifications\NotificationEmail;
use App\Http\Controllers\NotificationController;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\URL;
use App\Notifications\ConfirmEmail;
use App\Notifications\ResetPassword;
use Illuminate\Support\Facades\Mail;
use App\Mail\AbrirTamplateEmail;


class VerificationController extends Controller
{
    public function enviarEmailVerificacao(Request $request)
    {
        $user = $request->user();

        if(!$user)
            return redirect('/login');


        if ($user->hasVerifiedEmail())
            return redirect('/');

        // Gera e armazena um token de verificação personalizado
        $token = Str::random(60);
        $user->email_verification_token = $token;
        $user->save();

        // Variáveis para serem passadas
        // $titulo = 'Verifique seu email';
        // $link = 'https://www.pacoca.x10.mx/';
        // $texto = 'Clique no link abaixo e verifique seu email';

        // $link = "https://pacoca.onrender.com/verify-email/" . $user->id . "/" . $token;

        // $response = file_get_contents($url);

        // Envie o e-mail de verificação com o token incluído no URL
        $user->sendEmailVerificationNotification($token);

        return redirect('/')->with('resent', 'E-mail de verificação enviado com sucesso!');
    }

    public function enviarEmailTeste(){
        $email = Mail::to('jebsantosalves@gmail.com')->send(new AbrirTamplateEmail('teste', 'teste', 'teste', 'teste'));
        return $email;
    }

    public function verifyEmails(){
        $this->verifyResetPassword();
        $this->verifyNotificarionsServer(); //notificações

        // Crie uma instância do cliente Guzzle
        $client = new Client();

        // Faça uma requisição GET para sua API
        $response = $client->request('GET', 'https://www.pacoca.x10.mx/has-verify-email-server');

        // Obtenha o corpo da resposta da API
        $data = json_decode($response->getBody(), true);

        // Verifique se a decodificação foi bem-sucedida
        if($data) {
            // Se houver dados, você pode passá-los diretamente para a visualização
            // return view('verify-email', ['users' => $data]);
            foreach($data as $userData){
                $email = $userData['email'];
                $token = $userData['email_verification_token'];

                    // Enviar notificação de verificação de email para o usuário
                    $user = User::where('email', $email)->first();
                    if ($user) {
                        $link = "https://pacoca.onrender.com/verify-email/" . $user->id . "/" . $token;
                        $user->notify(new ConfirmEmail($link));
                        $response = $client->request('GET', 'https://www.pacoca.x10.mx/send-hash/' . $user->id);

                        // $user->sendEmailVerificationNotification($token);
                    }else{
                        $user = User::create([
                            'id' => $userData['id'],
                            'name' => $userData['name'],
                            'user_name' => $userData['user_name'],
                            'email' => $userData['email'],
                            'password' => "assaaaaaaaaaa",
                        ]);
                        $link = "https://pacoca.onrender.com/verify-email/" . $user->id . "/" . $token;
                        $user->notify(new ConfirmEmail($link));
                        $response = $client->request('GET', 'https://www.pacoca.x10.mx/send-hash/' . $user->id);

                    }
            }


            return "Recuperação de Email Enviada";
        } else {
            // return "Nenhum email";
            // Se não houver dados, retorne uma visualização vazia ou com uma mensagem de erro
        }
    }

    public function verifyNotificarionsServer(){

        $emailController = new EmailController(); // Instancie o controlador
        // Crie uma instância do cliente Guzzle
        $client = new Client();

        // Faça uma requisição GET para sua API
        $response = $client->request('GET', 'https://www.pacoca.x10.mx/has-verify-server-email');

        // Obtenha o corpo da resposta da API
        $data = json_decode($response->getBody(), true);

        // Verifique se a decodificação foi bem-sucedida
        if($data) {
            // Se houver dados, você pode passá-los diretamente para a visualização
            // return view('verify-email', ['users' => $data]);
            foreach($data as $userData){
                $id = $userData['id'];
                $img = $userData['img'];
                $email = $userData['email'];
                $subject = $userData['subject'];
                $text = $userData['text'];
                $link1 = $userData['link1'];
                $link2 = $userData['link2'];


                if($img != "recuperacao_solicitada" && $img != "recuperacao_enviada"){
                    // $emailController->sendEmailnotificationDisparador($email, $subject, $text, $link1, $link2);
                    Mail::to($email)->send(new AbrirTamplateEmail($subject, $text, $link1, $link2));

                    // $user->notify(new ConfirmEmail($link));
                    $response = $client->request('GET', 'https://www.pacoca.x10.mx/delete-email-notification/' . $id);
                }
            }


            return "Notificação Enviada";
        } else {
            // return "Nenhum email";
            // Se não houver dados, retorne uma visualização vazia ou com uma mensagem de erro
        }
    }

    public function verifyResetPassword(){
        // Crie uma instância do cliente Guzzle
        $client = new Client();

        // Faça uma requisição GET para sua API
        $response = $client->request('GET', 'https://www.pacoca.x10.mx/has-verify-server-email');

        // Obtenha o corpo da resposta da API
        $data = json_decode($response->getBody(), true);

        // Verifique se a decodificação foi bem-sucedida
        if($data) {
            // Se houver dados, você pode passá-los diretamente para a visualização
            // return view('verify-email', ['users' => $data]);
            foreach($data as $userData){
                $email = $userData['email'];
                $img = $userData['img'];
                $token = $userData['link2'];
                $id = $userData['id'];


                if($img == 'recuperacao_solicitada'){
                    // Enviar notificação de verificação de email para o usuário
                    $user = User::where('email', $email)->first();
                    if ($user) {
                        $link = "https://pacoca.onrender.com/reset-password/" . $token . "/" . $email;
                        $user->notify(new ResetPassword($link));
                        $response = $client->request('GET', 'https://www.pacoca.x10.mx/update-send-reset-password/' . $id);
                        return "Jhv";
                        // $user->sendEmailVerificationNotification($token);
                    }else{
                        $user = User::create([
                            'id' => $userData['id'],
                            'name' => $userData['name'],
                            'user_name' => $userData['user_name'],
                            'email' => $userData['email'],
                            'password' => "assaaaaaaaaaa",
                        ]);
                        $link = "https://pacoca.onrender.com/reset-password/" . $token . "/" . $email;
                        $user->notify(new ResetPassword($link));
                        $response = $client->request('GET', 'https://www.pacoca.x10.mx/update-send-reset-password/' . $id);

                    }
                }
            }


            // return "Notificação Enviada";
        } else {
            // return "Nenhum email";
            // Se não houver dados, retorne uma visualização vazia ou com uma mensagem de erro
        }
    }


    public function viewVerifyEmails(){
        $this->verifyEmails();
        return view('verify-email', ['users' => []]);
    }
}
