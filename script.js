//COPYRIGHT (C)  todolist ( Gabriel PERINO) 2019. All rights reserved.

let savebutton = document.getElementById('save')
let enterButton = document.getElementById("enter");
let input = document.getElementById("userInput");
// let btnAdd = document.getElementById("AddTask");
let ol = document.querySelector("ol");
let item = document.getElementsByTagName("li");
let nameList = document.getElementById('nameList');

function GetLocalStorage(){
    let length = localStorage.length;
    console.log(length)
    for (i = 0; i < length; i++) {

    }
}
savebutton.addEventListener("click", GetLocalStorage);
function saveList() {
    let ul = document.querySelector("ul");
    let li  =  document.createElement('li');
    ul.appendChild(li);
    let name = nameList.value;
    let List = [];
    let Todo = document.querySelectorAll('li');
    let length = Todo.length;
    for (let value of Todo.values()) {
        // console.log(value.firstChild.nodeValue);
        List.push(value.firstChild.nodeValue);
    }
    let todolist = JSON.parse("[" + List +"]");
    localStorage.setItem(nameList.value,todolist);
    return List;

}
// savebutton.addEventListener("click", saveList);


function inputLength() {
    return input.value.length;
}

function listLength() {
    return item.length;
}

function createListElement() {
    let li = document.createElement("li"); // creates an element "li"
    li.classList.add("inputUser")
    li.appendChild(document.createTextNode(input.value)); //makes text from input field the li text
    ol.appendChild(li); //adds li to ol
    // li.innerHTML('<p>'+ input.value  + '</p>');
    input.value = ""; //Reset text input field

    //@TODO	Add input tag in order to modify the list's elements
    //START STRIKETHROUGH
    // because it's in the function, it only adds it for new items

    li.addEventListener("click", function crossOut() {
        li.classList.toggle("done");
    });
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
    function deleteListItem() {
        li.parentNode.removeChild(li);
    }
    //END ADD CLASS DELETE
}


function addListAfterClick() {
    if (inputLength() > 0) { //makes sure that an empty input field doesn't create a li
        createListElement();
    }
}

function addListAfterKeypress(event) {
    if (inputLength() > 0 && event.which === 13) { //this now looks to see if you hit "enter"/"return"
        //the 13 is the enter key's keycode, this could also be display by event.keyCode === 13
        createListElement();
    }
}


enterButton.addEventListener("click", addListAfterClick);

input.addEventListener("keypress", addListAfterKeypress);