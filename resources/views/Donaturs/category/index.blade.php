<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Fundraising App
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
 </head>
 <body class="bg-blue-500">
  <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden">
   <!-- Header Section -->
   <div class="relative">
    <img alt="Illustration of a person with birds" class="w-full h-48 object-cover" height="200" src="https://storage.googleapis.com/a1aa/image/2fuNIEGPoExSJyUyuekeTrM9CNrQAMWyElKnM8iFfCexEMNgC.jpg" width="400"/>
    <div class="absolute top-4 left-4 text-white">
     <div class="flex items-center space-x-2">
      <a href="{{ url()->previous() }}">
      <button class="text-white text-xl">
       <i class="fas fa-arrow-left"></i>
      </button>
     </a>
     </div>
     <div class="text-lg font-bold">
      Bengkalis, Indonesia
     </div>
    </div>
    <div class="absolute top-4 right-4">
     <button class="bg-white p-2 rounded-full shadow-md">
      <i class="fas fa-user">
      </i>
     </button>
    </div>
    <div class="absolute bottom-4 left-4 text-white">
     <h1 class="text-2xl font-bold">
      Help Other People.
      <br/>
      Life Becomes Happier.
     </h1>
    </div>
   </div>
   <!-- Best Choices Section -->
   <div class="p-4">
    <div class="flex justify-between items-center mb-4">
     <h2 class="text-lg font-bold">
      {{ $categori->name }}
     </h2>
     <button class="text-sm text-gray-500">
      Explore All
     </button>
    </div>
    <div class="space-y-4">
       @forelse ($fundraisings as $item)
    <a href="{{ route('donaturs.show', $item->slug) }}">
        <div class="flex space-x-4 mb-4">
            <img alt="Image of a shipwreck" class="w-24 h-24 rounded-lg object-cover" 
                height="100" 
                src="{{ asset('thumbnail/' . $item->thumbnail) }}" 
                width="100" />
            <div class="flex-1">
                <h3 class="text-sm font-bold">
                    {{ $item->name }}
                </h3>
                <p class="text-xs text-gray-500 mb-2">
                    Target <span class="text-green-500">{{ $item->target_donasi }}</span>
                </p>
                <div class="w-full bg-gray-200 rounded-full h-1">
                    <div class="bg-green-500 h-1 rounded-full progress-bar" 
                         style="width: 0%;" 
                         data-fund="{{ $item->donasi_terkumpul }}" 
                         data-goal="{{ $item->target_donasi }}">
                    </div>
                </div>
                <p class="mt-2 text-sm font-bold">{{ $item->fundraiser_name }}<i class="fas fa-check-circle text-blue-500 ml-2">
                 </i></p>
                
            </div>
        </div>
    </a>
@empty
    <p>No fundraising items found.</p>
@endforelse

<script>
    // Update progress bar setelah DOM siap
    document.addEventListener('DOMContentLoaded', function () {
        // Cari semua elemen dengan class "progress-bar"
        const progressBars = document.querySelectorAll('.progress-bar');
        progressBars.forEach(progressBar => {
            // Ambil data dari atribut HTML
            const fundedAmount = parseInt(progressBar.getAttribute('data-fund'), 10);
            const goalAmount = parseInt(progressBar.getAttribute('data-goal'), 10);

            // Hitung persentase dan atur lebar progress bar
            const percentage = Math.min((fundedAmount / goalAmount) * 100, 100);
            progressBar.style.width = `${percentage}%`;
        });
    });
</script>

 
    </div>
   </div>

       <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-8">
      <div class="max-w-6xl mx-auto px-4 py-8 md:px-8 lg:flex flex-col lg:justify-between">
        <!-- About Section -->
        <div class="mb-6 lg:mb-0">
          <h3 class="text-lg font-bold mb-4">About KitaBantu</h3>
          <p class="text-sm text-gray-400 leading-relaxed">
            KitaBantu adalah platform penggalangan dana yang membantu masyarakat untuk saling berbagi dengan yang membutuhkan. Kami berkomitmen untuk menciptakan dunia yang lebih baik melalui donasi yang transparan dan mudah.
          </p>
        </div>

        <!-- Quick Links -->
        <div class="mb-6 lg:mb-0">
          <h3 class="text-lg font-bold mb-4">Quick Links</h3>
          <ul class="space-y-2 text-sm text-gray-400">
            <li><a href="#" class="hover:text-white">Home</a></li>
            <li><a href="#" class="hover:text-white">Popular Fundraisings</a></li>
            <li><a href="#" class="hover:text-white">How It Works</a></li>
            <li><a href="#" class="hover:text-white">Contact Us</a></li>
          </ul>
        </div>

        <!-- Social Media -->
        <div>
          <h3 class="text-lg font-bold mb-4">Follow Us</h3>
          <p class="text-sm text-gray-400 mb-4">Tetap terhubung dengan KitaBantu melalui sosial media:</p>
          <div class="flex space-x-4">
            <a href="https://www.facebook.com" target="_blank" class="text-gray-400 hover:text-white">
              <i class="fab fa-facebook-f text-xl"></i>
            </a>
            <a href="https://www.twitter.com" target="_blank" class="text-gray-400 hover:text-white">
              <i class="fab fa-twitter text-xl"></i>
            </a>
            <a href="https://www.instagram.com" target="_blank" class="text-gray-400 hover:text-white">
              <i class="fab fa-instagram text-xl"></i>
            </a>
            <a href="https://www.linkedin.com" target="_blank" class="text-gray-400 hover:text-white">
              <i class="fab fa-linkedin-in text-xl"></i>
            </a>
            <a href="https://www.youtube.com" target="_blank" class="text-gray-400 hover:text-white">
              <i class="fab fa-youtube text-xl"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- Copyright -->
      <div class="bg-gray-800 text-center py-4 mt-6">
        <p class="text-sm text-gray-500">
          &copy; 2025 KitaBantu. All rights reserved.
        </p>
      </div>
    </footer>


 <!-- Navigation Bar -->
    {{-- <div class="fixed bottom-4 left-1/2 transform -translate-x-1/2 bg-gray-900 text-white rounded-full shadow-lg w-11/12 max-w-md">
    <div class="flex justify-between items-center px-4 py-2">
        <!-- Discover Button -->
        <button class="flex flex-col items-center bg-orange-500 text-white rounded-full px-4 py-2">
        <i class="fas fa-heart text-xl"></i>
        <span class="text-xs">Discover</span>
        </button>
        <!-- Other Buttons -->
        <button class="flex flex-col items-center">
        <i class="fas fa-crown text-xl"></i>
        <span class="text-xs">Top</span>
        </button>
        <button class="flex flex-col items-center">
        <i class="fas fa-box text-xl"></i>
        <span class="text-xs">Box</span>
        </button>
        <button class="flex flex-col items-center">
        <i class="fas fa-cog text-xl"></i>
        <span class="text-xs">Settings</span>
        </button>
    </div>
    </div> --}}

  </div>
 </body>
</html>

