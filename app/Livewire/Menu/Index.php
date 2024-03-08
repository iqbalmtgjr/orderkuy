<?php

namespace App\Livewire\Menu;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Toko;
use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{

    public $toko, $menu, $makanan, $minuman, $snack, $carts, $productId, $quantity;

    public $count = 1;

    public $isClicked = false;

    public function render()
    {
        return view('livewire.menu.index');
    }

    #[On('dataUpdated')]
    public function mount($id)
    {
        $this->toko = Toko::find($id);
        $this->menu = Menu::where('toko_id', $id)->get();
        $this->makanan = Menu::where('toko_id', $id)->where('kategori', 'makanan')->get();
        $this->minuman = Menu::where('toko_id', $id)->where('kategori', 'minuman')->get();
        $this->snack = Menu::where('toko_id', $id)->where('kategori', 'snack')->get();
        $this->carts = Cart::where('user_id', auth()->user()->id)->get();
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
        if ($data) {
            $keranjang = Cart::find($data['id']);
            $keranjang
        } else {
            $keranjang = Cart::updateOrCreate($data);
        }

        $this->dispatch('cart-stored', ['message' => 'Menu ' . $menu->nama_produk . ' berhasil ditambahkan ke keranjang!']);
        $this->dispatch('dataUpdated', $keranjang->menu->toko_id);
    }

    public function updatedQuantity($productId, $quantity)
    {
        $this->dispatch('updateCartQuantity', $productId, $quantity);
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
