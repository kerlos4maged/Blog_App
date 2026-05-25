<?php

namespace App\Filament\Resources\Tags\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;

class TagForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                Section::make('Tag Information')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->placeholder('Enter tag name')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, $state) {
                                $set('slug', str()->slug($state));
                            }),

                        TextInput::make("slug")->required()->placeholder('auto-generated-from-name')->disabled()->dehydrated(),
                    ])
            ]);
    }
}
