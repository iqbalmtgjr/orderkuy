<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Menu;
use App\Models\Bill;
use App\Models\Meja;
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
        $data = Order::with('carts.menu', 'bill') // <- tambahkan eager load relasi
            ->where('toko_id', auth()->user()->admin->toko->id)
            ->whereDate('created_at', now()->toDateString())
            ->get()
            ->groupBy('user_id');

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('tanggal_transaksi', function ($row) {
                    return date('Y-m-d H:i', strtotime($row->created_at));
                })
                ->addColumn('aksi', function ($row) {
                    $actionBtn = '<button onclick="getdata(' . $row->id . ')" id="' . $row->id . '" class="btn btn-sm btn-clean btn-icon" title="Edit" data-toggle="modal" data-target="#edit"><i class="la la-edit"></i></button>';
                    $actionBtn .= '<button class="btn btn-sm btn-clean btn-icon delete" title="Hapus" data-nama="' . $row->no_meja . '" data-id="' . $row->id . '"><i class="la la-trash"></i></button>';
                    return $actionBtn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('admin.pesanan.index', compact('data'));
    }

    // fungsi create
    public function create()
    {
        $menus = Menu::where('toko_id', auth()->user()->admin->toko_id)->get();
        $mejas = Meja::where('toko_id', auth()->user()->admin->toko_id)->get();
        return view('admin.pesanan.create', compact('menus', 'mejas'));
    }

    /**
     * Store a newly created resource in storage.
     */

    //  store baru
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'meja_id' => 'required|exists:meja,id',
            'menu_id.*' => 'required|exists:menu,id',
            'qty.*' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('gagal', 'Ada Kesalahan Saat Penginputan!');
        }

        // Buat order baru
        $order = Order::create([
            'toko_id' => auth()->user()->admin->toko_id,
            'user_id' => auth()->id(),
            'meja_id' => $request->meja_id,
            'jenis_order' => 1,
            'catatan' => $request->catatan,
        ]);

        $total = 0;

        foreach ($request->menu_id as $index => $menu_id) {
            $menu = Menu::find($menu_id);

            $harga = (int) $menu->harga;
            $qty = (int) $request->qty[$index];

            $subtotal = $harga * $qty;

            Cart::create([
                'toko_id' => auth()->user()->admin->toko_id,
                'user_id' => auth()->id(),
                'menu_id' => $menu_id,
                'qty' => $qty,
                'harga' => $harga,
                'catatan' => $request->catatan_item[$index] ?? null,
                'order_id' => $order->id,
            ]);

            $total += $subtotal;
        }

        // Buat Bill untuk pesanan ini
        Bill::create([
            'order_makanan_id' => $order->id,
            'total_bayar' => $total,
        ]);

        return redirect()->route('pesanan.index')->with('sukses', 'Pesanan berhasil disimpan!');
    }


    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'no_meja' => 'required|unique:meja',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()
    //             ->back()
    //             ->withErrors($validator)
    //             ->withInput()
    //             ->with('gagal', 'Ada Kesalahan Saat Penginputan!');
    //     }

    //     Order::create([
    //         'toko_id' => auth()->user()->admin->toko_id,
    //         'no_meja' => $request->no_meja,
    //     ]);
    //     return redirect()->back()->with('sukses', 'Data Berhasil Diinput!');
    // }


    public function show($id)
    {
        $order = Order::with(['carts.menu', 'bill', 'meja'])
            ->where('toko_id', auth()->user()->admin->toko->id)
            ->findOrFail($id);

        return view('admin.pesanan.detail', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::with(['carts.menu', 'bill', 'meja'])
            ->where('toko_id', auth()->user()->admin->toko->id)
            ->findOrFail($id);

        $menus = Menu::where('toko_id', auth()->user()->admin->toko_id)->get();
        $mejas = Meja::where('toko_id', auth()->user()->admin->toko_id)->get();

        return view('admin.pesanan.edit', compact('order', 'menus', 'mejas'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'meja_id' => 'required|exists:meja,id',
            'menu_id.*' => 'required|exists:menu,id',
            'qty.*' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('gagal', 'Ada Kesalahan Saat Penginputan!');
        }

        $order = Order::where('toko_id', auth()->user()->admin->toko_id)->findOrFail($id);

        // Update data utama
        $order->update([
            'meja_id' => $request->meja_id,
            'catatan' => $request->catatan,
        ]);

        // Hapus cart & bill lama
        Cart::where('order_id', $order->id)->delete();
        Bill::where('order_makanan_id', $order->id)->delete();

        $total = 0;

        foreach ($request->menu_id as $index => $menu_id) {
            $menu = Menu::find($menu_id);

            $harga = (int) $menu->harga;
            $qty = (int) $request->qty[$index];
            $subtotal = $harga * $qty;

            Cart::create([
                'toko_id' => auth()->user()->admin->toko_id,
                'user_id' => auth()->id(),
                'menu_id' => $menu_id,
                'qty' => $qty,
                'harga' => $harga,
                'catatan' => $request->catatan_item[$index] ?? null,
                'order_id' => $order->id,
            ]);

            $total += $subtotal;
        }

        Bill::create([
            'order_makanan_id' => $order->id,
            'total_bayar' => $total,
        ]);

        return redirect()->route('pesanan.index')->with('sukses', 'Pesanan berhasil diperbarui!');
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
