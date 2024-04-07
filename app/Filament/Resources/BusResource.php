<?php

namespace App\Filament\Resources;

use App\Models\Bus;
use Filament\Forms;
use Filament\Tables;
use App\Enums\BusType;
use Filament\Forms\Form;
use App\Enums\SeatBigBus;
use Filament\Tables\Table;
use App\Enums\SeatMediumBus;
use App\Enums\SeatLegrestBus;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BusResource\Pages;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\Tables\PhoneColumn;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;
use App\Filament\Resources\BusResource\RelationManagers;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class BusResource extends Resource
{
    protected static ?string $slug = 'bus';

    protected static ?string $model = Bus::class;

    protected static ?string $label = 'Bus';
    protected static ?string $navigationLabel = 'Bus';
    protected static ?string $navigationGroup = 'Data Bus';
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'ri-bus-fill';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label('Armada')
                            ->placeholder('Armada')
                            ->required(),
                        Select::make('type')
                            ->label('Jenis Armada')
                            ->options(BusType::class)
                            ->live()
                            ->required()
                        ,
                        Select::make('seat_total')
                            ->live()
                            ->label('Seat Set')
                            ->placeholder(
                                fn (Forms\Get $get): string => empty($get('type')) ? 'Pilih jenis armada terlebih dahulu' : 'Pilih salah satu opsi'
                            )
                            ->options(
                                function (Forms\Get $get) {
                                    return match ($get('type')) {
                                        'Big Bus' => SeatBigBus::class,
                                        'Medium' => SeatMediumBus::class,
                                        'Legrest' => SeatLegrestBus::class,
                                        default => [],
                                    };
                                }
                            )
                            ->required(),
                        TextInput::make('pic')
                            ->label('PIC')
                            ->placeholder('PIC')
                            ->required()
                        ,
                        PhoneInput::make('pic_phone')
                            ->label('Kontak PIC')
                            ->defaultCountry('ID')
                            ->initialCountry('id')
                            ->displayNumberFormat(PhoneInputNumberType::E164)
                            ->showSelectedDialCode(true)
                            ->required()
                    ]),
                Section::make()
                    ->schema([
                        FileUpload::make('image')
                            ->label('Foto Bus')
                            ->directory('bus')
                            ->getUploadedFileNameForStorageUsing(
                                fn (TemporaryUploadedFile $file): string => (string)
                                str($file->getClientOriginalName())->prepend('bus' . '-' . now()->timestamp . '-'),
                            )
                            ->multiple()
                            ->maxSize(1024)
                            ->imageEditor()
                            ->image()
                            ->required()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Armada')
                    ->searchable()
                    ->formatStateUsing(function (Bus $bus) {
                        return ucwords($bus->name);
                    }),
                TextColumn::make('type')
                    ->label('Jenis Armada')
                    ->searchable(),
                TextColumn::make('seat_total')
                    ->label('Seat Set')
                    ->searchable(),
                TextColumn::make('pic')
                    ->label('PIC')
                    ->searchable()
                ,
                PhoneColumn::make('pic_phone')
                    ->displayFormat(PhoneInputNumberType::E164)
                    ->label('Kontak PIC')
                    ->searchable()
                ,
                ImageColumn::make('image')
                    ->label('Foto Bus')
                    ->width(200)
                    ->height(150)
                    // ->stacked()
                    ->limit(2)
                    ->limitedRemainingText(size: 'lg')
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListBuses::route('/'),
            'create' => Pages\CreateBus::route('/create'),
            'view' => Pages\ViewBus::route('/{record}'),
            'edit' => Pages\EditBus::route('/{record}/edit'),
        ];
    }
}
