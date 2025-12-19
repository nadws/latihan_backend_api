<x-filament-panels::page>
    <div class="space-y-2">
        @foreach ($this->users as $user)
            <div class="p-2 border rounded">
                {{ $user->name }} - {{ $user->email }}
            </div>
        @endforeach
    </div>
</x-filament-panels::page>
