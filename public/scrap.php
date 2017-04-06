<?php
require("../includes/helpers.php");
session_start() ;
if($_SERVER["REQUEST_METHOD"] === "GET"){
	render("search_view.php",["title" => "search"]) ;
}
?>
