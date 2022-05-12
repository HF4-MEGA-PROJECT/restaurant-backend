<?php

namespace App\Filament\Resources\OrderProductResource\Pages;

use App\Filament\Resources\OrderProductResource;
use Filament\Resources\Pages\ListRecords;

class ListOrderProducts extends ListRecords
{
    protected static string $resource = OrderProductResource::class;
}
