<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Destination;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DestinationResource\Pages;
use App\Filament\Resources\DestinationResource\RelationManagers;
use App\Enums\DestinationType;

class DestinationResource extends Resource
{
    protected static ?string $model = Destination::class;
    protected static ?string $slug = 'destinasi';

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $label = 'Destinasi';
    protected static ?string $navigationLabel = 'Destinasi';
    protected static ?string $navigationGroup = 'Data Inventaris';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label('Destinasi')
                            ->placeholder('Destinasi')
                            ->required(),
                        Select::make('type')
                            ->label('Type')
                            ->options(DestinationType::class)
                            ->required(),
                        TextInput::make('marketing_name')
                            ->label('Marketing Name')
                            ->placeholder('Marketing Name')
                            ->required(),
                        TextInput::make('phone_number')
                            ->label('Phone Number')
                            ->placeholder('08234494593')
                            ->tel()
                            ->maxLength(14)
                            ->required(),
                        TextInput::make('weekday_rate')
                            ->label('Weekday Rate')
                            ->placeholder('Weekday Rate')
                            ->numeric()
                            ->minValue(0)
                            ->required(),
                        TextInput::make('weekend_rate')
                            ->label('Weekend Rate')
                            ->placeholder('Weekend Rate')
                            ->numeric()
                            ->minValue(0)
                            ->required(),
                        TextInput::make('high_season_rate')
                            ->label('Highseason Rate')
                            ->placeholder('Highseason Rate')
                            ->numeric()
                            ->minValue(0)
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Destinasi')
                    ->searchable(),
                TextColumn::make('type')
                    ->label('Type')
                    ->searchable(),
                TextColumn::make('marketing_name')
                    ->label('Marketing Name')
                    ->searchable(),
                TextColumn::make('phone_number')
                    ->label('Phone Number')
                    ->searchable(),
                TextColumn::make('weekday_rate')
                    ->label('Weekend Rate')
                    ->searchable(),
                TextColumn::make('weekend_rate')
                    ->label('Weekend Rate')
                    ->searchable(),
                TextColumn::make('high_season_rate')
                    ->label('Highseason Rate')
                    ->searchable(),
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
            'index' => Pages\ListDestinations::route('/'),
            'create' => Pages\CreateDestination::route('/create'),
            'view' => Pages\ViewDestination::route('/{record}'),
            'edit' => Pages\EditDestination::route('/{record}/edit'),
        ];
    }
}
