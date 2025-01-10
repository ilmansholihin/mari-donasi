<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Donasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        .preset-container {
            transition: max-height 0.3s ease-in-out, opacity 0.3s ease-in-out;
            max-height: 500px;
            opacity: 1;
            overflow: hidden;
        }

        .preset-container.hidden {
            max-height: 0;
            opacity: 0;
        }

        .custom-amount {
            transition: all 0.3s ease-in-out;
            transform: translateY(0);
            opacity: 1;
        }

        .custom-amount.hidden {
            transform: translateY(-20px);
            opacity: 0;
            pointer-events: none;
        }

        .toggle-icon {
            transition: transform 0.3s ease;
        }

        .toggle-icon.rotated {
            transform: rotate(180deg);
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="max-w-md mx-auto p-4">
        <!-- Header dengan tombol kembali -->
        <div class="flex items-center mb-6">
            <a href="{{ url()->previous() }}" class="text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <h1 class="text-xl font-semibold text-gray-800 ml-4">Donasi untuk {{ $fundraising->name }}</h1>
        </div>

        <form action="{{ route('donaturs.store', $fundraising->id) }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Bagian Informasi Personal -->
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Personal</h2>
                
                <!-- Nama Lengkap -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-600 text-sm font-medium mb-2">Nama Lengkap</label>
                    <input type="text" id="name" name="name" 
                           class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                           placeholder="Masukkan nama lengkap" required>
                </div>
                
                <!-- Nomor HP -->
                <div class="mb-4">
                    <label for="nomer_hp" class="block text-gray-600 text-sm font-medium mb-2">Nomor HP</label>
                    <input type="tel" id="nomer_hp" name="nomer_hp" 
                           class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                           placeholder="Contoh: 08123456789" required>
                </div>
            </div>

            <!-- Bagian Jumlah Donasi -->
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Jumlah Donasi</h2>
                    <button type="button" id="toggleButton" class="text-gray-600 hover:text-gray-800">
                        <i class="fas fa-chevron-down toggle-icon"></i>
                    </button>
                </div>
                
                <!-- Jumlah Preset -->
                <div id="presetContainer" class="preset-container">
                    <div class="grid grid-cols-2 gap-3 mb-4">
                        @foreach([10000, 50000, 100000, 500000, 1000000, 2000000] as $amount)
                        <label class="relative flex items-center">
                            <input type="radio" name="total_donasi" value="{{ $amount }}" 
                                   class="donasi-radio hidden">
                            <div class="w-full border-2 border-gray-200 rounded-lg p-4 text-center cursor-pointer
                                      transition-all duration-200 donation-box">
                                <span class="text-sm font-medium text-gray-700">
                                    Rp{{ number_format($amount, 0, ',', '.') }}
                                </span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Jumlah Custom -->
                <div id="customAmount" class="custom-amount hidden">
                    <label for="custom_total_donasi" class="block text-gray-600 text-sm font-medium mb-2">
                        Jumlah Lainnya
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                        <input type="number" id="custom_total_donasi" name="custom_total_donasi" 
                               class="w-full pl-12 pr-4 py-3 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                               placeholder="Masukkan jumlah custom">
                    </div>
                </div>
            </div>

            <!-- Bagian Informasi Tambahan -->
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Tambahan</h2>
                
                <!-- Catatan -->
                <div class="mb-4">
                    <label for="notes" class="block text-gray-600 text-sm font-medium mb-2">Pesan Dukungan</label>
                    <textarea id="notes" name="notes" rows="3"
                              class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                              placeholder="Tulis pesan dukungan Anda (opsional)"></textarea>
                </div>
            </div>

            <!-- Tombol Submit -->
            <button type="submit" 
                    class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-4 px-6 rounded-full shadow-lg transition-colors duration-200">
                Kirim Donasi Sekarang
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const customInput = document.getElementById('custom_total_donasi');
            const radioButtons = document.querySelectorAll('.donasi-radio');
            const donationBoxes = document.querySelectorAll('.donation-box');
            const toggleButton = document.getElementById('toggleButton');
            const toggleIcon = toggleButton.querySelector('.toggle-icon');
            const presetContainer = document.getElementById('presetContainer');
            const customAmount = document.getElementById('customAmount');
            let isPresetVisible = true;

            // Fungsi untuk mengatur tampilan kotak donasi
            function updateDonationBoxes() {
                donationBoxes.forEach((box, index) => {
                    if (radioButtons[index].checked) {
                        box.classList.add('border-green-500', 'bg-green-50');
                        box.classList.remove('border-gray-200');
                    } else {
                        box.classList.remove('border-green-500', 'bg-green-50');
                        box.classList.add('border-gray-200');
                    }
                });
            }

            // Fungsi toggle
            toggleButton.addEventListener('click', function() {
                isPresetVisible = !isPresetVisible;
                
                // Animasi icon
                toggleIcon.classList.toggle('rotated');
                
                // Toggle tampilan preset dan custom
                if (isPresetVisible) {
                    presetContainer.classList.remove('hidden');
                    setTimeout(() => {
                        customAmount.classList.add('hidden');
                    });
                } else {
                    customAmount.classList.remove('hidden');
                    presetContainer.classList.add('hidden');
                }
            });

            // Event listener untuk input custom
            customInput.addEventListener('focus', function () {
                radioButtons.forEach(radio => {
                    radio.checked = false;
                });
                updateDonationBoxes();
            });

            // Event listener untuk radio buttons
            radioButtons.forEach((radio, index) => {
                radio.addEventListener('change', function () {
                    customInput.value = '';
                    updateDonationBoxes();
                });

                // Menambahkan click event ke box untuk memilih radio button
                donationBoxes[index].addEventListener('click', function() {
                    radio.checked = true;
                    updateDonationBoxes();
                });
            });
        });
    </script>
</body>
</html>