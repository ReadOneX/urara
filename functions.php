<?php
function getJikanData($path, $revalidate = 3600) {
    $apiUrl = "https://api.jikan.moe/v4" . $path;
    
    $options = [
        "http" => [
            "header" => "User-Agent: PHP-Jikan-Client\r\n",
            "method" => "GET",
            "timeout" => 5
        ]
    ];
    $context = stream_context_create($options);
    
    try {
        $response = @file_get_contents($apiUrl, false, $context);
        
        if ($response !== false) {
            $decoded = json_decode($response, true);
            if ($decoded && isset($decoded['data'])) {
                return $decoded;
            }
        }
    } catch (Exception $e) {
        // Fallback
    }

    // --- FALLBACK DATA (Data Cadangan jika API Gagal) ---
    
    // Fallback untuk Profil (index.php)
    if ($path === "/characters/161474") {
        return [
            "data" => [
                "name_kanji" => "ハルウララ",
                "about" => "Haru Urara is a cheerful horse girl...",
                "images" => ["webp" => ["image_url" => "public/Haru_Urara.png"]]
            ]
        ];
    }

    // Fallback untuk Stats & Media (stats.php)
    if ($path === "/characters/161474/full") {
        return [
            "data" => [
                "anime" => [
                    ["anime" => ["title" => "Uma Musume: Pretty Derby", "images" => ["webp" => ["image_url" => "public/Uma Musume Pretty Derby.png"]]]],
                    ["anime" => ["title" => "Uma Musume: Pretty Derby - Road to the Top", "images" => ["webp" => ["image_url" => "public/Uma Musume Pretty Derby - Road to the Top.png"]]]]
                ],
                "manga" => [
                    ["manga" => ["title" => "Umamusume: Pretty Derby—Anthology Comic STAR", "images" => ["webp" => ["image_url" => "public/Anthology_Comic_Star.png"]]]],
                    ["manga" => ["title" => "Uma Musume: Haru Urara Ganbaru!", "images" => ["webp" => ["image_url" => "public/HaruGanbaru.jpg"]]]]
                ]
            ]
        ];
    }
    
    return null;
}
?>
