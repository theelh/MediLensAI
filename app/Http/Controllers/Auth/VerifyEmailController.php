<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
{
    $user = $request->user();

    // Si l'email est déjà vérifié
    if ($user->hasVerifiedEmail()) {
        return redirect()->intended($this->redirectByRole($user) . '?verified=1');
    }

    $route = match ($user->role) {
        'doctor' => route('doctor.dashboard'),
        'admin' => route('admin.dashboard'),
        default => route('dashboard'),
    };
    
    // Marquer l'email comme vérifié
    if ($user->markEmailAsVerified()) {
        event(new Verified($user));
    }

    return redirect()->to($route . '?verified=1');
}

/**
 * Retourne la route de redirection selon le rôle
 */
protected function redirectByRole($user): string
{
    return match ($user->role) {
        'doctor' => route('doctor.dashboard'),
        'admin' => route('admin.dashboard'),
        default => route('dashboard'),
    };
}
}
