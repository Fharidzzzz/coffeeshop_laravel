<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Monolith - Exclusive Catalogue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .serif-title { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#121212] text-[#F5F5F7] min-h-screen">

    <nav class="border-b border-[#222222] bg-[#1A1A1A]/80 backdrop-blur-md sticky top-0 z-50 px-6 py-4 flex justify-between items-center">
        <h1 class="serif-title text-xl font-bold tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-[#D4AF37] to-[#AA771C]">THE MONOLITH</h1>
        <div class="flex items-center space-x-6 text-sm">
            <span class="text-gray-400">Welcome, <span class="text-[#D4AF37] font-medium">{{ auth()->user()->name }}</span></span>
            <form action="/logout" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-xs uppercase tracking-wider text-gray-500 hover:text-red-400 transition-colors duration-300">Logout</button>
            </form>
        </div>
    </nav>

    <header class="max-w-7xl mx-auto px-6 py-12 text-center">
        <p class="text-xs uppercase tracking-widest text-[#D4AF37] font-semibold mb-2">Curated Collection</p>
        <h2 class="serif-title text-4xl font-bold tracking-wide">Premium Coffee Selection</h2>
        <p class="text-sm text-gray-500 max-w-md mx-auto mt-3">Rasakan simfoni rasa terbaik dari biji kopi arabika pilihan yang diproses secara eksklusif untuk standar hidup Anda.</p>
    </header>

    <main class="max-w-7xl mx-auto px-6 pb-24">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($products as $product)
                <div class="bg-[#1A1A1A] border border-[#262626] rounded-2xl overflow-hidden shadow-xl hover:border-[#D4AF37]/40 transition-all duration-500 group flex flex-col justify-between">
                    
                    <div class="h-64 bg-[#222222] relative overflow-hidden flex items-center justify-center border-b border-[#262626]">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1A1A1A] to-transparent opacity-60 z-10"></div>
                        <span class="serif-title text-5xl opacity-10 group-hover:scale-110 transition-transform duration-700 select-none">☕</span>
                        <div class="absolute top-4 right-4 bg-black/60 backdrop-blur-md text-[#D4AF37] border border-[#D4AF37]/30 text-[10px] uppercase font-bold tracking-widest px-3 py-1 rounded-full z-20">
                            Available
                        </div>
                    </div>

                    <div class="p-6 space-y-4 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="serif-title text-xl font-bold group-hover:text-[#D4AF37] transition-colors duration-300">{{ $product->name }}</h3>
                            <p class="text-xs text-gray-500 mt-2 line-clamp-3 leading-relaxed">{{ $product->description }}</p>
                        </div>

                        <div class="pt-4 border-t border-[#262626] flex items-center justify-between">
                            <div>
                                <p class="text-[10px] uppercase tracking-wider text-gray-500">Premium Price</p>
                                <p class="text-lg font-semibold text-white">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>
                            
                            <!-- 🛒 Form Checkout Integrasi Midtrans -->
                            <form action="/checkout" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="bg-gradient-to-r from-[#B38728] to-[#AA771C] hover:from-[#AA771C] hover:to-[#B38728] text-black font-semibold text-xs px-4 py-2.5 rounded-xl transition-all duration-300 transform hover:-translate-y-0.5 shadow-lg block text-center">
                                    <span>Add to Experience</span>
                                    <span class="text-[10px] text-[#5c4308] font-bold tracking-wide mt-0.5 block border-t border-black/10 pt-0.5">
                                        $ {{ number_format($product->price * $usdRate, 2) }} USD
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </main>

</body>
</html>