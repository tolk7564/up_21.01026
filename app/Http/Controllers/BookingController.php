<?php
// app/Http/Controllers/BookingController.php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Skate;
use App\Models\SkateSize;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Показать главную страницу с формой бронирования
     */
    public function show()
    {
        // Получаем все активные модели коньков с их размерами
        $skates = Skate::with('sizes')
            ->where('is_active', true)
            ->get();

        return view('welcome', compact('skates'));
    }

    /**
     * Сохранить бронирование
     */
    public function store(Request $request)
    {
        // Валидация данных из формы
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'hours' => 'required|in:1,2,3,4',
            'with_skates' => 'nullable|boolean',
            'skate_id' => 'required_if:with_skates,true|exists:skates,id',
            'skate_size' => 'required_if:with_skates,true|integer|min:30|max:50',
        ]);

        // Базовая стоимость - входной билет 300₽
        $totalPrice = 300;

        // Если выбрана аренда коньков, добавляем стоимость
        if (!empty($validated['with_skates'])) {
            $totalPrice += $validated['hours'] * 150;

            // Проверяем наличие выбранных коньков на складе
            $skateSize = SkateSize::where('skate_id', $validated['skate_id'])
                ->where('size', $validated['skate_size'])
                ->first();

            if (!$skateSize || $skateSize->quantity < 1) {
                return back()->withErrors([
                    'skate_size' => 'Выбранного размера нет в наличии'
                ])->withInput();
            }
        }

        // Создаем запись в базе данных
        $booking = Booking::create([
            'full_name' => $validated['full_name'],
            'phone' => $validated['phone'],
            'hours' => $validated['hours'],
            'skate_id' => $validated['skate_id'] ?? null,
            'skate_size' => $validated['skate_size'] ?? null,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        return redirect()->route('booking.success', $booking)
            ->with('success', 'Бронирование успешно создано!');
    }

    /**
     * Показать страницу успеха
     */
    public function success(Booking $booking)
    {
        return view('booking.success', compact('booking'));
    }
}
