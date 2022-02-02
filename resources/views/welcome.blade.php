<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="shipping and delivering">
        <meta name="author" content="alforsan-ex">
        <meta name="icon" content="alforsan-ex">
        <meta name="keywords" content="shipping, delivering, الشحن,Alforsan, alforsan,الفرسان">
        <title>Home | AL FORSAN EX</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="icon" href="{{ asset('photos/logo.jpeg') }}" type="image/jpg">
        <!-- Styles -->
        <style>
                *{
                    padding:0;
                    margin:0;
                    box-sizing:border-box;
                }
                html{
                    font-size:calc(6px + (24 - 16) * ((100vw - 400px) / (800 - 400)));
                }
                body{
                    font-family:Lato;
                }
                a{
                    text-decoration: none;
                    color:unset;
                    cursor:pointer;
                }
                @media screen and (max-width:800px){
                    /******* TABLE *******/
                    html{
                    font-size:calc(24px + (24 - 16) * ((100vw - 400px) / (800 - 400)));
                    }
                }
                .basic-button,.def-button{
                    background-color: #db291d;
                    border-radius:0.2em;
                    color:#fff;
                    border:none;            outline:none;
                    font-size:0.6rem;       font-weight:700;
                    cursor:pointer;
                    padding:0.4em 0.8em;
                }
                .sec-button{
                    background-color: transparent;
                    border:1px solid #fff;
                    color:#fff;
                    border-radius:0.2em;         outline:none;
                    font-size:0.6rem;       font-weight:700;
                    cursor:pointer;
                    padding:0.4em 0.8em;
                    min-width: max-content;
                }
        </style>
        <!-- HEADER -->
        <style>
           .home-page-header{
               display:flex;    width:100%;
               position:sticky;   top:0;  left:0;
               background-color:#fff;
               color:#db291d;
               z-index:10;
           }
           .home-page-header img{
                height: 2.4em;
                transition:all 0.5s ease;
           }
           .home-page-header>section{
                display:flex;     justify-content:center;     align-items:center;
                min-width:max-content;
           }
           .home-page-header>section>*{
            transition:all 0.5s ease;
           }
           .home-page-header>.left-side{
             flex:0.3;
           }
           .home-page-header>.right-side{
             flex:0.3;
           }

           .home-page-header>.center{
             flex:0.4;
           }
           .home-page-header>.right-side a,.home-page-header>.center a{
             margin:0 0.4em;
             padding:0.3em 0;
             transition: all 0.3s ease;
             display:flex;     justify-content:center;     align-items:center;
           }
           .home-page-header svg{
             height:1em;
             fill:#db291d;
             margin:0.2em;
             max-width:1em;
           }
           .home-page-header>.right-side a:hover,.home-page-header>.center a:hover{
             border-top:4px solid #db291d;
             border-bottom:4px solid #db291d;
           }
           .home-page-header .phone{
               display:none !important;
           }

           @media screen and (max-width:992px) {
                .home-page-header{
                    display:flex;
                    flex-direction:column;
                }
                .home-page-header .phone{
                    display:flex;
                }
                .home-page-header .pc{
                    display:none;
                }
                .home-page-header>.right-side{
                    justify-content: flex-end;
                    flex:1;
                }
            }
        </style>
        <!-- MENU -->
        <style>
            .basic-navbar{

               background-color:#282828;
               height:0px;
               width:100%;
               z-index:10;
               transition:height 0.4s ease;
               flex-direction: column;
               text-align: center;
            }
            #basic-navbar>.link{
                display:none;
                align-items:center;  justify-content:center;
            }
            #basic-navbar>.link a{
                display:flex;
                align-items:center;  justify-content:center;
            }
            .menuDown{
               height:max-content;
            }
            #basic-navbar>.df{
                display:flex;
            }
            #menu-icon{
                margin:0 0.4em;
                cursor:pointer;
            }
            .home-page-header>.left-side>.menu-icon-container{
             flex:1;
             display:flex;
             justify-content:flex-end;
           }
        </style>
        <!-- BODY -->
        <style>
            .home-page-body{
                background-color:#eee;
                position:relative;
            }
            .home-page-body >h1{
                text-align:center;
                margin:2em 1em 0.5em 1em;
                color:#db291d
            }
            .home-page-body > .sec-section{
                display:flex;
                height:80vh;
            }
            .home-page-body > .sec-section > .left{
                flex:1;
                display:flex;
                justify-content:center;     align-items:center;
                flex-direction:column;
            }
            .home-page-body > .sec-section > .left > p{
                text-align:center;
                max-width:80%;
            }
            .home-page-body > .sec-section > .right{
                
            }
            .home-page-body > .sec-section > .right >img{
                height:100%;
            }
            .home-page-body > .delivery-types{
                display:flex;
                padding:1em;
            }
            .home-page-body > .delivery-types > section{
                flex:1;
                display:flex;  align-items:center;      flex-direction:column;
                margin:1em;
                padding:1em;
                background-color:#fff;
                border-radius:0.7em;
            }
            .home-page-body > .delivery-types > section p{
                font-size:0.6em;
                margin:1em 0.2em;
                text-align:center;
            }   
            .home-page-body > .delivery-types > section svg{
                height:3em;
                width:3em;
            }
            .home-page-body{
                background-color:#eee;
            }
            .home-page-body{
                background-color:#eee;
            }
            @media screen and (max-width:992px) {
                .pc{
                    display:none;
                }
                .home-page-body > .delivery-types{
                    flex-direction:column;
                }
            }
        </style>
        <!-- first-section -->
        <style>
            .first-section{
                height:90vh;
                position:relative;
            }
            .first-section>div{
                position:absolute;
                top:0;      left:0;
                width:100%; height:100%;
            }
            .first-section>.top{
                filter:drop-shadow(0px 0px 9px black);
                background-color:rgba(0,0,0,0.36) !important;
                display:flex;
            }
            .first-section>.top>.top-left{
                flex:4;
                display:flex;
                justify-content:center;     align-items:center;
                flex-direction:column;
                font-size:0.7em;
                text-align:center;

            }
            .first-section>.top>.top-left>p{
                color:#fff;
                margin:1em;
            }
            .first-section>.top>.top-left>h2{
                color: #db291d;
                text-shadow: 1px 1px aliceblue;
            }
            .first-section>.top>.top-right{
                
            }
            .first-section>.bottom{
                position:absolute;
                top:0;      left:0;
                width:100%; height:100%;
            }
            .first-section>.bottom>img{
                width:100%; height:100%;
            }
        </style>
        <!-- CONTACT -->
        <style>
            .contact{
                display:flex;
                justify-content:center;
                align-items:center;
            }
            .contact-form{
                padding:1em;
                text-align: center;
                max-width:90%;
            }
            .contact-form input,.contact-form textarea{
                width:100%;
                outline:none;
                border:1px solid #888;
                border-radius:0.4em;
                padding:0.4em;
                margin:0.4em;
                width:55em;
                max-width:90%;
                display:block;
                font-size:.5em;
            }
            .contact-form input{
                height:3em;        
            }
            .contact-form textarea{
                height:7em;
                resize:none;
            }
        </style>
        <!-- FOOTER -->
        <style>
           .home-page-footer{
               background-color:#828282;
           }
           .home-page-footer > header{
               background-color:#353b48;
               display:flex;
               color:#db291d
           }
           .home-page-footer > header >section{
            display:flex;     justify-content:center;     align-items:center;
                min-width:max-content;
           }
           .home-page-footer > header img{
                height:3em;
           }
           .home-page-footer > header > .left-side{
                display: flex;
                justify-content: center;
                align-items: center;
                min-width: max-content;
                flex:0.4;
           }
           .home-page-footer > header > .center{
              flex:0.4;

           }
           .home-page-footer > header > .right-side{
                flex:0.3;
           }
           .home-page-footer > footer {
               font-size:0.7em;
               padding: 0.5em;
               background-color:#eee;
           }
        </style>
        <!-- MESSAGE -->
        <style>

            body {
                font-family: 'Nunito', sans-serif;
            }
            .red-message{
                position:fixed;
                top:15px;
                left:0;     right:0;
                margin:auto;  padding:0.3em 0.4em ;
                width:max-content;
                background-color:#b62a07;    color:#fff;
                z-index:20;   border-radius: 4px;
                border:2px solid #fff;
            }
        </style>
    </head>
    <body>
        <div class="home-page">
            <header class="home-page-header">
                <!-- LEFT SIDE -->
                <section class="left-side">
                    <img src="{{asset('photos\logow.jpeg')}}" alt="">
                    <h4>Al Forsan Ex</h4>
                </section>
                <section class="center pc">
                    <a href="/login" id="home-link">
                        <h5>Home</h5>
                    </a>
                    <a href="/">
                        <h5>Pricing</h5>
                    </a>
                    <a href="/">
                        <h5>Contact</h5>
                    </a>
                </section>
                <!-- RIGHT SIDE -->
                <section class="right-side pc">
                    @guest
                        <a href="/login"> 
                            <h5>Sign in</h5> 
                            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 89.63 122.88"><title>log-in</title><path d="M33.27,68.66H7.15a7.23,7.23,0,0,1,0-14.45H33.27l-8.48-9.46a7.25,7.25,0,0,1,.5-10.16,7.07,7.07,0,0,1,10.06.5L54.62,56.61a7.25,7.25,0,0,1-.06,9.72L35.35,87.78a7.07,7.07,0,0,1-10.06.5,7.25,7.25,0,0,1-.5-10.16l8.48-9.46Zm16.25,54.08a7.22,7.22,0,1,1-2.83-14.17l3.39-.67c16.33-3.24,25.1-5.09,25.1-27.69V40.63c0-21-9.34-22.76-24.8-25.65l-3.63-.68A7.21,7.21,0,1,1,49.46.13L53,.81c22.82,4.26,36.6,6.84,36.6,39.82V80.21c0,34.43-12.84,37.11-36.74,41.85l-3.37.68Z"/></svg>
                        </a>
                    @endguest
                    @auth
                        <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();"
                        > 
                            <h5>Sign out</h5> 
                            <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 89.6 122.88"><title>sign-out</title><path d="M66.4,68.66H40.29a7.23,7.23,0,0,1,0-14.45H66.4l-8.48-9.46a7.25,7.25,0,0,1,.51-10.16,7.06,7.06,0,0,1,10.05.5L87.7,56.54a7.27,7.27,0,0,1,.06,9.72L68.48,87.77a7.05,7.05,0,0,1-10.05.51,7.25,7.25,0,0,1-.51-10.16l8.48-9.46ZM42.94,108.57a7.22,7.22,0,0,1-2.83,14.17l-3.37-.68C12.84,117.32,0,114.63,0,80.2V40.63C0,7.65,13.78,5.07,36.6.81L40.17.13A7.21,7.21,0,0,1,42.88,14.3L39.25,15c-15.46,2.89-24.8,4.63-24.8,25.65V80.2c0,22.61,8.77,24.46,25.1,27.7l3.39.67Z"/></svg>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                        </form>
                    @endauth
                </section>
                </div>
            </header>
            <div class="home-page-body">
                <!-- FIRST SECTION -->
                    <div class="first-section">
                        <div class="bottom">
                            <img src="{{asset('photos\food-delivery-man-with-boxes-with-food.jpg')}}" alt="">
                        </div>
                        <div class="top">
                            <section class="top-left">
                                <h2>Deliver What You Love, On Time</h2>
                                <p>Deliver your products to any place in Egypt with a one-stop,<br>
                                    full-service next-day delivery and logistics solution<br>
                                </p>
                                <section>
                                    @auth
                                    <a href="/dashboard"><button class="basic-button">Dashboard</button></a>
                                    <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();"
                                    > 
                                    <button class="sec-button">Sign out</button>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                    </form>
                                    @else
                                    <a href="/register"><button class="basic-button">Let's get started</button></a>
                                    <a href="/login"><button class="sec-button">Sign in</button></a>
                                    @endauth
                                </section>
                            </section>
                            <section class="top-right"></section>
                        </div>
                    </div>
                <!-- SECOND SECTION -->
                <h1>About</h1>

                    <div class="sec-section">
                        <section class="left">
                            <p>
                                Al-Fursan Shipping Company is one of the leading companies in the field of shipping, it was established in 2021, providing its services to many companies and institutions with activities different types of cargo inside Egypt, exerting our utmost energy and capabilities to satisfy them and provide all modern shipping solutions to our customers.
                            </p>
                        </section>
                        <section class="right pc">
                            <img src="{{asset('photos\awdfawefdrseafr.jpg')}}" alt="">
                        </section>
                    </div>
                <!-- DELIVERY TYPES -->
                    <h1>Our Services</h1>
                    <div class="delivery-types">
                        <section>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 113.21"><path class="cls-1" d="M82.42,60a3.52,3.52,0,1,0,3.2,3.51A3.36,3.36,0,0,0,82.42,60Z"/><path class="cls-2" d="M76.64,113.21l1.25-32.57c-8.45,8.48-15,14.79-27.82,15.12-4.06-.15-14.62-.46-18.68-.91C26.44,94.29,23,94.5,19.85,90,15,83,21.41,74.84,27.71,76.15c7.11.63,24,2.24,28.85-3.71,5-4.8,8.9-11.5,15.44-13.63,36.83-12,50.8-7.64,50.79,5.9l0,48.5ZM56.5,29.66,40.2,20,47,19.3l20.74,9.11L56.5,29.66ZM17.27,37.23V70.57a17.77,17.77,0,0,0-6.2,9.26L0,73.22.34,26.56,17.27,37.23Zm7.09-15.15,16.81,9.54L19.3,34.41,4,24.75l20.39-2.67Zm-3.61,46.4V37.72l22.79-2.91.75,21.78,8-5.45,8,4.53L58.64,32.89,72.3,31.32V47.74c-5.31,2.62-9.06,7-12.81,11.45a71.69,71.69,0,0,1-4.82,5.33,6.31,6.31,0,0,0-.55.6C50.71,69.31,38.6,68.19,31,67.49c-3.1-.29,4,.32-1.59-.17a15.09,15.09,0,0,0-8.63,1.16ZM83.5,7.6H67.92c-.52,0-.79.45-.93,1l-1.81,6.51c-.14.5.42,1,.93,1H78.69a24.27,24.27,0,0,0-1.16,7.43c0,13,10.15,23.46,22.68,23.46s22.67-10.5,22.67-23.46S112.73,0,100.21,0A22.3,22.3,0,0,0,83.5,7.6Z"/></svg>
                            <p>Create Orders <br>
                            To Deliver </p>
                            <h3>Deliver</h3>
                        </section>
                        <section>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 122"><path d="M120.19,4.78a2,2,0,0,1,1.25.24,2,2,0,0,1,1.15,1.78l.29,39.55a2,2,0,0,1-.95,1.74L105.82,57.7a1.94,1.94,0,0,1-1.16.38l-.32,0L62.49,53.4a2,2,0,0,1-1.86-1.95V11.23A2,2,0,0,1,61.8,9.41l21-9.25a2,2,0,0,1,1-.14l36.32,4.76Zm-79,65.44L29.74,76.74l13.92,1.77,10.47-6.59-12.91-1.7Zm-14.81,10-.58,16.91-6.27-4.27-6.28,3.55,1.28-17.71L3.91,77.36v36.27l38.16,4.24V82.23l-15.66-2Zm-8.75-5L28.8,68.6l-5.53-.73L9.09,74.1l8.57,1.1ZM46,81.66v35l12.37-7.38L58.09,74,46,81.66Zm-.79,40A2,2,0,0,1,44,122a1.72,1.72,0,0,1-.32,0L1.86,117.33a2,2,0,0,1-1.86-2V75.15a1.94,1.94,0,0,1,1.17-1.82l21-9.25a2,2,0,0,1,1-.14L59.55,68.7a2.21,2.21,0,0,1,2.41,2l.28,39.55A1.93,1.93,0,0,1,61.3,112l-16.11,9.61ZM74.3,109.74l6.31-32.08L87,87.31c13.78-5.54,21.52-14.66,22.67-28.7,11.32,19.79,4.45,37.54-9.9,47.93l6.53,9.84-32-6.64ZM50.71,10.44,44.4,42.51,38,32.87C24.22,38.4,16.48,47.52,15.33,61.57,4,41.77,10.88,24,25.23,13.64L18.7,3.8l32,6.64ZM101.85,6.3,90.38,12.82l13.92,1.77L114.76,8,101.85,6.3Zm-14.8,10-.58,16.92L80.19,29,73.92,32.5,75.2,14.8,64.54,13.44V49.71L102.7,54V18.31l-15.65-2Zm-8.75-5,11.13-6.6L83.91,4,69.73,10.18l8.57,1.09Zm28.31,6.47v35L119,45.32l-.25-35.22-12.12,7.64Z"/></svg>
                            <p>Exchange a new order <br>
                            with deliverd one</p>
                            <h3>Exchange</h3>
                        </section>
                        <section>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 101.94 122.88"><path class="cls-1" d="M93.34,7.49a3.11,3.11,0,0,1,2,.38,3.06,3.06,0,0,1,1.82,2.78l.2,28.16,0,0,0,0h0l0,0,0,0h0l0,0,0,0h0l0,0,0,0h0l0,0,0,0h-.09l0,0h0l0,0h-.09l0,0h0l0,0h-.05l0,0h0l-.05,0h0l0,0h-.05l0,0H95.8l0,0H91.82l0,0h-.09l-.09,0h0l-.09,0h-.09l0,0h0l0,0-.16-22.52-19,12V70.08a45.77,45.77,0,0,1-4.91,3l-1.21-1.82V28.7L41.4,25.57l-.91,26.52-9.83-6.71-9.84,5.56,2-27.74L6.12,21.07V77.91l39.5,4.39-1.19,6L2.91,83.71A3.06,3.06,0,0,1,0,80.65v-63a3.08,3.08,0,0,1,1.83-2.86L34.79.25A3.07,3.07,0,0,1,36.42,0L93.34,7.49ZM48.7,114.27l8.19-41.61,8.3,12.51C83.07,78,93.11,66.16,94.6,47.94c14.69,25.68,5.77,48.7-12.84,62.18l8.47,12.76L48.7,114.27ZM64.61,9.88l-18,10.21,21.82,2.78L84.85,12.53,64.61,9.88ZM27.68,17.67,45.14,7.32,36.48,6.19,14.25,16l13.43,1.71Z"/></svg>
                            <p>Return Deliverd Orders <br>
                            using order AWB</p>
                            <h3>Return</h3>
                        </section>
                    </div>
                <!-- Pricing -->
                <!-- Dashboard -->
                <!-- Available Locations -->
                <!-- Contacts -->
                <h1>How can we help?</h1>
                <a id="contact"></a>
                <div class="contact">
                    <form action="/create-outsider-ticket" method="post" class="contact-form">
                                @csrf
                                <input type="text" name="name" placeholder="Name">
                                <input type="text" name="mobile" placeholder="Mobile No.">

                                <input type="text" name="awb" placeholder="Order AWB">
  
                                <textarea name="desc" id="" cols="30" rows="10" placeholder="Notes"></textarea>
                                <button class="basic-button">Send</button>
                    </form>
                </div>
            </div>
            <!-- FOOTER -->
            <footer class="home-page-footer">
                <header>
                    <section class="left-side">
                        <img src="{{asset('photos\logog.jpeg')}}" alt="">
                        <h4>Al Forsan Ex</h4>
                    </section>
                    <section class="center"></section>
                    <section class="right-side">
                        <a href="">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="48" height="48" viewBox="0 0 24 24" style=" fill:#000000;">    <path d="M19,3H5C3.895,3,3,3.895,3,5v14c0,1.105,0.895,2,2,2h7.621v-6.961h-2.343v-2.725h2.343V9.309 c0-2.324,1.421-3.591,3.495-3.591c0.699-0.002,1.397,0.034,2.092,0.105v2.43h-1.428c-1.13,0-1.35,0.534-1.35,1.322v1.735h2.7 l-0.351,2.725h-2.365V21H19c1.105,0,2-0.895,2-2V5C21,3.895,20.105,3,19,3z"></path></svg>
                        </a>
                        <a href="">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="48" height="48" viewBox="0 0 30 30" style=" fill:#000000;">    <path d="M 9.9980469 3 C 6.1390469 3 3 6.1419531 3 10.001953 L 3 20.001953 C 3 23.860953 6.1419531 27 10.001953 27 L 20.001953 27 C 23.860953 27 27 23.858047 27 19.998047 L 27 9.9980469 C 27 6.1390469 23.858047 3 19.998047 3 L 9.9980469 3 z M 22 7 C 22.552 7 23 7.448 23 8 C 23 8.552 22.552 9 22 9 C 21.448 9 21 8.552 21 8 C 21 7.448 21.448 7 22 7 z M 15 9 C 18.309 9 21 11.691 21 15 C 21 18.309 18.309 21 15 21 C 11.691 21 9 18.309 9 15 C 9 11.691 11.691 9 15 9 z M 15 11 A 4 4 0 0 0 11 15 A 4 4 0 0 0 15 19 A 4 4 0 0 0 19 15 A 4 4 0 0 0 15 11 z"></path></svg>
                        </a>
                    </section>
                </header>
                <footer style="text-align:center;">
                    Copyright &copy;2021 elforsan.com
                </footer>
            </footer>
        </div>
    </body>
</html>
