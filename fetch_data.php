<?php

	require 'inc/connection.inc.php';
	$DISABLED = true;
	
	$base_url = "http://ca.ign.com/top/comic-book-villains/";
	if(!$DISABLED){

		for($i=1; $i<=100; $i++){
			$url = $base_url . $i . ".html";		
			$html = file_get_contents($url);

			$document = new DOMDocument();
			@$document->loadHTML($html);

			$elements = $document->getElementsByTagName('p');

			if(!is_null($elements)){
				$final_text = '';
				foreach($elements as $element){
					$final_text .= "\n" . $element->nodeValue;
				}
				$final_text = addslashes(trim($final_text));
			}

			$elements = $document->getElementsByTagName('h1');

			if(!is_null($elements)){
				foreach($elements as $element){
					$temp_name = $element->nodeValue;
					$temp_name = explode('.', $temp_name);

					$final_rank = intval(trim($temp_name[0]));
					$final_name = addslashes(trim($temp_name[1]));
				}
			}

			if(preg_match_all('/<img src=[^>]+>/i',$html, $result))
				if(preg_match('/src="([^"]+)/i',$result[0][0], $src_key))
					$final_image = $src_key[1];




			$query = "INSERT INTO `data` (`rank`,`name`,`description`,`image`) VALUES ('$final_rank','$final_name','$final_text','$final_image')";
			
			if(mysqli_query($connection, $query)){
				echo $i . "success\n";
			} else {
				echo $i . "fail\n";
			}
			
		}
	} else {
		echo 'This feature has been disabled!';
	}

?>