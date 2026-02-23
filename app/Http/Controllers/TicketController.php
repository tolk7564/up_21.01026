<?php
// app/Http/Controllers/TicketController.php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'price' => 'required|numeric|min:0',
        ]);

        // Создаем запись о покупке билета (используем ту же модель Booking)
        $ticket = Booking::create([
            'full_name' => $validated['full_name'],
            'phone' => $validated['phone'],
            'hours' => 0, // 0 часов аренды, только вход
            'total_price' => $validated['price'],
            'status' => 'pending',
        ]);

        return redirect()->route('home')->with('success', 'Билет успешно оформлен!');
    }
}
