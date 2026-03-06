"use client";

import Link from "next/link";
import { usePathname } from "next/navigation";

export default function Navbar() {
  const pathname = usePathname();

  const links = [
    { href: "/", label: "Profile" },
    { href: "/stats", label: "Stats" },
    { href: "/gallery", label: "Gallery" },
  ];

  return (
    <ul className="flex items-center gap-6 font-medium">
      {links.map((link) => {
        const isActive = pathname === link.href;
        return (
          <li key={link.href}>
            <Link
              href={link.href}
              className={`relative py-1 transition-colors ${
                isActive ? "text-pink-600 font-bold" : "text-gray-600 hover:text-pink-500"
              }`}
            >
              {link.label}
              {isActive && (
                <span className="absolute -bottom-1 left-0 w-full h-0.5 bg-pink-500 rounded-full animate-in fade-in slide-in-from-left-2 duration-300" />
              )}
            </Link>
          </li>
        );
      })}
    </ul>
  );
}
