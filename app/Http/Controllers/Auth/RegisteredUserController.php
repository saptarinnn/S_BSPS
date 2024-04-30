<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OTP;
use App\Models\Pengguna;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        DB::beginTransaction();
        try {
            $user = Pengguna::create($request->validate([
                'nama' => ['required', 'string', 'max:70'],
                'no_hp' => ['required', 'numeric', 'max_digits:15', 'unique:'.Pengguna::class],
                'username' => ['required', 'string', 'lowercase', 'max:20', 'unique:'.Pengguna::class],
                'password' => ['required', 'max:150', 'confirmed', Rules\Password::defaults()],
            ]));
            $user->assignRole('customer');

            /* Send OTP to Whatsapp After Registration */
            $curl = curl_init();
            $otp = rand(100000, 999999);
            $time_send = now();
            OTP::create([
                'pengguna_id' => $user->id,
                'otp' => $otp,
                'time_send' => $time_send,
            ]);

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => [
                    'target' => $user->no_hp,
                    'message' => 'Nomor OTP adalah : '.$otp,
                    'countryCode' => '62', //optional
                ],
                CURLOPT_HTTPHEADER => [
                    'Authorization: '.config('constants.TOKEN_API_WA'), //change TOKEN to your actual token
                ],
            ]);

            $response = curl_exec($curl);

            curl_close($curl);

            event(new Registered($user));

            Auth::login($user);
            DB::commit();

            return redirect(route('dashboard', absolute: false));
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
        }

    }
}
