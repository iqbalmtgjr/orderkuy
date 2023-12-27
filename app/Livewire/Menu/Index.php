<?php

namespace App\Livewire\Menu;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Toko;
use Livewire\Component;

class Index extends Component
{

    public $toko, $menu, $makanan, $minuman, $snack, $selectedItemId;

    public $count = 1;

    public $isClicked = false;

    public function render()
    {
        return view('livewire.menu.index');
    }

    public function mount($id)
    {
        $this->toko = Toko::find($id);
        $this->menu = Menu::where('toko_id', $id)->get();
        $this->makanan = Menu::where('toko_id', $id)->where('kategori', 'makanan')->get();
        $this->minuman = Menu::where('toko_id', $id)->where('kategori', 'minuman')->get();
        $this->snack = Menu::where('toko_id', $id)->where('kategori', 'snack')->get();
    }

    public function handleClick()
    {
        $this->isClicked = true;
    }

    public function increment($id)
    {
        $menus = Menu::find($id);
        $carts = Cart::find($id);
        $carts->increment('qty', 1);
        $updateHarga = $carts->qty * $menus->harga;

        $carts->update(['harga' => $updateHarga]);
    }

    public function decrement($id)
    {
        $carts = Cart::find($id);
        $carts->decrement('qty', 1);
        $updateHarga = $carts->qty * $carts->menu->harga;

        $carts->update(['harga' => $updateHarga]);
    }
}
