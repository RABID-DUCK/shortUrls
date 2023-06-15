<?php

$url = $_GET['url'];
if(file_exists('urls.json')){
    $json = file_get_contents('urls.json');
    $jsonArr = json_decode($json, true);
    foreach ($jsonArr as $item){
        if ($item['new_url'] === $url){
            header('Location: ' . $item['url']);
        }
    }
}