<?php
require_once "functions.php";
require_once "koneksi.php";
$title = "Haru Urara - Profile";
$data = getJikanData("/characters/161474");
include "includes/header.php";

if (!$data || !isset($data['data'])):
?>
    <div class="text-center p-12 bg-white rounded-3xl shadow-xl border border-pink-100">
        <p class="text-red-500 font-bold mb-4">Error fetching character data from Jikan API.</p>
        <button onclick="window.location.reload()" class="px-6 py-2 bg-pink-500 text-white rounded-full hover:bg-pink-600">Retry</button>
    </div>
<?php
else:
    $character = $data['data'];
?>
    <div class="animate-in space-y-10">
      <div class="flex flex-col md:flex-row gap-12 items-center md:items-start">
        <!-- Profile Image -->
        <div class="flex-shrink-0 relative">
            <div class="w-64 h-96 rounded-2xl overflow-hidden shadow-2xl border-4 border-white transition-transform hover:rotate-2 duration-300">
                <img src="public/Profile/Haru_Urara.png" alt="Haru Urara" class="object-cover w-full h-full" />
            </div>
            <div class="absolute -bottom-4 -right-4 bg-pink-500 text-white p-4 rounded-2xl shadow-lg transform rotate-6">
                <span class="text-2xl font-bold italic">Ceria!</span>
            </div>
        </div>

        <!-- Main Info -->
        <div class="flex-grow space-y-6">
          <div>
            <span class="text-pink-500 font-bold tracking-widest uppercase text-sm px-3 py-1 bg-pink-100 rounded-full">Profil Karakter</span>
            <h1 class="text-5xl font-extrabold text-pink-600 mt-4 leading-tight">Haru Urara</h1>
            <p class="text-xl text-gray-400 italic font-medium">ハルウララ • The Shining Loser</p>
          </div>

          <!-- Section: Tentang (Tidied Up) -->
          <div class="bg-white p-8 rounded-3xl shadow-sm border border-pink-100 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 bg-pink-50 rounded-bl-full -mr-10 -mt-10 transition-all group-hover:scale-150 duration-500"></div>
            
            <h2 class="text-2xl font-bold mb-6 text-pink-500 flex items-center gap-2">
                <span class="p-2 bg-pink-50 rounded-lg">🌸</span> Tentang Haru Urara (ハルウララ)
            </h2>
            
            <div class="grid md:grid-cols-5 gap-8 items-start">
                <div class="md:col-span-3 space-y-4">
                    <p class="text-lg leading-relaxed text-gray-700">
                        <strong>Haru Urara</strong> adalah simbol kegigihan dan optimisme di dunia <em>Uma Musume Pretty Derby</em>. Meski seringkali finish di urutan terakhir, ia tidak akan pernah membiarkan kekalahannya meredupkan senyumnya yang menular.
                    </p>
                    <p class="text-lg leading-relaxed text-gray-700 border-l-4 border-pink-200 pl-4 italic">
                        Berdasarkan kuda balap nyata dari Kota Mitsuishi, Hokkaido, Jepang, yang terkenal karena rekor kekalahan beruntunnya yang panjang, ia menjadi sensasi nasional karena sikapnya yang "tidak pernah menyerah".
                    </p>
                </div>
                
                <!-- Quick Stats Box -->
                <div class="md:col-span-2 bg-pink-50/50 p-6 rounded-2xl border border-pink-100 space-y-4">
                    <h3 class="font-bold text-pink-600 text-sm uppercase tracking-wider">Biodata Cepat</h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex justify-between border-b border-pink-100 pb-2">
                            <span class="text-gray-500 font-medium">Asal</span>
                            <span class="text-gray-800 font-bold text-right">Kota Mitsuishi, Hokkaido</span>
                        </li>
                        <li class="flex justify-between border-b border-pink-100 pb-2">
                            <span class="text-gray-500 font-medium">Teman Dekat</span>
                            <span class="text-gray-800 font-bold text-right">King Halo</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-500 font-medium">Julukan</span>
                            <span class="text-gray-800 font-bold text-right">Shining Star of Losers</span>
                        </li>
                    </ul>
                </div>
            </div>
          </div>

          <!-- Trivia (Compact Version) -->
          <div class="bg-white p-8 rounded-3xl shadow-sm border border-pink-100">
            <h2 class="text-2xl font-bold mb-8 text-pink-500 border-b border-pink-50 pb-4">Trivia Menarik</h2>
            <div class="grid sm:grid-cols-2 gap-8 text-base text-gray-700">
              <div class="flex gap-4">
                <div class="flex-shrink-0 w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center overflow-hidden">
                    <img src="public/icon/kaca-pembesar.png" alt="Search" class="w-7 h-7 object-contain" />
                </div>
                <div>
                    <p class="font-bold text-pink-700 mb-1 text-sm">Rahasia No.1</p>
                    <p class="text-sm leading-snug">Ia sangat kesulitan mengucapkan kata "prestigious" dengan benar.</p>
                </div>
              </div>

              <div class="flex gap-4">
                <div class="flex-shrink-0 w-10 h-10 bg-pink-100 rounded-xl flex items-center justify-center overflow-hidden">
                    <img src="public/icon/Berkuda.png" alt="Horse" class="w-7 h-7 object-contain" />
                </div>
                <div>
                    <p class="font-bold text-pink-700 mb-1 text-sm">Inspirasi Nyata</p>
                    <p class="text-sm leading-snug">Pakaian balapnya terinspirasi dari topeng merah-putih milik Haru Urara asli di dunia nyata.</p>
                </div>
              </div>

              <div class="flex gap-4">
                <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center overflow-hidden">
                    <img src="public/icon/roommate.png" alt="Roommate" class="w-7 h-7 object-contain" />
                </div>
                <div>
                    <p class="font-bold text-pink-700 mb-1 text-sm">Teman Sekamar</p>
                    <p class="text-sm leading-snug">Sekamar dengan King Halo, hubungan mereka satu sama lain adalah tidak pernah menyerah apapun yang terjadi.</p>
                </div>
              </div>

              <div class="flex gap-4">
                <div class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center overflow-hidden">
                    <img src="public/icon/pop.png" alt="Pop" class="w-7 h-7 object-contain" />
                </div>
                <div>
                    <p class="font-bold text-pink-700 mb-1 text-sm">Pop Culture</p>
                    <p class="text-sm leading-snug">Band Biffy Clyro menamai salah satu lagu mereka sesuai nama Haru Urara.</p>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Bottom Cards -->
          <div class="grid grid-cols-2 gap-4">
            <div class="bg-pink-600 p-6 rounded-2xl text-center shadow-lg transform transition-transform hover:-translate-y-1">
              <span class="block text-white font-black text-3xl">0 Wins</span>
              <span class="text-xs text-pink-200 font-bold uppercase tracking-widest mt-1">Racing Record</span>
            </div>
            <div class="bg-white border-2 border-pink-500 p-6 rounded-2xl text-center shadow-lg transform transition-transform hover:-translate-y-1">
              <span class="block text-pink-600 font-black text-3xl">∞ Spirit</span>
              <span class="text-xs text-pink-400 font-bold uppercase tracking-widest mt-1">Determination</span>
            </div>
          </div>

          <div class="pt-6 border-t border-pink-100 flex flex-wrap gap-4 items-center">
              <span class="text-xs font-bold text-gray-400 uppercase tracking-tighter">Referensi Resmi:</span>
              <div class="flex gap-3">
                <a href="https://x.com/uma_musu/status/1552225373860945920" target="_blank" class="p-1 bg-pink-50 hover:bg-pink-100 rounded-lg transition-colors overflow-hidden" title="X Official">
                  <img src="public/X.jpg" alt="X" class="w-6 h-6 object-cover rounded-md" />
                </a>
                <a href="https://en.wikipedia.org/wiki/Haru_Urara" target="_blank" class="p-1 bg-pink-50 hover:bg-pink-100 rounded-lg transition-colors overflow-hidden" title="Wikipedia">
                  <img src="public/Wikipedia-logo.png" alt="Wikipedia" class="w-6 h-6 object-cover rounded-md" />
                </a>
                <a href="https://umamusume.fandom.com/wiki/Haru_Urara" target="_blank" class="p-1 bg-pink-50 hover:bg-pink-100 rounded-lg transition-colors overflow-hidden" title="Fandom Wiki">
                  <img src="public/fandom-logo.png" alt="Fandom" class="w-6 h-6 object-cover rounded-md" />
                </a>
              </div>
          </div>
        </div>
      </div>
    </div>
<?php
endif;
include "includes/footer.php";
?>
