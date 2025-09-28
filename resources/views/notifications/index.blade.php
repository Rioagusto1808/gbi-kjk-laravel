<x-app-layout>
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Semua Notifikasi</h1>
            <p class="text-sm text-gray-500 mt-1">Unread: {{ $unreadCount }}</p>
        </div>

        @if ($unreadCount > 0)
            <form method="POST" action="{{ route('notifications.readall') }}">
                @csrf
                <button type="submit" class="px-3 py-2 text-sm rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                    Tandai semua sudah dibaca
                </button>
            </form>
        @endif
    </div>

    <div class="bg-white rounded-xl shadow border border-gray-200">
        @if ($notifications->count())
            <ul class="divide-y divide-gray-200">
                @foreach ($notifications as $notif)
                    <li class="p-4 flex items-start gap-3 {{ is_null($notif->read_at) ? 'bg-orange-50' : '' }}">
                        <div class="mt-1">
                            @if (is_null($notif->read_at))
                                <span class="inline-block w-2 h-2 rounded-full bg-orange-500"></span>
                            @else
                                <span class="inline-block w-2 h-2 rounded-full bg-gray-300"></span>
                            @endif
                        </div>

                        <div class="flex-1">
                            <a href="{{ $notif->data['url'] ?? '#' }}" class="block hover:underline">
                                <p class="text-sm font-semibold text-gray-800">
                                    {{ $notif->data['nama'] ?? 'Pengirim' }}
                                    <span class="text-xs text-gray-500">
                                        ({{ $notif->data['email'] ?? '-' }})
                                    </span>
                                </p>
                                <p class="text-sm text-gray-700 mt-1">
                                    {{ $notif->data['pesan'] ?? '-' }}
                                </p>
                                <p class="text-xs text-gray-400 mt-1">
                                    {{ $notif->created_at->diffForHumans() }}
                                </p>
                            </a>
                        </div>

                        @if (is_null($notif->read_at))
                            <form method="POST" action="{{ route('notifications.read', $notif->id) }}">
                                @csrf
                                <button type="submit"
                                    class="text-xs px-3 py-1 rounded border border-gray-300 hover:bg-gray-50">
                                    Tandai dibaca
                                </button>
                            </form>
                        @endif
                    </li>
                @endforeach
            </ul>

            <div class="p-4">
                {{ $notifications->links() }}
            </div>
        @else
            <div class="p-8 text-center text-gray-500">Belum ada notifikasi.</div>
        @endif
    </div>
</x-app-layout>
