# 📄 README.md: Projecte Futbol Femení
## Autor: Adrián Becerra Pérez
---

# Projecte Futbol Femení

## Descripció
Aquest projecte és una aplicació web construïda amb **Laravel 12** i **PHP 8.4** per gestionar equips de futbol femení, jugadores, estadis i partits.
L’objectiu principal de la **Part 2** és la gestió de partits i estadis, permetent afegir, visualitzar i validar partits amb equips i estadis relacionats.

---

## Estructura de la Base de Dades

### Taules principals
* **equips**
    * id, nom, ciutat, lliga, escut, timestamps
* **jugadoras**
    * id, nom, cognoms, equip_id, posicio, timestamps
* **estadis**
    * id, nom, ciutat, capacitat, equip_principal_id, timestamps
* **partits**
    * id, local_id, visitant_id, estadi_id, data, jornada, resultat, timestamps

### Relacions
* Una **jugadora** pertany a un **equip** (`belongsTo`).
* Un **partit** té un **equip local**, un **equip visitant** i un **estadi** (`belongsTo`).
* Un **estadi** pot tenir molts **partits** (`hasMany`) i pertany a un **equip principal** (`belongsTo`).

---

## Instal·lació i Configuració

1.  Clonar el repositori:
    ```bash
    git clone <URL_DEL_REPOSITORI>
    cd projecte-futbol-femeni
    ```
2.  Instal·lar dependències:
    ```bash
    composer install
    npm install
    npm run dev
    ```
3.  Configurar `.env` amb la base de dades MySQL:
    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=
    ```
4.  Migrar base de dades i crear dades de prova:
    ```bash
    php artisan migrate
    php artisan db:seed
    ```
5.  Opcionalment, utilitzar Tinker per verificar dades:
    ```bash
    ./vendor/bin/sail artisan tinker
    \App\Models\Jugadora::all();
    \App\Models\Equip::all();
    \App\Models\Estadi::all();
    \App\Models\Partit::with(['local','visitant','estadi'])->get();
    ```

---

## Mòduls de Gestió

### Gestió de Jugadoras
* **Llistat de jugadores:** Mostra el nom, equip i posició de cada jugadora.
* **Afegir jugadora nova:**
    * Formulari amb nom, equip (select d’equips existents) i posició.
    * Validació per camp obligatori i select d’equip existent.
    * Exemple de component Blade: `<x-jugadora :jugadora="$jugadora" />`

### Gestió de Partits
* **Llistat de partits:** Mostra local, visitant, estadi, data i resultat.
* **Afegir partit nou:**
    * Formulari amb selects per equip local, equip visitant i estadi.
    * Data en format `YYYY-MM-DD`.
    * Resultat opcional en format `X-Y`.
    * **Validació:** `local_id` i `visitant_id` diferents, `estadi_id` existeix.
    * **Controlador:** `PartitController` amb mètodes `index`, `create`, `store`.
* **Relacions a Eloquent:**
    * `Partit` -> `local` (`belongsTo Equip`)
    * `Partit` -> `visitant` (`belongsTo Equip`)
    * `Partit` -> `estadi` (`belongsTo Estadi`)

### Gestió d’Estadis
* **Llistat d’estadis:** Mostra nom, ciutat, capacitat i equip principal.
* **Afegir estadi nou:**
    * Formulari amb nom, ciutat, capacitat i equip principal (select).
* **Relacions a Eloquent:**
    * `Estadi` -> `equipPrincipal` (`belongsTo Equip`)
    * `Estadi` -> `partits` (`hasMany Partit`)

---

## Notes i Consideracions

* Es recomana utilitzar **selects** per equips i estadis al formulari per evitar errors de relacionament.
* S’ha utilitzat **Faker** per generar dades de prova amb **Factories** i **Seeders**.
* Alguns camps com `cognoms` o `equip_principal_id` tenen valors **obligatoris en BD**, assegurar-se que es proporcionen al crear nous registres.
* Tots els errors de validació es mostren al formulari per millorar l’experiència de l’usuari.

---

## Com executar l’aplicació

1.  Iniciar Sail (Docker) si s’utilitza:
    ```bash
    ./vendor/bin/sail up -d
    ```
2.  Accedir a l’aplicació via navegador a:
    ```
    http://localhost
    ```
3.  Navegar a:
    * `/jugadores` per gestionar jugadores.
    * `/partits` per gestionar partits.
    * `/estadis` per gestionar estadis.
