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


function addListAfterClick(){
	if (inputLength() > 0) { //makes sure that an empty input field doesn't create a li
		createListElement();
	}
}

function addListAfterKeypress(e) {
	if (inputLength() > 0 && e.which ===13) { //this now looks to see if you hit "enter"/"return"
		//the 13 is the enter key's keycode, this could also be display by e.keyCode === 13
		createListElement();
	} 
}
function listLength(){
	return task.length; // return the number of tasks in the list 
}
let li = document.createElement("li");

li.appendChild(document.createTextNode(input.value)); //makes text from input field the li text
	ul.appendChild(li); //adds li to ul
	input.value = ""; //Reset text input field

function crossOut(){
    li.classList.toggle("done");// change the statement of the class (true <--> false) 
}

li.addEventListener("click", crossOut);//mark task as done when it was clicked
reload.addEventListener("click", ReloadPage);
