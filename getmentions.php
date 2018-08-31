<html>

    <head>

    </head>

    <body>
        Offset: <?php echo ($_POST['offset']) ?>
        <form action="getmentions.php" method="post">
            <input type="number" name="offset" value="<?php echo ($_POST['offset']+50) ?>">
            <input type="submit" value="getmentions">
        </form>
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <button id="deleteall">deleteall</button>
        <script>
            $( "#deleteall" ).click(function() {
                $( "#test" ).click();
            });
        </script>
        <?php
        // общие параметры запроса
        $accessToken = '32336b6c00dcc2373dc13ce8133f42b5681511b7c6123c9c93e5d097d5e2ae0d316372819215be5997aee';
        $v = 5.84;

        // специальные параметры для упоминаний
        $userId = 170579647;
        $countMentions = 50;
        $offset = $_POST['offset'];

        // специальные параметры для комментариев
        $countComments = 100;

        // запрос
        $queryMentions = 'https://api.vk.com/method/newsfeed.getMentions?owner_id='.$userId.'&count='.$countMentions.'&offset='.$offset.'&access_token='.$accessToken.'&v='.$v.'';
        $jsonMentions = file_get_contents($queryMentions);

        // результат
        $resultMentions = json_decode($jsonMentions, true);
        $arrayMentions = $resultMentions['response']['items'];

        // вывод результата
        foreach ($arrayMentions as &$mention) {
            // инфа о найденных упоминаниях со ссылкой на пост
//            echo 'found mention in '.$mention['to_id'].' community, post id '.$mention['post_id'].'';
//            echo ', post url <a href="https://vk.com/wall'.$mention['to_id'].'_'.$mention['post_id'].'">here</a><br>';

            // запрос комментариев к каждому посту
            $queryComments = 'https://api.vk.com/method/wall.getComments?owner_id='.$mention['to_id'].'&post_id='.$mention['post_id'].'&count='.$countComments.'&access_token='.$accessToken.'&v='.$v.'';
            $jsonComments = file_get_contents($queryComments);

            // результат комментариев
            $resultComments = json_decode($jsonComments, true);
            $arrayComments = $resultComments['response']['items'];

            // вывод результата комментариев
            foreach ($arrayComments as &$comment) {
                if ($comment['from_id']=='170579647') {
                    echo '<form action="deletecomment.php" target="res" method="POST" style="height: 10px"><br><input type="text" name="owner_id" value="';
                    echo $mention['to_id'];
                    echo '"><input type="text" name="comment_id" value="';
                    echo $comment['id'];
                    echo '"><input type="submit" id="test" value="deletecomment"></form>';
                    //echo '<a href="https://api.vk.com/method/wall.deleteComment?owner_id='.$mention['to_id'].'&comment_id='.$comment['id'].'&access_token='.$accessToken.'&v='.$v.'">delete link</a>';
                }
            }
        }?>
        <iframe name="res" height="0" style="visibility: hidden"></iframe>
    </body>

</html>