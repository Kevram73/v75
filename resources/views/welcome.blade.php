<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <title>v75 Pro &mdash; Investment</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="{{asset('/images/V75.png')}}" style="border-radius: 100%;">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="vitrine/fonts/icomoon/style.css">

    <link rel="stylesheet" href="vitrine/css/bootstrap.min.css">
    <link rel="stylesheet" href="vitrine/css/jquery-ui.css">
    <link rel="stylesheet" href="vitrine/css/owl.carousel.min.css">
    <link rel="stylesheet" href="vitrine/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="vitrine/css/owl.theme.default.min.css">

    <link rel="stylesheet" href="vitrine/css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="vitrine/css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="vitrine/fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="vitrine/css/aos.css">

    <link rel="stylesheet" href="vitrine/css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>
    <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">


    <div id="overlayer"></div>
    <div class="loader">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
    </div>


    <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
        </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>


    <header class="site-navbar js-sticky-header site-navbar-target" role="banner">

        <div class="container">
        <div class="row align-items-center">

            <div class="col-6 col-xl-2">
            <!-- <br><img src="vitrine/images/V75.png" alt="logo" class="mb-0 site-logo" style="width: 70px; height: 70px; border-radius: 100%;">  -->
            <h1 class="mb-0 site-logo"><a href="/" class="h2 mb-0">v75 Pro<span class="text-success">.</span> </a></h1>
            </div>

            <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">

                <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li><a href="#home-section" class="nav-link">Accueil</a></li>
                <li class="has-children">
                    <a href="#about-section" class="nav-link">A propos</a>
                    <ul class="dropdown">
                        <li><a href="#about-section" class="nav-link">v75 Pro</a></li>
                        <li><a href="#how" class="nav-link">Comment ca marche ?</a></li>
                        <li><a href="#faq-section" class="nav-link">FAQ</a></li>
                        <li><a href="#testimonials-section" class="nav-link">Testimonials</a></li>
                        <li><a href="/policy" class="nav-link">Termes et conditions</a></li>

                    </ul>
                </li>

                <li><a href="#blog-section" class="nav-link">Actualités</a></li>
                <li><a href="#contact-section" class="nav-link">Contacts</a></li>
                <li class="social"><a href="{{route('client.login')}}"> Se connecter <i class="fa fa-spinner fa-spin" style="font-size:16px"></i></a></li>
                </ul>
            </nav>
            </div>

            <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle float-right"><span class="icon-menu h3"></span></a></div>

        </div>
        </div>

    </header>



    <div class="site-blocks-cover overlay" style="background-image: url(vitrine/images/13833.jpg); background-repeat: no-repeat; background-size: cover;" data-aos="fade" id="home-section">

        <div class="container">
        <div class="row align-items-center justify-content-center">


            <div class="col-md-10 mt-lg-5 text-center">
            <div class="single-text owl-carousel">
                <div class="slide">
                <br><br><h1 class="text-uppercase" data-aos="fade-up">v75 Pro Official investment Plateform</h2>
                <br><p class="mb-5 desc"  data-aos="fade-up" data-aos-delay="100">Investir intelligemment, v75 Pro vous guide ! <br>Faites vos placements de fonds et de capital de manière stratégique. <br>Trading automatisé de l'indice V75</p>
                <div data-aos="fade-up" data-aos-delay="100">
                    <a href="{{route('client.login')}}" target="_blank" class="btn  btn-success mr-2 mb-2" style="color: white;">Commencer maintenant</a>
                </div>
                </div>

                <div class="slide">
                    <br><br><h1 class="text-uppercase text-success" data-aos="fade-up">Une solution à vos soucis de placement</h1>
                    <br><p class="mb-5 desc" data-aos="fade-up" data-aos-delay="100">Multipliez vos gains avec v75 Pro : La solution d’investissement !<br>
                        Investissez dès maintenant et gagnez jusqu'à 3,33% de bénéfice journalier <br>(100% en un mois) sur votre capital initial.</p>
                    <div data-aos="fade-up" data-aos-delay="100">
                        <a href="{{route('client.login')}}" target="_blank" class="btn  btn-success mr-2 mb-2" style="color: white;">Commencer maintenant</a>
                    </div>
                </div>

                <div class="slide">
                <br><br><h1 class="text-uppercase" data-aos="fade-up">Un investissement Stratégique</h1>
                <br><p class="mb-5 desc" data-aos="fade-up" data-aos-delay="100">v75 Pro encourage à investir de manière stratégique pour devenir un investisseur averti avec notre bot de trading des indices en vous proposant des plans d'investissement financiers ; <br>Minimum à investir 10$</p>
                <div data-aos="fade-up" data-aos-delay="100">
                    <a href="{{route('client.login')}}" target="_blank" class="btn  btn-success mr-2 mb-2" style="color: white;">Commencer maintenant</a>
                </div>
                </div>

                <div class="slide">
                    <br><br><h1 class="text-uppercase text-success" data-aos="fade-up">Dépôt et retrait instantané</h1>
                    <br><p class="mb-5 desc" data-aos="fade-up" data-aos-delay="100">Investissez dès maintenant et commencer à percevoir vos gains 24H après votre inscription et la création de votre compte d'investissement ;
                        Dépôts et retrait instantané ! <br>Transactions possible via <span class="text-success">USDT TRC20 </span><br>Portefeuille supporté : <span class="text-success">Trust Wallet</span></p>
                    <div data-aos="fade-up" data-aos-delay="100">
                        <a href="{{route('client.login')}}" target="_blank" class="btn  btn-success mr-2 mb-2" style="color: white;">Commencer maintenant</a>
                    </div>
                </div>

                <div class="slide">
                    {{-- <br><br><h1 class="text-uppercase" data-aos="fade-up">Des commissions sur vos parrainages</h1> --}}
                    <p class="mb-5 desc" data-aos="fade-up" data-aos-delay="100">
                        <center>
                            <div><img src="vitrine/images/tsbg.png" alt="" class="img-fluid" style="width: 60%; height: 50%;"></div>
                        </center>
                        <br><p style="color: white; margin-left:5%; margin-right:5%; line-height:32px; font-size:18px;">Des commissions sur vos parrainages ; Vous pouvez gagnez 8% du bénéfice quotidien total de votre membre de niveau 1, 5% sur celui du niveau 2 et 3% sur celui de niveau 3</p>
                    </p><br>
                    <div data-aos="fade-up" data-aos-delay="100">
                        <a href="{{route('client.login')}}" target="_blank" class="btn  btn-success mr-2 mb-2" style="color: white;">Commencer maintenant</a>
                    </div>
                </div>


            </div>
            </div>

        </div>
        </div>

        <a href="#next" class="mouse smoothscroll">
        <br><span class="mouse-icon">
            <span class="mouse-wheel"></span>
        </span>
        </a>
    </div>


    <div class="site-section cta-big-image" id="about-section">
        <div class="container">
        <div class="row mb-5 justify-content-center">
            <div class="col-md-8 text-center">
            <h2 class="section-title mb-3 text-sucess" data-aos="fade-up" data-aos-delay="" style="color: black;">A propos de v75 pro</h2>
            <p class="lead" data-aos="fade-up" data-aos-delay="100">Plateforme d'investissement spécialisée dans le trading des indices synthétiques, notamment l'indice V75 index</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 mb-5" data-aos="fade-up" data-aos-delay="">
            <figure class="circle-bg">
            <img src="vitrine/images/img_2.jpg" alt="v75 pro" class="img-fluid">
            </figure>
            </div>
            <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="100">

            <h3 class="text-success mb-4">Qui sommes-nous ?</h3>

            <p style="text-align: justify; line-height: 34px;">V75 pro est la plateforme spécialisée dans le trading des indices synthétiques et particulièrement l'indice V75 index. Elle est  basée à Dubaï, opérant essentiellement dans le Trading, les investissements en ligne, et fait partie d'une holding de 13 sociétés qui exerce également dans le transport terrestre, le e-commerce, les BTP et bien d'autres.</p>

            <p style="text-align: justify; line-height: 34px;">En seulement quelques mois après le lancement, notre plate-forme enregistre à ce jour plus d'un millier d'utilisateurs et 600K $ d'actifs sous gestion.</p>

            </div>
        </div>

        </div>
    </div>

    <div class="site-section" id="next" style="margin-top: -10%;">
        <div class="container">
        <div class="row mb-5">
            <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="">
            <img src="vitrine/images/flaticon-svg/svg/001-wallet.svg" alt="v75 pro" class="img-fluid w-25 mb-4">
            <h3 class="card-title" style="line-height: 30px;">Des placements stratégiques et sécurisés</h3>
            <p>Nous disposons de l'une des meilleures équipe constitué de Traders professionnels.</p>
            </div>
            <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="100">
            <img src="vitrine/images/flaticon-svg/svg/004-cart.svg" alt="v75 pro" class="img-fluid w-25 mb-4">
            <h3 class="card-title" style="line-height: 30px;">A l'affût des fluctuations et tendances du marché</h3>
            <p>Nous suivons toutes les fluctuations et l'évolution du marché en temps réel.</p>
            </div>
            <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="200">
            <img src="vitrine/images/flaticon-svg/svg/006-credit-card.svg" alt="v75 pro" class="img-fluid w-25 mb-4">
            <h3 class="card-title" style="line-height: 30px;">Des gains journaliers recupérable à chaque instant</h3>
            <p>Investissez et percevez jusqu'à 3,3% par jour sur votre capital initial sans commissions.</p>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-6 mb-5" data-aos="fade-up" data-aos-delay="">
            <figure class="circle-bg">
            <img src="vitrine/images/about_2.jpg" alt="v75 pro" class="img-fluid">
            </figure>
            </div>
            <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="100">
            <div class="mb-4">
                <h3 class="h3 mb-4 text-black"><span class="text-success">$ Investir autrement</span></h3>
                <p>Avec la plateforme v75 pro, votre capital n'a jamais été un aussi bon employé à votre compte.</p>

            </div>

            <div class="mb-4">
                <ul class="list-unstyled ul-check success">
                <li>Créer votre compte d'invest dès maintenant</li>
                <li>Faites vos placements, investissez à partir de 10$</li>
                <li>Et gagnez jusqu'à 3,33% de gain quotidien</li>
                </ul>

            </div>




            </div>
        </div>
        </div>
    </div>


    <section class="site-section" id="how" style="margin-top: -10%;">
        <div class="container">

        <div class="row mb-5 justify-content-center">
            <div class="col-md-7 text-center">
            <h2 class="section-title mb-3 text-black" data-aos="fade-up" data-aos-delay="">Comment ça marche ?</h2>
            <p class="lead" data-aos="fade-up" data-aos-delay="100">Avec V75 pro investir n'a jamais été aussi facile. <br>Tout en trois (03) étapes</p>
            </div>
        </div>

        <div class="row align-items-lg-center" >
            <div class="col-lg-6 mb-5" data-aos="fade-up" data-aos-delay="">

            <div class="owl-carousel slide-one-item-alt">
                <img src="vitrine/images/img_1.jpg" alt="Image" class="img-fluid">
                <img src="vitrine/images/img_2.jpg" alt="Image" class="img-fluid">
                <img src="vitrine/images/img_1.jpg" alt="Image" class="img-fluid">
            </div>
            <div class="custom-direction">
                <a href="#" class="custom-prev" style="background-color: rgb(29, 168, 29); border-radius: 10% 0% 0% 10%;"><span><span class="icon-keyboard_backspace"></span></span></a><a href="#" class="custom-next" style="background-color: rgb(29, 168, 29); border-radius: 0% 10% 10% 0%;"><span><span class="icon-keyboard_backspace"></span></span></a>
            </div>

            </div>
            <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="100">

            <div class="owl-carousel slide-one-item-alt-text">
                <div>
                <h2 class="section-title mb-3 text-success" style="font-size: 36px;">01. Créer un compte</h2>
                <p style="text-align: justify; line-height: 34px;">Créer votre compte d'investissement v75 pro en fournissant les informations utiles ; puis se connecter ! <br>Accéder à votre tableau de bord et commencez à investir.</p>

                <p><a href="{{route('client.register')}}" class="btn btn-success mr-2 mb-2" style="color: white;">Créer maintenant</a></p>
                </div>
                <div>
                <h2 class="section-title mb-3 text-success" style="font-size: 36px;">02. Investir</h2>
                <p style="text-align: justify; line-height: 34px;">Une fois votre comptre créé, vous pouvez commencer à investir ; le placement minimum est de 10$. <br>Le moyen de transaction supporté par la plateforme est le <span class="text-black"> USDT TRC20.</span></p>
                <p><a href="{{route('client.login')}}" class="btn btn-success mr-2 mb-2" style="color: white;">Commencer</a></p>
                </div>
                <div>
                <h2 class="section-title mb-3 text-success" style="font-size: 36px;">03. Percevoir ses gains</h2>
                <p style="text-align: justify; line-height: 34px;">Une fois votre investissement faite, percevez jusqu'à 3,3% de bénéfice journalier sur votre capital ; à retirer à tout moment via USDT TRC20 (Portefeuille supporté : <span class="text-success">Trust Wallet</span>).</p>

                <p><a href="{{route('client.login')}}" class="btn btn-success mr-2 mb-2" style="color: white;">Commencer</a></p>
                </div>

            </div>

            </div>
        </div>
        </div>
    </section>




    <section class="site-section border-bottom bg-light" id="services-section">
        <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center" data-aos="fade">
            <h2 class="section-title mb-3 text-black">Dépôt et retrait instantanné</h2>
            <p class="lead" data-aos="fade-up" data-aos-delay="100">Avec notre bot de trading des indices, gagnez 3.33% par jour, 100% par mois. <br>
                Minimum à investir 10$, USDT TRC20 (Dépôt et retrait instantané, Portefeuille supporté : <span class="text-success">Trust Wallet</span>)</p>
            </div>
        </div>
        <div class="row align-items-stretch">
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up">
            <div class="unit-4 text-center">
                <div class="unit-4-icon">
                <img src="vitrine/images/flaticon-svg/svg/001-wallet.svg" alt="v75 pro" class="img-fluid w-25 mb-4">
                </div>
                <div>
                <h3 style="line-height: 30px;">Créez votre compte <br>d'investissement</h3>
                <br><p style="text-align: justify; line-height: 30px;">Investir n'a jamais été aussi simple avec v75 pro. Créez votre compte d'investissement v75 pro, connectez-vous et accédez à votre dashboard pour commencer à opérer.</p>
                <p><a href="{{route('client.login')}}" class="text-success">Commencer</a></p>
                </div>
            </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="unit-4 text-center">
                <div class="unit-4-icon">
                <img src="vitrine/images/flaticon-svg/svg/002-rich.svg" alt="v75 pro" class="img-fluid w-25 mb-4">
                </div>
                <div>
                <h3 style="line-height: 30px;">Faites vos placements <br>investissz dès 10$</h3>
                <br><p style="text-align: justify; line-height: 30px;">Faites vos dépôts d'investissement à partir de 10$ minimum via <a href="www.usdt.com" class="text-danger"> USDT TRC20</a> (Portefeuille supporté : <span class="text-success">Trust Wallet</span>).</p>
                <p><a href="#" class="text-success">Investir maintenant</a></p>
                </div>
            </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="unit-4 text-center">
                <div class="unit-4-icon">
                <img src="vitrine/images/flaticon-svg/svg/003-notes.svg" alt="v75 pro" class="img-fluid w-25 mb-4">
                </div>
                <div>
                <h3 style="line-height: 30px;">Percevez vos gains de 3,3% de RSI <br>(retour sur investissement)</h3>
                <br><p style="text-align: justify; line-height: 30px;">Gagnez 3,3% de bénéfices sur votre capital initial (sans commissions) ; et jusqu'à 8%, 5% et 3% sur les gains de vos filleuls de premier, deuxième et troisième niveau. </p>
                <p><a href="{{route('client.login')}}" class="text-success">Commencer maintenant</a></p>
                </div>
            </div>
            </div>




        </div>
        </div>
    </section>

    <section class="site-section testimonial-wrap" id="testimonials-section" data-aos="fade">
        <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
            <h2 class="section-title mb-3 text-black">Avis Clients </h2>
            </div>
        </div>
        </div>
        <div class="slide-one-item home-slider owl-carousel">
            <div>
            <div class="testimonial">

                <blockquote class="mb-5">
                <p style="line-height: 30px;">&ldquo; J’utilise V75 pro depuis plusieurs mois déjà et je suis impressionné par sa stabilité et sa précision sur le reversement des RSI. Je perçois mes 3,3% quotidiennement. Merci v75 pro ! &rdquo;</p>
                </blockquote>

                <figure class="mb-4 d-flex align-items-center justify-content-center">
                <div><img src="vitrine/images/person_1.jpg" alt="Image" class="w-50 img-fluid mb-3"></div>
                <p>Théodort Dichane</p>
                </figure>
            </div>
            </div>
            <div>
            <div class="testimonial">

                <blockquote class="mb-5">
                <p style="line-height: 30px;">&ldquo; L'indice V75 en elle-même est un excellent outil pour le scalping. Sa volatilité constante de 75 % en fait un choix fiable pour les traders actifs ; et là c'est encore mieux quand la plateforme se charge des placements et de trader pour nous. &rdquo;</p>
                <!-- <br>Aussi, les mouvements du marché sont fidèlement reflétés, ce qui me permet de prendre des décisions éclairées quand il s'agit de trader moi-même quelques fois à côté de mes invests -->
                </blockquote>
                <figure class="mb-4 d-flex align-items-center justify-content-center">
                <div><img src="vitrine/images/person_3.jpg" alt="Image" class="w-50 img-fluid mb-3"></div>
                <p>Christian Damatta</p>
                </figure>

            </div>
            </div>

            <div>
            <div class="testimonial">

                <blockquote class="mb-5">
                <p style="line-height: 30px;">&ldquo; V75 pro is an exceptional investment opportunity. The consistent yields and ease of use make it my favorite choice. it considerably rounds off my end of the month ! &rdquo;</p>
                </blockquote>
                <figure class="mb-4 d-flex align-items-center justify-content-center">
                <div><img src="vitrine/images/person_2.jpg" alt="Image" class="w-50 img-fluid mb-3"></div>
                <p>Katrine Spears</p>
                </figure>


            </div>
            </div>

            <div>
            <div class="testimonial">

                <blockquote class="mb-5">
                <p style="line-height: 30px;">&ldquo; На V75 pro я инвестирую уже некоторое время, и ежедневные прибыли в 3,3% меня впечатляют. Платформа удобна в использовании, и я чувствую себя уверенно в своих инвестициях. &rdquo;</p>
                </blockquote>
                <figure class="mb-4 d-flex align-items-center justify-content-center">
                <div><img src="vitrine/images/person_1.jpg" alt="Image" class="w-50 img-fluid mb-3"></div>
                <p>Viktor Petrov</p>
                </figure>

            </div>
            </div>

        </div>
    </section>

    <section class="site-section bg-light" id="pricing-section">
        <div class="container">


        <div class="row site-section" id="faq-section" style="margin-top: -10%;">
            <div class="col-12 text-center" data-aos="fade">
            <h2 class="section-title text-black">Questions fréquemment posées</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">

            <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-success h4 mb-4">Combien puis-je investir ?</h3>
            <p style="line-height: 32px; text-align: justify;">Vous êtes tout aussi librement investir le montant que vous désirez partant d'un minimum de 10$. Aucun plafond n'est réellement imposé.</p>
            </div>

            <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
                <h3 class="text-success h4 mb-4">Puis-je investir via Paypal ?</h3>
                <p style="line-height: 32px; text-align: justify;">Par soucis d'accessibilité universelle pour tous nos client, il est impossible d'investir via Paypal ; certaines zones géographiques ne sont pas prises en compte et n'y ont pas accès.
                Le but premier de la plateforme v75 pro est de permettre à toute personne d'investir indépendemment de sa situation géographique ; pour ce faire le seul moyen de transactions accepté par notre plateforme est : le <a href="" class="text-black"> USDT TRC20 (Portefeuille supporté : <span class="text-success">Trust Wallet</span>).</a></p>
            </div>
            </div>
            <div class="col-lg-6">

            <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
                <h3 class="text-success h4 mb-4">Je suis en Afrique, puis-je investir ?</h3>
                <p style="line-height: 32px; text-align: justify;">Oui ! La plateforme v75 pro est ouverte à tout le monde, accessible partout dans le monde et destinée à toute personne désireux d'investir ou placer ses fonds à trader.</p>
            </div>

            <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
                <h3 class="text-success h4 mb-4">Quels taux proposez-vous ?</h3>
                <p style="line-height: 32px; text-align: justify;">Percevez 3,3% de bénéfice journalier sur votre capital initial investit. En plus de vos RSI (retour sur investissement) quotidien gagner jusqu'à 8% sur les gains journaliers de toute personne directement parrainée (filleuls de niveau 1),
                5% sur les RSI quotidiens des filleuls de vos filleuls de niveau 1 (filleuls de niveau 2) et 3% en plus sur les gains journaliers des filleuls de ces derniers (filleuls de niveau 3).</p>
            </div>

            </div>
        </div>
        </div>
    </section>

    <section class="site-section" id="about-section">
        <div class="container">

        <div class="row">
            <div class="col-lg-6 mb-5" data-aos="fade-up" data-aos-delay="">
            <figure class="circle-bg">
            <img src="vitrine/images/img_4.jpg" alt="v75 pro" class="img-fluid">
            </figure>
            </div>
            <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="100">


            <div class="row">



                <div class="col-12 mb-4" data-aos="fade-up" data-aos-delay="">
                <div class="unit-4 d-flex">
                    <div class="unit-4-icon mr-4 mb-3"><span class="lead flaticon-head"></span></div>
                    <div>
                    <h3 class="text-black">Fidélité</h3>
                    <p style="line-height: 30px; text-align: justify;">v75 pro toujours fidèle à sa clientèle ; En seulement quelques mois après le lancement, notre plate-forme enregistre à ce jour plus d'un miller d'utilisateurs et 600K $ d'actifs sous gestion.</p>
                    <p class="mb-0"><a href="#" class="text-success">Nous rejoindre</a></p>
                    </div>
                </div>
                </div>
                <div class="col-12 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="unit-4 d-flex">
                    <div class="unit-4-icon mr-4 mb-3"><span class="lead flaticon-smartphone"></span></div>
                    <div>
                    <h3 class="text-black">Un accord professionnel </h3>
                    <p style="line-height: 30px; text-align: justify;">D'un point de vue jurique, il s’agit d’un accord entre la plateforme V75 pro et vous (Souscripteur et utilisateur de v75 pro). En utilisant la plateforme, vous acceptez d'avoir lu, compris et accepté toutes les conditions générales contenues dans les présentes (le «Contrat d'utilisation»), ainsi que notre politique de confidentialité disponible <a href="/policy" class="text-danger"> ici</a></p>
                    <p class="mb-0"><a href="#" class="text-success">Contrat d'utilisation</a></p>
                    </div>
                </div>
                </div>
            </div>



            </div>
        </div>


        </div>
    </section>




    <section class="site-section" id="blog-section" style="margin-top: -10%;">
        <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center" data-aos="fade">
            <h2 class="section-title mb-3 text-black">Actualités</h2>
            </div>
        </div>

        <div class="row">


                <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="">
                    @foreach ($announcements as $announcement)
                    <div class="h-entry">
                        <a href="single.html">
                        <img src="vitrine/images/bg.jpg" alt="Image" class="img-fluid">
                        </a>
                        @php
                            $content = $announcement->content;
                            $ctnt = Str::limit($content, 100, '...')
                        @endphp
                        <h2 class="font-size-regular"><a href="#">{{$announcement->title}}</a></h2>
                        <div class="meta mb-4">v75 pro<span class="mx-2">&bullet;</span> {{$announcement->updated_at->format('d/m/Y')}}<span class="mx-2">&bullet;</span> <a href="#">info</a></div>
                        <p>
                            <?php
                                echo '<style>';
                                    echo 'body { text-align: justify; line-height:26px; font-size:15px; color: #707070; }';
                                echo '</style>';
                                echo $ctnt;
                            ?>
                            {{-- A voir: Le content deborde --}}
                        </p>
                        <p><a href="#">Lire plus...</a></p>
                    </div>
            @endforeach
        </div>

        </div>
    </section>




    <section class="site-section bg-light" id="contact-section" data-aos="fade">
        <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
            <h2 class="section-title mb-3 text-black">Contacts</h2>
            </div>
        </div>
        <div class="row mb-5">



            <div class="col-md-6 text-center">
            <p class="mb-4">
                <span class="icon-room d-block h2 text-success"></span>
                <span>Siège officiel V75 pro, <br>Dubaï</span>
            </p>
            </div>
            {{-- <div class="col-md-4 text-center">
            <p class="mb-4">
                <span class="icon-phone d-block h2 text-success"></span>
                <a href="#" style="color: gray;">+1 222 3333 444</a>
            </p>
            </div> --}}
            <div class="col-md-6 text-center">
            <p class="mb-0">
                <span class="icon-mail_outline d-block h2 text-success"></span>
                <a href="#" class="text-success">info@v75pro.net</a>
            </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-5">

            <form action="#" class="p-5 bg-white">

                <h2 class="h4 text-black mb-5">Envoyer un message</h2>

                <div class="row form-group">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label class="text-black" for="fname">Prénom</label>
                    <input type="text" id="fname" class="form-control" placeholder="Votre prénom">
                </div>
                <div class="col-md-6">
                    <label class="text-black" for="lname">Nom</label>
                    <input type="text" id="lname" class="form-control" placeholder="Votre nom">
                </div>
                </div>

                <div class="row form-group">

                <div class="col-md-12">
                    <label class="text-black" for="email">Email</label>
                    <input type="email" id="email" class="form-control" placeholder="Adresse email">
                </div>
                </div>

                <div class="row form-group">

                <div class="col-md-12">
                    <label class="text-black" for="subject">Objet</label>
                    <input type="subject" id="subject" class="form-control" placeholder="L'objet du message">
                </div>
                </div>

                <div class="row form-group">
                <div class="col-md-12">
                    <label class="text-black" for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Rédigez votre message ici..."></textarea>
                </div>
                </div>

                <div class="row form-group">
                <div class="col-md-12">
                    <input type="submit" value="Envoyer" class="btn btn-success btn-md text-white">
                </div>
                </div>


            </form>
            </div>

        </div>
        </div>
    </section>


    <footer class="site-footer">
        <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div class="row">
                <div class="col-md-5">
                <h2 class="footer-heading mb-4">A propos</h2>
                <p style="line-height: 30px; text-align: justify;">V75 pro est la plateforme spécialisée dans le trading des indices synthétiques et particulièrement l'indice V75 index. Elle est basée à Dubaï, opérant essentiellement dans le Trading, les investissements en ligne.</p>
                </div>
                <div class="col-md-3 offset-1">
                <h2 class="footer-heading mb-4">Liens rapides</h2>
                <ul class="list-unstyled">
                    <li><a href="/policy" class="smoothscroll">Politique</a></li>
                    <li><a href="#about-section" class="smoothscroll">A propos</a></li>
                    <li><a href="#how" class="smoothscroll">Comment ça marche ?</a></li>
                    <li><a href="#faq-section" class="smoothscroll">FAQ</a></li>
                    <li><a href="#contact-section" class="smoothscroll">Contacts</a></li>
                </ul>
                </div>
                <div class="col-md-3 footer-social">
                <h2 class="footer-heading mb-4">Commencer</h2>
                <p><a href="{{route('client.register')}}" class="btn btn-success mr-2 mb-2" style="color: white;">Créer son compte <i class="fa fa-spinner fa-spin" style="font-size:16px"></i></a></p>

                </div>
            </div>
            </div>
            <!-- <div class="col-md-3">
            <h2 class="footer-heading mb-4">Se</h2>
            <form action="#" method="post" class="footer-subscribe">
                <div class="input-group mb-3">
                <input type="text" class="form-control border-secondary text-white bg-transparent" placeholder="Enter Email" aria-label="Enter Email" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary text-black" type="button" id="button-addon2">Send</button>
                </div>
                </div>
            </form>
            </div> -->
        </div>
        <div class="row pt-5 mt-5 text-center">
            <div class="col-md-12">
            <div class="border-top pt-5">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                <p>Copyright &copy;
                <script>document.write(new Date().getFullYear());</script> All rights reserved | <a href="/">v75 pro</a>
                </p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

            </div>
            </div>

        </div>
        </div>
    </footer>

    </div> <!-- .site-wrap -->

    <script src="vitrine/js/jquery-3.3.1.min.js"></script>
    <script src="vitrine/js/jquery-ui.js"></script>
    <script src="vitrine/js/popper.min.js"></script>
    <script src="vitrine/js/bootstrap.min.js"></script>
    <script src="vitrine/js/owl.carousel.min.js"></script>
    <script src="vitrine/js/jquery.countdown.min.js"></script>
    <script src="vitrine/js/jquery.easing.1.3.js"></script>
    <script src="vitrine/js/aos.js"></script>
    <script src="vitrine/js/jquery.fancybox.min.js"></script>
    <script src="vitrine/js/jquery.sticky.js"></script>
    <script src="vitrine/js/isotope.pkgd.min.js"></script>


    <script src="vitrine/js/main.js"></script>


    </body>
</html>
