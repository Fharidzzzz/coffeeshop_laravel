<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Monolith - Secure Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
</head>
<body class="bg-[#121212] text-[#F5F5F7] min-h-screen flex items-center justify-center font-sans">

    <div class="max-w-md w-full bg-[#1A1A1A] border border-[#262626] rounded-2xl p-8 shadow-2xl text-center">
        <p class="text-xs uppercase tracking-widest text-[#D4AF37] font-semibold mb-1">Secure Transaction</p>
        <h2 class="serif-title text-2xl font-bold tracking-wide text-white mb-6" style="font-family: 'Playfair Display', serif;">Order Confirmation</h2>
        
        <div class="border-b border-t border-[#262626] py-4 my-4 text-left space-y-2 text-sm text-gray-400">
            <div class="flex justify-between"><span class="text-gray-500">Invoice:</span> <span class="text-white font-mono">{{ $order->number }}</span></div>
            <div class="flex justify-between"><span class="text-gray-500">Item:</span> <span class="text-white">{{ $order->product->name }}</span></div>
            <div class="flex justify-between"><span class="text-gray-500">Total Price:</span> <span class="text-[#D4AF37] font-semibold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span></div>
        </div>

        <p class="text-xs text-gray-500 mb-6">Klik tombol di bawah untuk memicu sistem gerbang pembayaran simulasi Midtrans Sandbox.</p>

        <button id="pay-button" class="w-full bg-gradient-to-r from-[#B38728] to-[#AA771C] hover:from-[#AA771C] hover:to-[#B38728] text-black font-bold text-sm py-3 rounded-xl transition-all duration-300 shadow-lg transform hover:-translate-y-0.5">
            Proceed to Payment
        </button>
    </div>

    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            // Memicu jendela pop-up snap Midtrans menggunakan token dari controller
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    alert("Pembayaran Berhasil!"); console.log(result);
                    window.location.href = '/shop';
                },
                onPending: function(result){
                    alert("Menunggu Pembayaran Anda!"); console.log(result);
                    window.location.href = '/shop';
                },
                onError: function(result){
                    alert("Pembayaran Gagal!"); console.log(result);
                    window.location.href = '/shop';
                },
                onClose: function(){
                    alert('Anda menutup halaman pembayaran sebelum selesai.');
                }
            });
        });
    </script>
</body>
</html>