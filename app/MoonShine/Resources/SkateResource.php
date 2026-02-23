<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Skate;
use App\MoonShine\Resources\SkateSizeResource;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Switcher;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;

/**
 * @extends ModelResource<Skate>
 */
class SkateResource extends ModelResource
{
    protected string $model = Skate::class;
    protected string $title = 'Коньки';
    protected string $column = 'name';
    protected array $with = ['sizes'];

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Название', 'name')->sortable(),
            Text::make('Бренд', 'brand')->sortable(),
            Switcher::make('Активен', 'is_active')->sortable(),
        ];
    }

    public function formFields(): iterable
    {
        return [
            Text::make('Название', 'name')
                ->required()
                ->placeholder('Введите название модели'),

            Text::make('Бренд', 'brand')
                ->placeholder('Введите бренд'),

            Switcher::make('Активен', 'is_active')
                ->default(true),

            Tabs::make([
                Tab::make('Размеры', [
                    HasMany::make('Размеры', 'sizes', resource: SkateSizeResource::class)
                        ->fields([
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
                        ])
                        ->creatable()
                ]),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Название', 'name'),
            Text::make('Бренд', 'brand'),
            Switcher::make('Активен', 'is_active'),
            HasMany::make('Размеры', 'sizes', resource: SkateSizeResource::class)
                ->fields([
                    Number::make('Размер', 'size'),
                    Number::make('Количество', 'quantity'),
                ]),
        ];
    }

    protected function rules(mixed $item): array
    {
        return [
            'name' => ['required', 'min:3', 'max:255'],
            'brand' => ['nullable', 'max:255'],
            'is_active' => ['boolean'],
        ];
    }

    protected function search(): array
    {
        return ['id', 'name', 'brand'];
    }

    protected function filters(): iterable
    {
        return [
            Text::make('Название', 'name'),
            Text::make('Бренд', 'brand'),
            Switcher::make('Активен', 'is_active'),
        ];
    }
}
