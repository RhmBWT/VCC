<?php
// параметры запроса
$access_token = '32336b6c00dcc2373dc13ce8133f42b5681511b7c6123c9c93e5d097d5e2ae0d316372819215be5997aee';
$v = 5.84;
$owner_id = $_POST['owner_id'];
$comment_id = $_POST['comment_id'];

// запрос
$url = 'https://api.vk.com/method/wall.deleteComment?owner_id='.$owner_id.'&comment_id='.$comment_id.'&access_token='.$access_token.'&v='.$v.'';
$json = file_get_contents($url);

// результат
$out = json_decode($json, true);

//header('Location: ' . $_SERVER['HTTP_REFERER']);

print_r($out);