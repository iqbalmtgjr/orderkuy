<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Toko;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\NotifPendaftaranAkun;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\Datatables;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Toko::all();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('foto', function ($row) {
                    if ($row->foto == null) {
                        return '<p style="color:red">Foto Toko Belum Ada</p>';
                    }
                    return '<img class="card-img-top" style="height: 120px; width: 180px; object-fit: cover; object-position: center;" src="assets/img/toko/' . $row->foto . '" alt="foto-toko">';
                })
                // ->addColumn('pemilik', function ($row) {
                //     return $row->user->name;
                // })
                ->addColumn('aksi', function ($row) {
                    $actionBtn = '<button onclick="getdata(' . $row->id . ')" id="' . $row->id . '" class="btn btn-sm btn-clean btn-icon" title="Edit" data-toggle="modal" data-target="#edit"><i class="la la-edit"></i></button>';
                    $actionBtn .= '<button class="btn btn-sm btn-clean btn-icon delete" title="Hapus" data-nama="' . $row->nama_toko . '" data-id="' . $row->id . '"><i class="la la-trash"></i></button>';
                    return $actionBtn;
                })
                ->rawColumns(['foto', 'pemilik', 'aksi'])
                ->make(true);
        }
        return view('super_admin.toko.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_toko' => 'required',
            'status' => 'required',
            'alamat_toko' => 'required',
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
            $request->file('foto')->move(public_path('assets/img/toko/'), $nama_foto);
            $toko = Toko::create([
                'nama_toko' => $request->nama_toko,
                'alamat' => $request->alamat_toko,
                'status' => $request->status,
                'foto' => $nama_foto,
                'operasional' => 0
            ]);
        } else {
            $toko = Toko::create([
                'nama_toko' => $request->nama_toko,
                'status' => $request->status,
                'alamat' => $request->alamat_toko,
                'operasional' => 0
            ]);
        }

        return redirect()->back()->with('sukses', 'Toko Berhasil Diinput!!!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // dd($request->foto);
        $validator = Validator::make($request->all(), [
            //toko
            'nama_toko' => 'required',
            'status' => 'required',
            'alamat_toko' => 'required',
            'foto' => 'required|mimes:jpg,jpeg,png|max:5000'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('gagal', 'Ada Kesalahan Saat Penginputan!');
        }

        $data = Toko::findOrFail($request->id);

        if ($request->file('foto')) {
            // Hapus Foto Lama
            $path = public_path('assets/img/toko/' . $data->foto);
            if (file_exists($path)) {
                @unlink($path);
            }

            $nama_foto = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('foto')->getClientOriginalName());
            // dd($foto);
            $request->file('foto')->move(public_path('assets/img/toko/'), $nama_foto);
            $data->update([
                'nama_toko' => $request->nama_toko,
                'alamat' => $request->alamat_toko,
                'status' => $request->status,
                'foto' => $nama_foto,
            ]);
        } else {
            $data->update($request->except([$request->url_getdata]));
        }



        return redirect()->back()->with('sukses', 'Data toko berhasil update!');
    }

    function changeOperasional(Request $request)
    {
        $data = Toko::find($request->toko_id);
        if ($data->operasional == 1) {
            $data->operasional = 0;
        } else {
            $data->operasional = 1;
        }
        $data->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Toko::findOrFail($id)->delete();
        return redirect()->back()->with('sukses', 'Data Toko Berhasil Dihapus!!!');
    }

    public function getdata($id)
    {
        $data = Toko::find($id);
        return $data;
    }
}
