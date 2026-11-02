<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriCare - Sign Up {{ ucfirst($role) }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-6 sm:p-8">

        <div class="flex items-center gap-2 mb-6">
            <div class="w-6 h-6 bg-emerald-700 rounded-md flex items-center justify-center text-white font-bold text-xs">N</div>
            <span class="text-xs font-bold tracking-wider text-emerald-900">NUTRICARE</span>
        </div>

        <h2 class="text-center font-bold text-gray-800 mb-6 text-base">
            {{ $role == 'mahasiswa' ? 'Aku Mahasiswa!' : 'Pendaftaran Ahli Gizi' }}
        </h2>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded-xl text-xs mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST" class="space-y-3">
            @csrf
            <input type="hidden" name="role" value="{{ $role }}">

            <div>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="{{ $role == 'ahli_gizi' ? 'Nama dengan gelar' : 'Username' }}"
                       class="w-full bg-gray-200 text-gray-700 rounded-xl px-4 py-3 text-xs focus:outline-none focus:ring-2 focus:ring-emerald-600" required>
            </div>

            <div>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                       class="w-full bg-gray-200 text-gray-700 rounded-xl px-4 py-3 text-xs focus:outline-none focus:ring-2 focus:ring-emerald-600" required>
            </div>

            <div>
                <input type="password" name="password" placeholder="Password"
                       class="w-full bg-gray-200 text-gray-700 rounded-xl px-4 py-3 text-xs focus:outline-none focus:ring-2 focus:ring-emerald-600" required>
            </div>

            <button type="submit" class="w-full bg-emerald-800 hover:bg-emerald-900 text-white font-semibold py-3 rounded-xl text-xs transition shadow-md mt-2">
                Sign up
            </button>
        </form>

        <div class="text-center mt-6">
            <p class="text-xs text-gray-500">
                Already have an account?
                <a href="{{ route('login.role', ['role' => $role]) }}" class="text-emerald-700 font-semibold hover:underline">Log in</a>
            </p>
        </div>

    </div>
</body>
</html>
