<?php

namespace App\Filament\Resources\BusAvailabilityResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\BusAvailabilityResource;

class CreateBusAvailability extends CreateRecord
{
    protected static string $resource = BusAvailabilityResource::class;
    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        $ketersediaan_bus = $this->record;
        $user = auth()->user()->name;

        Notification::make()
        ->title('Ketersediaan bus baru sudah ditambahkan')
        ->icon('tabler-bus')
        ->body("**Ketersediaan bus {$ketersediaan_bus->bus->name} sudah ditambahkan oleh {$user}!**")
        ->actions([
            Action::make('View')->url(
                BusAvailabilityResource::getUrl('edit', ['record' => $ketersediaan_bus])
            ),
        ])
        ->sendToDatabase(auth()->user());
    }
}
