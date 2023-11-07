<?php

namespace App\Filament\Resources\CouponsResource\Pages;

use App\Filament\Resources\CouponsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCoupons extends ManageRecords
{
    protected static string $resource = CouponsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
