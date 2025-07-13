<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .sidebar {
            background: linear-gradient(180deg, #8B1538 0%, #A91B47 100%);
            min-height: 100vh;
            width: 250px;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        
        .sidebar .nav-item {
            margin: 10px 0;
        }
        
        .sidebar .nav-link {
            color: white;
            padding: 15px 25px;
            border-radius: 10px;
            margin: 0 15px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }
        
        .sidebar .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(5px);
        }
        
        .sidebar .nav-link.active {
            background-color: rgba(255,255,255,0.2);
            color: white;
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
            font-size: 18px;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }
        
        .date-widget {
            background: white;
            border-radius: 15px;
            padding: 15px 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            display: inline-block;
            margin-bottom: 30px;
        }
        
        .date-widget .flag {
            width: 20px;
            height: 15px;
            background: linear-gradient(to bottom, #ff0000 50%, #ffffff 50%);
            display: inline-block;
            margin-right: 8px;
            border-radius: 2px;
        }
        
        .module-card {
            background: white;
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        
        .module-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }
        
        .module-card .icon {
            font-size: 60px;
            margin-bottom: 20px;
        }
        
        .module-card .icon.blue { color: #3498db; }
        .module-card .icon.orange { color: #f39c12; }
        .module-card .icon.green { color: #27ae60; }
        
        .module-card h5 {
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
            font-size: 18px;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="d-flex flex-column h-100">
            <ul class="nav flex-column flex-grow-1 pt-4">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-th-large"></i>
                        Dashboard
                    </a>
                </li>
            </ul>
            
            <!-- Logout Button -->
            <div class="mt-auto p-3">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                        <i class="fas fa-sign-out-alt"></i>
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>