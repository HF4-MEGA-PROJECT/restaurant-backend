<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\BelongsToManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class ProductsRelationManager extends BelongsToManyRelationManager
{
    protected static string $relationship = 'products';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('category_id'),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price'),
            ]);
    }

    public static function attachForm(Form $form): Form
    {
        return $form
            ->schema([
                static::getAttachFormRecordSelect(),
                Forms\Components\TextInput::make('price_at_purchase')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category_id'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('price_at_purchase'),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ]);
    }
}
