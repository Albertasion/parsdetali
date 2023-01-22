<?php
//функция форматування
function format ($expre) {
    echo "<pre>";
    print_r($expre);
    echo "</pre>";
  }
  //функція запроса
function requests ($url, $cookiefile = '/Applications/MAMP/bin/mamp/cookie.txt') {
$ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
 curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36');
$output = curl_exec($ch);
curl_close($ch);
return $output;
}