<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Monolith - Edit Menu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>body { font-family: "Inter", sans-serif; } .serif-title { font-family: "Playfair Display", serif; }</style>
</head>
<body class="bg-[#121212] text-[#F5F5F7] min-h-screen flex items-center justify-center py-12 px-6">

    <div class="max-w-lg w-full bg-[#1A1A1A] border border-[#262626] rounded-2xl p-8 shadow-2xl">
        <div class="mb-6 text-center">
            <p class="text-xs uppercase tracking-widest text-[#D4AF37] font-semibold mb-1">Internal Management</p>
            <h2 class="serif-title text-2xl font-bold tracking-wide text-white">Update Coffee Menu</h2>
        </div>

        <form action="/admin/products/{{ $product->id }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT') <div>
                <label class="block text-xs uppercase tracking-wider text-gray-400 font-medium mb-2">Coffee Name</label>
                <input type="text" name="name" value="{{ $product->name }}" required class="w-full bg-[#222222] border border-[#2A2A2A] rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#D4AF37]/50 transition-colors">
            </div>

            <div>
                <label class="block text-xs uppercase tracking-wider text-gray-400 font-medium mb-2">Price (IDR)</label>
                <input type="number" name="price" value="{{ (int)$product->price }}" required class="w-full bg-[#222222] border border-[#2A2A2A] rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#D4AF37]/50 transition-colors">
            </div>

            <div>
                <label class="block text-xs uppercase tracking-wider text-gray-400 font-medium mb-2">Description</label>
                <textarea name="description" rows="4" required class="w-full bg-[#222222] border border-[#2A2A2A] rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#D4AF37]/50 transition-colors resize-none">{{ $product->description }}</textarea>
            </div>

            <div class="pt-2 flex space-x-4">
                <a href="/admin/dashboard" class="w-1/3 bg-transparent hover:bg-[#222222] text-center border border-[#333333] text-gray-400 font-medium text-xs py-3.5 rounded-xl transition-all duration-300">
                    Cancel
                </a>
                <button type="submit" class="w-2/3 bg-gradient-to-r from-[#B38728] to-[#AA771C] hover:from-[#AA771C] hover:to-[#B38728] text-black font-bold text-xs py-3.5 rounded-xl transition-all duration-300 shadow-lg transform hover:-translate-y-0.5">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

</body>
</html>