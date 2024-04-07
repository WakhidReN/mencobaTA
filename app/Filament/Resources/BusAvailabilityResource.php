<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use App\Models\Bus;
use Filament\Forms;
use Filament\Tables;
use App\Enums\BusPaymentStatus;
use Filament\Forms\Form;
use App\Enums\BusAvailabilityStatus;
use Filament\Tables\Table;
use App\Models\BusAvailability;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BusAvailabilityResource\Pages;
use App\Filament\Resources\BusAvailabilityResource\RelationManagers;

class BusAvailabilityResource extends Resource
{
    protected static ?string $model = BusAvailability::class;
    protected static ?string $slug = 'ketersediaan-bus';

    protected static ?string $label = 'Ketersediaan Bus';
    protected static ?string $navigationLabel = 'Ketersediaan Bus';
    protected static ?string $navigationGroup = 'Data Bus';
    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'tabler-bus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Keberangkatan')
                    ->schema([
                        DateTimePicker::make('start_date')
                            ->label('Tanggal Berangkat')
                            ->required()
                        ,
                        DateTimePicker::make('end_date')
                            ->label('Tanggal Pulang')
                            ->required()
                        ,
                        Select::make('bus_id')
                            ->label('Armada')
                            ->options(
                                Bus::pluck('name', 'id')
                            )
                            ->live()
                            ->preload()
                            ->required(),
                        Select::make('bus_id')
                            ->label('Jenis Armada')
                            ->live()
                            ->placeholder(
                                fn (Forms\Get $get): string => empty($get('bus_id')) ? 'Pilih armada terlebih dahulu' : 'Pilih salah satu opsi'
                            )
                            ->options(
                                function (Forms\Get $get) {
                                    $bus = Bus::find($get('bus_id'));
                                    $data = $bus ? [$bus->id => $bus->type->value] : [];
                                    return $data;
                                }
                            )
                            ->required()
                        ,
                        Select::make('bus_id')
                            ->label('Seat Set')
                            ->live()
                            ->placeholder(
                                fn (Forms\Get $get): string => empty($get('bus_id')) ? 'Pilih jenis armada terlebih dahulu' : 'Pilih salah satu opsi'
                            )
                            ->options(
                                function (Forms\Get $get) {
                                    $data = Bus::where('id', $get('bus_id'))->pluck('seat_total', 'id');
                                    return $data;
                                }
                            )
                            ->required(),
                        Select::make('status')
                            ->options(BusAvailabilityStatus::class)
                            ->label('Status')
                            ->required()
                    ])->columns(2)
                    ,
                    Section::make('Pembayaran')
                    ->schema([
                        Select::make('payment_status')
                            ->options(BusPaymentStatus::class)
                            ->label('Status Pembayaran')
                            ->required()
                        ,
                        DateTimePicker::make('payment_date')
                            ->label('Tanggal Pembayaran')
                            ->required()
                        ,
                        TextInput::make('total_payment')
                            ->label('Jumlah Nominal')
                            ->numeric()
                            ->placeholder('Jumlah Nominal')
                            ->minValue(0)
                            ->required()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('start_date')
                    ->label('Tanggal Berangkat')
                    ->searchable()
                    ->dateTime()
                ,
                TextColumn::make('month')
                    ->label('Bulan')
                    ->searchable()
                    ->state(function (BusAvailability $busAvailability): string {
                        return $busAvailability->start_date;
                    })
                    ->dateTime('Y-m')
                ,
                TextColumn::make('day')
                    ->label('Hari Berangkat')
                    ->searchable()
                    ->state(function (BusAvailability $busAvailability): string {
                        return $busAvailability->start_date;
                    })
                    ->dateTime('l')
                ,
                TextColumn::make('duration')
                    ->label('Durasi (Hari)')
                    ->searchable()
                    ->state(function (BusAvailability $busAvailability): string {
                        $startDate = Carbon::parse($busAvailability->start_date);
                        $endDate = Carbon::parse($busAvailability->end_date);

                        $durationInDays = round($startDate->diffInDays($endDate));

                        return (string)$durationInDays;
                    })
                    ->suffix(' Hari')
                ,
                TextColumn::make('end_date')
                    ->label('Tanggal Pulang')
                    ->searchable()
                    ->dateTime()
                ,
                TextColumn::make('payment_status')
                    ->label('Status Pembayaran')
                    ->searchable()
                ,
                TextColumn::make('remaining_days')
                    ->label('Remaining Days')
                    ->searchable()
                    ->state(function (BusAvailability $busAvailability) {
                        $startDate = Carbon::parse($busAvailability->start_date)->format('Y-m-d');
                        $now = Carbon::now()->format('Y-m-d');

                        if ($startDate == $now) {
                            return 'Hari ini berangkat';
                        } else {
                            $remainingInDay = Carbon::parse($now)->diffInDays($startDate);
                            return $remainingInDay . ' Hari';
                        }
                    })
                ,
                TextColumn::make('bus.name')
                    ->label('Mitra Armada'),
                TextColumn::make('bus.type')
                    ->label('Jenis Armada'),
                TextColumn::make('bus.seat_total')
                    ->label('Seat Set'),
                TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(function (BusAvailability $ketersediaan_bus) {
                        return ucwords($ketersediaan_bus->status);
                    })
                ,
                TextColumn::make('payment_date')
                    ->label('Tanggal Bayar')
                    ->searchable()
                    ->dateTime()
                ,
                TextColumn::make('total_payment')
                    ->label('Jumlah Nominal')
                    ->searchable()
                    ->money('IDR')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->mutateFormDataUsing(
                        function (array $data): array {
                            $data['armada'] = '22';

                            return $data;
                        }
                    )
                ,
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
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
            'index' => Pages\ListBusAvailabilities::route('/'),
            'create' => Pages\CreateBusAvailability::route('/create'),
            'view' => Pages\ViewBusAvailability::route('/{record}'),
            'edit' => Pages\EditBusAvailability::route('/{record}/edit'),
        ];
    }
}
