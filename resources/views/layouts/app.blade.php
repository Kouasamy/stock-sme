<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Stock Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --bg: #0f172a;
            --card-bg: rgba(30, 41, 59, 0.7);
            --sidebar-bg: #1e293b;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border: rgba(255, 255, 255, 0.1);
            --glass: rgba(255, 255, 255, 0.05);
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar */
        aside {
            width: 260px;
            background-color: var(--sidebar-bg);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            padding: 2rem 1.5rem;
            position: fixed;
            height: 100vh;
            transition: transform 0.3s ease;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 3rem;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        nav ul {
            list-style: none;
        }

        nav li {
            margin-bottom: 0.5rem;
        }

        nav a {
            text-decoration: none;
            color: var(--text-muted);
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.2s ease;
        }

        nav a:hover, nav a.active {
            background: var(--glass);
            color: var(--text-main);
            box-shadow: inset 0 0 0 1px var(--border);
        }

        nav a.active {
            background: var(--primary);
            color: white;
        }

        /* Main Content */
        main {
            flex: 1;
            margin-left: 260px;
            padding: 2.5rem;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3rem;
        }

        h1 {
            font-size: 1.875rem;
            font-weight: 700;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: var(--glass);
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            border: 1px solid var(--border);
        }

        /* Dashboard Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .stat-card {
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            padding: 1.5rem;
            border-radius: 1rem;
            border: 1px solid var(--border);
            transition: transform 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-label {
            color: var(--text-muted);
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
        }

        /* Tables */
        .card {
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            border-radius: 1rem;
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 1rem 1.5rem;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        td {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border);
        }

        tr:hover td {
            background: var(--glass);
        }

        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-success { background: rgba(16, 185, 129, 0.1); color: var(--success); }
        .badge-warning { background: rgba(245, 158, 11, 0.1); color: var(--warning); }
        .badge-danger { background: rgba(239, 68, 68, 0.1); color: var(--danger); }

        /* Buttons */
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        @media (max-width: 1024px) {
            aside { transform: translateX(-100%); width: 0; padding: 0; }
            main { margin-left: 0; }
        }
    </style>
    @yield('styles')
</head>
<body>
    @auth
    <aside>
        <div class="logo">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"></path><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path><path d="m3.3 7 8.7 5 8.7-5"></path><path d="M12 22V12"></path></svg>
            StockManager
        </div>
        <nav>
            <ul>
                <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a></li>
                <li><a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}">Produits</a></li>
                <li><a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">Catégories</a></li>
                <li><a href="{{ route('suppliers.index') }}" class="{{ request()->routeIs('suppliers.*') ? 'active' : '' }}">Fournisseurs</a></li>
            </ul>
        </nav>
        <div style="margin-top: auto; padding-top: 2rem;">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn" style="width: 100%; background: rgba(239,68,68,0.1); color: var(--danger); text-align: left; display: flex; align-items: center; gap: 0.75rem;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    Déconnexion
                </button>
            </form>
        </div>
    </aside>
    @endauth

    <main style="{{ Auth::check() ? '' : 'margin-left: 0; padding-top: 5rem;' }}">
        @auth
        <header>
            <h1>@yield('title', 'Tableau de bord')</h1>
            <div class="user-profile">
                <span>{{ Auth::user()->name }}</span>
                <div style="width: 32px; height: 32px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </header>
        @endauth

        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>
