<?php

namespace App\Livewire\Menu;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Toko;
use Flasher\Laravel\Http\Request;
use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{

    public $toko, $menu, $makanan, $minuman, $snack, $carts, $productId, $quantity, $selectedOption1, $selectedOption2, $catatan, $produk, $produk_id, $toko_id, $jenisOrder;

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
        $this->jenisOrder = Order::where('user_id', auth()->user()->id)->first()->jenis_order;
        // dd($this->order->jenis_order);
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

    public function colorChange($id)
    {
        if ($id === 1) {
            $this->selectedOption1 = "btn-danger";
            $this->selectedOption2 = "btn-secondary";
        } else if ($id === 0) {
            $this->selectedOption2 = "btn-danger";
            $this->selectedOption1 = "btn-secondary";
        }
    }

    public function note($id)
    {
        $this->produk = Cart::find($id)->menu->nama_produk;
        $this->produk_id = Cart::find($id)->id;

        $keranjang = Cart::find($id);
        $this->catatan = $keranjang->catatan;
    }

    public function addNote()
    {
        $updateNote = Cart::find($this->produk_id);
        $updateNote->update([
            'catatan' => $this->catatan,
        ]);
        $this->dispatch('dataUpdated', $updateNote->menu->toko_id);
    }

    public function addToCart($menu_id)
    {
        $menu = Menu::find($menu_id);
        $keranjang = Cart::where('menu_id', $menu_id)->first();
        $cart = [
            'user_id' => auth()->user()->id,
            'toko_id' => $menu->toko_id,
            'menu_id' => $menu_id,
            'qty' => 1,
            'harga' => $menu->harga,
        ];

        if ($keranjang) {
            $keranjang->increment('qty', 1);
        } else {
            $keranjang = Cart::updateOrCreate($cart);
        }

        // $this->dispatch('cart-stored', ['message' => 'Menu ' . $menu->nama_produk . ' berhasil ditambahkan ke keranjang!']);
        $this->dispatch('dataUpdated', $keranjang->menu->toko_id);
    }

    public function order($user_id)
    {
        // dd($this->jenisOrder);
        $keranjang = Cart::where('user_id', $user_id)->get();

        foreach ($keranjang as $key) {
            // if ($key->menu_id == )
            Order::updateOrCreate([
                'toko_id' => $key->toko_id,
                'user_id' => $user_id,
                'meja_id' => 1,
                'menu_id' => $key->menu_id,
                'jumlah' => $key->qty,
                'jenis_order' => $this->jenisOrder,
                'catatan' => $key->catatan
            ]);
        }

        $this->dispatch('order-stored', ['message' => 'Order anda berhasil. Silahkan menunggu hingga makanan siap disajikan']);
    }
}
