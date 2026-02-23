{{-- resources/views/layouts/app.blade.php --}}
    <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ледовый каток')</title>
    <style>
        /* Стили из предыдущего ответа */
        :root {
            --primary: #40E0D0;
            --primary-dark: #2fc0b0;
            --bg-light: #f8fafc;
            --text-dark: #1e293b;
            --text-gray: #64748b;
            --white: #ffffff;
            --shadow-sm: 0 4px 6px -1px rgb(0 0 0 / 0.05);
            --shadow-md: 0 10px 15px -3px rgb(0 0 0 / 0.05);
            --radius-lg: 24px;
            --radius-md: 16px;
            --radius-sm: 12px;
            --transition: all 0.2s ease;
            --grid-base: 8px;
        }
        /* ... остальные стили из предыдущего ответа ... */

        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 16px;
            border-radius: var(--radius-sm);
            margin-bottom: 24px;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            padding: 16px;
            border-radius: var(--radius-sm);
            margin-bottom: 24px;
        }

        .error {
            color: #dc3545;
            font-size: 14px;
            margin-top: 4px;
        }
    </style>
    @stack('styles')
</head>
<body>
@include('partials.header')

<main class="container">
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

    @yield('content')
</main>

@include('partials.footer')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@stack('scripts')
</body>
</html>
