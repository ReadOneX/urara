"use client";

import { useState, useEffect } from "react";
import Image from "next/image";

interface Picture {
  jpg: { image_url: string };
  webp: { image_url: string };
}

const LOCAL_PICTURES: Picture[] = [
  { webp: { image_url: "/gallery/Haru_Urara_R_Card.png" }, jpg: { image_url: "/gallery/Haru_Urara_R_Card.png" } },
  { webp: { image_url: "/gallery/Haru_Urara_SSR03.png" }, jpg: { image_url: "/gallery/Haru_Urara_SSR03.png" } },
  { webp: { image_url: "/gallery/HaruUraraSSR1.png" }, jpg: { image_url: "/gallery/HaruUraraSSR1.png" } },
  { webp: { image_url: "/gallery/HaruUraraSSR2.png" }, jpg: { image_url: "/gallery/HaruUraraSSR2.png" } },
];

export default function GalleryPage() {
  const [pictures, setPictures] = useState<Picture[]>(LOCAL_PICTURES);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);
  const [cheerCount, setCheerCount] = useState(0);

  useEffect(() => {
    async function fetchPictures() {
      try {
        setLoading(true);
        const res = await fetch("https://api.jikan.moe/v4/characters/161474/pictures");
        if (!res.ok) throw new Error("Could not fetch gallery pictures");
        const { data } = await res.json();
        
        // Jikan API structure is { images: { webp: { image_url: '...' } } }
        // We map it to our Picture interface { webp: { image_url: '...' } }
        const mappedData: Picture[] = data.map((item: any) => ({
          webp: item.webp,
          jpg: item.jpg
        }));

        const combined = [...LOCAL_PICTURES, ...mappedData];
        console.log("Gallery Pictures:", combined);
        setPictures(combined);
      } catch (err: any) {
        console.error("Fetch error:", err);
        setPictures(LOCAL_PICTURES); // Fallback to local only on error
      } finally {
        setLoading(false);
      }
    }

    fetchPictures();
  }, []);

  if (loading && pictures.length === 0) {
    return (
      <div className="flex flex-col items-center justify-center min-h-[50vh] animate-pulse">
        <div className="w-16 h-16 border-4 border-pink-500 border-t-transparent rounded-full animate-spin mb-4"></div>
        <p className="text-pink-500 font-bold">Collecting photos...</p>
      </div>
    );
  }

  if (error && pictures.length === 0) {
    return (
      <div className="text-center p-12 bg-white rounded-3xl shadow-xl border border-pink-100">
        <p className="text-red-500 font-bold mb-4">Oops: {error}</p>
        <button 
          onClick={() => window.location.reload()}
          className="px-6 py-2 bg-pink-500 text-white rounded-full hover:bg-pink-600 cursor-pointer"
        >
          Retry
        </button>
      </div>
    );
  }

  return (
    <div className="space-y-12 animate-in fade-in zoom-in-95 duration-700">
      <div className="flex flex-col md:flex-row justify-between items-center gap-6">
        <div>
          <h1 className="text-4xl font-extrabold text-pink-600 mb-2">Haru Urara Gallery</h1>
          <p className="text-gray-500 font-medium">Dynamic Client-Side Rendering (CSR) with state management</p>
        </div>
        
        <div className="bg-white px-6 py-4 rounded-full shadow-lg border-2 border-pink-200 flex items-center gap-4 hover:border-pink-500 transition-colors duration-300">
          {loading && (
            <div className="flex items-center gap-2 mr-4 text-pink-400">
              <div className="w-4 h-4 border-2 border-pink-400 border-t-transparent rounded-full animate-spin"></div>
              <span className="text-xs font-bold uppercase">Syncing...</span>
            </div>
          )}
          <div className="flex flex-col items-center">
            <span className="text-xs text-pink-400 font-bold uppercase tracking-widest">Total Cheers</span>
            <span className="text-2xl font-black text-pink-600">{cheerCount}</span>
          </div>
          <button 
            onClick={() => setCheerCount(prev => prev + 1)}
            className="w-12 h-12 bg-pink-500 text-white rounded-full flex items-center justify-center text-2xl hover:bg-pink-600 hover:scale-110 active:scale-90 transition-all shadow-md cursor-pointer"
            aria-label="Cheer for Haru Urara"
          >
            🌸
          </button>
        </div>
      </div>

      <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8">
        {pictures.map((pic, idx) => (
          <div 
            key={idx} 
            className="group relative aspect-[3/4] rounded-2xl overflow-hidden shadow-lg border-2 border-white hover:border-pink-400 transition-all duration-500 hover:shadow-2xl hover:-translate-y-2"
          >
            <Image
              src={pic.webp.image_url}
              alt={`Haru Urara Image ${idx + 1}`}
              fill
              className="object-cover group-hover:scale-110 transition-transform duration-700"
              sizes="(max-width: 640px) 50vw, (max-width: 1024px) 33vw, 25vw"
            />
            <div className="absolute inset-0 bg-gradient-to-t from-pink-900/40 via-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none" />
            <div className="absolute bottom-4 left-4 right-4 translate-y-8 group-hover:translate-y-0 transition-transform duration-300 pointer-events-none">
              <span className="bg-white/90 backdrop-blur-sm text-pink-600 text-[10px] font-bold px-2 py-1 rounded uppercase tracking-widest block w-fit">
                Haru Urara Photo #{idx + 1}
              </span>
            </div>
          </div>
        ))}
      </div>

      {pictures.length === 0 && (
        <div className="text-center py-20 text-gray-400 italic">
          No images found in the gallery. 🌸
        </div>
      )}
    </div>
  );
}
