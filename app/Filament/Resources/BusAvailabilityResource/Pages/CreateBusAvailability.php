<?php

namespace App\Filament\Resources\BusAvailabilityResource\Pages;

use App\Filament\Resources\BusAvailabilityResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBusAvailability extends CreateRecord
{
    protected static string $resource = BusAvailabilityResource::class;
    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}