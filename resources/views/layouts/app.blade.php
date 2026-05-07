<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'GlowBook') }} - Makeup Appointments</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #ff4d94;
            --primary-dark: #e6005c;
            --secondary: #2d3436;
            --accent: #fab1a0;
            --bg: #0f0c29;
            --glass: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --text: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
        }

        nav {
            background: var(--glass);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--glass-border);
            padding: 1rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-links a {
            color: var(--text);
            text-decoration: none;
            font-weight: 400;
            transition: 0.3s;
            opacity: 0.8;
        }

        .nav-links a:hover {
            color: var(--primary);
            opacity: 1;
        }

        .btn {
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 15px rgba(255, 77, 148, 0.3);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .container {
            padding: 2rem 5%;
        }

        .glass-card {
            background: var(--glass);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.37);
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        input, select, textarea {
            width: 100%;
            padding: 0.8rem 1.2rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            color: white;
            outline: none;
            transition: 0.3s;
        }

        input:focus {
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--glass-border);
        }

        th {
            font-weight: 600;
            opacity: 0.7;
        }

        .badge {
            padding: 0.3rem 0.8rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .badge-pending { background: #fdcb6e; color: #000; }
        .badge-approved { background: #00b894; color: #fff; }
        .badge-cancelled { background: #ff7675; color: #fff; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade {
            animation: fadeIn 0.8s ease forwards;
        }
    </style>
</head>
<body>
    <nav>
        <a href="/" class="logo">GlowBook</a>
        <div class="nav-links">
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <a href="{{ route('admin.services.index') }}">Services</a>
                @else
                    <a href="{{ route('client.dashboard') }}">My Bookings</a>
                @endif
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn" style="background: transparent; color: white; border: 1px solid var(--glass-border);">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
            @endauth
        </div>
    </nav>

    <main class="container">
        @if(session('success'))
            <div class="glass-card" style="background: rgba(0, 184, 148, 0.2); margin-bottom: 2rem; border-color: #00b894;">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer style="text-align: center; padding: 2rem; opacity: 0.5; font-size: 0.8rem;">
        &copy; {{ date('Y') }} GlowBook Makeup Services. Built with Elegance.
    </footer>
</body>
</html>
