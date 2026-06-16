<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ella Raos Cookies - Exclusive Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .serif-title { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#121212] text-[#F5F5F7] min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-[#1A1A1A] border border-[#2A2A2A] rounded-2xl p-8 shadow-2xl relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-[#B38728] via-[#FBF5B7] to-[#AA771C]"></div>

        <div class="text-center mb-8">
            <h2 class="serif-title text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#D4AF37] to-[#AA771C] tracking-wide">THE MONOLITH</h2>
            <p class="text-xs text-gray-500 uppercase tracking-widest mt-2">Reserve Your Experience</p>
        </div>

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-950/40 border border-red-800 text-red-400 text-sm rounded-lg">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/login" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-xs font-medium uppercase tracking-wider text-gray-400 mb-2">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full bg-[#222222] border border-[#333333] focus:border-[#D4AF37] rounded-xl px-4 py-3 text-sm text-white focus:outline-none transition-all duration-300">
            </div>

            <div>
                <label class="block text-xs font-medium uppercase tracking-wider text-gray-400 mb-2">Password</label>
                <input type="password" name="password" required class="w-full bg-[#222222] border border-[#333333] focus:border-[#D4AF37] rounded-xl px-4 py-3 text-sm text-white focus:outline-none transition-all duration-300">
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-[#B38728] to-[#AA771C] hover:from-[#AA771C] hover:to-[#B38728] text-black font-semibold text-sm py-3 px-4 rounded-xl shadow-lg hover:shadow-[#D4AF37]/10 transition-all duration-300 transform hover:-translate-y-0.5">
                Sign In to Lounge
            </button>
        </form>

        <div class="mt-8 text-center border-t border-[#262626] pt-6">
            <p class="text-xs text-gray-500">Belum memiliki hak akses eksklusif? <a href="/register" class="text-[#D4AF37] hover:underline">Register Akun</a></p>
        </div>
    </div>

</body>
</html>