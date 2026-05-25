<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;

class PostForm
{
    public static function configure(Schema $schema): Schema
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
}
