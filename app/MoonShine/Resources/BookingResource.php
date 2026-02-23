<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Booking;
use App\MoonShine\Resources\SkateResource;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Select;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\UI\Fields\Date;

/**
 * @extends ModelResource<Booking>
 */
class BookingResource extends ModelResource
{
    protected string $model = Booking::class;

    protected string $title = 'Бронирования';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('ФИО', 'full_name')->sortable(),
            Text::make('Телефон', 'phone')->sortable(),
            Number::make('Часов', 'hours')->sortable(),
            Select::make('Статус', 'status')->options([
                'pending' => 'Ожидает',
                'paid' => 'Оплачено',
                'cancelled' => 'Отменено',
            ])->sortable(),
            Date::make('Создано', 'created_at')->format('d.m.Y')->sortable(),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                Grid::make([
                    Column::make([
                        Text::make('ФИО', 'full_name')->required(),
                        Text::make('Телефон', 'phone')->required(),
                        Number::make('Часов аренды', 'hours')->required()->min(1)->max(24),
                    ])->columnSpan(6),

                    Column::make([
                        Select::make('Статус', 'status')->options([
                            'pending' => 'Ожидает',
                            'paid' => 'Оплачено',
                            'cancelled' => 'Отменено',
                        ])->default('pending'),
                        Number::make('Сумма', 'total_price')->min(0)->step(0.01),
                    ])->columnSpan(6),
                ]),

                Grid::make([
                    Column::make([
                        BelongsTo::make('Коньки', 'skate', resource: SkateResource::class)
                            ->nullable()
                            ->searchable(),
                    ])->columnSpan(6),

                    Column::make([
                        Number::make('Размер', 'skate_size')->nullable()->min(30)->max(50),
                    ])->columnSpan(6),
                ]),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('ФИО', 'full_name'),
            Text::make('Телефон', 'phone'),
            Number::make('Часов', 'hours'),
            Select::make('Статус', 'status')->options([
                'pending' => 'Ожидает',
                'paid' => 'Оплачено',
                'cancelled' => 'Отменено',
            ]),
            Number::make('Сумма', 'total_price'),
            BelongsTo::make('Коньки', 'skate', resource: SkateResource::class),
            Number::make('Размер', 'skate_size'),
            Date::make('Создано', 'created_at')->format('d.m.Y H:i'),
        ];
    }

    protected function rules(mixed $item): array
    {
        return [
            'full_name' => 'required|min:3|max:255',
            'phone' => 'required|max:20',
            'hours' => 'required|integer|min:1|max:24',
            'status' => 'required|in:pending,paid,cancelled',
            'skate_id' => 'nullable|exists:skates,id',
            'skate_size' => 'nullable|integer|min:30|max:50',
            'total_price' => 'nullable|numeric|min:0',
        ];
    }

    protected function filters(): iterable
    {
        return [
            Text::make('ФИО', 'full_name'),
            Select::make('Статус', 'status')->options([
                'pending' => 'Ожидает',
                'paid' => 'Оплачено',
                'cancelled' => 'Отменено',
            ]),
        ];
    }
}
