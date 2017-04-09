<?php
require("../includes/helpers.php");
if($_SERVER["REQUEST_METHOD"]==="GET"){
	$auth = base64_encode('shanigaram:8NJfxQ8x');

	$aContext = array(
			'http' => array(
			'proxy' => 'tcp://202.141.80.24:3128',
			'request_fulluri' => true,
			'header' => "Proxy-Authorization : Basic $auth"
		),
	);
	$cxContext = stream_context_create($aContext);

	$source=file_get_contents($_GET[link], False, $cxContext);
	$data='<br>';
	if(preg_match_all('@<h2 class="tuple-clg-heading"><a href="[^"]+" target="_blank">\s*(.+)@',$source,$matches)){
			
			preg_match_all('@<h2 class="tuple-clg-heading"><a href="(.+)" target="_blank">@',$source,$links);
			
			
			
				for($i=0;$i<count($matches[1]);$i++){
				
					$clg=file_get_contents($links[1][$i],False,$cxContext);
					if(preg_match_all('@<a class="[^"]+">\s*(.+)\s*</a>@',$clg,$facilities)){
					
						preg_match_all('@<span class="location-of-clg">, (.+)</span></h1>@',$clg,$address);
						
						$data=$data.$matches[1][$i].'--->'.$address[0][0].'<br>';
						
						preg_match_all('@Showing [\d*] of (\d+) reviews@',$clg,$review);
						$fac='';
						for($j=0;$j<count($facilities[1]);$j++){
							$fac = $fac.$facilities[1][$j].'   ' ;
						}
						$data = $data.$fac;
						/*$connect=database_connect();
						
						//$query="INSERT INTO `colleges` (`college`, `addresss`, `facilities`, `reviews`) VALUES ('".$matches[1][$i]."','".$address[1][0]."','".$fac."','".$reviews[1][0]."');";
						
						$add=$address[1][0];
						$college=$matches[1][$i];
						$reviews=$review[1][0];
						$query="INSERT INTO `colleges` (`college`, `addresss`, `facilities`, `reviews`) VALUES ('$college','$add','sfaf','$reviews');";
						$stat=query($connect,$query);*/
						
						
						if(preg_match_all('@Showing [\d*] of (\d+) reviews@',$clg,$review))
							$data = $data.'<br>no of reviews '.$review[1][0].'<br>';
							
						else
							$data = $data.'<br>no of reviews 0 <br>';
						
					}
					sleep(1);
				}	
				
			
		}
	header("Content-type: application/json") ;
	print(json_encode($data,JSON_PRETTY_PRINT)) ;	
}
?>
