<?php

namespace App\Filament\Resources\BusAvailabilityResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Actions\Action;
use App\Filament\Resources\BusAvailabilityResource;

class EditBusAvailability extends EditRecord
{
    protected static string $resource = BusAvailabilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        $ketersediaan_bus = $this->record;
        $user = auth()->user()->name;

        return Notification::make()
                ->title('Ketersediaan bus berhasil diubah')
                ->icon('tabler-bus')
                ->body("**Ketersediaan bus {$ketersediaan_bus->bus->name} sudah diubah oleh {$user}!**")
                ->actions([
                    Action::make('View')->url(
                        BusAvailabilityResource::getUrl('edit', ['record' => $ketersediaan_bus])
                    ),
                ])
                ->sendToDatabase(auth()->user());
    }
}
