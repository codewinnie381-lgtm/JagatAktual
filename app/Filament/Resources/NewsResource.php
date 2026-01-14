<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Resources\NewsResource\RelationManagers;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class NewsResource extends Resource
{
    
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    public static function canEdit(Model $record): bool
    {
        return auth()->user()->can('update', $record);
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->can('delete', $record);
    }
    /* =========================
     * FORM
     * ========================= */
    public static function form(Form $form): Form
    {
        return $form->schema([
            // AUTHOR (HANYA ADMIN)
            Forms\Components\Select::make('author_id')
                ->relationship('author', 'name')
                ->required()
                ->visible(fn () => auth()->user()->role === 'admin'),

            // AUTO AUTHOR UNTUK AUTHOR
            Forms\Components\Hidden::make('author_id')
                ->default(fn () => auth()->id())
                ->visible(fn () => auth()->user()->role === 'author'),

            Forms\Components\Select::make('news_category_id')
                ->relationship('newsCategory', 'title')
                ->required(),

            Forms\Components\TextInput::make('title')
                ->live(onBlur: true)
                ->afterStateUpdated(fn (Set $set, ?string $state) =>
                    $set('slug', Str::slug($state))
                )
                ->required(),

            Forms\Components\TextInput::make('slug')
                ->readOnly(),

            Forms\Components\FileUpload::make('thumbnail')
                ->image()
                ->required()
                ->columnSpanFull(),

            Forms\Components\RichEditor::make('content')
                ->required()
                ->columnSpanFull(),

            Forms\Components\Toggle::make('is_featured')
                ->visible(fn () => auth()->user()->role === 'admin'),
        ]);
    }

    /* =========================
     * QUERY (BATASI AUTHOR)
     * ========================= */
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (auth()->user()->role === 'author') {
            $query->where('author_id', auth()->id());
        }

        return $query;
    }

    /* =========================
     * TABLE
     * ========================= */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('author.name')->label('Author'),
                Tables\Columns\TextColumn::make('newsCategory.title')->label('Category'),
                Tables\Columns\TextColumn::make('title')->limit(40),
                Tables\Columns\ImageColumn::make('thumbnail'),
                Tables\Columns\ToggleColumn::make('is_featured')
                    ->visible(fn () => auth()->user()->role === 'admin'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),

                Tables\Actions\EditAction::make()
                    ->visible(fn ($record) =>
                        auth()->user()->role === 'admin'
                        || $record->author_id === auth()->id()
                    ),

                Tables\Actions\DeleteAction::make()
                    ->visible(fn ($record) =>
                        auth()->user()->role === 'admin'
                        || $record->author_id === auth()->id()
                    ),
            ]);
    }

    /* =========================
     * PAGES
     * ========================= */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
