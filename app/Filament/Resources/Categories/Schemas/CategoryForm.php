<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Category Information')
                    ->description('Add or edit category details')
                    ->icon('heroicon-o-rectangle-stack')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->placeholder('Enter category name')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, $state) {
                                $set('slug', str()->slug($state));
                            }),

                        TextInput::make('slug')
                            ->required()
                            ->placeholder('auto-generated-from-name')
                            ->disabled()
                            ->dehydrated(),
                    ])->columns(2),
            ]);
    }
}
