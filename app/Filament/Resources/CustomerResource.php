<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Customer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CustomerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CustomerResource\RelationManagers;

use function Laravel\Prompts\search;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                       TextInput::make('no_telp')->required()->unique(ignorable:fn($record)=>$record), 
                       TextInput::make('nama')->required(),
                       Select::make('jenis_lapangan')->options([
                        'LAPANGAN BASKET'=>'LAPANGAN BASKET',
                        'LAPANGAN VOLLY'=>'LAPANGAN VOLLY',
                        'LAPANGAN FUTSAL'=>'LAPANGAN FUTSAL',
                       ]),
                       Select::make('metode_pembayaran')->options([
                        'DANA'=>'DANA',
                        'GOPAY'=>'GOPAY',
                        'BCA'=>'BCA',
                        'BRI'=>'BRI',
                        'BNI'=>'BNI'
                       ]),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no_telp')->sortable()->searchable(),
                TextColumn::make('nama')->sortable()->searchable(),
                TextColumn::make('jenis_lapangan')->sortable()->searchable(),
                TextColumn::make('metode_pembayaran')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
