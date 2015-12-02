<?php

	require_once 'inc/func.inc.php';

	$url = "http://ca.ign.com/top/comic-book-villains/29.html";
	$html = file_get_contents($url);

	// $html = urlecmb_convert_encoding($html, 'utf-8');

	$document = new DOMDocument();
	@$document->loadHTML($html);

	$elements = $document->getElementsByTagName('p');

	if(!is_null($elements)){
		$final_text = '';
		foreach($elements as $element){
			$final_text .= "\n" . $element->nodeValue;
		}
		$final_text = trim($final_text);
	}

	$elements = $document->getElementsByTagName('h1');

	if(!is_null($elements)){
		foreach($elements as $element){
			$temp_name = $element->nodeValue;
			$temp_name = explode('.', $temp_name);

			$final_rank = intval(trim($temp_name[0]));
			$final_name = trim($temp_name[1]);
		}
	}

	if(preg_match_all('/<img src=[^>]+>/i',$html, $result))
		if(preg_match('/src="([^"]+)/i',$result[0][0], $src_key))
			$final_image = $src_key[1];




// die;

echo '<hr>';
echo $final_name;
echo '<hr>';
echo $final_rank;
echo '<hr>';
echo $final_text;
	
echo '<hr>';
echo $final_image;
	