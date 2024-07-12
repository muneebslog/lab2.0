<?php

namespace App\Filament\Resources\TestFieldResource\Pages;

use App\Filament\Resources\TestFieldResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTestField extends CreateRecord
{
    protected static string $resource = TestFieldResource::class;
}
