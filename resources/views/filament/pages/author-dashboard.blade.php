<x-filament::page>
    <h2 class="text-2xl font-bold mb-4">
        Halo, {{ auth()->user()->name }} 👋
    </h2>

    <p class="text-gray-500 mb-6">
        Selamat datang di dashboard Author.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <x-filament::card>
            <h3 class="font-semibold">Total Berita Kamu</h3>
            <p class="text-3xl mt-2">
                {{ \App\Models\News::where('user_id', auth()->id())->count() }}
            </p>
        </x-filament::card>

        <x-filament::card>
            <h3 class="font-semibold">Berita Dipublish</h3>
            <p class="text-3xl mt-2">
                {{ \App\Models\News::where('user_id', auth()->id())->count() }}
            </p>
        </x-filament::card>
    </div>
</x-filament::page>
