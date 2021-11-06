let enter = document.getElementById("btn-submit-task");
let InputUser = document.getElementById("create-task");
let list = document.getElementsByTagName("ul");
let task = document.getElementByTagName("li");



function inputLength(){
	return input.value.length;// To return de length of input by user
	function listLength(){
		return task.length; // return the number of tasks in the list 
	}
}

// START ADD TASK TO LIST
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
// END ADD TASK TO LIST
enterButton.addEventListener("click",addListAfterClick);

input.addEventListener("keypress", addListAfterKeypress);

//START ADD ITEM LIST 

let li = document.createElement("li");

li.appendChild(document.createTextNode(input.value)); //makes text from input field the li text
	list.appendChild(li); //adds li to ul
	input.value = ""; //Reset text input field

//END ADD ITEM LIST 


//START MARK AS DONE OPTION
function crossOut(){
    li.classList.toggle("done");// change the statement of the class (true <--> false) 
}

li.addEventListener("click", crossOut);//mark task as done when it was clicked

// END MARK AS DONE OPTION

// START ADD DELETE BUTTON
var dBtn = document.createElement("button");
dBtn.appendChild(document.createTextNode("X"));
li.appendChild(dBtn);
dBtn.addEventListener("click", deleteListItem);
// END ADD DELETE BUTTON

//ADD CLASS DELETE (DISPLAY: NONE)
function deleteListItem(){
	li.classList.add("delete")
}
//END ADD CLASS DELETE

