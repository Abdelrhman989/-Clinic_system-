<?php

namespace App\Filament\Resources\Apointments\Pages;

use App\Filament\Resources\Apointments\ApointmentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageApointments extends ManageRecords
{
    protected static string $resource = ApointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
