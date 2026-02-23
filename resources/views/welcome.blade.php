<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ледовый каток</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
<!-- Шапка -->
<header class="header">
    <div class="container header-content">
        <a href="/" class="logo">ICE<span>ARENA</span></a>
        <nav class="nav">
            <a href="#prices" class="nav-link">Цены</a>
            <a href="#booking" class="nav-link">Бронирование</a>
            <a href="#contacts" class="nav-link">Контакты</a>
        </nav>
        <button class="btn btn-primary" onclick="document.getElementById('ticket').scrollIntoView({behavior: 'smooth'})">
            Купить билет
        </button>
    </div>
</header>

<main class="container">
    <!-- Герой -->
    <section class="hero">
        <h1 class="hero-title">Добро пожаловать на лёд</h1>
        <p class="hero-text">Современный ледовый каток в центре города</p>
        <button class="btn btn-outline btn-large" onclick="document.getElementById('booking').scrollIntoView({behavior: 'smooth'})">
            Забронировать коньки
        </button>
    </section>

    <!-- Цены -->
    <section id="prices">
        <h2 class="section-title">Наши <span>цены</span></h2>
        <div class="cards-grid">
            <div class="card">
                <h3 class="card-title">Входной билет</h3>
                <div class="card-price">300₽</div>
                <button class="btn btn-primary" style="width: 100%;" onclick="document.getElementById('ticket').scrollIntoView({behavior: 'smooth'})">
                    Купить билет
                </button>
            </div>
            <div class="card">
                <h3 class="card-title">Аренда коньков</h3>
                <div class="card-price">150₽ <small>/ час</small></div>
                <button class="btn btn-outline" style="width: 100%;" onclick="document.getElementById('booking').scrollIntoView({behavior: 'smooth'})">
                    Забронировать
                </button>
            </div>
        </div>
    </section>

    <!-- Покупка билета -->
    <section id="ticket">
        <h2 class="section-title">Купить <span>билет</span></h2>
        <div class="form">
            <h3 class="form-title">Вход на каток</h3>
            <div style="font-size: 32px; color: var(--primary); text-align: center; margin-bottom: 20px;">300 ₽</div>
            <button class="btn btn-primary btn-large" style="width: 100%;">Оплатить вход</button>
        </div>
    </section>

    <!-- Форма бронирования -->
    <section id="booking">
        <h2 class="section-title">Бронирование <span>коньков</span></h2>
        <div class="form">
            <form action="{{ route('booking.store') }}" method="POST">
                @csrf

                <!-- ФИО -->
                <div class="form-group">
                    <label class="form-label">ФИО *</label>
                    <input type="text" name="full_name" class="form-input" value="{{ old('full_name') }}" placeholder="Иванов Иван Иванович" required>
                </div>

                <!-- Телефон с маской -->
                <div class="form-group">
                    <label class="form-label">Телефон *</label>
                    <input type="tel" name="phone" id="phone" class="form-input" value="{{ old('phone') }}" placeholder="+7 (___) ___-__-__" maxlength="18" required>
                </div>

                <!-- Часы аренды -->
                <div class="form-group">
                    <label class="form-label">Часов аренды *</label>
                    <select name="hours" class="form-select" required>
                        <option value="1">1 час - 150₽</option>
                        <option value="2">2 часа - 300₽</option>
                        <option value="3">3 часа - 450₽</option>
                        <option value="4">4 часа - 600₽</option>
                    </select>
                </div>

                <!-- Коньки? -->
                <div style="margin: 20px 0;">
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                        <input type="checkbox" name="with_skates" id="withSkates" value="1" {{ old('with_skates') ? 'checked' : '' }}>
                        <span>Мне нужны коньки (+150₽/час)</span>
                    </label>
                </div>

                <!-- Блок выбора коньков -->
                <div id="skatesBlock" style="{{ old('with_skates') ? '' : 'display: none;' }}">
                    <div class="form-group">
                        <label class="form-label">Модель</label>
                        <select name="skate_id" class="form-select">
                            <option value="">-- Не выбрано --</option>
                            @foreach($skates as $skate)
                                <option value="{{ $skate->id }}">{{ $skate->name }} ({{ $skate->brand }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Размер</label>
                        <select name="skate_size" class="form-select">
                            <option value="">-- Не выбрано --</option>
                            @foreach(range(36, 45) as $size)
                                <option value="{{ $size }}">{{ $size }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Кнопка отправки -->
                <button type="submit" class="btn btn-primary btn-large" style="width: 100%; margin-top: 20px;">
                    Забронировать
                </button>
            </form>
        </div>
    </section>

    <!-- Контакты -->
    <section id="contacts" style="text-align: center;">
        <h2 class="section-title">Контакты</h2>
        <div style="display: flex; justify-content: center; gap: 30px; flex-wrap: wrap;">
            <div class="card">ул. Ледовая, 1</div>
            <div class="card">10:00 - 22:00</div>
            <div class="card">+7 (999) 123-45-67</div>
        </div>
    </section>
</main>

<!-- Футер -->
<footer class="footer">
    <div class="container footer-content">
        <a href="/" class="logo">ICE<span>ARENA</span></a>
        <div>© 2026</div>
    </div>
</footer>

<!-- Простые скрипты -->
<script>
    // 1. Маска для телефона (работает просто и надежно)
    const phoneInput = document.getElementById('phone');

    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            // Удаляем все кроме цифр
            let numbers = this.value.replace(/\D/g, '');

            // Если первая цифра не 7, добавляем 7
            if (numbers.length > 0 && numbers[0] !== '7') {
                numbers = '7' + numbers;
            }

            // Ограничиваем длину
            if (numbers.length > 11) {
                numbers = numbers.slice(0, 11);
            }

            // Форматируем
            let result = '+7';

            if (numbers.length > 1) {
                result += ' (' + numbers.slice(1, 4);
            }
            if (numbers.length >= 5) {
                result += ') ' + numbers.slice(4, 7);
            }
            if (numbers.length >= 8) {
                result += '-' + numbers.slice(7, 9);
            }
            if (numbers.length >= 10) {
                result += '-' + numbers.slice(9, 11);
            }

            this.value = result;
        });
    }

    // 2. Показать/скрыть блок с коньками
    document.getElementById('withSkates')?.addEventListener('change', function() {
        document.getElementById('skatesBlock').style.display = this.checked ? 'block' : 'none';
    });
</script>

<!-- Сообщения об ошибках и успехе -->
@if($errors->any())
    <div style="position: fixed; bottom: 20px; right: 20px; background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; z-index: 1000;">
        <ul style="margin: 0; padding-left: 20px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('success'))
    <div style="position: fixed; bottom: 20px; right: 20px; background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; z-index: 1000;">
        {{ session('success') }}
    </div>
@endif
</body>
</html>
