function is_agree(){

	var checkbox = document.getElementById("check");
	var button = document.getElementById("submit");
	
	if(!checkbox.checked){
		button.setAttribute("disabled", "true");
	}else{
		button.removeAttribute("disabled", "true");
	}
}