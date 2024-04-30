<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class VerifyNumberController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        if ($request->user()->aktif == '1') {
            return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
        }

        $request->validate([
            'otp' => ['required', 'numeric'],
        ]);

        $data = Pengguna::with('otp')->find(auth()->user()->id)->whereHas('otp', function (Builder $query) use ($request) {
            $query->where('otp', $request->otp);
        })->first();

        if (! $data) {
            throw ValidationException::withMessages([
                'otp' => 'Nomor OTP yang dimasukkan tidak terdaftar.',
            ]);
        }

        $data->update([
            'aktif' => '1',
        ]);

        return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
    }
}
