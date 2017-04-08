
function scrape(){
	var link=document.getElementById("q").value ;
	var loader="<img id=\"loading\" src=\"img/loader.gif\" alt=\"Loading...\" />" ;
	document.getElementById('show').innerHTML = loader;
	$.getJSON('/scrap_js.php',{
		link: link,
	}).done(function(data){
		if (data.length === 0)
		{
			var table="no results found";
			
			document.getElementById('show').innerHTML = table;
		}
		else
		{
			var loader="<img id=\"loading\" src=\"img/loader.gif\" alt=\"Loadingde...\" />" ;
			document.getElementById('show').innerHTML = loader;
			

		  
		
		  
			var content=data;
			document.getElementById('show').innerHTML = content;
			//document.getElementById('loading').style.visibility='hidden' ;*/
		}
			
	});
			
		
}
