{{-- Laravel Blade Template (resources/views/auth/login.blade.php) --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NYEKUY - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-template {
            background-image: url('{{ asset('images/template-bg.png') }}');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="min-h-screen bg-gray-200 flex items-center justify-center p-4">
    <div class="w-full max-w-6xl h-[600px] relative overflow-hidden rounded-3xl shadow-2xl">
        <!-- Background Template -->
        <div class="absolute inset-0 bg-template"></div>

        <div class="relative z-10 flex h-full">
            <!-- Left Side - Login Form -->
            <div class="flex-1 flex items-center justify-center p-8 lg:p-16">
                <div class="w-full max-w-sm space-y-6">
                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf
                        
                        <div class="space-y-2">
                            <label for="username" class="text-sm font-medium text-gray-700">
                                Username
                            </label>
                            <input
                                id="username"
                                name="username"
                                type="text"
                                value="{{ old('username', 'admin') }}"
                                class="w-full px-4 py-3 bg-gray-100 border-0 rounded-lg focus:bg-white focus:ring-2 focus:ring-red-800 transition-all text-gray-900 @error('username') ring-2 ring-red-500 @enderror"
                                required
                            />
                            @error('username')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="password" class="text-sm font-medium text-gray-700">
                                Password
                            </label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                placeholder="••••••••"
                                class="w-full px-4 py-3 bg-gray-100 border-0 rounded-lg focus:bg-white focus:ring-2 focus:ring-red-800 transition-all text-gray-900 @error('password') ring-2 ring-red-500 @enderror"
                                required
                            />
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button
                            type="submit"
                            class="w-full bg-red-800 hover:bg-red-900 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-200 text-base"
                        >
                            LOG IN
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Side - Brand Logo -->
            <div class="flex-1 flex items-center justify-center p-8 lg:p-16">
                <div class="text-center">
                    <img
                        src="{{ asset('images/nyekuy-logo.png') }}"
                        alt="NYEKUY"
                        class="mx-auto max-w-full h-auto"
                    />
                </div>
            </div>
        </div>
    </div>
</body>
</html>
