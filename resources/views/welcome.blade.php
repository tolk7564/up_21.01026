<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ледовый каток</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <style>
        /* Добавим стили для сообщений об ошибках */
        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 16px;
            border-radius: var(--radius-sm);
            margin-bottom: 24px;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            padding: 16px;
            border-radius: var(--radius-sm);
            margin-bottom: 24px;
            border: 1px solid #f5c6cb;
        }

        .error {
            color: #dc3545;
            font-size: 14px;
            margin-top: 4px;
        }

        .form-input.error,
        .form-select.error {
            border-color: #dc3545;
        }
    </style>
</head>
<body>
<!-- Шапка -->
<header class="header">
    <div class="container header-content">
        <a href="{{ route('home') }}" class="logo">
            ICE<span>ARENA</span>
        </a>

        <nav class="nav">
            <a href="#about" class="nav-link">О нас</a>
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
    <!-- Сообщения об ошибках и успехе -->
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert-error">
            <ul style="margin-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Герой -->
    <section class="hero">
        <h1 class="hero-title">Добро пожаловать на лёд</h1>
        <p class="hero-text">Современный ледовый каток в центре города. Профессиональное оборудование, уютная атмосфера и отличное настроение</p>
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
                <div class="card-price">300₽ <small>разово</small></div>
                <p style="margin-bottom: 24px; color: var(--text-gray);">Неограниченное время на катке</p>
                <button class="btn btn-primary" style="width: 100%;" onclick="document.getElementById('ticket').scrollIntoView({behavior: 'smooth'})">
                    Купить билет
                </button>
            </div>

            <div class="card">
                <h3 class="card-title">Аренда коньков</h3>
                <div class="card-price">150₽ <small>/ час</small></div>
                <p style="margin-bottom: 24px; color: var(--text-gray);">Профессиональные коньки любых размеров</p>
                <button class="btn btn-outline" style="width: 100%;" onclick="document.getElementById('booking').scrollIntoView({behavior: 'smooth'})">
                    Забронировать
                </button>
            </div>

            <div class="card">
                <h3 class="card-title">Свои коньки</h3>
                <div class="card-price">0₽</div>
                <p style="margin-bottom: 24px; color: var(--text-gray);">Заточка коньков - 200₽</p>
                <button class="btn btn-outline" style="width: 100%;" onclick="document.getElementById('booking').scrollIntoView({behavior: 'smooth'})">
                    Записаться
                </button>
            </div>
        </div>
    </section>

    <!-- Покупка билета -->
    <section id="ticket">
        <h2 class="section-title">Купить <span>билет</span></h2>

        <div class="form">
            <h3 class="form-title">Вход на каток</h3>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Стоимость входа</label>
                    <div style="font-size: 32px; font-weight: 700; color: var(--primary);">300 ₽</div>
                </div>

                <button class="btn btn-primary btn-large" style="width: 100%; margin-top: 16px;">
                    Оплатить вход
                </button>

                <p style="text-align: center; color: var(--text-gray); font-size: 14px;">
                    После оплаты вы получите доступ на каток
                </p>
            </div>
        </div>
    </section>

    <!-- Форма бронирования коньков -->
    <section id="booking">
        <h2 class="section-title">Бронирование <span>коньков</span></h2>

        <div class="form">
            <form action="{{ route('booking.store') }}" method="POST">
                @csrf
                <div class="form-grid">
                    <!-- ФИО -->
                    <div class="form-group">
                        <label class="form-label">ФИО *</label>
                        <input type="text"
                               name="full_name"
                               class="form-input @error('full_name') error @enderror"
                               value="{{ old('full_name') }}"
                               placeholder="Иванов Иван Иванович"
                               required>
                        @error('full_name')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Телефон с маской -->
                    <div class="form-group">
                        <label class="form-label">Телефон *</label>
                        <input type="tel"
                               name="phone"
                               id="phone"
                               class="form-input @error('phone') error @enderror"
                               value="{{ old('phone') }}"
                               placeholder="+7 (___) ___-__-__"
                               required>
                        @error('phone')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Часы аренды -->
                    <div class="form-group">
                        <label class="form-label">Количество часов *</label>
                        <select name="hours" class="form-select @error('hours') error @enderror" required>
                            <option value="" disabled {{ old('hours') ? '' : 'selected' }}>Выберите время</option>
                            <option value="1" {{ old('hours') == '1' ? 'selected' : '' }}>1 час - 150₽</option>
                            <option value="2" {{ old('hours') == '2' ? 'selected' : '' }}>2 часа - 300₽</option>
                            <option value="3" {{ old('hours') == '3' ? 'selected' : '' }}>3 часа - 450₽</option>
                            <option value="4" {{ old('hours') == '4' ? 'selected' : '' }}>4 часа - 600₽</option>
                        </select>
                        @error('hours')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Выбор коньков (необязательно) -->
                    <div class="checkbox-wrapper">
                        <input type="checkbox"
                               name="with_skates"
                               id="withSkates"
                               value="1"
                            {{ old('with_skates') ? 'checked' : '' }}>
                        <label for="withSkates" class="checkbox"></label>
                        <span>Мне нужны коньки (дополнительно 150₽/час)</span>
                    </div>

                    <div class="optional-block" id="skatesBlock"
                         style="{{ old('with_skates') ? 'display: block;' : '' }}">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Модель коньков</label>
                                <select name="skate_id"
                                        id="skate_id"
                                        class="form-select @error('skate_id') error @enderror">
                                    <option value="" disabled selected>Выберите модель</option>
                                    @foreach($skates as $skate)
                                        <option value="{{ $skate->id }}"
                                            {{ old('skate_id') == $skate->id ? 'selected' : '' }}>
                                            {{ $skate->name }} ({{ $skate->brand }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('skate_id')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Размер</label>
                                <select name="skate_size"
                                        id="skate_size"
                                        class="form-select @error('skate_size') error @enderror">
                                    <option value="" disabled selected>Сначала выберите модель</option>
                                </select>
                                @error('skate_size')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Информация о наличии -->
                        <div id="availabilityInfo" style="margin-top: 16px; padding: 12px; border-radius: var(--radius-sm); display: none;"></div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-large" style="width: 100%; margin-top: 16px;">
                        Забронировать
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Контакты -->
    <section id="contacts" style="text-align: center;">
        <h2 class="section-title">Как <span>найти</span></h2>

        <div style="display: flex; justify-content: center; gap: 32px; flex-wrap: wrap;">
            <div class="card" style="min-width: 250px;">
                <h4 style="margin-bottom: 16px;">Адрес</h4>
                <p style="color: var(--text-gray);">ул. Ледовая, 1</p>
            </div>

            <div class="card" style="min-width: 250px;">
                <h4 style="margin-bottom: 16px;">Режим работы</h4>
                <p style="color: var(--text-gray);">Ежедневно 10:00 - 22:00</p>
            </div>

            <div class="card" style="min-width: 250px;">
                <h4 style="margin-bottom: 16px;">Телефон</h4>
                <p style="color: var(--text-gray);">+7 (999) 123-45-67</p>
            </div>
        </div>
    </section>
</main>

<!-- Футер -->
<footer class="footer">
    <div class="container footer-content">
        <a href="{{ route('home') }}" class="logo">
            ICE<span>ARENA</span>
        </a>

        <div class="footer-links">
            <a href="#about" class="footer-link">О нас</a>
            <a href="#prices" class="footer-link">Цены</a>
            <a href="#booking" class="footer-link">Бронирование</a>
            <a href="#contacts" class="footer-link">Контакты</a>
        </div>

        <div style="color: var(--text-gray);">
            © 2026 ICEARENA
        </div>
    </div>
</footer>

<script>
    // Маска для телефона
    document.getElementById('phone')?.addEventListener('input', function(e) {
        let x = e.target.value.replace(/\D/g, '').match(/(\d{0,1})(\d{0,3})(\d{0,3})(\d{0,2})(\d{0,2})/);
        e.target.value = '+7 ' + (x[2] ? '(' + x[2] : '') + (x[3] ? ') ' + x[3] : '') + (x[4] ? '-' + x[4] : '') + (x[5] ? '-' + x[5] : '');
    });

    // Показываем/скрываем блок выбора коньков
    document.getElementById('withSkates')?.addEventListener('change', function() {
        const block = document.getElementById('skatesBlock');
        block.style.display = this.checked ? 'block' : 'none';

        // Делаем поля необязательными если сняли галочку
        document.getElementById('skate_id').required = this.checked;
        document.getElementById('skate_size').required = this.checked;
    });

    // Загружаем размеры при выборе модели
    document.getElementById('skate_id')?.addEventListener('change', function() {
        const skateId = this.value;
        const sizeSelect = document.getElementById('skate_size');
        const availabilityInfo = document.getElementById('availabilityInfo');

        if (!skateId) {
            sizeSelect.innerHTML = '<option value="" disabled selected>Сначала выберите модель</option>';
            availabilityInfo.style.display = 'none';
            return;
        }

        // Данные о размерах из PHP (переданы в шаблон)
        const skates = @json($skates);
        const selectedSkate = skates.find(s => s.id == skateId);

        if (selectedSkate && selectedSkate.sizes) {
            let options = '<option value="" disabled selected>Выберите размер</option>';

            // Сортируем размеры по порядку
            const sortedSizes = selectedSkate.sizes.sort((a, b) => a.size - b.size);

            sortedSizes.forEach(item => {
                const disabled = item.quantity < 1 ? 'disabled' : '';
                const label = item.quantity < 1 ? `${item.size} (нет в наличии)` : item.size;
                const selected = {{ old('skate_size') }} == item.size ? 'selected' : '';
                options += `<option value="${item.size}" ${disabled} ${selected}>${label}</option>`;
            });

            sizeSelect.innerHTML = options;

            // Если был выбран старый размер, показываем информацию о наличии
            if ({{ old('skate_size') }}) {
                setTimeout(() => {
                    const event = new Event('change');
                    sizeSelect.dispatchEvent(event);
                }, 100);
            }
        }
    });

    // Показываем наличие при выборе размера
    document.getElementById('skate_size')?.addEventListener('change', function() {
        const size = this.value;
        const skateId = document.getElementById('skate_id').value;
        const availabilityInfo = document.getElementById('availabilityInfo');

        if (size && skateId) {
            const skates = @json($skates);
            const selectedSkate = skates.find(s => s.id == skateId);
            const selectedSize = selectedSkate?.sizes.find(s => s.size == size);

            if (selectedSize) {
                availabilityInfo.style.display = 'block';

                if (selectedSize.quantity > 0) {
                    availabilityInfo.style.background = '#d4edda';
                    availabilityInfo.style.color = '#155724';
                    availabilityInfo.style.border = '1px solid #c3e6cb';
                    availabilityInfo.textContent = `✓ В наличии: ${selectedSize.quantity} пар`;
                } else {
                    availabilityInfo.style.background = '#f8d7da';
                    availabilityInfo.style.color = '#721c24';
                    availabilityInfo.style.border = '1px solid #f5c6cb';
                    availabilityInfo.textContent = '✗ Нет в наличии';
                }
            }
        } else {
            availabilityInfo.style.display = 'none';
        }
    });

    // Загружаем размеры при загрузке страницы, если была выбрана модель
    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('skate_id').value) {
            const event = new Event('change');
            document.getElementById('skate_id').dispatchEvent(event);
        }

        // Устанавливаем required для полей если галочка стоит
        if (document.getElementById('withSkates').checked) {
            document.getElementById('skate_id').required = true;
            document.getElementById('skate_size').required = true;
        }
    });
</script>
</body>
</html>
