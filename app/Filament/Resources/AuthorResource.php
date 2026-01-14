<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuthorResource\Pages;
use App\Filament\Resources\AuthorResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;

class AuthorResource extends Resource
{
    public static function shouldRegisterNavigation(): bool
{
    return auth()->user()->role === 'admin';
}
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()
        ->where('role', 'author');
}
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required(),
                Forms\Components\TextInput::make('username')
                ->required(),
                Forms\Components\FileUpload::make('avatar')
                ->image()
                ->required(),
                Forms\Components\Textarea::make('bio')
                ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('email')->searchable(),
            Tables\Columns\TextColumn::make('created_at')->date(),
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
        ]);
    }
public static function canCreate(): bool
{
    return false;
}

public static function canDelete(Model $record): bool
{
    return false;
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
            'index' => Pages\ListAuthors::route('/'),
            'create' => Pages\CreateAuthor::route('/create'),
            'edit' => Pages\EditAuthor::route('/{record}/edit'),
        ];
    }
}
