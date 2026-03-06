import Image from "next/image";

async function getStatsData() {
  const res = await fetch("https://api.jikan.moe/v4/characters/161474/full", {
    cache: "no-store", // SSR: Fetch on every request
  });

  if (!res.ok) {
    throw new Error("Failed to fetch statistics data");
  }

  return res.json();
}

export default async function StatsPage() {
  const { data } = await getStatsData();

  return (
    <div className="space-y-12 animate-in fade-in slide-in-from-bottom-8 duration-700">
      <div className="text-center">
        <h1 className="text-4xl font-extrabold text-pink-600 mb-2">Live Stats & Media</h1>
        <p className="text-gray-500 font-medium tracking-wide">Real-time data fetched from Server-Side (SSR)</p>
      </div>

      <div className="grid md:grid-cols-2 gap-8">
        {/* Anime Appearances */}
        <section className="bg-white p-8 rounded-3xl shadow-xl border-l-8 border-pink-500 hover:shadow-2xl transition-shadow duration-300">
          <h2 className="text-2xl font-bold mb-6 text-pink-500 flex items-center gap-3">
            📺 Anime Appearances
          </h2>
          <div className="space-y-4 max-h-[400px] overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-pink-200">
            {/* Custom Entry: Uma Musume Pretty Derby */}
            <a 
              href="https://www.youtube.com/playlist?list=PLxSscENEp7JjzK3AD896WNfsfosMcC6pL" 
              target="_blank" 
              rel="noopener noreferrer"
              className="group flex items-center gap-4 p-4 rounded-2xl hover:bg-pink-50 transition-colors border border-transparent hover:border-pink-200 shadow-sm"
            >
              <div className="flex-shrink-0 relative w-16 h-20 rounded-lg overflow-hidden border border-pink-100 group-hover:scale-110 transition-transform duration-300">
                <Image
                  src="/Uma Musume Pretty Derby.png"
                  alt="Uma Musume: Pretty Derby"
                  fill
                  className="object-cover"
                />
              </div>
              <div>
                <h3 className="font-bold text-gray-800 line-clamp-2 leading-tight group-hover:text-pink-600 transition-colors">Uma Musume: Pretty Derby</h3>
              </div>
            </a>

            {/* Custom Entry: Uma Musume Pretty Derby - Road to the Top */}
            <a 
              href="https://www.youtube.com/playlist?list=PLbRq7_wpPI8lJ0y8LbQVMMCETmEItK3Pa#:~:text=Umamusume%3A%20Pretty%20Derby%20Road%20to%20the%20Top%20%2D%20YouTube" 
              target="_blank" 
              rel="noopener noreferrer"
              className="group flex items-center gap-4 p-4 rounded-2xl hover:bg-pink-50 transition-colors border border-transparent hover:border-pink-200 shadow-sm"
            >
              <div className="flex-shrink-0 relative w-16 h-20 rounded-lg overflow-hidden border border-pink-100 group-hover:scale-110 transition-transform duration-300">
                <Image
                  src="/Uma Musume Pretty Derby - Road to the Top.png"
                  alt="Uma Musume: Pretty Derby - Road to the Top"
                  fill
                  className="object-cover"
                />
              </div>
              <div>
                <h3 className="font-bold text-gray-800 line-clamp-2 leading-tight group-hover:text-pink-600 transition-colors">Uma Musume: Pretty Derby - Road to the Top</h3>
              </div>
            </a>

            {data.anime
              .filter((item: any) => item.anime.title !== "UFO Princess Valkyrie 2: Juunigatsu no Yasoukyoku")
              .map((item: any) => (
              <div 
                key={item.anime.mal_id} 
                className="group flex items-center gap-4 p-4 rounded-2xl hover:bg-pink-50 transition-colors border border-transparent hover:border-pink-200 shadow-sm"
              >
                <div className="flex-shrink-0 relative w-16 h-20 rounded-lg overflow-hidden border border-pink-100 group-hover:scale-110 transition-transform duration-300">
                  <Image
                    src={item.anime.images.webp.image_url}
                    alt={item.anime.title}
                    fill
                    className="object-cover"
                  />
                </div>
                <div>
                  <h3 className="font-bold text-gray-800 line-clamp-2 leading-tight group-hover:text-pink-600 transition-colors">{item.anime.title}</h3>
                </div>
              </div>
            ))}
          </div>
        </section>

        {/* Manga Appearances */}
        <section className="bg-white p-8 rounded-3xl shadow-xl border-l-8 border-pink-300 hover:shadow-2xl transition-shadow duration-300">
          <h2 className="text-2xl font-bold mb-6 text-pink-500 flex items-center gap-3">
            📖 Manga Appearances
          </h2>
          <div className="space-y-4 max-h-[400px] overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-pink-100">
            {/* Custom Entry: Anthology Comic STAR */}
            <a 
              href="https://mangadex.org/title/19e83dd3-083b-47a2-a308-8eb56c53df1f/umamusume-pretty-derby-anthology-comic-star" 
              target="_blank" 
              rel="noopener noreferrer"
              className="group flex items-center gap-4 p-4 rounded-2xl hover:bg-pink-50 transition-colors border border-transparent hover:border-pink-200 shadow-sm"
            >
              <div className="flex-shrink-0 relative w-16 h-20 rounded-lg overflow-hidden border border-pink-100 group-hover:scale-110 transition-transform duration-300">
                <Image
                  src="/Anthology_Comic_Star.png"
                  alt="Umamusume: Pretty Derby—Anthology Comic STAR"
                  fill
                  className="object-cover"
                />
              </div>
              <div>
                <h3 className="font-bold text-gray-800 line-clamp-2 leading-tight group-hover:text-pink-600 transition-colors">Umamusume: Pretty Derby—Anthology Comic STAR</h3>
              </div>
            </a>

            {/* Custom Entry: Uma Musume: Haru Urara Ganbaru! */}
            <a 
              href="https://mangadex.org/title/9a5e32cc-c88c-48ad-8685-5de136ad6202/uma-musume-pretty-derby-haru-urara-ganbaru" 
              target="_blank" 
              rel="noopener noreferrer"
              className="group flex items-center gap-4 p-4 rounded-2xl hover:bg-pink-50 transition-colors border border-transparent hover:border-pink-200 shadow-sm"
            >
              <div className="flex-shrink-0 relative w-16 h-20 rounded-lg overflow-hidden border border-pink-100 group-hover:scale-110 transition-transform duration-300">
                <Image
                  src="/HaruGanbaru.jpg"
                  alt="Uma Musume: Haru Urara Ganbaru!"
                  fill
                  className="object-cover"
                />
              </div>
              <div>
                <h3 className="font-bold text-gray-800 line-clamp-2 leading-tight group-hover:text-pink-600 transition-colors">Uma Musume: Haru Urara Ganbaru!</h3>
              </div>
            </a>

            {data.manga.map((item: any) => (
              <div 
                key={item.manga.mal_id} 
                className="group flex items-center gap-4 p-4 rounded-2xl hover:bg-pink-50 transition-colors border border-transparent hover:border-pink-200 shadow-sm"
              >
                <div className="flex-shrink-0 relative w-16 h-20 rounded-lg overflow-hidden border border-pink-100 group-hover:scale-110 transition-transform duration-300">
                  <Image
                    src={item.manga.images.webp.image_url}
                    alt={item.manga.title}
                    fill
                    className="object-cover"
                  />
                </div>
                <div>
                  <h3 className="font-bold text-gray-800 line-clamp-2 leading-tight group-hover:text-pink-600 transition-colors">{item.manga.title}</h3>
                </div>
              </div>
            ))}
          </div>
        </section>
      </div>

      <div className="bg-pink-600 p-8 rounded-3xl text-white shadow-2xl relative overflow-hidden group">
        <div className="absolute top-0 right-0 p-8 opacity-10 group-hover:scale-125 transition-transform duration-700 pointer-events-none">
          <span className="text-9xl">🌸</span>
        </div>
        <div className="relative z-10">
          <h2 className="text-3xl font-extrabold mb-4 tracking-tight">Fakta Tentang Haru Urara</h2>
          <p className="text-xl font-medium leading-relaxed max-w-2xl opacity-90">
            Meski mengalami kekalahan beruntun yang panjang di dunia nyata, Haru Urara menjadi sensasi nasional karena sikapnya yang "pantang menyerah", menginspirasi jutaan orang di Jepang!
          </p>
        </div>
      </div>
    </div>
  );
}
