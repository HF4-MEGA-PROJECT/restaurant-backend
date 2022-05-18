<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyThroughRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class IngredientsRelationManager extends HasManyThroughRelationManager
{
    protected static string $relationship = 'ingredients';

    protected static ?string $recordTitleAttribute = 'name';

    protected static bool $hasAssociateAction = true;
    protected static bool $hasDissociateAction = true;
    protected static bool $hasDissociateBulkAction = true;

    protected static ?string $inverseRelationship = 'products';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_in_stock')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\BooleanColumn::make('is_in_stock'),
            ])
            ->filters([
                //
            ]);
    }
}
