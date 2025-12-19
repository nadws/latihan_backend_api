<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Actions\Action;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Spatie\Permission\PermissionRegistrar;

class ManageStoreUsers extends Page
{
    protected string $view = 'filament.pages.manage-store-users';
    protected static ?string $navigationLabel = 'User Toko';

    public function getUsersProperty()
    {
        $storeId = session('current_store_id');

        return User::whereHas('roles', function ($q) use ($storeId) {
            $q->where('model_has_roles.store_id', $storeId);
        })->get();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('addUser')
                ->label('Tambah User')
                ->form([
                    TextInput::make('email')
                        ->email()
                        ->required(),

                    Select::make('role')
                        ->options([
                            'admin' => 'Admin',
                            'cashier' => 'Kasir',
                        ])
                        ->required(),
                ])
                ->action(function ($data) {
                    $storeId = session('current_store_id');

                    app(PermissionRegistrar::class)
                        ->setPermissionsTeamId($storeId);

                    $user = User::where('email', $data['email'])->firstOrFail();

                    $role = Role::firstOrCreate([
                        'name' => $data['role'],
                        'guard_name' => 'web',
                        'store_id' => $storeId,
                    ]);

                    $user->assignRole($role);
                }),
        ];
    }
}
