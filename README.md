<!-- Languages and tools -->
<p id="top" align="center"> 
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
<p align="center"> 
 <a href="http://vps-a13d8b64.vps.ovh.net:2000">Podgląd strony</a><br>
</p>

##
<!-- TABLE OF CONTENTS -->

<summary>Spis treści</summary>
<ol>
  <li><a href="#install">Instalacja</a></li>
  <li><a href="#diagram">Diagram ERD bazy danych</a></li>
  <li><a href="#screens">Przykładowe screeny</a></li>
</ol>




<!-- Installation -->
## Instalacja
<div id="install"></div>
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

<p align="right">(<a href="#top">do góry</a>)</p>

## Diagram ERD bazy danych
<div id="diagram"></div>

<img src="https://i.ibb.co/7X9RhBt/baza-danych-drawio.png" alt="diagram erd"/>

<p align="right">(<a href="#top">do góry</a>)</p>

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


<p align="right">(<a href="#top">do góry</a>)</p>





