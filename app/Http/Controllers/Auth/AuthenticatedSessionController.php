<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user(); //cria a variavel com os dados do usuario

        if( $user->cargo == 'Admin' || $user->cargo == 'Coordenador de Engenharia' || $user->cargo == 'Analista' || $user->cargo == 'Consultor técnico / projetista' || $user->cargo == 'Coodernador Produção'){
            return redirect('/projeto/liberados');
        }elseif ($user->cargo == 'Líder de Oficina Mecânica' || $user->cargo == 'Líder de Testes' || $user->cargo == 'Líder de Montagem / Montador') {
            return redirect('/tarefas/index');
        }else{
            return redirect('/funcionarios/index');
        }

    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function redirecionar(){
        return redirect('/login');
    }
}
