<?php

/*============= CREATE JSON DATA STORES START ====================*/


/*============= CREATE JSON DATA STORES END ====================*/


/*============= YOUR DRESS FUNCTIONS START ====================*/

function page($page){

       
     if($page === "Home"){
	
	return "id=\"none\"";
	
	}else{
	
	return "id=\"nextpage\"";
	}
}

function seo($current_page){
	
	if($current_page === "Home"){
		
		return "website development, content management, logo design,";
	}elseif($current_page === "Services" ){
		return "website development, content management, logo design,";
	}elseif($current_page === "Events"){
		return "design, fair, desinging,";
	}elseif($current_page === "Gallery"){
		
		return "website development, content management, logo design,";
	}else{
		
		return "website development, content management, logo design,";
	}
	
	
}



























?>