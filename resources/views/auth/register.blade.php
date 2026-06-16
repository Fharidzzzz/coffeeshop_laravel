<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ella Raos Cookies - Membership Registry</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; } .serif-title { font-family: 'Playfair Display', serif; }</style>
</head>
<body class="bg-[#121212] text-[#F5F5F7] min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-[#1A1A1A] border border-[#2A2A2A] rounded-2xl p-8 shadow-2xl relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-[#B38728] via-[#FBF5B7] to-[#AA771C]"></div>

        <div class="text-center mb-8">
            <h2 class="serif-title text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#D4AF37] to-[#AA771C] tracking-wide">REGISTER</h2>
            <p class="text-xs text-gray-500 uppercase tracking-widest mt-2">Join The Elite Guild</p>
        </div>

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-950/40 border border-red-800 text-red-400 text-sm rounded-lg">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/register" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-xs font-medium uppercase tracking-wider text-gray-400 mb-1">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full bg-[#222222] border border-[#333333] focus:border-[#D4AF37] rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none transition-all duration-300">
            </div>

            <div>
                <label class="block text-xs font-medium uppercase tracking-wider text-gray-400 mb-1">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full bg-[#222222] border border-[#333333] focus:border-[#D4AF37] rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none transition-all duration-300">
            </div>

            <div>
                <label class="block text-xs font-medium uppercase tracking-wider text-gray-400 mb-1">Password</label>
                <input type="password" name="password" required class="w-full bg-[#222222] border border-[#333333] focus:border-[#D4AF37] rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none transition-all duration-300">
            </div>

            <div>
                <label class="block text-xs font-medium uppercase tracking-wider text-gray-400 mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" required class="w-full bg-[#222222] border border-[#333333] focus:border-[#D4AF37] rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none transition-all duration-300">
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-[#B38728] to-[#AA771C] text-black font-semibold text-sm py-3 rounded-xl transition-all duration-300 transform hover:-translate-y-0.5">
                Create Account
            </button>
        </form>

        <div class="mt-6 text-center border-t border-[#262626] pt-4">
            <p class="text-xs text-gray-500">Sudah terdaftar? <a href="/login" class="text-[#D4AF37] hover:underline">Log In disini</a></p>
        </div>
    </div>

</body>
</html>