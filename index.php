<?php
$url = $_GET['URL'] ?? '';
$adblock = isset($_GET['Adblocker']) && $_GET['Adblocker'] == 1;
$nocookies = isset($_GET['NoCookies']) && $_GET['NoCookies'] == 1;

// טיפול ב-NoCookies
if ($nocookies) {
    $url = str_replace("youtube.com", "youtube-nocookie.com", $url);
}

// טיפול ב-Adblocker (דוגמה – שימוש בפרוקסי של Piped)
if ($adblock) {
    preg_match("/v=([a-zA-Z0-9_-]+)/", $url, $matches);
    if (isset($matches[1])) {
        $videoId = $matches[1];
        $url = "https://piped.video/embed/" . $videoId;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Video Player</title>
</head>
<body style="margin:0;padding:0;">
<iframe width="100%" height="100%" src="<?= htmlspecialchars($url) ?>" frameborder="0" allowfullscreen></iframe>
</body>
</html>
