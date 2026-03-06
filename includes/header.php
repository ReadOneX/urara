<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title . " - Haru Urara" : "Haru Urara Fan Site"; ?></title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        pink: {
                            50: '#fff1f2',
                            100: '#ffe4e6',
                            200: '#fecdd3',
                            300: '#fda4af',
                            400: '#fb7185',
                            500: '#f43f5e',
                            600: '#e11d48',
                            700: '#be123c',
                            800: '#9f1239',
                            900: '#881337',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-in {
            animation: fadeIn 0.6s ease-out forwards;
        }
        .nav-link-active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background: #f43f5e;
            border-radius: 99px;
            transform: scaleX(1);
            transition: transform 0.3s ease;
        }
        .nav-link:not(.nav-link-active)::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background: #f43f5e;
            border-radius: 99px;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        .nav-link:hover::after {
            transform: scaleX(1);
        }
    </style>
</head>
<body class="antialiased bg-[#fff8f9] text-gray-900 min-h-screen flex flex-col font-sans">
    <!-- Main Navigation Header -->
    <header class="sticky top-0 z-50 w-full transition-all duration-300">
        <div class="absolute inset-0 bg-white/80 backdrop-blur-md border-b border-pink-100/50 shadow-sm"></div>
        <nav class="relative max-w-6xl mx-auto px-6 py-4 flex flex-col md:flex-row justify-between items-center gap-4">
            <!-- Logo Section -->
            <a href="index.php" class="flex items-center gap-3 group">
                <div class="w-10 h-10 bg-pink-500 rounded-xl flex items-center justify-center text-xl shadow-lg shadow-pink-200 group-hover:rotate-12 transition-transform duration-300">
                    🌸
                </div>
                <span class="text-xl font-black tracking-tight text-gray-800 group-hover:text-pink-600 transition-colors">
                    Haru Urara <span class="text-pink-500">Fan Site</span>
                </span>
            </a>

            <!-- Navigation Links -->
            <ul class="flex items-center gap-1 md:gap-4 bg-pink-50/50 p-1 rounded-2xl border border-pink-100/50">
                <?php
                $current_page = basename($_SERVER['PHP_SELF']);
                $links = [
                    'index.php' => 'Profile',
                    'stats.php' => 'Stats',
                    'gallery.php' => 'Gallery'
                ];
                foreach ($links as $file => $label):
                    $isActive = ($current_page == $file) || ($current_page == '' && $file == 'index.php');
                ?>
                    <li>
                        <a href="<?php echo $file; ?>" 
                           class="flex items-center gap-2 px-5 py-2 rounded-xl text-sm font-bold transition-all duration-300 
                           <?php echo $isActive 
                                ? 'bg-white text-pink-600 shadow-sm ring-1 ring-pink-100' 
                                : 'text-gray-500 hover:text-pink-500 hover:bg-white/50'; ?>">
                            <?php echo $label; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </header>

    <main class="flex-grow container mx-auto px-4 py-10 max-w-6xl">
