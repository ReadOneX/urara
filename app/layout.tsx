import type { Metadata } from "next";
import { Geist, Geist_Mono } from "next/font/google";
import "./globals.css";
import Link from "next/link";
import Navbar from "./components/Navbar";

const geistSans = Geist({
  variable: "--font-geist-sans",
  subsets: ["latin"],
});

const geistMono = Geist_Mono({
  variable: "--font-geist-mono",
  subsets: ["latin"],
});

export const metadata: Metadata = {
  title: "Haru Urara - Uma Musume Fan Site",
  description: "A showcase of Haru Urara using Next.js rendering techniques",
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="en" className="h-full">
      <body
        className={`${geistSans.variable} ${geistMono.variable} antialiased bg-pink-50 text-gray-900 min-h-screen flex flex-col`}
      >
        <header className="bg-white shadow-md sticky top-0 z-50 px-4 py-3 md:px-8">
          <nav className="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
            <Link href="/" className="text-2xl font-bold text-pink-500 hover:text-pink-600 transition-colors">
              🌸 Haru Urara Fan
            </Link>
            <Navbar />
          </nav>
        </header>

        <main className="flex-grow container mx-auto px-4 py-8 max-w-6xl">
          {children}
        </main>

        <footer className="bg-pink-100 py-6 text-center text-gray-600">
          <p>© 2026 Haru Urara Fan Project. Made with Next.js 16.</p>
        </footer>
      </body>
    </html>
  );
}
