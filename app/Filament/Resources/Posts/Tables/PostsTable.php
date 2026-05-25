<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
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

                TextColumn::make('created_at')->label('Created')->dateTime('M d, Y')->sortable()->color('gray'),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('published')
                    ->label('Published')
                    ->options([
                        '1' => 'Published',
                        '0' => 'Draft',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped();

    }
}
