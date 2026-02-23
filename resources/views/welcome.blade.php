<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ледовый каток</title>
    <link rel="stylesheet" href="{{asset('style.css')}}">
</head>
<body>
<!-- Шапка -->
<header class="header">
    <div class="container header-content">
        <a href="/" class="logo">
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
            <form>
                <div class="form-grid">
                    <!-- ФИО -->
                    <div class="form-group">
                        <label class="form-label">ФИО *</label>
                        <input type="text" class="form-input" placeholder="Иванов Иван Иванович" required>
                    </div>

                    <!-- Телефон с маской -->
                    <div class="form-group">
                        <label class="form-label">Телефон *</label>
                        <input type="tel" class="form-input" placeholder="+7 (___) ___-__-__"
                               pattern="\+7\s?[\(]?\d{3}[\)]?\s?\d{3}[\-]?\d{2}[\-]?\d{2}"
                               required>
                    </div>

                    <!-- Часы аренды -->
                    <div class="form-group">
                        <label class="form-label">Количество часов *</label>
                        <select class="form-select" required>
                            <option value="" disabled selected>Выберите время</option>
                            <option value="1">1 час - 150₽</option>
                            <option value="2">2 часа - 300₽</option>
                            <option value="3">3 часа - 450₽</option>
                            <option value="4">4 часа - 600₽</option>
                        </select>
                    </div>

                    <!-- Выбор коньков (необязательно) -->
                    <div class="checkbox-wrapper">
                        <input type="checkbox" id="withSkates">
                        <label for="withSkates" class="checkbox"></label>
                        <span>Мне нужны коньки (дополнительно 150₽/час)</span>
                    </div>

                    <div class="optional-block" id="skatesBlock">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Модель коньков</label>
                                <select class="form-select">
                                    <option value="" disabled selected>Выберите модель</option>
                                    <option>Bauer Vapor X3</option>
                                    <option>CCM Jetspeed</option>
                                    <option>Bauer Supreme</option>
                                    <option>CCM Tacks</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Размер</label>
                                <select class="form-select">
                                    <option value="" disabled selected>Выберите размер</option>
                                    <option>36</option>
                                    <option>37</option>
                                    <option>38</option>
                                    <option>39</option>
                                    <option>40</option>
                                    <option>41</option>
                                    <option>42</option>
                                    <option>43</option>
                                    <option>44</option>
                                    <option>45</option>
                                </select>
                            </div>
                        </div>
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
        <a href="/" class="logo">
            ICE<span>ARENA</span>
        </a>

        <div class="footer-links">
            <a href="#" class="footer-link">О нас</a>
            <a href="#" class="footer-link">Цены</a>
            <a href="#" class="footer-link">Бронирование</a>
            <a href="#" class="footer-link">Контакты</a>
        </div>

        <div style="color: var(--text-gray);">
            © 2026 ICEARENA
        </div>
    </div>
</footer>

<script>
    // Простая маска для телефона
    document.querySelector('input[type="tel"]')?.addEventListener('input', function(e) {
        let x = e.target.value.replace(/\D/g, '').match(/(\d{0,1})(\d{0,3})(\d{0,3})(\d{0,2})(\d{0,2})/);
        e.target.value = '+7 ' + (x[2] ? '(' + x[2] : '') + (x[3] ? ') ' + x[3] : '') + (x[4] ? '-' + x[4] : '') + (x[5] ? '-' + x[5] : '');
    });
</script>
</body>
</html>
