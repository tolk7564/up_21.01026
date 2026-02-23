<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\SkateSize;
use App\MoonShine\Resources\SkateResource;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;

/**
 * @extends ModelResource<SkateSize>
 */
class SkateSizeResource extends ModelResource
{
    protected string $model = SkateSize::class;
    protected string $title = 'Размеры коньков';
    protected array $with = ['skate'];

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Модель коньков', 'skate', resource: SkateResource::class)->sortable(),
            Number::make('Размер', 'size')->sortable(),
            Number::make('Количество', 'quantity')->sortable(),
        ];
    }

    public function formFields(): iterable
    {
        return [
            BelongsTo::make('Модель коньков', 'skate', resource: SkateResource::class)
                ->required()
                ->searchable(),

            Number::make('Размер', 'size')
                ->required()
                ->min(30)
                ->max(50)
                ->buttons(),

            Number::make('Количество', 'quantity')
                ->required()
                ->min(0)
                ->default(0)
                ->buttons(),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            BelongsTo::make('Модель коньков', 'skate', resource: SkateResource::class),
            Number::make('Размер', 'size'),
            Number::make('Количество', 'quantity'),
        ];
    }

    protected function rules(mixed $item): array
    {
        return [
            'skate_id' => ['required', 'exists:skates,id'],
            'size' => ['required', 'integer', 'min:30', 'max:50'],
            'quantity' => ['required', 'integer', 'min:0'],
        ];
    }
}
