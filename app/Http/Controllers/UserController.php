<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\User;
use App\Models\Admin;
use App\Models\Dapur;
use App\Models\Kasir;
use App\Models\Pelanggan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\NotifPendaftaranAkun;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = User::where('role', '!=', 'super_admin')->get();
        $toko = Toko::all();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('alamat', function ($row) {
                    if ($row->role == 'user') {
                        return $row->pelanggan->alamat;
                    } elseif ($row->role == 'admin') {
                        return $row->admin->alamat;
                    } elseif ($row->role == 'dapur') {
                        return $row->dapur->alamat;
                    } else {
                        return $row->kasir->alamat;
                    }
                })
                ->addColumn('no_hp', function ($row) {
                    if ($row->role == 'user') {
                        return $row->pelanggan->no_hp;
                    } elseif ($row->role == 'admin') {
                        return $row->admin->no_hp;
                    } elseif ($row->role == 'dapur') {
                        return $row->dapur->no_hp;
                    } else {
                        return $row->kasir->no_hp;
                    }
                })
                ->addColumn('aksi', function ($row) {
                    $actionBtn = '<button onclick="getdata(' . $row->id . ')" id="' . $row->id . '" class="btn btn-sm btn-clean btn-icon" title="Edit" data-toggle="modal" data-target="#edit"><i class="la la-edit"></i></button>';
                    $actionBtn .= '<button class="btn btn-sm btn-clean btn-icon delete" title="Hapus" data-nama="' . $row->name . '" data-id="' . $row->id . '"><i class="la la-trash"></i></button>';
                    return $actionBtn;
                })
                ->rawColumns(['no_hp', 'alamat', 'aksi'])
                ->make(true);
        }
        return view('super_admin.user.index', compact('toko'));
    }

    function indexx()
    {
        $data = User::where('role', '!=', 'super_admin')->get();
        return view('super_admin.user.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->role == 'user') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:50',
                'username' => 'required|max:50',
                'email' => 'required|max:35|unique:users|email',
                'no_hp' => 'required',
                'jenis_kelamin' => 'required',
                'alamat' => 'required',
                'role' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:50',
                'username' => 'required|max:50',
                'email' => 'required|max:35|unique:users|email',
                'no_hp' => 'required',
                'jenis_kelamin' => 'required',
                'alamat' => 'required',
                'role' => 'required',
                'toko' => 'required',
            ]);
        }

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('gagal', 'Ada Kesalahan Saat Penginputan!');
        }

        if ($request->role == 'admin') {
            //create_users
            $user = new User;
            $user->role = $request->role;
            $user->name = $request->name;
            $user->email = $request->email;
            // $make_password = Str::random(8);
            $make_password = 'qweasdzxc123';
            $user->password = Hash::make($make_password);
            $user->save();

            //create_admin
            $admin = new Admin;
            $admin->user_id = $user->id;
            $admin->no_hp = $request->no_hp;
            $admin->alamat = $request->alamat;
            $admin->username = $request->username;
            $admin->toko_id = $request->toko;
            $admin->save();
        } elseif ($request->role == 'user') {
            //create_users
            $user = new User;
            $user->role = $request->role;
            $user->name = $request->name;
            $user->email = $request->email;
            // $make_password = Str::random(8);
            $make_password = 'qweasdzxc123';
            $user->password = Hash::make($make_password);
            $user->save();

            //create_pelanggan
            $pelanggan = new Pelanggan;
            $pelanggan->user_id = $user->id;
            $pelanggan->no_hp = $request->no_hp;
            $pelanggan->alamat = $request->alamat;
            $pelanggan->username = $request->username;
            $pelanggan->save();
        } elseif ($request->role == 'kasir') {
            //create_users
            $user = new User;
            $user->role = $request->role;
            $user->name = $request->name;
            $user->email = $request->email;
            // $make_password = Str::random(8);
            $make_password = 'qweasdzxc123';
            $user->password = Hash::make($make_password);
            $user->save();

            //create_kasir
            $kasir = new Kasir;
            $kasir->user_id = $user->id;
            $kasir->no_hp = $request->no_hp;
            $kasir->alamat = $request->alamat;
            $kasir->username = $request->username;
            $kasir->toko_id = $request->toko;
            $kasir->save();
        } else {
            //create_users
            $user = new User;
            $user->role = $request->role;
            $user->name = $request->name;
            $user->email = $request->email;
            // $make_password = Str::random(8);
            $make_password = 'qweasdzxc123';
            $user->password = Hash::make($make_password);
            $user->save();

            //create_dapur
            $dapur = new Dapur;
            $dapur->user_id = $user->id;
            $dapur->no_hp = $request->no_hp;
            $dapur->alamat = $request->alamat;
            $dapur->username = $request->username;
            $dapur->toko_id = $request->toko;
            $dapur->save();
        }

        Mail::to($user->email)->send(new NotifPendaftaranAkun($user, $make_password));

        return redirect()->back()->with('sukses', 'User Berhasil Diinput!!!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'username' => 'required|max:50',
            // 'email' => 'required|max:35|unique:users|email',
            'no_hp' => 'required',
            'alamat' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('gagal', 'Ada Kesalahan Saat Penginputan!');
        }

        //update_user
        $user = User::findOrFail($request->id);
        //kalau role nya ganti
        if ($request->role != $user->role) {
            // $update_user = $user->update([
            //     'name' => $request->name,
            //     'email' => $request->email,
            //     'role' => $request->role,
            // ]);

            if ($request->role == 'kasir' && $user->role == 'admin') {
                // dd('Role Sekarang Ini Adalah admin dan request rolenya kasir');
                $admin = Admin::where('user_id', $request->id)->delete();
                $kasir = Kasir::create([
                    'user_id' => $request->id,
                    'username' => $request->username,
                    'no_hp' => $request->no_hp,
                    'alamat' => $request->alamat,
                ]);
            } elseif ($request->role == 'dapur' && $user->role == 'admin') {
                // dd('Role Sekarang Ini Adalah admin dan request rolenya dapur');
                $admin = Admin::where('user_id', $request->id)->delete();
                $dapur = Dapur::create([
                    'user_id' => $request->id,
                    'username' => $request->username,
                    'no_hp' => $request->no_hp,
                    'alamat' => $request->alamat,
                ]);
            } elseif ($request->role == 'user' && $user->role == 'admin') {
                // dd('Role Sekarang Ini Adalah admin dan request rolenya user');
                $admin = Admin::where('user_id', $request->id)->delete();
                $pelanggan = Pelanggan::create([
                    'user_id' => $request->id,
                    'username' => $request->username,
                    'no_hp' => $request->no_hp,
                    'alamat' => $request->alamat,
                ]);
            }
            //batas_admin
            elseif ($request->role == 'admin' && $user->role == 'kasir') {
                // dd('Role Sekarang Ini Adalah kasir dan request rolenya admin');
                $kasir = Kasir::where('user_id', $request->id)->delete();
                $admin = Admin::create([
                    'user_id' => $request->id,
                    'username' => $request->username,
                    'no_hp' => $request->no_hp,
                    'alamat' => $request->alamat,
                ]);
            } elseif ($request->role == 'dapur' && $user->role == 'kasir') {
                // dd('Role Sekarang Ini Adalah kasir dan request rolenya dapur');
                $kasir = Kasir::where('user_id', $request->id)->delete();
                $dapur = Dapur::create([
                    'user_id' => $request->id,
                    'username' => $request->username,
                    'no_hp' => $request->no_hp,
                    'alamat' => $request->alamat,
                ]);
            } elseif ($request->role == 'user' && $user->role == 'kasir') {
                // dd('Role Sekarang Ini Adalah kasir dan request rolenya user');
                $kasir = Kasir::where('user_id', $request->id)->delete();
                $pelanggan = Pelanggan::create([
                    'user_id' => $request->id,
                    'username' => $request->username,
                    'no_hp' => $request->no_hp,
                    'alamat' => $request->alamat,
                ]);
            }
            //batas_kasir
            elseif ($request->role == 'admin' && $user->role == 'dapur') {
                // dd('Role Sekarang Ini Adalah dapur dan request rolenya admin');
                $dapur = Dapur::where('user_id', $request->id)->delete();
                $admin = Admin::create([
                    'user_id' => $request->id,
                    'username' => $request->username,
                    'no_hp' => $request->no_hp,
                    'alamat' => $request->alamat,
                ]);
            } elseif ($request->role == 'kasir' && $user->role == 'dapur') {
                // dd('Role Sekarang Ini Adalah dapur dan request rolenya kasir');
                $dapur = Dapur::where('user_id', $request->id)->delete();
                $kasir = Kasir::create([
                    'user_id' => $request->id,
                    'username' => $request->username,
                    'no_hp' => $request->no_hp,
                    'alamat' => $request->alamat,
                ]);
            } elseif ($request->role == 'user' && $user->role == 'dapur') {
                // dd('Role Sekarang Ini Adalah dapur dan request rolenya user');
                $dapur = Dapur::where('user_id', $request->id)->delete();
                $pelanggan = Pelanggan::create([
                    'user_id' => $request->id,
                    'username' => $request->username,
                    'no_hp' => $request->no_hp,
                    'alamat' => $request->alamat,
                ]);
            }
            //batas_dapur
            elseif ($request->role == 'admin' && $user->role == 'user') {
                // dd('Role Sekarang Ini Adalah user dan request rolenya admin');
                $pelanggan = Pelanggan::where('user_id', $request->id)->delete();
                $admin = Admin::create([
                    'user_id' => $request->id,
                    'username' => $request->username,
                    'no_hp' => $request->no_hp,
                    'alamat' => $request->alamat,
                ]);
            } elseif ($request->role == 'kasir' && $user->role == 'user') {
                // dd('Role Sekarang Ini Adalah user dan request rolenya kasir');
                $pelanggan = Pelanggan::where('user_id', $request->id)->delete();
                $kasir = Kasir::create([
                    'user_id' => $request->id,
                    'username' => $request->username,
                    'no_hp' => $request->no_hp,
                    'alamat' => $request->alamat,
                ]);
            } else {
                // dd('Role Sekarang Ini Adalah user dan request rolenya dapur');
                $pelanggan = Pelanggan::where('user_id', $request->id)->delete();
                $dapur = Dapur::create([
                    'user_id' => $request->id,
                    'username' => $request->username,
                    'no_hp' => $request->no_hp,
                    'alamat' => $request->alamat,
                ]);
            }
        }


        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        if ($request->role == 'admin') {
            $admin = Admin::where('user_id', $request->id)->update([
                'username' => $request->username,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]);
        } elseif ($request->role == 'kasir') {
            $kasir = Kasir::where('user_id', $request->id)->update([
                'username' => $request->username,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]);
        } elseif ($request->role == 'dapur') {
            $dapur = Dapur::where('user_id', $request->id)->update([
                'username' => $request->username,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]);
        } else {
            $pelanggan = Pelanggan::where('user_id', $request->id)->update([
                'username' => $request->username,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]);
        }

        return redirect()->back()->with('sukses', 'User Berhasil Diedit!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cari_role = User::find($id)->role;
        $data = User::findOrFail($id)->delete();
        if ($cari_role == 'admin') {
            $admin = Admin::where('user_id', $id)->delete();
        } elseif ($cari_role == 'kasir') {
            $kasir = Kasir::where('user_id', $id)->delete();
        } elseif ($cari_role == 'dapur') {
            $dapur = Dapur::where('user_id', $id)->delete();
        } else {
            $pelanggan = Pelanggan::where('user_id', $id)->delete();
        }

        return redirect()->back()->with('sukses', 'Data User Berhasil Dihapus!!!');
    }

    public function getdata($id)
    {
        $data = User::find($id);
        $data->pelanggan;
        $data->admin;
        $data->kasir;
        $data->dapur;
        return $data;
    }
}
