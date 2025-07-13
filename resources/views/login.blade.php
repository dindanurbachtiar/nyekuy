{{-- resources/views/auth/login.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NYEKUY - Login</title>
    <style>
        /* Global Styles */
        body {
            margin: 0;
            font-family: sans-serif; /* Ganti dengan font yang Anda inginkan */
            background-color: #e0e0e0; /* Warna abu-abu muda */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Top Red Bar */
        .top-bar {
            width: 100%;
            height: 32px; /* Setengah dari 64px (h-16) */
            background-color: #8b0000; /* Warna merah gelap */
        }

        /* Main Content Container */
        .main-content {
            flex: 1;
            display: flex;
            align-items: flex-start; /* Menggeser ke atas, sesuaikan dengan padding-top */
            justify-content: center;
            padding: 16px; /* p-4 */
            padding-top: 64px; /* pt-16 */
        }

        /* Login Card Container */
        .login-card-container {
            width: 100%;
            max-width: 1024px; /* max-w-6xl */
            height: 600px;
            position: relative;
            overflow: hidden;
            border-radius: 24px; /* rounded-3xl */
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1); /* shadow-2xl */
            background-color: #fff; /* Default background jika gambar tidak dimuat */
        }

        /* Background Template Image */
        .bg-template-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0; /* Pastikan di belakang konten */
        }

        /* Inner Flex Container for Form and Logo */
        .inner-flex-container {
            position: relative;
            z-index: 1; /* Pastikan di atas gambar background */
            display: flex;
            height: 100%;
        }

        /* Left Side - Login Form */
        .login-form-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px; /* p-8 */
        }
        @media (min-width: 1024px) { /* lg:p-16 */
            .login-form-section {
                padding: 64px;
            }
        }

        .login-form-wrapper {
            width: 100%;
            max-width: 384px; /* max-w-sm */
            display: flex;
            flex-direction: column;
            gap: 24px; /* space-y-6 */
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px; /* space-y-2 */
        }

        .form-label {
            font-size: 0.875rem; /* text-sm */
            font-weight: 500; /* font-medium */
            color: #4a5568; /* text-gray-700 */
        }

        .form-input {
            width: 100%;
            padding: 12px 16px; /* px-4 py-3 */
            background-color: #f3f4f6; /* bg-gray-100 */
            border: 0;
            border-radius: 8px; /* rounded-lg */
            color: #1a202c; /* text-gray-900 */
            transition: all 0.2s ease-in-out; /* transition-all */
        }
        .form-input:focus {
            outline: none;
            background-color: #fff;
            box-shadow: 0 0 0 2px #8b0000; /* ring-2 ring-red-800 */
        }
        .form-input.error { /* Untuk error validasi Laravel */
            box-shadow: 0 0 0 2px #ef4444; /* ring-2 ring-red-500 */
        }
        .error-message {
            color: #ef4444; /* text-red-500 */
            font-size: 0.75rem; /* text-xs */
            margin-top: 4px; /* mt-1 */
        }

        .login-button {
            width: 100%;
            display: flex;
            justify-content: center;
            padding: 12px 24px; /* py-3 px-6 */
            background-color: #8b0000; /* bg-red-800 */
            color: #fff; /* text-white */
            font-weight: 600; /* font-semibold */
            font-size: 1rem; /* text-base */
            border: none;
            border-radius: 8px; /* rounded-lg */
            cursor: pointer;
            transition: background-color 0.2s ease-in-out; /* transition-colors duration-200 */
        }
        .login-button:hover {
            background-color: #6b0000; /* hover:bg-red-900 */
        }

        /* NYEKUY Logo Section */
        .nyekuy-logo-section {
            position: absolute; /* Menggunakan absolute untuk posisi yang lebih presisi */
            top: 50%;
            left: 50%; /* Awalnya di tengah horizontal */
            transform: translate(-50%, -50%); /* Menggeser kembali 50% dari lebar/tinggi sendiri */
            z-index: 2; /* Pastikan di atas form dan background */
            /* Sesuaikan left untuk menggeser ke kanan/kiri */
            left: 50%; /* Sesuaikan nilai ini untuk menggeser logo */
        }

        /* Responsive Adjustments */
        @media (max-width: 1023px) { /* Untuk layar tablet dan mobile (lg breakpoint) */
            .inner-flex-container {
                flex-direction: column; /* Tumpuk form dan logo secara vertikal */
            }
            .login-form-section {
                padding: 32px; /* p-8 */
            }
            .nyekuy-logo-section {
                position: relative; /* Kembali ke posisi relatif untuk mobile */
                top: auto;
                left: auto;
                transform: none;
                margin-top: 32px; /* Beri sedikit jarak dari form */
                margin-bottom: 32px;
            }
            .login-card-container {
                height: auto; /* Biarkan tinggi menyesuaikan konten */
            }
        }
    </style>
</head>
<body class="min-h-screen bg-gray-200 flex flex-col">
    {{-- Top Dark Red Bar --}}
    <div class="top-bar"></div>

    {{-- Main Content Area --}}
    <div class="main-content">
        <div class="login-card-container">
            {{-- Background Template Image --}}
            <img src="{{ asset('images/template-bg.png') }}" alt="Background Template" class="bg-template-image" />

            {{-- NYEKUY Logo - Absolutely positioned --}}
            <div class="nyekuy-logo-section">
                <img src="{{ asset('images/nyekuy-logo.png') }}" alt="NYEKUY" style="width: 400px; height: 100px; display: block; margin: auto;" />
            </div>

            <div class="inner-flex-container">
                {{-- Left Side - Login Form --}}
                <div class="login-form-section">
                    <div class="login-form-wrapper">
                        <form method="POST" action="{{ route('login') }}" style="display: flex; flex-direction: column; gap: 24px;">
                            @csrf {{-- Token CSRF untuk keamanan --}}

                            <div class="form-group">
                                <label for="username" class="form-label">
                                    Username
                                </label>
                                <input
                                    id="username"
                                    name="username"
                                    type="text"
                                    value="{{ old('username', 'admin') }}"
                                    class="form-input @error('username') error @enderror"
                                    required
                                />
                                @error('username')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-label">
                                    Password
                                </label>
                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    placeholder="••••••••"
                                    class="form-input @error('password') error @enderror"
                                    required
                                />
                                @error('password')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="login-button">
                                LOG IN
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Right side - This div is still needed to maintain the flex layout for the left side --}}
                <div style="flex: 1;"></div>
            </div>
        </div>
    </div>
</body>
</html>
