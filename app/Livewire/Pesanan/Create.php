<?php

namespace App\Livewire\Pesanan;

use Livewire\Component;
use App\Models\Menu;
use App\Models\Meja;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Bill;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $meja_id;
    public $catatan;
    public $menus;
    public $mejas;

    public $items = [];

    public function pilihMenu($index, $menuId)
    {
        if (isset($this->items[$index])) {
            $this->items[$index]['menu_id'] = $menuId;
        }
    }


    public function mount()
    {
        $this->menus = Menu::where('toko_id', auth()->user()->admin->toko_id)->get();
        $this->mejas = Meja::where('toko_id', auth()->user()->admin->toko_id)->get();
        $this->addItem();
    }

    public function addItem()
    {
        $this->items[] = [
            'menu_id' => '',
            'qty' => 1,
            'catatan_item' => '',
        ];
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function store()
    {
        $this->validate([
            'meja_id' => 'required|exists:meja,id',
            'items.*.menu_id' => 'required|exists:menu,id',
            'items.*.qty' => 'required|integer|min:1',
        ]);

        $order = Order::create([
            'toko_id' => auth()->user()->admin->toko_id,
            'user_id' => Auth::id(),
            'meja_id' => $this->meja_id,
            'jenis_order' => 1,
            'catatan' => $this->catatan,
        ]);

        $total = 0;

        foreach ($this->items as $item) {
            $menu = Menu::find($item['menu_id']);

            if ($menu->stok < $item['qty']) {
                session()->flash('gagal', "Stok untuk menu '{$menu->nama}' tidak mencukupi!");
                return;
            }

            $subtotal = $menu->harga * $item['qty'];

            Cart::create([
                'toko_id' => auth()->user()->admin->toko_id,
                'user_id' => Auth::id(),
                'menu_id' => $item['menu_id'],
                'qty' => $item['qty'],
                'harga' => $menu->harga,
                'catatan' => $item['catatan_item'],
                'order_id' => $order->id,
            ]);

            $menu->decrement('stok', $item['qty']);

            $total += $subtotal;
        }

        Bill::create([
            'order_makanan_id' => $order->id,
            'total_bayar' => $total,
        ]);

        session()->flash('sukses', 'Pesanan berhasil disimpan!');
        return redirect()->route('pesanan.index');
    }

    public function render()
    {
        return view('livewire.pesanan.create');
    }

    public function incrementQty($index)
    {
        if (isset($this->items[$index]['qty'])) {
            $this->items[$index]['qty']++;
        }
    }

    public function decrementQty($index)
    {
        if (isset($this->items[$index]['qty']) && $this->items[$index]['qty'] > 1) {
            $this->items[$index]['qty']--;
        }
    }
}
