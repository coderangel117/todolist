let enterButton = document.getElementById("enter");
let input = document.getElementById("userInput");
let ol = document.querySelector("ol");
let item = document.getElementsByTagName("li");

function inputLength(){
	return input.value.length;
} 

function listLength(){
	return item.length;
}

function createListElement() {
	let li = document.createElement("li"); // creates an element "li"
	li.classList.add("inputUser")
	li.appendChild(document.createTextNode(input.value)); //makes text from input field the li text
	ol.appendChild(li); //adds li to ol
	// li.innerHTML('<p>'+ input.value  + '</p>');
	input.value = ""; //Reset text input field


	//START STRIKETHROUGH
	// because it's in the function, it only adds it for new items
	function crossOut() {
		li.classList.toggle("done");
	}

	li.addEventListener("click",crossOut);
	//END STRIKETHROUGH

	// CREATION of DOM's ELEMENT CORRESPONDING TO TRASH IMG (USE TO DELETE)
	let DOM_img = document.createElement("img");
	DOM_img.src = "img/trash.png";

	// START ADD DELETE BUTTON
	let dBtn = document.createElement("button");
	dBtn.classList.add("button");
	dBtn.appendChild(DOM_img);
	li.appendChild(dBtn);
	dBtn.addEventListener("click", deleteListItem);
	// END ADD DELETE BUTTON


	//ADD CLASS DELETE (DISPLAY: NONE)
	function deleteListItem(){
		li.classList.add("delete")
	}
	//END ADD CLASS DELETE
}


function addListAfterClick(){
	if (inputLength() > 0) { //makes sure that an empty input field doesn't create a li
		createListElement();
	}
}

 function addListAfterKeypress(event) {
 	if (inputLength() > 0 && event.which ===13) { //this now looks to see if you hit "enter"/"return"
 		//the 13 is the enter key's keycode, this could also be display by event.keyCode === 13
 		createListElement();
 	} 
 }


enterButton.addEventListener("click",addListAfterClick);

input.addEventListener("keypress", addListAfterKeypress);