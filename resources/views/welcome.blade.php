@extends('layouts.app') @section('content')
<style>
   body {
   background: #252B42;
   }
   .shape_hero {
   z-index: -1;
   position: absolute;
   top: 0px;
   left: 0px;
   }
   h1, .h1 {
   font-size: 50px;
   font-family: 'Nunito';
   }
   .image_block {
   position: relative;
   top: 0;
   left: 0;
   }
   #image1 {
   position: relative;
   top: 220px;
   left: 240px;
   width: 25%;
   }
   #image2 {
   position: absolute;
   top: 0px;
   right: 15px;
   width: 45%;
   }
   .block {
   margin: 25% 0;
   }
   div#card1 {
   position: absolute;
   left: 0;
   top: 0;
   }
   div#card2 {
   position: absolute;
   left: 21em;
   top: 8rem;
   }
   div#card3 {
   position: absolute;
   left: 0;
   top: 14rem;
   }
   .card {
   padding: 0px;
   margin: 10px;
   }
   .checked {
   color: orange;
   }
   .reviews {
   text-align: center;
   font-size: 20px;
   }
   .footer {
   position: relative;
   width: 100%;
   min-height: 100px;
   padding: 20px 50px;
   display: flex;
   justify-content: center;
   align-items: center;
   flex-direction: column;
   }
   .social-icon,
   .menu {
   position: relative;
   display: flex;
   justify-content: center;
   align-items: center;
   margin: 10px 0;
   flex-wrap: wrap;
   }
   .social-icon__item,
   .menu__item {
   list-style: none;
   }
   .social-icon__link {
   font-size: 2rem;
   color: #fff;
   margin: 0 10px;
   display: inline-block;
   transition: 0.5s;
   }
   .social-icon__link:hover {
   transform: translateY(-10px);
   }
   .menu__link {
   font-size: 1.2rem;
   color: #fff;
   margin: 0 10px;
   display: inline-block;
   transition: 0.5s;
   text-decoration: none;
   opacity: 0.75;
   font-weight: 300;
   }
   .menu__link:hover {
   opacity: 1;
   }
   .footer p {
   color: #fff;
   margin: 15px 0 10px 0;
   font-size: 1rem;
   font-weight: 300;
   }
