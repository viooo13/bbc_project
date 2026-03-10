<div id="modalTestimoni" class="fixed inset-0 hidden flex items-center justify-center bg-black/50 z-[999] px-4">
    <div class="bg-white w-full max-w-lg rounded-2xl shadow-xl p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold">Tambah Testimoni</h3>
            <button type="button" onclick="tutupModalTestimoni && tutupModalTestimoni()" class="text-gray-500 hover:text-gray-800">&times;</button>
        </div>

        <div class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama</label>
                <input id="testimoniBahan" type="text" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Nama kamu" />
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Rating</label>
                <select id="testimoniRating" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                    <option value="5">5 - Sangat puas</option>
                    <option value="4">4 - Puas</option>
                    <option value="3">3 - Cukup</option>
                    <option value="2">2 - Kurang</option>
                    <option value="1">1 - Buruk</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Ulasan</label>
                <textarea id="testimoniText" rows="4" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Tulis pengalaman kamu..."></textarea>
            </div>
        </div>

        <div class="mt-6 flex justify-end gap-2">
            <button type="button" onclick="tutupModalTestimoni && tutupModalTestimoni()" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-200">Batal</button>
            <button type="button" onclick="submitTestimonial && submitTestimonial()" class="bg-red-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-700">Kirim</button>
        </div>
    </div>
</div>
