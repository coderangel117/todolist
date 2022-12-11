let savebutton = document.getElementById('save')
let enterButton = document.getElementById("enter");
let input = document.getElementById("userInput");
let btnAdd = document.getElementById("AddTask");
let ol = document.querySelector("ol");
let item = document.getElementsByTagName("li");
let Todo = document.querySelectorAll('li');
let length = Todo.length;


function inputLength() {
    return input.value.length;
}

function listLength() {
    return item.length;
}


function createListElement() {

    if (length > 4) {
        btnAdd.setAttribute('class', 'invisible');
    }
    let ListItem = document.createElement("input"); // creates an element "input"
    ListItem.appendChild(document.createTextNode(input.value)); //makes text from input field the li text
    let li = document.createElement("li"); // creates an element "li"
    // li.classList.add("inputUser");
    li.appendChild(document.createTextNode(input.value)); //makes text from input field the li text
    // btnAdd.addEventListener("click", addListAfterClick);
    ol.appendChild(li); //adds li to ol
    input.value = ""; //Reset text input field

}
function addListAfterKeypress(event) {
    if (inputLength() > 0 && event.which === 13) { //this now looks to see if you hit "enter"/"return"
        //the 13 is the enter key's keycode, this could also be display by event.keyCode === 13
        createListElement();
    }
}

function addListAfterClick() {
    if (inputLength() > 0) { //makes sure that an empty input field doesn't create a li
        createListElement();
    }
}

enterButton.addEventListener("click", addListAfterClick);

input.addEventListener("keypress", addListAfterKeypress);

// let ListItem = document.createElement("input"); // creates an element "input"
// ListItem.classList.add("inputUser");
// li.appendChild(ListItem); //adds input item to li
// ListItem.innerHTML('<p>'+ input.value  + '</p>');