<x-mail::layout>

    {{-- Header --}}
    <x-slot:header>
        <x-mail::header :url="config('app.url')">
            <div class="text-center" style="font-size:18px; font-weight:bold; color:#b91c1c;">
                GBI KJK
            </div>
        </x-mail::header>
    </x-slot:header>

    {{-- Body --}}
    {!! $slot !!}

    {{-- Subcopy --}}
    @isset($subcopy)
        <x-slot:subcopy>
            <x-mail::subcopy>
                {!! $subcopy !!}
            </x-mail::subcopy>
        </x-slot:subcopy>
    @endisset

    {{-- Footer --}}
    <x-slot:footer>
        <x-mail::footer>
            <p style="margin:0; font-size:12px; color:#6b7280;">
                © {{ date('Y') }} GBI KJK. Semua hak dilindungi.
            </p>
            <p style="margin:0; font-size:12px; color:#6b7280;">
                Jl. Raya [isi alamat lengkap], Lampung Utara
            </p>
            <p style="margin:0; font-size:12px; color:#6b7280;">
                Hubungi kami:
                <a href="mailto:rioagustor18@gmail.com" style="color:#b91c1c; text-decoration:none;">
                    rioagustor18@gmail.com
                </a>
            </p>
        </x-mail::footer>
    </x-slot:footer>

</x-mail::layout>
