@if(isset($menus) && $menus->count() > 0)
         @foreach($menus as $menu)
         <article class="menu-item bg-[#F9EDDE] rounded-2xl border border-[#eadbc8] shadow-[0_6px_16px_rgba(58,42,26,0.08)] hover:shadow-[0_12px_22px_rgba(58,42,26,0.14)] transition-all duration-300 p-4 md:p-5">
             <div class="flex items-center gap-3 md:gap-4">
                 <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full overflow-hidden bg-white shrink-0 shadow-md ring-2 ring-[#f1e5d5]">
                     <img src="{{ $menu->image ? asset($menu->image) : 'https://placehold.co/300x300/f9edde/3a2a1a?text=Menu' }}"
                          alt="{{ $menu->name }}"
                          class="w-full h-full object-cover">
                 </div>

                 <div class="min-w-0 flex-1">
                     <h4 class="text-sm sm:text-base font-extrabold text-[#2f1f16] uppercase leading-tight tracking-[0.01em] truncate">{{ $menu->name }}</h4>
                     <p class="text-[11px] sm:text-xs text-[#4b382a] mt-1.5 leading-relaxed overflow-hidden" style="display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;">
                         {{ $menu->description ?: 'Menu spesial dengan cita rasa gurih dan lezat.' }}
                     </p>
                 </div>
             </div>

             <div class="mt-3 pt-2 border-t border-[#eadbc8] flex justify-center">
                 <a href="https://gofood.co.id" target="_blank" rel="noopener" class="inline-flex items-center justify-center rounded-full bg-white/70 px-3 py-1 hover:bg-white transition">
                     <img src="{{ asset('gofood.png') }}" alt="GoFood" class="h-4 sm:h-5 w-auto object-contain" />
                 </a>
             </div>
         </article>
         @endforeach
     @else
         <div class="col-span-full text-center text-gray-700">
             <div class="bg-[#F9EDDE] rounded-2xl p-10 shadow">
                 <h4 class="text-2xl font-bold mb-2">Menu belum tersedia</h4>
                 <p class="text-sm">Silakan tambahkan data menu dari halaman admin.</p>
         </div>
     </div>
 @endif
