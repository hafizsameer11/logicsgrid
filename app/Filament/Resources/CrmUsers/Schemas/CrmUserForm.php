<?php

namespace App\Filament\Resources\CrmUsers\Schemas;

use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rules\Password;

class CrmUserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->revealable()
                    ->live(onBlur: true)
                    ->helperText(fn (string $operation): string => $operation === 'edit'
                        ? 'Leave blank to keep the current password. Fill to set a new password (works for yourself and other users).'
                        : 'Set the login password for this user.')
                    ->dehydrated(fn (?string $state): bool => filled($state))
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->rule(Password::defaults())
                    ->confirmed()
                    ->autocomplete('new-password'),
                TextInput::make('password_confirmation')
                    ->label('Confirm Password')
                    ->password()
                    ->revealable()
                    ->dehydrated(false)
                    ->required(fn (string $operation, Get $get): bool => $operation === 'create' || filled($get('password')))
                    ->autocomplete('new-password'),
                Select::make('role')
                    ->options([
                        User::ROLE_ADMIN => 'Admin',
                        User::ROLE_TEAM_MEMBER => 'Team Member',
                    ])
                    ->required()
                    ->native(false)
                    ->default(User::ROLE_TEAM_MEMBER),
                TextInput::make('designation')
                    ->label('Role / Designation')
                    ->placeholder('e.g. Frontend Developer')
                    ->maxLength(255),
                Select::make('status')
                    ->options([
                        User::STATUS_ACTIVE => 'Active',
                        User::STATUS_INACTIVE => 'Inactive',
                    ])
                    ->required()
                    ->native(false)
                    ->default(User::STATUS_ACTIVE),
            ]);
    }
}
