<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenggunaResource\Pages;
use App\Filament\Resources\PenggunaResource\RelationManagers;
use App\Models\User;
use BladeUI\Icons\Components\Icon;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Date;

class PenggunaResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'Pengguna';

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationLabel = 'User Internal';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                TextInput::make('email'),
                  
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user_id')
                    ->label('ID')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Fullname')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('username')
                    ->label('Username')
                    ->toggleable()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('handphone')
                    ->label('HP')
                    ->toggleable()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->toggleable()
                    ->searchable(),
                IconColumn::make('aktif')
                    ->sortable()
                    ->trueIcon('heroicon-o-check-circle') // Icon for "aktif = 1"
                    ->falseIcon('heroicon-o-x-circle') // Icon for "aktif = 2"
                    ->getStateUsing(fn ($record) => $record->aktif === 1)
                    ->toggleable(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('Update Date')
                    ->sortable(),                    
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListPenggunas::route('/'),
            'create' => Pages\CreatePengguna::route('/create'),
            'view' => Pages\ViewPengguna::route('/{record}'),
            'edit' => Pages\EditPengguna::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
{
    return static::getModel()::count();
}
}
