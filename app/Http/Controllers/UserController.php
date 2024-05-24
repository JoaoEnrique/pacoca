<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Post;
use App\Models\Follower;
use App\Models\Notification;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Support\Str;

class UserController extends Controller
{
    use VerifiesEmails;


    // CREATE
    public function store(Request $request){

        try{
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'user_name' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'password_confirmation' => ['required', 'string', 'min:8'],
            ]);

            $dados = $request->only(['name', 'user_name', 'email', 'phone', 'password', 'site', 'biography', 'sexo', 'birth_date']);
            $dados['password'] = Hash::make($dados['password']);
            $dados_login = $request->only(['email', 'password']);


            $new_user = User::create($dados);
            $this->setNotification($new_user->id, '../img/pacoca-fundo.png', 'Seja bem vindo ao Paçoca, sua nova rede social', '/pacoca', '/pacoca');

            if (Auth::attempt($dados_login, 1)) {
                $request->session()->regenerate();

                return redirect('/verify-email');
            }
            return redirect()->route('login')->with('conta-create-success', 'Conta criada com sucesso');

        } catch (Exception $e){
            return redirect()->route('login')->with('conta-create-danger', 'Erro ao criar conta');
        }
    }

    public function login(Request $request){
        $dados = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($dados, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('');
        }

        return back()->withErrors([
            'password' => 'O email e/ou senha são invalidos'
        ])->withInput();
    }

    public function account($user_name){
        $user = User::where('user_name', $user_name)
            ->get()
            ->first();

        if($user){
            $posts = User::join('posts', 'users.id', '=', 'posts.id_user')
                ->select('users.*', 'posts.*')
                ->where('id_user', $user->id)
                ->orderByDesc('posts.id')
                ->get();

            return view('user.account', ['user' => $user, 'posts' => $posts]);
        }else{
            return view('errors.404');
        }
    }

    // SAIR DA CONTA
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function search(){

        if(isset($_GET['search'])){
            $users = User::where('name', 'like', '%'. $_GET['search'] . '%')
                ->orWhere('phone', 'like', '%'. $_GET['search'] . '%')
                ->orWhere('user_name', 'like', '%'. $_GET['search'] . '%')
            ->get();
        }else{
            return view('user.search_mobile');
        }
        return view('user.search', ['users' => $users]);
    }

    // Função pra seguir
    public function follow_user(Request $request){
        // Verifica se usuário já está seguindo
        $usuario_seguido = Follower::where('id_user', auth()->user()->id)
            ->where('id_following', $request->id_user)
            ->first();
        $user = User::where('id', $request->id_user)->first();

        // Caso seteja seguindo, deixa de seguir
        if($usuario_seguido){
            // Deixa de seguir
            $usuario_seguido->delete();
            return response()->json(['message' => 'unfollow']);
        }else{
            // Salva no banco
            Follower::create([
                'id_user' => auth()->user()->id,
                'id_following' =>$request->id_user
            ]);

            // NOTIFICAÇÃO
            $id_user = $request->id_user;

            if(auth()->user()->img_account){
                $img = auth()->user()->img_account;
            }else{
                $img = 'img/img-account.png';
            }

            $text = auth()->user()->name . " começou a te seguir";
            $link1 = "/" . auth()->user()->user_name;
            $link2 = "https://www.pacoca.x10.mx/" . auth()->user()->user_name;


            $caractereParaRemover = "../";
            $img_account = str_replace($caractereParaRemover, '', $img);


            if(auth()->user()->id != $user->id){
                $this->setNotification($id_user, $img, $text, $link1, $link2);

                return response()->json(
                    [
                        'message' => 'follow',
                        'email_notification' => $user->email,
                        'subject' => $text,
                        'text' =>   "",
                        'link1' => $img_account,
                        'link2' =>  $link2,
                    ]
                );
            }


            return response()->json(['message' => 'follow']);
        }

    }

    // Pega todos os seguidores de um usuário
    public function getFollowers($id_user){
        $followers = Follower::where('id_following', $id_user)->get();

        return $followers;
    }

    // Pega todos que um usuario esta seguindo
    public function getFollowing($id_user){
        $following = Follower::where('id_user', $id_user)->get()->count();

        return $following;
    }

    // Verifica se usuario logado está seguindo outro usuário
    public function is_following($id_user){
        $usuario_seguido = 0;
        if(auth()->check()){
            $usuario_seguido = Follower::where('id_user', auth()->user()->id)
                ->where('id_following', $id_user)
                ->get()
                ->count();
        }

            return $usuario_seguido;
    }

    public function editInfo(Request $request){
        try{
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'user_name' => ['required', 'string', 'max:255', Rule::unique('users')->ignore(auth()->id())],
                // 'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(auth()->id())],
                'phone' => ['required', 'string', 'max:255'],
                // 'password' => ['required', 'string', 'min:8', 'confirmed'],
                // 'password_confirmation' => ['required', 'string', 'min:8'],
                'site' => ['max:255'],
                'biography' => ['max:255'],
                'sexo' => ['max:255'],
                'birth_date' => ['required', 'date']
            ]);

            $user = User::where('id', $request->id_user)->get()->first();

            $user->update([
                'name' => $request->name,
                'user_name' => $request->user_name,
                // 'email' => $request->email,
                'phone' => $request->phone,
                // 'password' => Hash::make($request->password),
                'site' => $request->site,
                'biography' => $request->biography,
                'sexo' => $request->sexo,
                'birth_date' => $request->birth_date,
            ]);


            return redirect('/' . $request->user_name)->with('success', 'Dados editados com sucesso');
        }

        catch(Exception $e){
            return redirect()->route('account')->with('danger', 'Não foi possível editar conta');
        }
    }

    public function editEmail(Request $request){
        try{

            if(!auth()->chech()){
                $request->validate([
                    'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(auth()->id())],
                ]);

                $user = User::find($request->id_user);

                // senha atual igual a nova
                if($request->email == $user->email){
                    return redirect()->back()->withErrors(['email' => 'O email atual não pode ser igual ao novo.'])->withInput();
                }
            }else{
                $user = auth()->user();
            }

            $user->email = $request->email;
            $user->email_verified_at = null;
            $user->save();

            return redirect('/verify-email')->with('success', 'Conta editada com sucesso');
        }

        catch(Exception $e){
            return redirect()->route('account')->with('danger', 'Não foi possível editar conta');
        }
    }

    public function editPassword(Request $request){
        try{
            $request->validate([
                'old_password' => ['required'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'password_confirmation' => ['required', 'string', 'min:8'],
            ]);

            $user = User::find($request->id_user);

            // Senha atual errada
            if(!Hash::check($request->old_password, $user->password)){
                return redirect()->back()->withErrors(['old_password' => 'A senha atual está incorreta.'])->withInput();
            }

            // senha atual igual a nova
            if($request->old_password == $request->password){
                return redirect()->back()->withErrors(['password' => 'A nova senha não pode ser igual a atual.'])->withInput();
            }

            $user->update([
                'password' => Hash::make($request->password)
            ]);

            return redirect('/' . $request->user_name)->with('success', 'Conta editada com sucesso');
        }

        catch(Exception $e){
            return redirect()->route('account')->with('danger', 'Não foi possível editar conta');
        }
    }

    // Edita imagem da conta
    public function edit_image(Request $request){

        $request->validate([
            'img' => ['required']
        ]);

        $user = User::find(auth()->user()->id);

        // CASO TENHA IMAGEM NO POST
        if($request->hasFile('img') ){
            if($request->file('img')->isValid()){
                $img = $request->img;
                $extension = $img->extension();
                $imgName = auth()->user()->id . ".png";
                $path = public_path('img/img_account');

                $request->img->move($path, $imgName);

                $user->update([
                    'img' => "../img/img_account/" . $imgName,
                ]);

                return redirect('/' . auth()->user()->user_name)->with('success', 'Imagem alterada com sucesso!');
            }else{
                return redirect('/' . auth()->user()->user_name)->with('danger', 'Não foi possível alterar imagem!');
            }
        }

        echo $request->img;
    }

    public function getUserById($id){
        $user = User::find($id);
        return $user;
    }

    public function getUserByUserName($user_name){
        $user = User::where('user_name', $user_name)->get()->first();
        return $user;
    }


    public function searchByUsername($username) {
        $users = User::where('user_name', 'like', "%$username%")->pluck('user_name');
        return response()->json(['usernames' => $users]);
    }


    public function dateDifference($date){
        $date = strtotime($date);
        $data_atual = time();
        $diferencaSegundos = $data_atual - $date;

        if ($diferencaSegundos < 60) {
            $tempo =  'há menos de um minuto';
        } elseif ($diferencaSegundos < 3600) {
            $minutos = floor($diferencaSegundos / 60);
            $tempo =  'há ' . $minutos . ' minuto(s)';
        } elseif ($diferencaSegundos < 86400) {
            $horas = floor($diferencaSegundos / 3600);
            $tempo =  'há ' . $horas . ' hora(s)';
        } elseif ($diferencaSegundos < 604800) { // Uma semana possui 604800 segundos
            $dias = floor($diferencaSegundos / 86400);
            if ($dias == 1) {
                $tempo =  'ontem';
            } else {
                $tempo =  'há ' . $dias . ' dia(s)';
            }
        } else {
            $tempo = date('d/m/Y', $date); // Retorna a data formatada se a diferença for maior que uma semana
        }

        return $tempo;

    }

    public function setNotification($id_user, $img_notification, $text, $link1, $link2){
        // $id_user, $text, $link1, $link2, $read
        $read = 0;
        $opened = 0;

        $notifications = Notification::create([
            'id_user' => $id_user,
            'img_notification' => $img_notification,
            'text' => $text,
            'link1' => $link1,
            'link2' => $link2,
            'opened' => 0,
            'read' => $read,
        ]);

        return $notifications;
    }

    public function resetPasswordEmail(Request $request){
        try{
            $request->validate([
                'email' => ['required', 'string', 'max:255']
            ]);

            $user = User::where('email', $request->email)->first();

            if(!$user)
                return redirect()->back()->with('danger', 'Email nao cadastrado')->withInput();

                $token = Str::random(60);
                $user->reset_password_token = $token;
                $user->save();


                // Variáveis para serem passadas
                $titulo = 'Redefinir senha';
                $link = 'https://www.pacoca.x10.mx/reset-password?email=' . $user->email . 'token=' . $token;
                $texto = 'Clique no link abaixo para redefinir senha';
                $to = $user->email;

                $url = 'https://crud-odontologia.000webhostapp.com/email?' .
                    'titulo=' . urlencode(utf8_encode($titulo)) .
                    '&link=' . urlencode(utf8_encode($link)) .
                    '&texto=' . urlencode(utf8_encode($texto)) .
                    '&to=' . urlencode(utf8_encode($to));

                $response = file_get_contents($url);



            return redirect()->back()->with('sucess', 'Link de redefinicao enviado para seu email');

        } catch (Exception $e){
            return redirect()->back()->with('danger', 'Erro ao redefinir email');
        }
    }

    public function resetPasswordForm($email, $token){
        try{
            $user = User::where('email', $email)->first();

            if(!$user)
                return redirect()->back()->with('danger', 'Email nao cadastrado')->withInput();

            if($user->reset_password_token == $token){
                return view('auth.passwords.reset', ['token' => $token, 'email' => $email]);
            }

            return redirect()->back()->with('danger', 'Link errado');

        } catch (Exception $e){
            return redirect()->back()->with('danger', 'Erro ao redefinir email');
        }
    }

    public function tagUser($username){
    // Encontre o usuário alvo pelo username
    $usuarioAlvo = User::where('username', $username)->first();

    if ($usuarioAlvo) {
        // Lógica para associar a marcação ao usuário alvo
        // (Isso pode envolver adicionar uma entrada a uma tabela pivot ou similar)
        // Exemplo: $usuarioLogado->marcacoes()->attach($usuarioAlvo);

        return response()->json(['message' => 'Usuário marcado com sucesso.']);
    } else {
        return response()->json(['message' => 'Usuário não encontrado.'], 404);
    }
}
}
