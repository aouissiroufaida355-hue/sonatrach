<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController
{
    // Afficher la page login
    public function showLogin()
    {
        return view('login');
    }

    // Connexion AJAX
    public function login(Request $request)
    {
        $request->validate([
            'nom_utilisateur' => 'required',
            'mot_de_passe'    => 'required',
            'role'            => 'required|in:encadrant,grh',
        ]);

        $user = DB::table('users')
            ->where('nom_utilisateur', $request->nom_utilisateur)
            ->where('role', $request->role)
            ->first();

        if ($user && hash('sha256', $request->mot_de_passe) === $user->mot_de_passe) {
            session(['user' => $user]);
            return response()->json([
                'success'  => true,
                'message'  => 'Connexion réussie !',
                'role'     => $user->role,
                'redirect' => $user->role === 'encadrant'
                                ? '/encadrant/sujets'
                                : '/grh/dashboard',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Identifiants incorrects.',
        ], 401);
    }

    // Déconnexion
    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
