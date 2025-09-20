@if (session('success') || session('error'))
    @php
        $type = session('success') ? 'success' : 'error';
        $message = session('success') ?? session('error');

        $styles = [
            'success' => [
                'color' => 'green',
                'icon' => 'check-circle',
                'title' => 'Berhasil!',
                'bg' => 'bg-green-500',
            ],
            'error' => [
                'color' => 'red',
                'icon' => 'x-circle',
                'title' => 'Gagal!',
                'bg' => 'bg-red-500',
            ],
        ];

        $style = $styles[$type];
    @endphp

    <div 
        x-data="{ show: true }" 
        x-show="show" 
        x-init="setTimeout(() => show = false, 3000)" 
        x-transition:enter="transform transition ease-out duration-500"
        x-transition:enter-start="translate-x-full opacity-0"
        x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transform transition ease-in duration-500"
        x-transition:leave-start="translate-x-0 opacity-100"
        x-transition:leave-end="translate-x-full opacity-0"
        class="fixed top-20 right-4 z-50"
        style="pointer-events: none;"
    >
        <div 
            class="inline-flex items-center justify-between {{ $style['bg'] }} text-white rounded-md shadow-lg px-4 py-2"
            style="pointer-events: auto;"
        >
            <div class="flex items-center gap-2">
                <x-dynamic-component :component="'heroicon-o-' . $style['icon']" class="w-5 h-5" />
                <div class="text-sm">
                    <span class="font-semibold">{{ $style['title'] }}</span>
                    <span class="ml-1">{{ $message }}</span>
                </div>
            </div>
            <button 
                @click="show = false" 
                class="ml-3 text-white hover:text-opacity-75 transition"
            >
                <x-heroicon-o-x-mark class="w-4 h-4" />
            </button>
        </div>
    </div>
@endif
