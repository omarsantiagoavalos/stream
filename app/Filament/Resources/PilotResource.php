<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PilotResource\Pages;
use App\Filament\Resources\PilotResource\RelationManagers;
use App\Models\Pilot;
use Filament\Forms;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PilotResource extends Resource
{
    protected static ?string $navigationLabel = 'Pilotos';
    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'delete',
            'delete_any',
            'publish'
        ];
    }
    protected static ?string $model = Pilot::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_employee')
                    ->label('Numero de Empleado')
                    ->required()
                    ->numeric()
                    ->unique(Pilot::class, 'id_employee', ignoreRecord: true),
                Forms\Components\TextInput::make('name')
                    ->label('Nombre Completo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('gender')
                    ->label('Genero')
                    ->required()
                    ->options([
                        'Masculino' => 'Masculino',
                        'Femenino' => 'Femenino',
                    ]),
                Forms\Components\FileUpload::make('image')
                    ->label('Fotografia')

                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('streaming_key')
                    ->label('Clave de Streaming')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('status')
                    ->label('Estatus')
                    ->required()
                    ->options([
                        'Online' => 'Online',
                        'Offline' => 'Offline',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_employee')
                ->label('Numero de Empleado')
                    ->searchable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre Completo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->label('Genero')
                    ->searchable(),

                Tables\Columns\ImageColumn::make('image')
                    ->label('Fotografia')
                    ->circular(),
                Tables\Columns\TextColumn::make('streaming_key')
                    ->label('Clave de Streaming')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    Tables\Columns\ToggleColumn::make('status')
                    ->label('Estatus')
                    ->onColor('success')  // Verde cuando está activo (Online)
                    ->offColor('danger')  // Rojo cuando está desactivado (Offline)
                    ->sortable()
                    ->getStateUsing(function ($record) {
                        // Aquí le pasas el valor actual del 'status' en la base de datos
                        return $record->status === 'Online';  // Si el 'status' es 'Online', se activará el toggle
                    })
                    ->afterStateUpdated(function ($record, $state) {
                        // Actualiza el valor de 'status' según el estado del toggle (Online o Offline)
                        $record->update(['status' => $state ? 'Online' : 'Offline']);
                    }),
                




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
            'index' => Pages\ListPilots::route('/'),
            'create' => Pages\CreatePilot::route('/create'),
            'edit' => Pages\EditPilot::route('/{record}/edit'),
        ];
    }
}
