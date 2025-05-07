<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\URL;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request, $id, $hash): RedirectResponse
    {
        // Validate the signature of the email verification link
        if (! URL::hasValidSignature($request)) {
            abort(401); // or a custom response if needed
        }

        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(config('app.frontend_url').'/dashboard?verified=1');
        }

        // Mark the user's email as verified
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(config('app.frontend_url').'/dashboard?verified=1');
    }
}
