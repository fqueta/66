<?php
class Url
{
	public static function getHashedUrl($key)
	{
		if(!file_exists("rev-manifest.json"))
			return "dist/".$key;
		$manifest = file_get_contents("rev-manifest.json");
		$manifest = json_decode($manifest, true);

		if($manifest[$key] == null)
			return "/dist/".$key;
		return "dist/".$manifest[$key];
	}
}
?>
