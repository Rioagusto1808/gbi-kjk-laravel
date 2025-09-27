@component('mail::message')
    # Pesan Baru Masuk

    **Nama:** {{ $data['nama'] }}
    **Email:** {{ $data['email'] }}
    **Pesan:**
    {{ $data['pesan'] }}
@endcomponent
