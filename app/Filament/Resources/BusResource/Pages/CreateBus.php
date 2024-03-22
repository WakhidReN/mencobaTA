<?php

namespace App\Filament\Resources\BusResource\Pages;

use Filament\Actions;
use App\Filament\Resources\BusResource;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateBus extends CreateRecord
{
    protected static string $resource = BusResource::class;
    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        $bus = $this->record;
        $user = auth()->user()->name;

        Notification::make()
        ->title('Bus baru sudah ditambahkan')
        ->icon('ri-bus-fill')
        ->body("**Bus {$bus->name} sudah ditambahkan oleh {$user}!**")
        ->actions([
            Action::make('View')->url(
                BusResource::getUrl('edit', ['record' => $bus])
            ),
        ])
        ->sendToDatabase(auth()->user());
    }
}
