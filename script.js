//COPYRIGHT (C)  todolist ( Gabriel PERINO) 2019. All rights reserved.

const input = document.getElementById("userInput");
const ol = document.querySelector("ol");
const item = document.getElementsByTagName("li");
const ThemeButton = document.getElementById("ThemeButton");
const html = document.querySelector("html");


let DOM_img = document.createElement("img");
DOM_img.src = "images/icon-cross.svg";

// START ADD DELETE BUTTON
let dBtn = document.createElement("button");
dBtn.classList.add("button");
dBtn.appendChild(DOM_img);
function ToggleTheme() {
    html.classList.toggle("theme-dark");
    html.classList.toggle("theme-light");
}

function ToggleImageTheme() {
    const sun_img = document.createElement("img");
    const moon_img = document.createElement("img");
    moon_img.src = "images/icon-moon.svg";
    sun_img.src = "images/icon-sun.svg";

    ThemeButton.classList.toggle("dark");
    ThemeButton.classList.toggle("light");
    if (ThemeButton.classList.contains("light")) {
        ThemeButton.appendChild(moon_img);
    } else {
        ThemeButton.appendChild(sun_img);
    }
    ThemeButton.removeChild(ThemeButton.children[0]);
}

function ToggleClass(element, toggleClass) {
    if (element.classList.contains(toggleClass)) {
        element.classList.remove(toggleClass);
    } else {
        element.classList.add(toggleClass);
    }
}

ThemeButton.addEventListener("click", function () {
    ToggleImageTheme();
    ToggleTheme();
})
input.addEventListener("keypress", addListAfterKeypress);

function inputLength() {
    return input.value.length;
}

function listLength() {
    return item.length;
}


function createListElement() {
    let li = document.createElement("li"); // creates an element "li"
    li.setAttribute("id", listLength().toString());
    li.appendChild(document.createTextNode(input.value)); //makes text from input field the li text
    let Tasks = JSON.parse(localStorage.getItem("TasksList"));
    Tasks.push(
        {
            order: listLength(),
            content: input.value,
            completed: false,
        })
    ol.appendChild(li);
    localStorage.setItem('TasksList', JSON.stringify(Tasks));

    console.log(JSON.parse(localStorage.getItem("TasksList")));
    input.value = ""; //Reset text input field

    //@TODO	Add input tag in order to modify the list's elements


}    function deleteListItem(item) {
    item.parentNode.removeChild(item);
}

ol.addEventListener("click", function (event) {

    let liClicked = event.target;
    ToggleClass(liClicked, 'done')
    let storeList = JSON.parse(localStorage.getItem("TasksList"));
    if (liClicked.classList.contains("done")) {
        liClicked.innerText = strikeThrough(liClicked.innerText)
    }
    else{
        liClicked.innerText =  unstrikeThrough(liClicked.innerText)
    }
    storeList[liClicked.id]= {
        content: liClicked.innerText,
        completed:!!liClicked.classList.contains("done")
}
    localStorage.setItem("TasksList", JSON.stringify(storeList));
})

ol.addEventListener('mouseover', function (event) {
    let li = event.target;
    li.appendChild(dBtn);
    console.log( li.id)
    dBtn.addEventListener("click", function (){
           ol.removeChild(ol.children[li.id]);
    } );

})
ol.addEventListener('mouseout', function (event) {
    let li = event.target;
    console.log(li.children[0])

    li.removeChild(li.children[0]);
})
function strikeThrough(text) {
    return text
        .split('')
        .map(char => char + '\u0336')
        .join('')
}
function unstrikeThrough(text) {
    return text.replace(/[\u0336]/g, '')
}

function addListAfterKeypress(event) {
    if (inputLength() > 0 && event.which === 13) { //this now looks to see if you hit "enter"/"return"
        //the 13 is the enter key's keycode, this could also be display by event.keyCode === 13
        createListElement();
    }
}


window.addEventListener("load", (event) => {
    let Tasks = localStorage.getItem("TasksList") ?? '[]'
    Tasks = JSON.parse(Tasks)
    if (Tasks.length > 0) {
        Tasks.forEach(task => {
            let li = document.createElement("li"); // creates an element "li"
            li.setAttribute("id", listLength().toString());
            if (task.completed) {
                li.classList.add("done");
                li.innerText = strikeThrough(li.innerText)
            }
            li.appendChild(document.createTextNode(task.content)); //makes text from input field the li text
            ol.appendChild(li);
        })
    }
    localStorage.setItem('TasksList', JSON.stringify(Tasks));
});