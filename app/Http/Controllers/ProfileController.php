<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Exception;
use App\Uploads;
use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return view('user.profil.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            // 'email' => 'required|max:35|unique:users|email',
            'no_hp' => 'required',
            'tgl_lahir' => 'date',
            'jenis_kelamin' => 'required|max:10',
            'alamat' => 'required',
        ]);

        if ($validator->fails()) {
            toastr()->error('Ada kesalahan saat penginputan data!');
            return redirect('profile')
                ->withErrors($validator)
                ->withInput();
            // ->with('gagal', 'Ada Kesalahan Saat Penginputan!');
        }

        // Retrieve the validated input...
        $validator->validated();


        try {
            $updateUser = User::find(Auth::user()->id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

            $updatePelanggan = Pelanggan::where('user_id', Auth::user()->id)->update([
                'username' => $request->username,
                'no_hp' => $request->no_hp,
                'tgl_lahir' => $request->tgl_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
            ]);
            return redirect('profile')->with('sukses', 'Data Berhasil Disimpan!');
        } catch (Exception $e) {
            return redirect('profile')->with('gagal', $e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password_lama' => ['required', 'min:8'],
            'password_baru' => ['required', 'min:8'],
            'konfirmasi_password' => ['required', 'min:8', 'same:password_baru']
        ]);

        if ($validator->fails()) {
            return redirect('profile')
                ->withErrors($validator)
                ->withInput()
                ->with('gagal', 'Ada Kesalahan Saat Penginputan!');
        }

        $currentPasswordStatus = Hash::check($request->password_lama, auth()->user()->password);
        if ($currentPasswordStatus) {

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password_baru),
            ]);

            return redirect()->back()->with('sukses', 'Password Berhasil Diubah!');
        } else {
            return redirect()->back()->with('gagal', 'Password Tidak Sama Dengan Password Lama!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function updateAvatar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'avatar' => 'required|mimes:jpg,jpeg,png|max:5000'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('gagal', 'Ada Kesalahan Saat Penginputan!');
        }

        // Hapus Avatar Lama
        $path = public_path('assets/img/profile/' . Auth::user()->avatar);
        if (file_exists($path)) {
            @unlink($path);
        }

        $avatar = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('avatar')->getClientOriginalName());
        $request->file('avatar')->move(public_path('assets/img/profile/'), $avatar);
        User::findOrFail(Auth::user()->id)->update(['avatar' => $avatar]);

        return redirect()->back()->with('sukses', 'Berhasil Ganti Foto Profile');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
