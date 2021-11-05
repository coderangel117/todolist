let reload = document.getElementById("reload");
let enter = document.getElementById("btn-submit-task");
let InputUser = document.getElementById("create-task");
let list = document.getElementsByTagName("ul");
let task = document.getElementByTagName("li");

function ReloadPage(){
    location.reload();
}


function inputLength(){
	return input.value.length;// to test if input is not empty 
} 

function listLength(){
	return task.length; // the number of tasks in the list 
}
let li = document.createElement("li");

li.appendChild(document.createTextNode(input.value)); //makes text from input field the li text
	ul.appendChild(li); //adds li to ul
	input.value = ""; //Reset text input field

function crossOut(){
    li.classList.toggle("done");
}
li.addEventListener("click", crossOut);//mark task as done when it was clicked

reload.addEventListener("click", ReloadPage);
