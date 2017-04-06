


function items(){
	var id1=document.getElementById("cat").value ;
	var id2=document.getElementById("col").value ;
	$.getJSON('/items_js.php',{
		category: id1,
		college: id2
	}).done(function(data){
		if (data.length === 0)
		{
			var table="<table style='padding:20px'><thead><tr><th>Image</th><th>Title</th><th>Price</th><th>College</th><th>Category</th><th>Date Posted</th><th>Contact Seller</th></tr></thead>";
			
			table+="<tbody></tbody>" ;
			var msg="<h1>Sorry No products found</h1>" ;
			table+=msg;
			document.getElementById('mytable').innerHTML = table;
		}
		else
		{
			var loader="<img id=\"loading\" src=\"img/loader.gif\" alt=\"Loading...\" />" ;
			document.getElementById('mytable').innerHTML = loader;
			

		  
		
		  
			var table="<table style='padding:20px'><thead><tr><th>Image</th><th>Title</th><th>Price</th><th>College</th><th>Category</th><th>Date Posted</th><th>Contact Seller</th></tr></thead>";
			
			table+="<tbody>" ;
			var template= _.template("<tr><td><img src='img/uploads/<%- image %>' height=60px width=60px onerror='this.src=\"img/noimage.jpg\";'></td><td><%-name%></td><td><%- price%></td><td><%-college%></td><td><%-category%><td><%-date%></td><td><a href='contact_seller.php?ad_id=<%ad_id%>'>Contact Seller</a></tr>");
			for(var i=0;i<data.length;i++){
				table+= template({
					image: data[i].image,
					name: data[i].name,
					price: data[i].price,
					college: data[i].college,
					category:data[i].category,
					date: data[i].date,
					ad_id: data[i].ad_id
				});
			}
			table+="</tbody>" ;
			document.getElementById('mytable').innerHTML = table;
			//document.getElementById('loading').style.visibility='hidden' ;*/
		}
			
	});
			
		
}
