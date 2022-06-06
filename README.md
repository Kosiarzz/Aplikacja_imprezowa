<!-- Languages and tools -->
<p align="center"> 
  <a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300"></a>
  <a href="https://www.mysql.com/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/mysql/mysql-original-wordmark.svg" alt="mysql" width="130"/> </a> 
</p>

<!-- ABOUT THE PROJECT -->
## Opis aplikacji
  
<p align="left">   
Celem pracy było utworzenie aplikacji internetowej z funkcjonalnościami
społecznościowymi, która ułatwi zorganizowanie wybranego wydarzenia tj.
Wesele, Chrzest, Komunia święta, Urodziny. Aplikacja udostępnia dwa typy kont:
użytkownik zwykły i użytkownik firmowy (firma). Użytkownik zwykły może
organizować wyżej wymienione wydarzenia. Każdy typ wydarzenia generuje
odpowiednią listę zadań i opłat jakie użytkownik powinien wykonać w ramach
organizowania tego wydarzenia. Aplikacja pozwala modyfikować i dostosowywać
tą listę, dodatkowo umożliwia zarządzanie listą gości, wydatków oraz
przeglądanie i rezerwowanie usług itp. Funkcjonalności użytkownika firmowego
(firma) pozwalają tworzyć profil firmy, udostępniać usługi jakie oferuje. Panel
firmy pozwala m. in. łatwo zarządzać rezerwacjami, przeglądać statystyki swoich
usług i ofert, zbierać opinie użytkowników poprzez komentarze i oceny. Aplikacja
udostępnia użytkownikowi bardzo ładny, łatwy w użyciu, intuicyjny interfejs
graficzny. W ramach implementacji aplikacji utworzono również na jej potrzeby
odpowiednią bazę danych w technologii MySQL. Aplikacja została napisana w
frameworku Laravel natomiast frontend został utworzony w szablonach Blade z
pomocą frameworka Bootstrap.
</p>
</div>


##
<!-- TABLE OF CONTENTS -->

<summary>Spis treści</summary>
<ol>
  <li><a href="#Instalacja">Instalacja</a></li>
  <li><a href="#diagram">Diagram ERD bazy danych</a></li>
  <li><a href="#screens">Przykładowe screeny</a></li>
</ol>




<!-- Installation -->
## Instalacja

Skopiuj repozytorium na swój komputer

```bash
  git clone https://github.com/Kosiarzz/Aplikacja_imprezowa.git
```

Będą w folderze z projektem uruchom terminal i wpisz komendę

```bash
  composer intall
```

Po zakończeniu instalacji skopiuj plik ```.env.example``` i nazwij ``` .env```.
<p>Następnie zmień w nim wartości na takie jak poniżej</p>

```bash
  APP_LOCALE=pl
  FILESYSTEM_DRIVER=public
```

Nastęnie wygeneruj nowy klucz

```bash
  php artisan key:generate
```

Wykonaj migrację bazy danych wraz z danymi

```bash
  php artisan migrate --seed
```


Zainstaluj i skompiluj pakiety

```bash
  npm install
  npm run dev
```
Uruchom lokalny serwer

```bash
  php artisan serve
```

<p align="right">(<a href="#top">back to top</a>)</p>

## Diagram ERD bazy danych
<div id="diagram"></div>

![ERD][erd]

<p align="right">(<a href="#top">back to top</a>)</p>

## Przykładowe screeny
<div id="screens"></div>

Podsumowanie wydarzenia

<img src="https://i.ibb.co/HBRjsmZ/obraz1.png" alt="panel główny"/>

##
Lista gości

<img src="https://i.ibb.co/CzQf9Pm/goscie.png" alt="lista gości"/>

##
  
Kalendarz zadań i finansów
  
<img src="https://i.ibb.co/SdJf7Zk/kalendarz.png" alt="kalendarz" width="900" height="700"/>

Wyszukiwanie ofert
  
<img src="https://i.ibb.co/ftBPnG4/filtry.png" alt="filtry" width="1000" height="600"/>

Zarządzanie rezerwacjami (firma)
  
<img src="https://i.ibb.co/cCRM7tt/rezerwacje.png" alt="rezerwacje" width="1000" height="600"/>

Wykres odwiedziń, polubień i dokonanych rezerwacji firmy
  
<img src="https://i.ibb.co/bPT26Xb/wykres.png" alt="wykres" width="900" height="600"/>

</p>


<p align="right">(<a href="#top">back to top</a>)</p>

<!-- MARKDOWN LINKS & IMAGES -->
[erd]: https://iv.pl/images/d8b65d7dbca79663edd19915c3b3f7c3.png

[panel]: https://iv.pl/images/a16e361fb3c6475b23c2e34eda56d046.png
[guests]: https://iv.pl/images/b0ab126c7337a42cbc299cc573789685.png
[calendar]: https://iv.pl/images/7adaa58dbbc70e510edd457b85baee2d.png
[filters]: https://iv.pl/images/5ae7b5bb84b4f45637743ab69909edd7.png
[reservations]: https://iv.pl/images/869e81e499347b44ec8db098301787a2.png
[chart]: https://iv.pl/images/c00c4e6ac8a16b1d5a51fa320f3cbcc4.png



