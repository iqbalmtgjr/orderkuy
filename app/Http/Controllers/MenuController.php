<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Menu::all();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('foto', function ($row) {
                    if ($row->foto == null) {
                        return '<p style="color:red">Foto Menu Belum Ada</p>';
                    }
                    return '<img class="card-img-top" style="height: 120px; width: 180px; object-fit: cover; object-position: center;" src="assets/img/menu/' . $row->foto . '" alt="foto-menu">';
                })
                ->addColumn('aksi', function ($row) {
                    $actionBtn = '<button onclick="getdata(' . $row->id . ')" id="' . $row->id . '" class="btn btn-sm btn-clean btn-icon" title="Edit" data-toggle="modal" data-target="#edit"><i class="la la-edit"></i></button>';
                    $actionBtn .= '<button class="btn btn-sm btn-clean btn-icon delete" title="Hapus" data-nama="' . $row->nama_produk . '" data-id="' . $row->id . '"><i class="la la-trash"></i></button>';
                    return $actionBtn;
                })
                ->rawColumns(['foto', 'aksi'])
                ->toJson();
        }
        return view('dapur.menu.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|max:50',
            'kategori' => 'required|max:50',
            'harga' => 'alpha_num|required',
            'qty' => 'alpha_num|required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('gagal', 'Ada Kesalahan Saat Penginputan!');
        }

        if ($request->file('foto')) {
            $nama_foto = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('foto')->getClientOriginalName());
            $request->file('foto')->move(public_path('assets/img/menu/'), $nama_foto);
            Menu::create([
                'toko_id' => $request->daftar_resto_id,
                'nama_produk' => $request->nama_produk,
                'kategori' => $request->kategori,
                'harga' => $request->harga,
                'qty' => $request->qty,
                'estimasi' => 0,
                'foto' => $nama_foto,
            ]);
        } else {
            Menu::create([
                'toko_id' => $request->daftar_resto_id,
                'nama_produk' => $request->nama_produk,
                'kategori' => $request->kategori,
                'harga' => $request->harga,
                'estimasi' => 0,
                'qty' => $request->qty,
            ]);
        }

        return redirect()->back()->with('sukses', 'Input menu berhasil!!!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|max:50',
            'kategori' => 'required|max:50',
            'harga' => 'alpha_num|required',
            'qty' => 'alpha_num|required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('gagal', 'Ada Kesalahan Saat Penginputan!');
        }

        $data = Menu::findOrFail($request->id);
        if ($request->file('foto')) {
            $nama_foto = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('foto')->getClientOriginalName());
            $request->file('foto')->move(public_path('assets/img/menu/'), $nama_foto);
            $data->update([
                'nama_produk' => $request->nama_produk,
                'kategori' => $request->kategori,
                'harga' => $request->harga,
                'qty' => $request->qty,
                'foto' => $nama_foto,
            ]);
        } else {
            $data->update($request->except([$request->url_getdata]));
        }

        return redirect()->back()->with('sukses', 'Data menu berhasil diupdate!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Menu::findOrFail($id)->delete();
        return redirect()->back()->with('sukses', 'Menu Berhasil Dihapus!!!');
    }

    public function getdata($id)
    {
        $data = Menu::find($id);
        return $data;
    }
}
