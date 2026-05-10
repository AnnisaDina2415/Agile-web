<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - ReGoods</title>
    <link rel="shortcut icon" href="{{ asset('images/logo/logo.jpeg') }}" type="image/x-icon">
    @vite('resources/css/app.css') <!-- Tailwind -->
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md">
        
        <!-- Logo & Title -->
        <div class="text-center mb-6">
            <div class="flex justify-center mb-2">
                <img src="{{ asset('images/logo/logo.jpeg') }}" alt="Logo ReGoods" class="h-12 w-12">
            </div>
            <h1 class="text-xl font-semibold text-gray-800">ReGoods Admin</h1>
            <p class="text-gray-500 text-sm">Masuk ke Dashboard Admin</p>
        </div>

        <!-- Card -->
        <div class="bg-white shadow-md rounded-2xl p-6">
            
            <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf

            @if($errors->any())
                <div class="mb-4 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-sm text-gray-600 mb-1">Email</label>
                <input 
                    type="email" 
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="admin@regoods.com"
                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400"
                    required
                >
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="block text-sm text-gray-600 mb-1">Password</label>
                <input 
                    type="password" 
                    name="password"
                    placeholder="••••••••"
                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400"
                    required
                >
            </div>

            <!-- Button -->
            <button 
                type="submit"
                class="w-full bg-green-500 hover:bg-green-600 text-white font-medium py-2 rounded-lg transition"
            >
                Masuk
            </button>
        </form>

            <!-- Links -->
            <div class="text-center mt-4 text-sm text-gray-500">
                <p class="mb-2">Akun Admin Default:</p>
                <p class="text-slate-700">Email: <span class="font-semibold">admin@regoods.com</span></p>
                <p class="text-slate-700">Password: <span class="font-semibold">password123</span></p>
            </div>

        </div>

    </div>

</body>
</html>
