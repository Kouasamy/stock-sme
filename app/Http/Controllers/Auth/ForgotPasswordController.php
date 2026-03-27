<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\ResetPasswordMail;
// use Illuminate\Foundation\Auth\SendsPasswordResetEmails; // We'll do it manually for better control
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Cet email n\'est pas associé à un compte PME.']);
        }

        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );

        try {
            Mail::to($request->email)->send(new ResetPasswordMail($user, $token));
            return back()->with('success', 'Un lien de réinitialisation a été envoyé à votre adresse email.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de l\'envoie de l\'email : ' . $e->getMessage());
        }
    }
}
