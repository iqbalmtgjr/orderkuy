<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Support\Facades\Validator;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Order::where('toko_id', auth()->user()->admin->toko->id)
            ->whereDate('created_at', now()->toDateString())
            ->get()
            ->groupBy('user_id');
        // dd($data);
        // if ($request->ajax()) {
        //     return Datatables::of($data)
        //         ->addIndexColumn()
        //         // ->addColumn('no_meja', function ($row) {
        //         //     return 'Meja Nomor ' . $row->no_meja;
        //         // })
        //         ->addColumn('aksi', function ($row) {
        //             $actionBtn = '<button onclick="getdata(' . $row->id . ')" id="' . $row->id . '" class="btn btn-sm btn-clean btn-icon" title="Edit" data-toggle="modal" data-target="#edit"><i class="la la-edit"></i></button>';
        //             $actionBtn .= '<button class="btn btn-sm btn-clean btn-icon delete" title="Hapus" data-nama="' . $row->no_meja . '" data-id="' . $row->id . '"><i class="la la-trash"></i></button>';
        //             return $actionBtn;
        //         })
        //         ->rawColumns(['aksi'])
        //         ->make(true);
        // }
        return view('admin.pesanan.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_meja' => 'required|unique:meja',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('gagal', 'Ada Kesalahan Saat Penginputan!');
        }

        Order::create([
            'toko_id' => auth()->user()->admin->toko_id,
            'no_meja' => $request->no_meja,
        ]);
        return redirect()->back()->with('sukses', 'Data Berhasil Diinput!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_meja' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('gagal', 'Ada Kesalahan Saat Penginputan!');
        }

        $data = Order::find($request->id);
        $data->update([
            'no_meja' => $request->no_meja,
        ]);
        return redirect()->back()->with('sukses', 'Data Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Order::find($id)->delete();
        return redirect()->back()->with('sukses', 'Data Berhasil Dihapus!');
    }

    public function getdata($id)
    {
        $data = Order::find($id);
        return $data;
    }
}
