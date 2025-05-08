<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cargo' => $request->cargo, //adiciona a coluna de cargo
            'nivel_acesso' => $request->nivel_acesso,//adiciona a coluna de nivel de acesso
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);
      
        if ($user->cargo == 'Coordenador de Engenharia') {
            return redirect('/projeto/liberados');
        }elseif ($user->cargo == 'Coodernador Produção'){
            return redirect('/projeto/liberados');
        }elseif ($user->cargo == 'Líder de Oficina mecânica' || $user->cargo == 'Líder de Testes' || $user->cargo == 'Líder de Montagem / Montador') {
            return redirect('/tarefas/index');
        }else{
            return redirect('/funcionarios/index');
        }

        return redirect()->intended(RouteServiceProvider::HOME);

    }
}
