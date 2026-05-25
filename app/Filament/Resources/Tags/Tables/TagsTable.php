<?php

namespace App\Filament\Resources\Tags\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TagsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(30),

                TextColumn::make('slug')
                    ->searchable()
                    ->color('gray')
                    ->limit(30),

            ])
            ->filters([
                //

            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
