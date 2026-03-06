<?php
require_once "functions.php";
$title = "Haru Urara - Stats & Media";
$data = getJikanData("/characters/161474/full");
include "includes/header.php";

if (!$data || !isset($data['data'])):
?>
    <div class="text-center p-12 bg-white rounded-3xl shadow-xl border border-pink-100">
        <p class="text-red-500 font-bold mb-4">Error fetching statistics data from Jikan API.</p>
        <button onclick="window.location.reload()" class="px-6 py-2 bg-pink-500 text-white rounded-full hover:bg-pink-600">Retry</button>
    </div>
<?php
else:
    $characterData = $data['data'];
    
    // Daftar URL khusus yang ingin kita tambahkan ke item tertentu jika ada
    $customLinks = [
        "Uma Musume: Pretty Derby" => "https://www.youtube.com/playlist?list=PLxSscENEp7JjzK3AD896WNfsfosMcC6pL",
        "Uma Musume: Pretty Derby - Road to the Top" => "https://www.youtube.com/playlist?list=PLbRq7_wpPI8lJ0y8LbQVMMCETmEItK3Pa",
        "Umamusume: Pretty Derby—Anthology Comic STAR" => "https://mangadex.org/title/19e83dd3-083b-47a2-a308-8eb56c53df1f/umamusume-pretty-derby-anthology-comic-star",
        "Uma Musume: Haru Urara Ganbaru!" => "https://mangadex.org/title/9a5e32cc-c88c-48ad-8685-5de136ad6202/uma-musume-pretty-derby-haru-urara-ganbaru"
    ];
