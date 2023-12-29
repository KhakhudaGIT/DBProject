<?php require_once 'timplate.php' ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https:
    <link rel="stylesheet" href="https:
    <?php startblock('link') ?><?php endblock() ?>
	<title><?php startblock('titlePage') ?><?php endblock() ?></title>
</head>
<body>
	<?php 
		session_start();
		startblock('bodyPageMain') ?><?php endblock() 
	?>
</body>
</html>