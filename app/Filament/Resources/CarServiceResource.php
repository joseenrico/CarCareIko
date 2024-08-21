<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarServiceResource\Pages;
use App\Filament\Resources\CarServiceResource\RelationManagers;
use App\Models\CarService;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CarServiceResource extends Resource
{
    protected static ?string $model = CarService::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('name')
                    ->helperText('Masukkan nama layanan yang sesuai bisnis anda ')
                    ->required() //tidak boleh kosong
                    ->maxLength(255),

                Forms\Components\TextInput::make('price')
                    ->required() //tidak boleh kosong
                    ->numeric()
                    ->prefix('IDR'),

                Forms\Components\TextInput::make('duration_in_hour')
                    ->required() //tidak boleh kosong
                    ->numeric()
                    ->maxLength(255),

                Forms\Components\FileUpload::make('photo')
                    ->image()
                    ->required(), //tidak boleh kosong

                Forms\Components\FileUpload::make('icon')
                    ->image()
                    ->required(),

                Forms\Components\Textarea::make('about')
                    ->required() //tidak boleh kosong
                    ->rows(10)
                    ->cols(20)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\ImageColumn::make('icon')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListCarServices::route('/'),
            'create' => Pages\CreateCarService::route('/create'),
            'edit' => Pages\EditCarService::route('/{record}/edit'),
        ];
    }
}
