let reload = document.getElementById("reload");
let enter = document.getElementById("btn-submit-task");
let InputUser = document.getElementById("create-task");
let liste = document.getElementsByTagName("ul");
let task = document.getElementByTagName("li");

function ReloadPage(){
    location.reload();
}


function inputLength(){
	return input.value.length;
} 

function listLength(){
	return task.length;
}

reload.addEventListener("click", ReloadPage);
