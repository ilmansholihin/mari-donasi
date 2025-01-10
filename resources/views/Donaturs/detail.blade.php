<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>Details</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
 </head>
 <body class="bg-gray-100">
  <div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
   <!-- Previous header section remains the same -->
   <div class="relative">
    <img alt="Firefighters extinguishing a fire" class="w-full h-48 object-cover" src="{{ asset('thumbnail/' . $fundraising->thumbnail) }}"/>
    <div class="absolute top-0 left-0 p-4 flex items-center justify-between w-full">
     <a href="{{ route('donaturs.index') }}">
      <button class="text-white text-2xl">
       <i class="fas fa-arrow-left"></i>
      </button>
     </a>
     <h1 class="text-white text-lg font-semibold">Details</h1>
     <button class="text-white text-2xl">
      <i class="fas fa-heart"></i>
     </button>
    </div>
    <div class="absolute bottom-0 left-0 w-full bg-orange-500 text-white text-center py-2">
     <p>Everyone deserves your best help</p>
    </div>
   </div>

   <div class="p-4">
    <!-- Status badge -->
    <div class="flex items-center mb-4">
     <span class="bg-teal-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
      IN PROGRESS
     </span>
    </div>

    <!-- Title and user info -->
    <h2 class="text-2xl font-bold mb-2">{{ $fundraising->name}}</h2>
    <div class="flex items-center mb-4">
     <img alt="User avatar" class="w-10 h-10 rounded-full mr-2" src="{{ asset('avatar/' . $fundraising->user_avatar) }}"/>
     <span class="text-sm font-semibold">{{ $fundraising->user_name }}</span>
     <i class="fas fa-check-circle text-blue-500 ml-1"></i>
    </div>

    <!-- Progress section -->
    <div class="mb-6">
     <p class="text-sm font-semibold mb-2">Progress</p>
     <div class="flex justify-between items-center">
      <span class="text-gray-500">Rp {{ $fundraising->donasi_terkumpul }}</span>
      <span class="text-green-500 font-bold">Rp {{ $fundraising->target_donasi }}</span>
     </div>
     <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
      <div id="progress-bar" class="bg-green-500 h-2.5 rounded-full" style="width: 0%"></div>
     </div>
    </div>

    <!-- About section with improved text formatting -->
    <div class="mb-6">
     <h3 class="text-lg font-semibold mb-3">About</h3>
     <p class="text-gray-600 leading-relaxed bg-gray-50 p-4 rounded-lg border border-gray-100">
      {{ $fundraising->tentang }}
     </p>
    </div>

    <!-- Supporters section with improved layout -->
    <div class="mb-20"> <!-- Added bottom margin to accommodate fixed button -->
     <div class="flex justify-between items-center mb-4">
      <h3 class="text-lg font-semibold">Supporters ({{ $donatursCount }})</h3>
      <button class="text-sm text-blue-500 font-semibold hover:text-blue-600">View All</button>
     </div>
     
     @forelse ($donaturs as $donaturs)
     <div class="bg-gray-50 p-4 rounded-lg shadow-sm mb-3 hover:bg-gray-100 transition-colors">
      <div class="flex items-start space-x-4">
       <img alt="User avatar" class="w-12 h-12 rounded-full" src="https://storage.googleapis.com/a1aa/image/8bw7I8Rv0aqhJR6kkOZS20ZNyd1xOgKoxxRZJZLJNPzNIvAF.jpg"/>
       <div class="flex-1">
        <div class="flex justify-between items-start">
         <div class="text-lg font-semibold text-gray-800">Rp {{ $donaturs->total_donasi }}</div>
         <div class="text-sm text-gray-500">by {{ $donaturs->name }}</div>
        </div>
        <div class="text-sm text-gray-600 mt-1 italic">"{{ $donaturs->notes }}"</div>
       </div>
      </div>
     </div>
     @empty
     <p class="text-gray-600 text-sm text-center py-4 bg-gray-50 rounded-lg">
      Belum ada yang memberikan donasi.
     </p>
     @endforelse
    </div>

    <!-- Support button with rounded corners and shadow -->
    <div class="fixed bottom-4 left-1/2 transform -translate-x-1/2 w-11/12 max-w-md">
        @if ( $finish == 0)
     <a href="{{ route('donaturs.create', $fundraising->id) }}">
      <button class="w-full bg-green-500 hover:bg-green-600 text-white text-lg font-semibold py-4 rounded-full shadow-lg transition-colors duration-200">
       Send My Support Now
      </button>
     </a>
     @endif
    </div>
   </div>
  </div>

  <!-- Progress bar script -->
  <script>
    const fundedAmount = {{ $fundraising->donasi_terkumpul }};
    const goalAmount = {{ $fundraising->target_donasi }};
    const percentage = Math.min((fundedAmount / goalAmount) * 100, 100);
    const progressBar = document.getElementById("progress-bar");
    progressBar.style.width = `${percentage}%`;
  </script>
 </body>
</html>