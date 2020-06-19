<?php

mail('vanteateam@gmail.com', 'Тема письма', 'Текст письма', 'From: zamaldinov.raxa@gmail.com');

	function readLinks($filename) {
		$data = array();
		 
		$items = file('data.txt');

		foreach ($items as $item) {
			$item_ = explode('&',$item);
			$data[] = array(
				'title' => $item_[0],
				'descr' => $item_[1],
				'link' => $item_[2]
			);
		}

		return $data;
	}

	$links = readLinks('data.txt');

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Git-Cloud</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

	<header>
		<div class="cont">
			<div class="logo">My Cloud</div>
			<div class="add-btn" onclick="addWindowShow('block', '0.5', '100')"></div>
		</div>	
	</header>

	<div id="addWindow">
		<div class="addWindowForm">
			<form action="file_parser.php" name="addForm">
				<h3 id="gotoAdd">Перейдите по <a href="https://my-files.su/" target="_blank">этой</a> ссылке, загрузите файл и поместите ссылку в нижнее поле:</h4>
				<h4>Ссылка на страницу файла:</h4>
				<input id="addLink" type="text" placeholder="Ссылка" name="fileLink" required="True">
				<button id="addReady">Добавить</button>
				<button id="addCancel" onclick="addWindowShow('none', '0', '-100')" type="button">Отмена</button>
			</form>
		</div>
	</div>

	<div class="cont">
		<div class="search-form">
			<center>
				<input id="search" type="text" placeholder="Поиск">
				<a href="#" id="search-btn"></a>
			</center>
		</div>
		<div class="cards">
			<?php

				foreach($links as $link) {
					$title = $link['title'];
					$descr = $link['descr'];
					$link = $link['link'];

					?>
						<div class="item">
							<div class="item-title"><h2><?=$title?></h2></div>
							<div class="item-descr"><p><?=$descr?></p></div>
							<div class="item-delete dropdown">
								<button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									...
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item" href="http://git-cloud.by/index.php?delete=<?=$title?>">Удалить</a>
								</div>
							</div>
							<a href="<?=$link?>" class="item-downBtn">Скачать</a>
						</div>
					<?

				}

			?>
		</div>
	</div>

	<div id="TB_overlay"></div>

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="assets/js/script.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

	<?php

		if (isset($_GET['result']) AND $_GET['result'] == 'exists') {
			?><script>itemExists();</script><?
		} else if (isset($_GET['result']) AND $_GET['result'] == 'uncorrect_url') {
			?><script>uncorrectUrl();</script><?
		}

		if (isset($_GET['delete'])) {
			$file=file("data.txt");
			foreach($file as $k=>$v)
			if (!stristr($v,$_GET['delete']))
			$nfile[]=$v;
			$file=fopen("data.txt","w");
			fwrite($file,implode($nfile,"\n"));
			file_put_contents('data.txt', array_filter(file('data.txt'),'trim'));
			fclose($file);
			echo '<script> window.location.href = "index.php" </script>;';	
		}

	?>

</body>
</html>