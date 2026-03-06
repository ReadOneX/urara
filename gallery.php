<?php
require_once "functions.php";
$title = "Haru Urara - Gallery";
$localPictures = [
    ["url" => "public/gallery/Haru_Urara_R_Card.png", "caption" => "Haru Urara Photo #1"],
    ["url" => "public/gallery/Haru_Urara_SSR03.png", "caption" => "Haru Urara Photo #2"],
    ["url" => "public/gallery/HaruUraraSSR1.png", "caption" => "Haru Urara Photo #3"],
    ["url" => "public/gallery/HaruUraraSSR2.png", "caption" => "Haru Urara Photo #4"]
];

$allPictures = $localPictures;

include "includes/header.php";
?>
    <div class="space-y-12 animate-in pb-12">
      <div class="flex flex-col md:flex-row justify-between items-center gap-6">
        <div>
          <h1 class="text-4xl font-extrabold text-pink-600 mb-2">Haru Urara Gallery</h1>
        </div>
        
        <div class="bg-white px-6 py-4 rounded-full shadow-lg border-2 border-pink-200 flex items-center gap-4 hover:border-pink-500 transition-colors duration-300">
          <div class="flex flex-col items-center">
            <span class="text-xs text-pink-400 font-bold uppercase tracking-widest">Total Cheers</span>
            <span id="cheer-count" class="text-2xl font-black text-pink-600">0</span>
          </div>
          <button 
            onclick="cheer()"
            class="w-12 h-12 bg-pink-500 text-white rounded-full flex items-center justify-center text-2xl hover:bg-pink-600 hover:scale-110 active:scale-90 transition-all shadow-md cursor-pointer"
            aria-label="Cheer for Haru Urara"
          >
            🌸
          </button>
        </div>
      </div>

      <!-- Gallery Grid -->
      <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8">
        <?php foreach ($allPictures as $idx => $pic): ?>
          <div 
            onclick="openModal('<?php echo $pic['url']; ?>', '<?php echo addslashes($pic['caption']); ?>')"
            class="group relative aspect-[3/4] rounded-2xl overflow-hidden shadow-lg border-2 border-white hover:border-pink-400 transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 cursor-pointer"
          >
            <img
              src="<?php echo $pic['url']; ?>"
              alt="<?php echo htmlspecialchars($pic['caption']); ?>"
              class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-700"
              loading="lazy"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-pink-900/40 via-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none flex items-center justify-center">
            </div>
            <div class="absolute bottom-4 left-4 right-4 translate-y-8 group-hover:translate-y-0 transition-transform duration-300 pointer-events-none">
              <span class="bg-white/90 backdrop-blur-sm text-pink-600 text-[10px] font-bold px-2 py-1 rounded uppercase tracking-widest block w-fit">
                <?php echo $pic['caption']; ?>
              </span>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Image Modal (Pop-up) -->
    <div id="imageModal" class="fixed inset-0 z-[100] hidden bg-black/90 backdrop-blur-sm flex items-center justify-center p-4 md:p-10 transition-all duration-500 opacity-0" onclick="closeModal()">
        <button class="absolute top-6 right-6 text-white text-5xl font-light hover:text-pink-400 hover:rotate-90 transition-all duration-300 z-[110]" onclick="closeModal()">&times;</button>
        <div id="modalContent" class="relative max-w-4xl w-full h-full flex flex-col items-center justify-center gap-6 transition-all duration-500 scale-75 opacity-0" onclick="event.stopPropagation()">
            <img id="modalImg" src="" alt="" class="max-w-full max-h-[80vh] object-contain rounded-2xl shadow-[0_0_50px_rgba(0,0,0,0.5)] border-4 border-white/10" />
            <p id="modalCaption" class="text-white font-black tracking-[0.2em] uppercase text-xs bg-pink-600 px-6 py-3 rounded-full shadow-2xl transform -translate-y-4 opacity-0 transition-all duration-700 delay-150"></p>
        </div>
    </div>

    <script>
        // Gallery Functions
        function openModal(url, caption) {
            const modal = document.getElementById('imageModal');
            const modalContent = document.getElementById('modalContent');
            const modalImg = document.getElementById('modalImg');
            const modalCaption = document.getElementById('modalCaption');
            
            modalImg.src = url;
            modalCaption.innerText = caption;
            
            // 1. Munculkan container utama
            modal.classList.remove('hidden');
            
            // 2. "Force Reflow" - Trik agar browser siap menjalankan animasi
            void modal.offsetWidth; 
            
            // 3. Jalankan animasi (Fade & Scale)
            modal.classList.add('opacity-100');
            modalContent.classList.remove('scale-75', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
            
            modalCaption.classList.remove('opacity-0', '-translate-y-4');
            modalCaption.classList.add('opacity-100', 'translate-y-0');

            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('imageModal');
            const modalContent = document.getElementById('modalContent');
            const modalCaption = document.getElementById('modalCaption');
            
            // Balikkan animasi
            modal.classList.remove('opacity-100');
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-75', 'opacity-0');
            modalCaption.classList.add('opacity-0', '-translate-y-4');
            
            // Sembunyikan setelah animasi selesai (500ms sesuai durasi transisi)
            setTimeout(() => {
                if (!modal.classList.contains('opacity-100')) {
                    modal.classList.add('hidden');
                    document.body.style.overflow = 'auto';
                }
            }, 500);
        }

        // Close on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal();
        });

        // Cheer Logic
        const cheerCountEl = document.getElementById('cheer-count');
        
        fetch('api/cheer.php')
            .then(res => res.json())
            .then(data => {
                cheerCountEl.innerText = data.count;
            });

        function cheer() {
            let current = parseInt(cheerCountEl.innerText);
            cheerCountEl.innerText = current + 1;

            fetch('api/cheer.php', { method: 'POST' })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        cheerCountEl.innerText = data.count;
                    }
                });
        }
    </script>
<?php
include "includes/footer.php";
?>
