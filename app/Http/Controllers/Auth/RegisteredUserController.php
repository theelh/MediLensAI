<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:patient,doctor'],
            'certificate' => ['nullable', 'file', 'mimes:pdf,jpg,png', 'max:2048'],
        ]);

        $certificatePath = null;

    if ($request->role === 'doctor' && $request->hasFile('certificate')) {
        $certificatePath = $request->file('certificate')->store('certificates', 'public');
    }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'doctor_certificate' => $certificatePath,
            'is_verified_doctor' => false, // par défaut pas validé
        ]);

        event(new Registered($user));

        // ⚡ Gestion spécifique selon le rôle
        if ($request->role === 'doctor') {
            // Ne pas connecter l'utilisateur, juste afficher le message
            return redirect()->route('welcome')->with('status', 'Thank you for your registration. We will respond to you as soon as possible.');
        } else {
            // Pour les patients, connexion directe
            Auth::login($user);
            return redirect()->route('dashboard');
        }
    }
}