</style>
<div class="container pt-5 pb-8">
   <div class="shape_hero">
      <svg width="747" height="765" viewBox="0 0 747 765" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path d="M573.913 578.756L747 0H0V765L518.178 632.31C533.36 628.422 540.951 626.478 547.273 622.654C553.611 618.819 559.019 613.623 563.103 607.443C567.177 601.279 569.422 593.771 573.913 578.756Z" fill="#133466" />
      </svg>
   </div>
   <div class="row">
      <div class="col-md-6">
         <h5 class="text-info mb-5">Добро пожаловать</h5>
         <h1 class="text-light mb-4">Лучшие возможности обучения</h1>
         <h3 class="text-light mb-4">Представляем лучшие курсы для корпоративного обучения и повышение компетенции ваших сотрудников.</h3>
         <a href="#" class="btn btn-primary m-1">{{ __('Присоединиться') }}</a>
         <a href="#" class="btn btn-outline-primary m-1">{{ __('Узнать больше') }}</a>
      </div>
      <div class="col-md-6">
         <div class="image_block">
            <img src="img\rew2.png" id="image2">
            <img src="img\rew1.png" id="image1">
         </div>
      </div>
   </div>
   <div class="row pt-5">
      <div class="col-md-6">
         <div class="block">
            <h1 class="text-light mb-4">Посмотрите наши курсы</h1>
            <a href="#" class="btn btn-outline-primary m-1">{{ __('Узнать больше') }}</a>
         </div>
      </div>
      <div class="col-md-6">
         <div class="image_block">
            <div class="card" id="card1" style="width: 16rem;">
               <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
               </div>
            </div>
            <div class="card" id="card2" style="width: 16rem;">
               <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
               </div>
            </div>
            <div class="card" id="card3" style="width: 16rem;">
               <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row pt-5">
      <div class="col-md-6">
         <img src="img\it 1.png" alt="...">
      </div>
      <div class="col-md-6">
         <div class="block">
            <h1 class="text-light mb-4">Доступное <br>обучение 24/7</h1>
            <h3 class="text-light mb-4">Проблемы, пытающиеся разрешить конфликт между две основные области классической физики: Ньютоновская механика</h3>
            <a href="#" class="btn btn-outline-primary m-1">{{ __('Узнать больше') }}</a>
         </div>
      </div>
   </div>
   <div class="row pt-5 pb-5">
      <h5 class="text-info mb-5">Практический совет</h5>
      <h1 class="text-light mb-4">Сделайте онлайн-образование</h1>
      <h3 class="text-light mb-4">Размещайте на нашей платформе свои курсы и делайте образование <br> доступным для корпоративных пользователей</h3>
      <div class="col-sm-6 col-md-4">
         <div class="card" style="width: 21rem;">
            <img src="img\product-cover-195.png" class="card-img-top" alt="...">
            <div class="card-body">
               <h5 class="card-title">Базовое программирование на<br> PHP</h5>
               <p class="card-text">Базовый курс для начинающих специалистов в IT</p>
               <a href="#" class="btn btn-primary">Кнопка</a>
            </div>
         </div>
      </div>
      <div class="col-sm-6 col-md-4">
         <div class="card" style="width: 21rem;">
            <img src="img\product-cover-195.png" class="card-img-top" alt="...">
            <div class="card-body">
               <h5 class="card-title">Базовое программирование на<br> JS</h5>
               <p class="card-text">Базовый курс для начинающих специалистов в IT</p>
               <a href="#" class="btn btn-primary">Кнопка</a>
            </div>
         </div>
      </div>
      <div class="col-sm-6 col-md-4">
         <div class="card" style="width: 21rem;">
            <img src="img\product-cover-195.png" class="card-img-top" alt="...">
            <div class="card-body">
               <h5 class="card-title">Базовое программирование на<br> C++</h5>
               <p class="card-text">Базовый курс для начинающих специалистов в IT</p>
               <a href="#" class="btn btn-primary">Кнопка</a>
            </div>
         </div>
      </div>
   </div>
   <div class="row pt-5">
      <h5 class="text-info mb-5">Отзывы участников курсов</h5>
      <h1 class="text-light mb-4">Каждый клиент важен.</h1>
      <h3 class="text-light mb-4">Problems trying to resolve the conflict between<br>the two major realms of Classical physics: Newtonian mechanics </h3>
      <div class="col-sm-6 col-md-4">
         <div class="card" style="width: 21rem;">
            <div class="card-body">
               <div class="reviews">
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
               </div>
               <p class="card-text reviews">Большое человеческое спасибо! До курса Ивана зря терял свое время, пытаясь найти качественный обучающий материал в доступной и понятной форме. Продолжаю обучение и далее с этим преподавателем.</p>
               <div class="reviewer reviews">
                  <img src="img\testimonial-user-cover-139.png" class="avatar" alt="Avatar">
                  <div class="name_reviewer">
                     <h3>Андрей</h3>
                     <p>Программист</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-6 col-md-4">
         <div class="card" style="width: 21rem;">
            <div class="card-body">
               <div class="reviews">
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
               </div>
               <p class="card-text reviews">Большое человеческое спасибо! До курса Ивана зря терял свое время, пытаясь найти качественный обучающий материал в доступной и понятной форме. Продолжаю обучение и далее с этим преподавателем.</p>
               <div class="reviewer reviews">
                  <img src="img\testimonial-user-cover-139.png" class="avatar" alt="Avatar">
                  <div class="name_reviewer">
                     <h3>Андрей</h3>
                     <p>Программист</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-6 col-md-4">
         <div class="card" style="width: 21rem;">
            <div class="card-body">
               <div class="reviews">
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
               </div>
               <p class="card-text reviews">Большое человеческое спасибо! До курса Ивана зря терял свое время, пытаясь найти качественный обучающий материал в доступной и понятной форме. Продолжаю обучение и далее с этим преподавателем.</p>
               <div class="reviewer reviews">
                  <img src="img\testimonial-user-cover-139.png" class="avatar" alt="Avatar">
                  <div class="name_reviewer">
                     <h3>Андрей</h3>
                     <p>Программист</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<footer class="footer">
   </div>
   <ul class="social-icon">
      <li class="social-icon__item">
         <a class="social-icon__link" href="#">
            <ion-icon name="logo-facebook"></ion-icon>
         </a>
      </li>
      <li class="social-icon__item">
         <a class="social-icon__link" href="#">
            <ion-icon name="logo-twitter"></ion-icon>
         </a>
      </li>
      <li class="social-icon__item">
         <a class="social-icon__link" href="#">
            <ion-icon name="logo-linkedin"></ion-icon>
         </a>
      </li>
      <li class="social-icon__item">
         <a class="social-icon__link" href="#">
            <ion-icon name="logo-instagram"></ion-icon>
         </a>
      </li>
   </ul>
   <ul class="menu">
      <li class="menu__item"><a class="menu__link" href="#">Главная</a>
      </li>
      <li class="menu__item"><a class="menu__link" href="#">О проекте</a>
      </li>
      <li class="menu__item"><a class="menu__link" href="#">Курсы</a>
      </li>
      <li class="menu__item"><a class="menu__link" href="#">Контакты</a>
      </li>
   </ul>
</footer>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
@endsection