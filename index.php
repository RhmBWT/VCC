<html>
	<head>

	<head>
	<body>
        <!--Получаем в ответе нужный токен-->
		<a href="https://oauth.vk.com/authorize?client_id=6678286&display=popup&redirect_uri=https://oauth.vk.com/blank.html&scope=wall&response_type=token&v=5.84&state=123456">Authorize</a>

		<a href="getmentions.php">getmentions</a>
        <form action="getmentions.php" method="post">
            <input type="number" name="offset" value="0">
            <input type="submit" value="getmentions">
        </form>
	</body>
</html>