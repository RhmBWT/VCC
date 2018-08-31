<?php
// параметры запроса
$access_token = '32336b6c00dcc2373dc13ce8133f42b5681511b7c6123c9c93e5d097d5e2ae0d316372819215be5997aee';
$owner_id = $_POST['owner_id'];
$post_id = $_POST['post_id'];
$count = 100;
$v = 5.84;

// запрос
$url = 'https://api.vk.com/method/wall.getComments?owner_id='.$owner_id.'&post_id='.$post_id.'&count='.$count.'&access_token='.$access_token.'&v='.$v.'';
$json = file_get_contents($url);

// результат
$out = json_decode($json, true);
$arr = $out['response']['items'];

// вывод результата
foreach ($arr as &$value) {
    if ($value['from_id']=='170579647') {
        echo 'found comment '.$value['id'].'<br>';
        echo '<form action="deletecomment.php" method="POST"><br><input type="text" name="owner_id" value="';
        echo $owner_id;
        echo '"><input type="text" name="comment_id" value="';
        echo $value['id'];
        echo '"><input type="submit" value="deletecomment"></form>';
    }
}
echo '.';
