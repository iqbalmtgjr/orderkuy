<?php

namespace App\Livewire\Menu;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Toko;
use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{

    public $toko, $menu, $makanan, $minuman, $snack;

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

    public function addToCart($id)
    {
        $menu = Menu::find($id);
        $data = [
            'user_id' => auth()->user()->id,
            'menu_id' => $id,
            'qty' => 1,
            'harga' => $menu->harga,
        ];
        // dd($menu->nama_produk);
        $keranjang = Cart::updateOrCreate($data);

        // session()->flash('sukses', 'Menu berhasil ditambahkan ke keranjang!');
        $this->dispatch('cart-stored', ['message' => 'Menu ' . $menu->nama_produk . ' berhasil ditambahkan ke keranjang!']);
        // $this->redirect('/menu/toko/' . $menu->toko->id);
        // $this->isClicked = true;
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

    // #[On('cart-stored')]
    public function handleStored($data)
    {
        // dd('sukses');
        session()->flash('sukses', 'Menu berhasil ditambahkan ke keranjang!');
    }
}
