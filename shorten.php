<?php

if(isset($_POST['url'])){
    $url = $_POST['url'];
}else{
    echo "Произошла ошибка!";
    return;
}

$new_url = explode('://', $url, 2);
$new_url = str_replace($new_url[1], bin2hex(random_bytes(3)), $new_url[1]);

if(file_exists('urls.json')){
    $json = file_get_contents('urls.json');
    $jsonArr = json_decode($json, true);
    foreach ($jsonArr as $item){
        if ($item['url'] === $url){
            $url = explode('://', $url);

            echo $url[0] . "://". $_SERVER['HTTP_HOST'] . "/" . $item['new_url'];
            return;
        }
    }
}
$jsonArr[] = [
    'url' => $url,
    'new_url' => $new_url
];
file_put_contents('urls.json', json_encode($jsonArr, JSON_FORCE_OBJECT));

$url = explode('://', $url);

echo $url[0] . "://". $_SERVER['HTTP_HOST'] . "/" . $new_url;


