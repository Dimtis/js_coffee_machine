<!doctype html>
<html lang="ru">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="shortcut icon" href="img/favicon_coffee.jpg" type="image/jpg">
    <title>Кофемашина</title>
    <style>
      
      .left-side {
        padding: 2rem;
        background-image: url(img/background.jpg);
        background-size: cover;
      }
      .coffee-title {
        background: Tan;
        font-size: 2rem;
        border-radius: 50px 0 0 50px;
        margin: 0.5rem;
      }
      .coffee-btn {
        background: Brown;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 1px solid black;
      }

      .espresso {
        background: Brown url(img/coffee_espresso.png) center center no-repeat;
        background-size: cover;
      }
      .americano {
        background: Brown url(img/coffee_americano.png) center center no-repeat;
        background-size: cover;
      }
      .capuchino {
        background: Brown url(img/coffee_capuchino.png) center center no-repeat;
        background-size: cover;
      }
      .latte {
        background: Brown url(img/coffee_latte.png) center center no-repeat;
        background-size: cover;
      }
      .glysse {
        background: Brown url(img/coffee_glysse.png) center center no-repeat;
        background-size: cover;
      }
      .coffee-btn + p {
        margin: 0 0 0 0.5rem;
      }
      .coffee-title:hover .coffee-btn {
        width: 60px;
        height: 60px;
        cursor: pointer;
      }
      
      .coffee-title:hover p {
        color: Maroon;
      }
      
      .coffee-btn:active {
        background: Maroon;
      }
      
      #display {
        width: 100%;
        height: 150px;
        background: midnightblue;
        color: white;
        border: 4px groove black;
      }

      img[src$='rub.png']{
        cursor: pointer;
        width: 64px;
        position: absolute;
      }
      img[src$='rub.png']:hover{
        filter: contrast(130%);
      }
      
      #coffee_ready {
        margin: auto;
        width: 200px;
        height: 200px;
        opacity: 0;
      }
      
      @keyframes animCoffee {
        0%{
          background-size: 40% 40%;
        }
        100%{
          background-size: 90% 90%;
        }
      }
      
      #change_tray {
        position: relative;
        width: 100%;
        height: 200px;
        background: mediumseagreen;
      }
      
    </style>
  </head>
  <body>
   <div class="container my-3 border">
     <div class="row">
       <div class="col-sm-6 left-side">
         <div class="coffee-title row">
           <div class="coffee-btn americano" onclick="getCoffee('Американо', 30)"></div>
           <p>Американо - 30р.</span>
         </div>
         <div class="coffee-title row">
           <div class="coffee-btn espresso" onclick="getCoffee('Еспрессо', 38)"></div>
           <p>Еспрессо - 38р.</p>
         </div>
         <div class="coffee-title row">
           <div class="coffee-btn latte" onclick="getCoffee('Латте', 42)"></div>
           <p>Латте - 42р.</p>
         </div>
         <div class="coffee-title row">
           <div class="coffee-btn capuchino" onclick="getCoffee('Каппучино', 55)"></div>
           <p>Каппучино - 55р.</p>
         </div>
         <div class="coffee-title row">
           <div class="coffee-btn glysse" onclick="getCoffee('Гляссе', 93)"></div>
           <p>Гляссе - 93р.</p>
         </div>
       </div>
       <div class="col-sm-6">
         <div class="row">
           <div class="col-sm-6">
             <div id="display">
               <p id="info">Внесите деньги и выберите любимый кофе &#128523</p>
               <p id="balance_info">Кредит: 0 руб.</p>
               <div class="progress" style="opacity: 0">
                 <div class="progress-bar progress-bar-striped progress-bar-animated" 
                 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
               </div>
             </div>
             <buton class="btn btn-primary" onclick="getChange(money.value)">Получить сдачу</buton>
             <div id="coffee_ready"></div>
          </div>
          <div class="col-sm-6">
             <input type="hidden" id="money">
             <img src="img/bill_acc.png" alt="" id="bill_acc">
             <div id="change_tray"></div>
          </div>
         </div>
       </div>
     </div>
   </div>
  
   <img src="img/50rub.jpg" alt="50">
   <img src="img/100rub.jpg" alt="100">
   <img src="img/500rub.jpg" alt="500">
   
   <script>
   
     let bills = document.querySelectorAll('img[src$="rub.jpg"]');
     let nameCoffee;
     let sound = new Audio();
     let coinsSound;
     let coffeeSound;
     document.addEventListener('click', function(event) {
      if (event.target.classList[0] == 'coffee-btn') {
        nameCoffee = event.target.classList[1];
        if (info.innerText.indexOf('Добавьте еще') == -1) { 
          coffeeSound = sound;
          coffeeSound.src = 'audio/Sound_coffee.mp3';
          coffeeSound.play();
        } 
      }
      if (event.target.classList[1] == 'btn-primary') {
        if (balance_info.innerText.indexOf('Кредит: 0 руб.') == -1) { 
          coinsSound = sound;
          coinsSound.src = 'audio/Sound_coins.mp3';
          coinsSound.play();
        };
        money.value = "";
        balance_info.innerHTML = `Кредит: 0 руб.`;
      }
     });
     
     function getCoffee(name,price) {
       if (coffee_ready.src != `img/coffee_${nameCoffee}.png`) {
         coffee_ready.style.opacity = '0';
         coffee_ready.style.animation = '';
       }
       info.innerHTML = `<p></p>`;
       if (money.value >= price) {
         document.querySelector('.progress').style.opacity = '1';
         money.value = money.value - price;
         info.innerHTML = `<p>Coffee ${name} is being prepared. Please wait...</p>`;
         balance_info.innerHTML = `Кредит: ${money.value} руб.`;
         let progressBar = document.querySelector('.progress-bar');
         let i = 0;
         let timerId = setInterval(() => {
            progressBar.style.width = i+'%';
            i+=0.5;
            if (i>100) {
              clearInterval(timerId);
              document.querySelector('.progress').style.opacity = '0';
              info.innerHTML = `<p>Coffee ${name} is ready. Enjoy! &#128522</p>`;
              progressBar.style.width = '0%';
              coffeeSound.pause();
              coffee_ready.style.opacity = '1';
              coffee_ready.style.animation = 'animCoffee 2s linear';
              coffee_ready.style.animationFillMode = 'forwards';
              coffee_ready.style.background = `url(img/coffee_${nameCoffee}.png) center center no-repeat`;
            }
         }, 50);
       }
       else info.innerHTML += `<p>Добавьте еще ${price-money.value} руб.</p>`;
      }
       
      function getChange(num){
        if (balance_info.innerText.indexOf('Кредит: 0 руб.') == -1) {
          let left = getRandom(0,change_tray.getBoundingClientRect().width-64);
          let top  = getRandom(0,change_tray.getBoundingClientRect().height-64);
          if (num>=10){
            change_tray.innerHTML += `<img style="top:${top}px; left:${left}px" onclick="this.style.display = 'none';" 
                                      src="img/10rub.png">`;
            getChange(num-10);
          }
          else if (num>=5){
            change_tray.innerHTML += `<img style="top:${top}px; left:${left}px" onclick="this.style.display = 'none';" 
                                      src="img/5rub.png">`;
            getChange(num-5);
          }
          else if (num>=2){
            change_tray.innerHTML += `<img style="top:${top}px; left:${left}px" onclick="this.style.display = 'none';" 
                                      src="img/2rub.png">`;
            getChange(num-2);
          }
          else if (num>=1){
            change_tray.innerHTML += `<img style="top:${top}px; left:${left}px" onclick="this.style.display = 'none';" 
                                      src="img/1rub.png">`;
          }
          for (let i = 0; i < bills.length; i++) {
              bills[i].style.display = 'initial';
              bills[i].style.transform = 'rotate(0deg)';
          }
        }
      }
      
      function getRandom(min,max){
        return Math.random()*(max-min)+min;
      }
     
      for (let i = 0; i < bills.length; i++){
          let startLeft = bills[i].getBoundingClientRect().left+'px';
          let startTop = bills[i].getBoundingClientRect().top+'px';

          bills[i].addEventListener('mousedown',()=>{
            bills[i].style.position = `absolute`;
            function onMouseMove(event){
              bills[i].style.left = event.pageX-bills[i].offsetWidth/2+'px';
              bills[i].style.top = event.pageY-bills[i].offsetHeight/2+'px';
              bills[i].style.transition = 'transform .3s';
              bills[i].style.transform = 'rotate(-90deg)';
          }
          
          document.addEventListener('mousemove',onMouseMove);
          
          bills[i].addEventListener('mouseup',()=>{
            document.removeEventListener('mousemove',onMouseMove);
            
            let bill_acc_left = bill_acc.getBoundingClientRect().left;
            let bill_acc_right = bill_acc.getBoundingClientRect().right;
            let bill_acc_bottom = bill_acc.getBoundingClientRect().bottom;
            let bill_acc_top = bill_acc.getBoundingClientRect().top;
            
            let bill_left = bills[i].getBoundingClientRect().left;
            let bill_right = bills[i].getBoundingClientRect().right;
            let bill_top = bills[i].getBoundingClientRect().top;
            
            bills[i].style.position = `static`;
            
            if (bill_acc_left < bill_left && bill_acc_right > bill_right &&
              bill_acc_bottom > bill_top && bill_acc_top < bill_top) {
              bills[i].style.display = 'none';
              money.value = +money.value + (+bills[i].alt);
              balance_info.innerHTML = `Кредит: ${money.value} руб.`;
            } else {
                bills[i].style.transition = 'transform .5s';
                bills[i].style.transform = 'rotate(0deg)';
                bills[i].style.left = startLeft;
                bills[i].style.top = startTop;
            }
          })
        });
        
        bills[i].onmouseout = bills[i].onmouseover = function onMouseCursor(event) {
          if (event.type == 'mouseout') {
            bills[i].style.cursor='default';
            bills[i].style.filter='contrast(100%)';
            bills[i].style.zIndex = 'auto';
          }
          if (event.type == 'mouseover') {
            bills[i].style.cursor='pointer';
            bills[i].style.filter='contrast(130%)';
            bills[i].style.zIndex = '4'; 
          }
        };
  
        bills[i].ondragstart = function() {
          return false;
        };
      }
     
   </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
