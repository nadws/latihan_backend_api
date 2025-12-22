<x-filament-panels::page>
    <div class="space-y-4">

        @if ($this->stores->isEmpty())
            <p class="text-gray-500">
                Kamu belum memiliki store.
            </p>
        @else
            <h2 class="text-lg font-bold">Pilih Store</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($this->stores as $store)
                    <x-filament::button wire:click="selectStore({{ $store->id }})" color="secondary">
                        {{ $store->name }}
                    </x-filament::button>
                @endforeach
            </div>
        @endif

    </div>
</x-filament-panels::page>
