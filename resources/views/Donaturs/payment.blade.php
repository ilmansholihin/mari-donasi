<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Donasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100">
    <!-- Modal yang Ditingkatkan -->
    <div id="payment-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full z-50 backdrop-blur-sm transition-all duration-300">
        <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-md shadow-xl rounded-xl bg-white transform transition-all">
            <div class="mt-3 text-center">
                <div id="modal-icon" class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4 transform transition-all duration-300">
                    <svg id="success-icon" class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <svg id="pending-icon" class="hidden h-8 w-8 text-yellow-600 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <svg id="error-icon" class="hidden h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                <h3 id="modal-title" class="text-xl font-bold text-gray-900 mb-2"></h3>
                <div class="mt-2 px-7 py-3">
                    <p id="modal-message" class="text-gray-600"></p>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="modal-close" class="w-full bg-green-500 text-white font-semibold py-3 px-6 rounded-full hover:bg-green-600 transition-colors duration-200 shadow-lg">
                        Mengerti
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Konten Utama -->
    <div class="max-w-md mx-auto p-4">
        <!-- Header dengan tombol kembali -->
        <div class="flex items-center mb-6">
            <a href="{{ url()->previous() }}" class="text-gray-600 hover:text-gray-800 transition-colors">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <h1 class="text-xl font-semibold text-gray-800 ml-4">Konfirmasi Pembayaran</h1>
        </div>

        <!-- Card Pembayaran -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <!-- Header Card -->
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-800 mb-1">{{ $fundraising->name }}</h2>
                <p class="text-gray-500 text-sm">Terima kasih atas dukungan Anda</p>
            </div>

            <!-- Detail Pembayaran -->
            <div class="p-6 space-y-4">
                <!-- Total Donasi -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-600 text-sm mb-1">Total Donasi</p>
                    <p class="text-2xl font-bold text-green-500">
                        Rp{{ number_format($donatur->total_donasi, 0, ',', '.') }}
                    </p>
                </div>

                <!-- Informasi Pembayaran -->
                <div class="space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Status</span>
                        <span class="font-medium text-yellow-500">Menunggu Pembayaran</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">ID Transaksi</span>
                        <span class="font-medium">{{ $donatur->id }}</span>
                    </div>
                </div>

                <!-- Tombol Bayar -->
                <button id="pay-button" class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-4 px-6 rounded-full shadow-lg transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98]">
                    Lanjutkan ke Pembayaran
                </button>
            </div>

            <!-- Footer Card -->
            <div class="p-4 bg-gray-50 text-center">
                <p class="text-sm text-gray-500">
                    <i class="fas fa-shield-alt mr-2"></i>
                    Pembayaran Aman & Terenkripsi
                </p>
            </div>
        </div>
    </div>

    <script>
        // Fungsi Modal
        function showModal(title, message, type = 'success') {
            const modal = document.getElementById('payment-modal');
            const modalTitle = document.getElementById('modal-title');
            const modalMessage = document.getElementById('modal-message');
            const successIcon = document.getElementById('success-icon');
            const pendingIcon = document.getElementById('pending-icon');
            const errorIcon = document.getElementById('error-icon');
            const modalIcon = document.getElementById('modal-icon');

            // Sembunyikan semua ikon
            successIcon.classList.add('hidden');
            pendingIcon.classList.add('hidden');
            errorIcon.classList.add('hidden');

            // Atur ikon dan warna berdasarkan tipe
            if (type === 'success') {
                successIcon.classList.remove('hidden');
                modalIcon.classList.remove('bg-yellow-100', 'bg-red-100');
                modalIcon.classList.add('bg-green-100');
            } else if (type === 'pending') {
                pendingIcon.classList.remove('hidden');
                modalIcon.classList.remove('bg-green-100', 'bg-red-100');
                modalIcon.classList.add('bg-yellow-100');
            } else if (type === 'error') {
                errorIcon.classList.remove('hidden');
                modalIcon.classList.remove('bg-green-100', 'bg-yellow-100');
                modalIcon.classList.add('bg-red-100');
            }

            modalTitle.textContent = title;
            modalMessage.textContent = message;
            modal.classList.remove('hidden');
            
            // Animasi masuk
            setTimeout(() => {
                modal.querySelector('div').classList.add('scale-100');
                modal.querySelector('div').classList.remove('scale-95');
            }, 10);
        }

        function hideModal() {
            const modal = document.getElementById('payment-modal');
            modal.classList.add('hidden');
        }

        // Event listener untuk tombol tutup
        document.getElementById('modal-close').addEventListener('click', hideModal);

        // Handler klik tombol pembayaran
        document.getElementById('pay-button').onclick = function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function (result) {
                    showModal('Pembayaran Berhasil! 🎉', 'Terima kasih atas donasi Anda. Dukungan Anda sangat berarti.', 'success');

                    const data = {
                        donatur_id: '{{ $donatur->id }}',
                        total_donasi: '{{ $donatur->total_donasi }}',
                        fundraising_id: '{{ $fundraising->id }}',
                        result: result
                    };

                    fetch('{{ route('midtrans.notification') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(responseData => {
                        console.log('Response:', responseData);
                        setTimeout(() => {
                            window.location.href = "{{ route('donaturs.index') }}";
                        }, 2000);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showModal('Gagal', 'Terjadi kesalahan dalam memproses pembayaran.', 'error');
                    });
                },
                onPending: function (result) {
                    showModal('Pembayaran Dalam Proses', 'Silakan selesaikan pembayaran Anda sesuai instruksi.', 'pending');
                },
                onError: function (result) {
                    showModal('Pembayaran Gagal', 'Mohon maaf, terjadi kesalahan. Silakan coba lagi.', 'error');
                }
            });
        };
    </script>
</body>
</html>