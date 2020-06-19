<?php

	require_once 'libs/phpQuery.php';

	$url = trim($_GET['fileLink']);

	if (strpos($url, 'my-files.su') !== false) {
		$validation = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
		if ((bool)preg_match($validation, $url) === false) {
			header ('Location: index.php?result=uncorrect_url');
		} else {
			if ($url != '') {
				$html = file_get_contents($url);
				$pq = phpQuery::newDocument($html);

				$name = $pq->find('h2.breakword')->html();
				$descr = $pq->find('[itemprop="description"]')->html();
				$link = $url;

				$item = $name . '&' . $descr . '&' . $link;

				$file = fopen('data.txt', 'a');
				$file_lines = file('data.txt');

				if (filesize('data.txt') != 0) {
					foreach ($file_lines as $line) {
						if ($line != $item) {
							if (filesize('data.txt') != 0) {
								fwrite($file, "\n" . $item);
							} else {
								fwrite($file, $item);
							}

							header ('Location: index.php');
						} else {
							header ('Location: index.php?result=exists');
						}
					}
				} else {
					if ($line != $item) {
						if (filesize('data.txt') != 0) {
							fwrite($file, "\n" . $item);
						} else {
							fwrite($file, $item);
						}

						header ('Location: index.php');
					} else {
						header ('Location: index.php?result=exists');
					}
				}
				
				fclose($file);
			}
		}
	} else {
		header ('Location: index.php?result=uncorrect_url');
	}
	

?>