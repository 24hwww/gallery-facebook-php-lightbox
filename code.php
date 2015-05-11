<?php
//ID Fan Page = "797531790317008"; replace your id
$contents = file_get_contents('http://graph.facebook.com/797531790317008?fields=albums');
$albums = json_decode($contents,true);
$albums1 = $albums['data'];

function get_cover_photo($string){
	$url_cover_photo = 'http://graph.facebook.com/'.$string.'?fields=images';
	$photo_cover = file_get_contents($url_cover_photo);
	$get_photo_cover = json_decode($photo_cover,true);
		foreach ($get_photo_cover['images'] as $ky) {
		if($ky['height'] == '140'){
		echo "<img style='margin:0 auto' class='load_photos_album img-responsive' src='".$ky['source']."'>";
		}
	}
	return false;
}
function get_photos($string){
$url = "http://graph.facebook.com/".$string."/photos?limit=30&fields=images";
$photos = file_get_contents($url);
$get_photos = json_decode($photos,true);
echo '<div id="get_photos">';
	foreach ($get_photos as $image) {
		foreach($image as $source => $src) {
		$photoID = $src['id'];
			if(!empty($photoID)){
				echo '<a class="'.$string.'" href="http://graph.facebook.com/'.$photoID.'/picture">'.$photoID.'</a>';
			}
		}
	}
echo '</div>';
return false;
}

foreach ($albums as $key => $content) {
foreach ($content['data'] as $k => $c) {

	if($c['type'] == 'normal'){
	
	echo '<div class="col-sm-6"><div class="item-projecto">';
	echo '<div class="img-projecto">';
	get_cover_photo($c['cover_photo']);
	echo '</div>';
	echo '<h1>'.$c["name"].'</h1>';
	echo '<p>'.$c["description"].'</p>';
	echo '<a href="#" album="'.$c["id"].'" title="Doble Click: '.$c["name"].'" class="load_photos_album">Ver Galería</a>';
	get_photos($c["id"]);
	echo '</div></div>';
	
	}
	
}
}

?>
