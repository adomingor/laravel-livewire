<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Spatie\Permission\Models\Role;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                TextInput::make('password')
                    ->label('Contraseña')
                    ->password()
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->minLength(8)
                    ->dehydrateStateUsing(fn (?string $state) => filled($state) ? bcrypt($state) : null)
                    ->dehydrated(fn (?string $state) => filled($state))
                    ->hint('Dejar vacío para mantener la contraseña actual'),

                CheckboxList::make('roles')
                    ->label('Roles')
                    ->relationship(titleAttribute: 'name')
                    ->options(fn () => Role::orderBy('name')->pluck('name', 'id'))
                    ->columns(3),
            ]);
    }
}
