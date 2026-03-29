@if(isset($menus) && $menus->count() > 0)
         @foreach($menus as $menu)
         <div class="menu-item bg-[#F9EDDE] rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 p-5">
             <div class="flex items-start gap-4">
                 <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full overflow-hidden bg-[#EFE1D1] shrink-0">
                     <img src="{{ $menu->image ? asset($menu->image) : 'https://placehold.co/300x300/f9edde/3a2a1a?text=Menu' }}"
                          alt="{{ $menu->name }}"
                          class="w-full h-full object-cover">
                 </div>

                 <div class="min-w-0 flex-1">
                     <div class="flex items-start justify-between gap-3">
                         <h4 class="text-xs sm:text-sm font-extrabold text-[#3a2a1a] uppercase leading-snug">{{ $menu->name }}</h4>
                         
                     </div>
                     <p class="text-[11px] text-[#3a2a1a] mt-1 leading-relaxed max-h-10 overflow-hidden">{{ $menu->description }}</p>
                    
                 </div>
             </div>
         </div>
         @endforeach
     @else
         <div class="col-span-full text-center text-gray-700">
             <div class="bg-[#F9EDDE] rounded-2xl p-10 shadow">
                 <h4 class="text-2xl font-bold mb-2">Menu belum tersedia</h4>
                 <p class="text-sm">Silakan tambahkan data menu dari halaman admin.</p>
         </div>
     </div>
 @endif
