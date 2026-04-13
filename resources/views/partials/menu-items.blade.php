@if(isset($menus) && $menus->count() > 0)
         @foreach($menus as $menu)
         <article class="menu-item group h-full overflow-hidden rounded-[22px] border border-[#f3c0bd] bg-[#fff4f3] shadow-[0_10px_24px_rgba(139,0,0,0.08)] transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_18px_32px_rgba(139,0,0,0.16)]">
             <div class="relative bg-gradient-to-br from-[#a10f14] via-[#d91f26] to-[#ef4444] px-4 pt-4 pb-0">
                 <div class="absolute left-4 top-4 z-10 rounded-full bg-white/92 px-2.5 py-1 text-[10px] font-extrabold uppercase tracking-wide text-[#a10f14] shadow-sm">
                     {{ ucfirst($menu->category) }}
                 </div>
                 <div class="absolute right-4 top-4 z-10 rounded-full bg-white/95 px-3 py-1 text-[11px] font-extrabold text-[#a10f14] shadow-sm">
                     Rp {{ number_format((float) $menu->price, 0, ',', '.') }}
                 </div>

                 <div class="relative aspect-[4/3] overflow-hidden rounded-t-[18px] bg-[#ffe7e6]">
                     <img src="{{ $menu->image ? asset($menu->image) : 'https://placehold.co/300x300/f9edde/3a2a1a?text=Menu' }}"
                          alt="{{ $menu->name }}"
                          class="h-full w-full object-cover transition duration-500 ease-out group-hover:scale-105">
                     <div class="absolute inset-0 bg-gradient-to-t from-[#8b0000]/10 via-transparent to-transparent"></div>
                 </div>
             </div>

             <div class="flex h-full flex-col gap-2 p-4 md:p-4.5 bg-[#fff7f7]">
                 <div>
                     <h4 class="bg-transparent p-0 m-0 text-base sm:text-lg font-extrabold text-[#5e0f13] uppercase leading-tight tracking-[0.01em] truncate">{{ $menu->name }}</h4>
                     <p class="mt-1.5 text-[11px] sm:text-xs leading-relaxed text-[#6d2a2a] overflow-hidden" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;">
                         {{ $menu->description ?: 'Menu spesial dengan cita rasa gurih dan lezat.' }}
                     </p>
                 </div>

                 <div class="mt-auto flex items-center justify-between pt-2">
                     <span class="rounded-full bg-[#ffe3e5] px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide text-[#a10f14]">
                         Best taste
                     </span>
                     <a href="https://gofood.co.id" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-full bg-[#ffe3e5] px-3 py-1.5 text-[11px] font-extrabold text-[#a10f14] transition hover:bg-[#ffd3d6]">
                         <i class="fas fa-motorcycle text-[10px]"></i>
                         GoFood
                     </a>
                 </div>
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
