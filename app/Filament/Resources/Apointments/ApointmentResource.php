<?php

namespace App\Filament\Resources\Apointments;

use App\Filament\Resources\Apointments\Pages\ManageApointments;
use App\Models\Apointment;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ApointmentResource extends Resource
{
    protected static ?string $model = Apointment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->unique(Apointment::class, 'email', ignoreRecord: true)
                    ->maxLength(255)
                    ->default(null),
                TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->unique(Apointment::class, 'phone', ignoreRecord: true)
                    ->maxLength(20),
                FileUpload::make('image')
                    ->image()
                    ->required(fn(string $context): bool => $context === 'create')
                    ->default('defaultImageDoctor.jpg'),
                Select::make('status')
                    ->options([
                        0 => 'Pending',
                        1 => 'Confirmed',
                        2 => 'Completed',
                        3 => 'Cancelled',
                    ])
                    ->required()
                    ->default(0),
                Select::make('doctor_id')
                    ->relationship('doctor', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('phone'),
                ImageEntry::make('image'),
                TextEntry::make('status')
                    ->badge()
                    ->formatStateUsing(fn($state) => match ($state) {
                        0 => 'Pending',
                        1 => 'Confirmed',
                        2 => 'Completed',
                        3 => 'Cancelled',
                        default => 'Unknown',
                    })
                    ->color(fn($state) => match ($state) {
                        0 => 'warning',
                        1 => 'info',
                        2 => 'success',
                        3 => 'danger',
                        default => 'gray',
                    }),
                TextEntry::make('doctor.name')
                    ->label('Doctor'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                ImageColumn::make('image'),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn($state) => match ($state) {
                        0 => 'Pending',
                        1 => 'Confirmed',
                        2 => 'Completed',
                        3 => 'Cancelled',
                        default => 'Unknown',
                    })
                    ->color(fn($state) => match ($state) {
                        0 => 'warning',
                        1 => 'info',
                        2 => 'success',
                        3 => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('doctor.name')
                    ->label('Doctor')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageApointments::route('/'),
        ];
    }
}
