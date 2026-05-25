<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use Filament\Resources\Pages\CreateRecord;
use Override;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    #[Override]
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
