<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Toko;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('isLogin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $toko = Toko::all();
        return view('home', compact('toko'));
    }

    public function index2()
    {
        return view('super_admin/dashboard');
    }

    public function menu($id)
    {
        $toko = Menu::where('toko_id', $id)->first();
        $menu = Menu::where('toko_id', $id)->get();
        $makanan = Menu::where('toko_id', $id)->where('kategori', 'makanan')->get();
        $minuman = Menu::where('toko_id', $id)->where('kategori', 'minuman')->get();
        $snack = Menu::where('toko_id', $id)->where('kategori', 'snack')->get();
        if (empty($toko)) {
            return redirect()->back()->with('peringatan', 'Belum Ada Menu!');
        }
        return view('user.menu.index', compact('toko', 'menu', 'makanan', 'minuman', 'snack'));
    }
}
