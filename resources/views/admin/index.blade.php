<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Monolith - Admin Control Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>body { font-family: "Inter", sans-serif; } .serif-title { font-family: "Playfair Display", serif; }</style>
</head>
<body class="bg-[#121212] text-[#F5F5F7] min-h-screen">

    <nav class="border-b border-[#222222] bg-[#1A1A1A] px-8 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <h1 class="serif-title text-xl font-bold tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-[#D4AF37] to-[#AA771C]">THE MONOLITH</h1>
            <span class="bg-[#D4AF37]/10 text-[#D4AF37] text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 border border-[#D4AF37]/20 rounded">Internal Management</span>
        </div>
        <div class="flex items-center space-x-6">
            <span class="text-sm text-gray-400">Logged in as: <span class="text-white font-medium">{{ auth()->user()->name }}</span></span>
            <form action="/logout" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-red-950/40 hover:bg-red-900/60 border border-red-800 text-red-400 text-xs uppercase font-semibold tracking-wider px-4 py-2 rounded-xl transition-all duration-300">Logout</button>
            </form>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-8 py-12">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="serif-title text-3xl font-bold text-white tracking-wide">Product Management</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola data menu kopi, harga, dan deskripsi produk eksklusif Anda.</p>
            </div>
            <a href="/admin/products/create" class="bg-gradient-to-r from-[#B38728] to-[#AA771C] hover:from-[#AA771C] hover:to-[#B38728] text-black font-semibold text-xs px-5 py-3 rounded-xl transition-all duration-300 shadow-lg transform hover:-translate-y-0.5">
                + Add New Coffee
            </a>
        </div>

        <div class="bg-[#1A1A1A] border border-[#262626] rounded-2xl overflow-hidden shadow-xl">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-[#262626] text-xs uppercase tracking-wider text-gray-400 bg-[#222222]/40">
                        <th class="py-4 px-6 font-medium">Menu Name</th>
                        <th class="py-4 px-6 font-medium">Description</th>
                        <th class="py-4 px-6 font-medium">Price</th>
                        <th class="py-4 px-6 font-medium text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-[#262626]">
                    @foreach($products as $product)
                    <tr class="hover:bg-[#222222]/20 transition-colors duration-200">
                        <td class="py-4 px-6 font-medium text-white flex items-center space-x-3">
                            <span class="text-lg">☕</span>
                            <span>{{ $product->name }}</span>
                        </td>
                        <td class="py-4 px-6 text-gray-400 max-w-xs truncate">{{ $product->description }}</td>
                        <td class="py-4 px-6 text-[#D4AF37] font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="py-4 px-6 text-center space-x-3">
                            <a href="/admin/products/{{ $product->id }}/edit" class="text-xs font-semibold text-[#D4AF37] hover:underline">Edit</a>
                            
                            <form action="/admin/products/{{ $product->id }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs font-semibold text-red-400 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>