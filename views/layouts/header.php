<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
        name="description"
        content="Vente aux enchères en ligne de timbres rares, anciens et de collection. Enchérissez facilement et trouvez des pièces uniques pour enrichir votre collection." />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        rel="preload"
        as="style"
        href="https://fonts.googleapis.com/css2?family=Balthazar&family=Dancing+Script:wght@400..700&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Lora:ital,wght@0,400..700;1,400..700&display=swap"
        onload="this.onload=null;this.rel='stylesheet'" />
    <title>{{ title }}</title>
    <link rel="stylesheet" href="{{ asset }}css/main.css">
</head>

<body>
    <div class="wrapper">
        <main>
            <header>
                <header id="navigation">
                    <div>
                        <a class="logo" href="/">
                            <img
                                src="{{asset}}img/logo2.png"
                                alt="Logo en lettres L et S la lettre S represente une tete de lion" />
                        </a>
                    </div>
                    <ul id="navigation-principale">
                        <li class="menu-deroulant">
                            <a href="#">Enchères<small>▼</small></a>
                            <ul>
                                <li><a href="">Enchères en cours</a></li>
                                <li><a href="">Enchères archivées</a></li>
                            </ul>
                        </li>
                        <li class="menu-deroulant">
                            <a href="#">Actualités<small>▼</small></a>
                            <ul>
                                <li><a href="">Timbres</a></li>
                                <li><a href="">Enchères</a></li>
                                <li><a href="">Bridge</a></li>
                            </ul>
                        </li>
                        <li class="menu-deroulant">
                            <a href="#">À propos<small>▼</small></a>
                            <ul>
                                <li><a href="">La philatélie, c'est la vie.</a></li>
                                <li><a href="">Biographie du Lord</a></li>
                                <li><a href="">Historique familial</a></li>
                            </ul>
                        </li>
                        {%if isAuthenticated %}
                        <li><a href="{{base}}/user/show?id={{session.user_id}}">Mon profil</a> / <a href="{{base}}/logout">Se deconnecter</a></li>
                        {% else %}
                        <li><a href="{{base}}/login">Se connecter</a></li>
                        {% endif %}
                    </ul>
                </header>