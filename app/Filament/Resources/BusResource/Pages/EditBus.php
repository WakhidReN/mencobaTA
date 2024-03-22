<?php

namespace App\Filament\Resources\BusResource\Pages;

use Filament\Actions;
use App\Filament\Resources\BusResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Actions\Action;

class EditBus extends EditRecord
{
    protected static string $resource = BusResource::class;

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
        $bus = $this->record;
        $user = auth()->user()->name;

        return Notification::make()
                ->title('Bus berhasil diubah')
                ->icon('ri-bus-fill')
                ->body("**Bus {$bus->name} sudah diubah oleh {$user}!**")
                ->actions([
                    Action::make('View')->url(
                        BusResource::getUrl('edit', ['record' => $bus])
                    ),
                ])
                ->sendToDatabase(auth()->user());
    }
}
