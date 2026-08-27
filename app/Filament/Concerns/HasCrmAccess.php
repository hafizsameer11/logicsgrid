<?php

namespace App\Filament\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait HasCrmAccess
{
    public static function userCanManageFinance(): bool
    {
        $user = auth()->user();

        return $user && $user->isAdmin();
    }

    public static function userIsAdmin(): bool
    {
        $user = auth()->user();

        return $user && $user->isAdmin();
    }

    public static function canViewAny(): bool
    {
        return (bool) auth()->user();
    }

    public static function canCreate(): bool
    {
        return static::userIsAdmin();
    }

    public static function canEdit(Model $record): bool
    {
        return static::userIsAdmin();
    }

    public static function canDelete(Model $record): bool
    {
        return static::userIsAdmin();
    }

    public static function canDeleteAny(): bool
    {
        return static::userIsAdmin();
    }

    protected static function scopeToAssignedProjects(Builder $query): Builder
    {
        $user = auth()->user();

        if (! $user || $user->isAdmin()) {
            return $query;
        }

        return $query->whereHas('teamMembers', fn (Builder $q) => $q->where('users.id', $user->id));
    }
}
