<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AplikasiResource\Pages;
use App\Filament\Resources\AplikasiResource\RelationManagers;
use App\Models\Aplikasi;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AplikasiResource extends Resource
{
    protected static ?string $model = Aplikasi::class;

    protected static ?string $modelLabel = 'Aplikasi';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Aplikasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->whereNot('status', 1)) //DRAFT not show
            ->columns([
                TextColumn::make('apl_id')
                    ->label('APL ID')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('eqp_name')
                    ->label('Nama Perangkat')
                    ->limit(20)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();

                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }

                        // Only render the tooltip if the column content exceeds the length limit.
                        return $state;
                    })
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('eqp_merk')
                    ->label('Merk')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('eqp_type')
                    ->label('Tipe')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('negara.uredi')
                    ->label('Buatan')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('serial_number_1')
                    ->label('Nomor Seri')
                    ->limit(20)
                    ->searchable()
                    ->toggleable()
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();

                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }
                        return $state;
                    })
                    ->sortable(),
                TextColumn::make('statusnya.tab_desc')
                    ->label('Status'),
                TextColumn::make('customer.cust_name')
                    ->label('Customer')
                    ->limit(20)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();

                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }
                        return $state;
                    })
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListAplikasis::route('/'),
            'create' => Pages\CreateAplikasi::route('/create'),
            'view' => Pages\ViewAplikasi::route('/{record}'),
            'edit' => Pages\EditAplikasi::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make()
                    ->schema([
                        Tabs::make('Tabs')
                            ->tabs([
                                Tabs\Tab::make('Data Pengujian')
                                    ->schema([
                                        TextEntry::make('apl_id')
                                            ->label('ID Aplikasi'),
                                        TextEntry::make('apl_id')
                                            ->label('Nomor Permohonan'),
                                        TextEntry::make('apl_id')
                                            ->label('Tanggal & Estimasi Pengujian'),
                                        TextEntry::make('eqp_name')
                                            ->label('Nama Perangkat'),
                                        TextEntry::make('eqp_merk')
                                            ->label('Merk'),                                      
                                        TextEntry::make('eqp_type')
                                            ->label('Tipe'),
                                        TextEntry::make('serial_number_1')
                                            ->label('Nomor Seri Sampel 1'),
                                        TextEntry::make('serial_number_2')
                                            ->label('Nomor Seri Sampel 2'),
                                        TextEntry::make('negara.uredi')
                                            ->label('Buatan'),
                                        TextEntry::make('jenis_pengujian.tab_desc')
                                            ->label('Jenis Pengujian'),
                                    ])
                                    ,
                                Tabs\Tab::make('Data Sertifikasi')
                                    ->schema([]),
                                Tabs\Tab::make('Data Perusahaan')
                                    ->schema([]),
                                Tabs\Tab::make('File Lampiran')
                                    ->schema([]),
                                // Tabs\Tab::make('Riwayat SP2')
                                //     ->schema([]),
                                // Tabs\Tab::make('Riwayat Pengujian')
                                //     ->schema([]),
                                // Tabs\Tab::make('Riwayat LHU')
                                //     ->schema([]),
                                // Tabs\Tab::make('Riwayat Aplikasi')
                                //     ->schema([]),
                            ])
                            ->columns(2)
                            ,
                    ])
                    ->columnSpanFull()
            ])
            ;
    }
}
