<?php
	function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
	}

function parseResponse($model, $markdown = false){
	$content = "";
	if($markdown){
		$Parsedown = new Parsedown();
		$content = strip_tags($Parsedown->text($model->content));
	}
	$blocks = json_decode($model->content, true)['data'];
	if($blocks){
		foreach ($blocks as $block) {
			if( in_array($block['type'], ['text', 'header1', 'header2', 'small']) )
				$content = $content . "\n" . strip_tags($block['data']['text']);
			else if($block['type'] === 'list'){
				foreach ($block["data"]["listItems"] as $listItems)
					$content = $content . "\n" . strip_tags($listItems["content"]);
			}
		}
	}
	$model->parsed_response = $content;
	return $model;
}

function formatSizeUnits($bytes){
		if(is_string($bytes))
			return $bytes;
        elseif ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}