?>
    <div class="space-y-12 animate-in pb-12">
      <!-- Header Section -->
      <div class="flex flex-col md:flex-row justify-between items-end gap-6 border-b border-pink-100 pb-8">
        <div>
          <h1 class="text-4xl font-black text-pink-600 mb-2">Live Stats & Media</h1>
        </div>
        <div class="hidden md:block">
            <span class="px-4 py-2 bg-pink-100 text-pink-600 rounded-full text-xs font-bold uppercase tracking-widest">
                Data Updated: <?php echo date('d M Y'); ?>
            </span>
        </div>
      </div>

      <div class="grid md:grid-cols-2 gap-10">
        <!-- Anime Appearances -->
        <section class="space-y-6">
          <?php 
            // 1. Prepare Local Data
            $localAnime = [
                ["title" => "Uma Musume: Pretty Derby", "img" => "public/Uma Musume Pretty Derby.png", "link" => $customLinks["Uma Musume: Pretty Derby"]],
                ["title" => "Uma Musume: Pretty Derby - Road to the Top", "img" => "public/Uma Musume Pretty Derby - Road to the Top.png", "link" => $customLinks["Uma Musume: Pretty Derby - Road to the Top"]]
            ];

            // 2. Prepare & Filter API Data
            $filteredAnime = [];
            foreach ($characterData['anime'] as $item) {
                $title = $item['anime']['title'];
                if ($title === "UFO Princess Valkyrie 2: Juunigatsu no Yasoukyoku") continue;
                if ($title === "Soreike! Anpanman" || $title === "Sore Ike! Anpanman") continue;
                if (strpos($title, "Uma Musume") !== false) continue;
                $filteredAnime[] = $item;
            }

            $totalAnimeCount = count($localAnime) + count($filteredAnime);
          ?>
          <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
              <span class="w-10 h-10 bg-pink-500 text-white rounded-xl flex items-center justify-center shadow-lg">📺</span>
              Anime Appearances
            </h2>
            <span class="text-xs font-bold text-pink-400 bg-pink-50 px-3 py-1 rounded-full"><?php echo $totalAnimeCount; ?> Entries</span>
          </div>

          <div class="grid gap-4 max-h-[600px] overflow-y-auto pr-4 scrollbar-thin scrollbar-thumb-pink-200">
            <?php foreach ($localAnime as $a): ?>
                <a href="<?php echo $a['link']; ?>" target="_blank" 
                   class="group bg-white p-4 rounded-2xl flex items-center gap-5 border border-pink-100 hover:border-pink-300 hover:shadow-xl hover:-translate-x-1 transition-all duration-300">
                    <div class="flex-shrink-0 w-20 h-24 rounded-xl overflow-hidden shadow-md border-2 border-white group-hover:border-pink-500 transition-colors">
                        <img src="<?php echo $a['img']; ?>" alt="<?php echo $a['title']; ?>" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="flex-grow">
                        <h3 class="font-extrabold text-gray-800 group-hover:text-pink-600 transition-colors line-clamp-2"><?php echo htmlspecialchars($a['title']); ?></h3>
                        <span class="text-[10px] text-pink-500 font-bold uppercase tracking-widest mt-2 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-pink-500 rounded-full animate-pulse"></span> Watch Now
                        </span>
                    </div>
                </a>
            <?php endforeach; ?>

            <?php foreach ($filteredAnime as $item): 
                $title = $item['anime']['title'];
                $link = $customLinks[$title] ?? "#";
                $imgUrl = $item['anime']['images']['webp']['image_url'] ?? $item['anime']['images']['jpg']['image_url'] ?? "";
            ?>
                <a href="<?php echo $link; ?>" <?php echo $link !== "#" ? 'target="_blank"' : ''; ?> 
                   class="group bg-white p-4 rounded-2xl flex items-center gap-5 border border-transparent hover:border-pink-200 hover:shadow-xl hover:-translate-x-1 transition-all duration-300">
                    <div class="flex-shrink-0 w-20 h-24 rounded-xl overflow-hidden shadow-md border-2 border-white group-hover:border-pink-500 transition-colors">
                        <img src="<?php echo $imgUrl; ?>" alt="<?php echo $title; ?>" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="flex-grow">
                        <h3 class="font-extrabold text-gray-800 group-hover:text-pink-600 transition-colors line-clamp-2"><?php echo htmlspecialchars($title); ?></h3>
                        <?php if($link !== "#"): ?>
                            <span class="text-[10px] text-pink-500 font-bold uppercase tracking-widest mt-2 flex items-center gap-1">
                                <span class="w-1.5 h-1.5 bg-pink-500 rounded-full animate-pulse"></span> Watch Now
                            </span>
                        <?php endif; ?>
                    </div>
                </a>
            <?php endforeach; ?>
          </div>
        </section>

        <!-- Manga Appearances -->
        <section class="space-y-6">
          <?php 
            // 1. Prepare Local Data
            $localManga = [
                ["title" => "Umamusume: Pretty Derby—Anthology Comic STAR", "img" => "public/Anthology_Comic_Star.png", "link" => $customLinks["Umamusume: Pretty Derby—Anthology Comic STAR"]],
                ["title" => "Uma Musume: Haru Urara Ganbaru!", "img" => "public/HaruGanbaru.jpg", "link" => $customLinks["Uma Musume: Haru Urara Ganbaru!"]]
            ];

            // 2. Prepare & Filter API Data
            $filteredManga = [];
            foreach ($characterData['manga'] as $item) {
                $title = $item['manga']['title'];
                if (strpos($title, "Uma Musume") !== false || strpos($title, "Umamusume") !== false) continue;
                $filteredManga[] = $item;
            }

            $totalMangaCount = count($localManga) + count($filteredManga);
          ?>
          <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
              <span class="w-10 h-10 bg-pink-400 text-white rounded-xl flex items-center justify-center shadow-lg">📖</span>
              Manga Appearances
            </h2>
            <span class="text-xs font-bold text-pink-300 bg-pink-50 px-3 py-1 rounded-full"><?php echo $totalMangaCount; ?> Entries</span>
          </div>

          <div class="grid gap-4 max-h-[600px] overflow-y-auto pr-4">
            <?php foreach ($localManga as $m): ?>
                <a href="<?php echo $m['link']; ?>" target="_blank" 
                   class="group bg-white p-4 rounded-2xl flex items-center gap-5 border border-pink-100 hover:border-pink-300 hover:shadow-xl hover:translate-x-1 transition-all duration-300">
                    <div class="flex-shrink-0 w-20 h-24 rounded-xl overflow-hidden shadow-md border-2 border-white group-hover:border-pink-400 transition-colors">
                        <img src="<?php echo $m['img']; ?>" alt="<?php echo $m['title']; ?>" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="flex-grow">
                        <h3 class="font-extrabold text-gray-800 group-hover:text-pink-600 transition-colors line-clamp-2"><?php echo htmlspecialchars($m['title']); ?></h3>
                        <span class="text-[10px] text-pink-400 font-bold uppercase tracking-widest mt-2 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-pink-400 rounded-full animate-pulse"></span> Read Online
                        </span>
                    </div>
                </a>
            <?php endforeach; ?>

            <?php foreach ($filteredManga as $item): 
                $title = $item['manga']['title'];
                $link = $customLinks[$title] ?? "#";
                $imgUrl = $item['manga']['images']['webp']['image_url'] ?? $item['manga']['images']['jpg']['image_url'] ?? "";
            ?>
                <a href="<?php echo $link; ?>" <?php echo $link !== "#" ? 'target="_blank"' : ''; ?> 
                   class="group bg-white p-4 rounded-2xl flex items-center gap-5 border border-transparent hover:border-pink-100 hover:shadow-xl hover:translate-x-1 transition-all duration-300">
                    <div class="flex-shrink-0 w-20 h-24 rounded-xl overflow-hidden shadow-md border-2 border-white group-hover:border-pink-400 transition-colors">
                        <img src="<?php echo $imgUrl; ?>" alt="<?php echo $title; ?>" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="flex-grow">
                        <h3 class="font-extrabold text-gray-800 group-hover:text-pink-600 transition-colors line-clamp-2"><?php echo htmlspecialchars($title); ?></h3>
                        <?php if($link !== "#"): ?>
                            <span class="text-[10px] text-pink-400 font-bold uppercase tracking-widest mt-2 flex items-center gap-1">
                                <span class="w-1.5 h-1.5 bg-pink-400 rounded-full animate-pulse"></span> Read Online
                            </span>
                        <?php endif; ?>
                    </div>
                </a>
            <?php endforeach; ?>
          </div>
        </section>
      </div>

      <!-- Fun Fact Card -->
      <div class="bg-gradient-to-r from-pink-600 to-pink-500 p-10 rounded-3xl text-white shadow-2xl relative overflow-hidden group">
        <div class="absolute -top-10 -right-10 w-48 h-48 bg-white/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-1000"></div>
        <div class="relative z-10 flex flex-col md:flex-row items-center gap-8">
            <div class="text-6xl filter drop-shadow-lg">🌸</div>
            <div>
                <h2 class="text-3xl font-black mb-3 italic">Pesan Semangat Haru Urara</h2>
                <p class="text-xl font-medium leading-relaxed opacity-95 max-w-3xl">
                    "Haru Urara tidak pernah menyerah, dan kamu juga tidak boleh menyerah! Percayalah pada dirimu sendiri!" 
                    <span class="block mt-2 text-sm font-bold text-pink-200">— Haru Urara</span>
                </p>
            </div>
        </div>
      </div>
    </div>
<?php
endif;
include "includes/footer.php";
?>
