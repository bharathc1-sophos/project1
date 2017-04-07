<?php
require("../includes/helpers.php");
session_start() ;
if($_SERVER["REQUEST_METHOD"] === "GET"){
	render("search_view.php",["title" => "search"]) ;
}
else{
	if(!empty($_POST[link])){
		$auth = base64_encode('shanigaram:8NJfxQ8x');

		$aContext = array(
			'http' => array(
				'proxy' => 'tcp://202.141.80.24:3128',
				'request_fulluri' => true,
				'header' => "Proxy-Authorization : Basic $auth"
			),
		);
		$cxContext = stream_context_create($aContext);

		$source=file_get_contents($_POST[link], False, $cxContext);
		if(preg_match_all('@<a class="[^"]+">\s*(.+)\s*</a>@',$source,$matches)){
			
			//$k=preg_match_all('@<h2 class="tuple-clg-heading"><a href="(.+)" target="_blank">@',$source,$address);
			
				for($i=0;$i<count($matches[1]);$i++){
					//preg_match('@\|\s*(.+)@',$address[1][$i],$add);
					echo $matches[1][$i].'<br>' ;
				}
				//echo $address[1][0].'<br>' ;
				//var_dump($address[1][0]);
				//var_dump($matches[0]);
			
		}
		else{
			$msg="not found";
			var_dump($matches);
			echo $msg."sorry".$source ;
			
		}
	}
	else{
		$msg="you must provide the link";
		apologize($msg);
	}
}
?>
