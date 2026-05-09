<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'GlowBook') }} - Makeup Appointments</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #f91880;
            --primary-soft: #fdf2f8;
            --secondary: #64748b;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --border: #e2e8f0;
            --text-dark: #0f172a;
            --text-light: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--bg);
            color: var(--text-dark);
            min-height: 100vh;
            line-height: 1.5;
        }

        nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            padding: 0.75rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary);
            text-decoration: none;
            letter-spacing: -0.5px;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .nav-links a {
            color: var(--text-light);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: 0.2s;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .btn {
            padding: 0.6rem 1.25rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s ease;
            cursor: pointer;
            border: 1px solid transparent;
            font-size: 0.9rem;
            display: inline-block;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 6px -1px rgba(249, 24, 128, 0.2);
        }

        .btn-primary:hover {
            background: #e01272;
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(249, 24, 128, 0.3);
        }

        .container {
            padding: 3rem 5%;
            max-width: 1280px;
            margin: 0 auto;
        }

        .glass-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
            border-color: var(--primary);
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.25rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--text-dark);
        }

        input, select, textarea {
            width: 100%;
            padding: 0.625rem 1rem;
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text-dark);
            outline: none;
            transition: 0.2s;
            font-size: 0.95rem;
        }

        input:focus {
            border-color: var(--primary);
            ring: 2px solid var(--primary-soft);
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 1rem;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        th {
            font-weight: 600;
            color: var(--text-light);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .badge-pending { background: #fef3c7; color: #92400e; }
        .badge-approved { background: #dcfce7; color: #166534; }
        .badge-completed { background: #d1fae5; color: #065f46; border: 1px solid #6ee7b7; }
        .badge-cancelled { background: #fee2e2; color: #991b1b; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade {
            animation: fadeIn 0.5s ease-out forwards;
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
                    <a href="{{ route('admin.appointments.index') }}">Appointments</a>
                    <a href="{{ route('admin.calendar') }}">Calendar</a>
                    <a href="{{ route('admin.reports') }}">Reports</a>
                    <a href="{{ route('admin.services.index') }}">Services</a>
                @elseif(auth()->user()->role === 'client')
                    <a href="{{ route('client.dashboard') }}">My Bookings</a>
                    <a href="{{ route('client.book') }}">Book Service</a>
                @endif
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn" style="background: transparent; color: var(--text-dark); border: 1px solid var(--border); margin-left: 1rem;">Logout</button>
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
