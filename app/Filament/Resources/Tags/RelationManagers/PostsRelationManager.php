<?php

namespace App\Filament\Resources\Tags\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PostsRelationManager extends RelationManager
{
    protected static string $relationship = 'posts';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Post Information')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->placeholder('Enter category title')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, $state) {
                                $set('slug', str()->slug($state));
                            }),

                        TextInput::make("slug")
                            ->required()
                            ->placeholder('auto-generated-from-title')
                            ->disabled()
                            ->dehydrated(),

                        Select::make('category_id')
                            ->label('Category')
                            ->relationship(name: 'category', titleAttribute: 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('tags')
                            ->label('Tags')
                            ->relationship(name: 'tags', titleAttribute: 'name')
                            ->multiple()
                            ->searchable()
                            ->preload(),

                        SpatieMediaLibraryFileUpload::make("Image"),

                        Toggle::make("is_published"),

                        Textarea::make("content")->required(),
                    ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                SpatieMediaLibraryImageColumn::make('Image')
                    ->label('Image')
                    ->circular()
                ,
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(30),

                TextColumn::make('slug')
                    ->searchable()
                    ->color('gray')
                    ->limit(30),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->sortable(),

                TextColumn::make('tags.name')
                    ->label('Tags')
                    ->badge()
                    ->sortable(),

                IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AttachAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DetachAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
