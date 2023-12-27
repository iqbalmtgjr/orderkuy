<x-mail::message>
    # Registrasi Akun OrderYuk!!!

    Hai {{ $user->name }}
    Selamat anda telah terdaftar di Aplikasi OrderYuk!!!.
    Password akun anda adalah {{ $make_password }}.

    Terima Kasih,
    {{ config('app.name') }}
</x-mail::message>
