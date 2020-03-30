// ==UserScript==
// @name         New Userscript
// @namespace    http://tampermonkey.net/
// @version      0.1
// @description  try to take over the world!
// @author       You
// @match        https://yandex.ru/*
// @match        https://xn----7sbab5aqcbiddtdj1e1g.xn--p1ai/*
// @grant        none
// ==/UserScript==


let yandexInput = document.querySelector(`input[aria-label="Запрос"]`);
let searchWords = ["Гобой","Флейта","Саксофон","Валторна","Кларнет","Фагот"];
let searchWord = searchWords[getRandom(0,searchWords.length)];
let i = 0;

let timerId = setInterval(()=>{
    yandexInput.value += searchWord[i];
    i++;
    if (i==searchWord.length) {
       clearInterval(timerId);
       document.querySelector(`button[type="submit"]`).click();
    }
    },getRandom(100, 1000));
if (location.host == "yandex.ru"){
    let flag = true;
    let links = document.links;
    for (let i=0; i<links.length; i++){
        if (links[i].href.indexOf('xn----7sbab5aqcbiddtdj1e1g.xn--p1ai') != -1){
            flag = false;
            if (links[i].target == '_blank') links[i].target = `_self`;
            links[i].click();
//            links[i].addEventListener('click', function(event) {
//                event.preventDefault();
//                if(startPage.blur()) {
//                    startPage.focus();
//                    startPage.closed();
//                    targetPage.focus();
//                }
//            });
            break;
         }
    }
if (flag){
    if (document.querySelectorAll(`span[aria-label^="Текущая страница"]`)[0].innerText>9)
        location.href = "https://yandex.ru/";
    else
        setTimeout(()=>{document.querySelector(`a[aria-label="Следующая страница"]`).click();},getRandom(1000,5000));
    }
}
else {
    let links = document.links;
    setInterval(()=>{
        let index = getRandom(0,links.length);
        console.log(links[index]);
        links[index].click();
        if (getRandom(0,101)<=30) location.href = "https://yandex.ru/";
    },getRandom(3000, 8000));
}

function getRandom(min,max){
    return Math.floor(Math.random()*(max-min)+min);
}
