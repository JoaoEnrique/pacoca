<?php

namespace App\Http\Controllers;
use App\Models\Visita;
use Illuminate\Support\Facades\Session;


class VisitasController extends Controller
{
    public function gerenciarVisita()
    {
        // date_default_timezone_set('America/Sao_Paulo');

        // $dataOnlineInicio = now()->subSeconds(6);

        // $visita = Visita::firstOrNew(['id' => Session::get('id_visitante')]);

        // if ($visita->exists) {
        //     // Editar usuário online
        //     $visita->update(['data_final' => now()]);
        // } else {
        //     // Cadastrar usuário online
        //     $novoVisita = Visita::create([
        //         'data_inicio' => now(),
        //         'data_final' => now(),
        //     ]);

        //     Session::put('id_visitante', $novoVisita->id);
        // }

        // // Recuperar usuários online
        // $qtdUsuarioOnline = Visita::where('data_final', '>=', $dataOnlineInicio)->count();

        // // Retornar dados para o JavaScript
        // $retorno = [
        //     'status' => true,
        //     'qtd_usuarios' => $qtdUsuarioOnline,
        //     'data_atual' => now(),
        // ];

        // return response()->json($retorno);

        return view('errors.500');
    }
}
