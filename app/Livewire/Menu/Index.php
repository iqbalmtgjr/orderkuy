<?php

namespace App\Livewire\Menu;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Toko;
use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{

    public $toko, $menu, $makanan, $minuman, $snack, $carts, $productId, $quantity, $selectedOption1, $selectedOption2;

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

    public function colorChange($id)
    {
        // dd($id);
        if ($id === 1) {
            $this->selectedOption1 = "btn-danger";
            $this->selectedOption2 = "btn-secondary";
        } else if ($id === 0) {
            $this->selectedOption2 = "btn-danger";
            $this->selectedOption1 = "btn-secondary";
        }
    }

    public function addToCart($id)
    {
        $menu = Menu::find($id);
        $keranjang = Cart::where('menu_id', $id)->first();
        $cart = [
            'user_id' => auth()->user()->id,
            'menu_id' => $id,
            'qty' => 1,
            'harga' => $menu->harga,
        ];

        if ($keranjang) {
            $keranjang->increment('qty', 1);
        } else {
            $keranjang = Cart::updateOrCreate($cart);
        }

        $this->dispatch('cart-stored', ['message' => 'Menu ' . $menu->nama_produk . ' berhasil ditambahkan ke keranjang!']);
        $this->dispatch('dataUpdated', $keranjang->menu->toko_id);
    }

    public function increment($id)
    {
        $carts = Cart::find($id);
        $carts->increment('qty', 1);

        $this->dispatch('dataUpdated', $carts->menu->toko_id);
    }

    public function decrement($id)
    {
        $carts = Cart::find($id);
        if ($carts->qty <= 1) {
            $carts->delete();
        } else {
            $carts->decrement('qty', 1);
        }

        $this->dispatch('dataUpdated', $carts->menu->toko_id);
    }
}
