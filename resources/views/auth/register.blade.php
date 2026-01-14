<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Author | Jagat Aktual</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Tailwind CDN (Filament-like) --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: radial-gradient(ellipse at top, #1f2937, #020617);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center text-white">

    <div class="w-full max-w-md bg-gray-900/80 backdrop-blur rounded-xl shadow-xl p-8">

        <!-- Brand -->
        <div class="text-center mb-6">
            <h1 class="text-lg font-semibold">Jagat Aktual</h1>
            <h2 class="text-2xl font-bold mt-2">Sign up</h2>
            <p class="text-sm text-gray-400 mt-1">
                or
                <a href="{{ url('/admin/login') }}" class="text-amber-400 hover:underline">
                    sign in to your account
                </a>
            </p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('author.register.store') }}" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <label class="block text-sm font-medium mb-1">Name<span class="text-red-500">*</span></label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    class="w-full rounded-lg bg-gray-800 border border-gray-700 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500"
                >
                @error('name')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium mb-1">Email address<span class="text-red-500">*</span></label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    class="w-full rounded-lg bg-gray-800 border border-gray-700 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500"
                >
                @error('email')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium mb-1">Password<span class="text-red-500">*</span></label>
                <input
                    type="password"
                    name="password"
                    required
                    class="w-full rounded-lg bg-gray-800 border border-gray-700 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500"
                >
                @error('password')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="block text-sm font-medium mb-1">Confirm password<span class="text-red-500">*</span></label>
                <input
                    type="password"
                    name="password_confirmation"
                    required
                    class="w-full rounded-lg bg-gray-800 border border-gray-700 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500"
                >
            </div>

            <!-- Submit -->
            <button
                type="submit"
                class="w-full mt-4 py-2 rounded-lg font-semibold text-black bg-amber-400 hover:bg-amber-500 transition"
            >
                Sign up
            </button>
        </form>

    </div>

</body>
</html>
