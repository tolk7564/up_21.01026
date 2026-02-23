<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Бронирование подтверждено</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
<header class="header">
    <div class="container header-content">
        <a href="{{ route('home') }}" class="logo">
            ICE<span>ARENA</span>
        </a>
    </div>
</header>

<main class="container">
    <section style="text-align: center; padding: 60px 0;">
        <div style="font-size: 80px; color: var(--primary); margin-bottom: 24px;">✓</div>

        <h1 class="section-title">Спасибо, <span>{{ $booking->full_name }}</span>!</h1>

        <div class="form" style="max-width: 500px;">
            <h3 style="margin-bottom: 24px;">Детали бронирования</h3>

            <div style="text-align: left; margin-bottom: 32px;">
                <p><strong>Номер брони:</strong> #{{ $booking->id }}</p>
                <p><strong>Телефон:</strong> {{ $booking->phone }}</p>
                <p><strong>Часов аренды:</strong> {{ $booking->hours }}</p>
                @if($booking->skate_id)
                    <p><strong>Коньки:</strong> {{ $booking->skate->name }} (размер {{ $booking->skate_size }})</p>
                @endif
                <p><strong>Статус:</strong>
                    @if($booking->status == 'pending')
                        Ожидает оплаты
                    @elseif($booking->status == 'paid')
                        Оплачено
                    @else
                        {{ $booking->status }}
                    @endif
                </p>
                <p><strong>К оплате:</strong> {{ $booking->total_price }}₽</p>
            </div>

            <a href="{{ route('home') }}" class="btn btn-primary" style="width: 100%;">На главную</a>
        </div>
    </section>
</main>
</body>
</html>
