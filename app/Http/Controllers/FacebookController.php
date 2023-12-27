<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\NotifPendaftaranAkun;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $userFacebook = Socialite::driver('facebook')->user();
            $finduser = User::where('facebook_id', $userFacebook->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                return redirect()->intended('home')->with('sukses', 'Selamat Anda Berhasil Login !!!');
            } else {
                $make_password = Str::random(8);
                $user = User::updateOrCreate(['email' => $userFacebook->email], [
                    'role' => 'user',
                    'name' => $userFacebook->getName(),
                    'facebook_id' => $userFacebook->getId(),
                    'avatar' => $userFacebook->getAvatar(),
                    'password' => Hash::make($make_password)
                ]);

                $newPelanggan = Pelanggan::create(['user_id' => $user->id]);
                Mail::to($user->email)->send(new NotifPendaftaranAkun($user, $make_password));
                Auth::login($user);

                return redirect()->intended('home')->with('sukses', 'Selamat Anda Berhasil Login !!!');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
