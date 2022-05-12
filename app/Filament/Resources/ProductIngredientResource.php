<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductIngredientResource\Pages;
use App\Filament\Resources\ProductIngredientResource\RelationManagers;
use App\Models\ProductIngredient;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ProductIngredientResource extends Resource
{
    protected static ?string $model = ProductIngredient::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('products_id')
                    ->required(),
                Forms\Components\TextInput::make('ingredients_id')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('products_id'),
                Tables\Columns\TextColumn::make('ingredients_id'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductIngredients::route('/'),
            'create' => Pages\CreateProductIngredient::route('/create'),
            'edit' => Pages\EditProductIngredient::route('/{record}/edit'),
        ];
    }
}
