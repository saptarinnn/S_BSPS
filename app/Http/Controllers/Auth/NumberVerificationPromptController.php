<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NumberVerificationPromptController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        return $request->user()->aktif == '1'
                     ? redirect()->intended(route('dashboard', absolute: false))
                     : view('auth.verify-number');
    }
}
