# 📄 Projecte Futbol Femení (Part 3)

## 👤 Autor
**Adrián Becerra Pérez** - Desenvolupament d'Aplicacions Web (DAW)

---

## 📝 Descripció del Projecte
Aquest projecte és una aplicació web completa construïda amb **Laravel 12** i **PHP 8.4** per a la gestió integral d'un club o lliga de futbol femení.

Aquesta entrega final (**Part 3**) transforma el projecte en un sistema professional llest per a producció. S'han integrat funcionalitats avançades com:
* **Seguretat basada en Rols** (Admin, Mànager, Àrbitre).
* **Generació d'Actes en PDF**.
* **Notificacions per Correu Electrònic**.
* **Lògica de Negoci Complexa** (Classificació automàtica, ratxes de victòries, mitjana d'edat).
* **API REST** pública.
* **Internacionalització** (Valencià / Castellà / Anglès).

---

## 🔑 Credencials d'Accés (Usuaris de Prova)

Per avaluar correctament les funcionalitats i les restriccions de seguretat (Policies/Gates), s'han creat els següents usuaris mitjançant els *Seeders*:

| Rol | Email | Contrasenya | Permisos i Funcionalitats Clau |
| :--- | :--- | :--- | :--- |
| **Administrador** | `admin@futbolfemeni.com` | `password` | **Control Total**. Pot crear, editar i esborrar qualsevol entitat (Equips, Jugadores, Estadis, Partits). |
| **Mànager** | `manager_valencia-cf@futbolfemeni.com` | `password` | **Gestió de Club**. Només pot editar el *seu* equip i les *seues* jugadores. Rep correus de la jornada. |
| **Àrbitre** | `arbitre1@futbolfemeni.com` | `password` | **Gestió de Resultats**. Només pot editar el resultat ("Gols-Gols") dels partits on està assignat. |

> **Nota:** Si regeneres la base de dades, utilitza aquestes credencials. Per provar el rol de Mànager, assegura't d'utilitzar un usuari assignat a un equip específic (com l'exemple del València CF) i no el genèric.
---

## 🗺️ Guia de Navegació (URLs Importants)

Ací tens les rutes clau per verificar les funcionalitats de la pràctica:

### 🏠 Panell Principal (Dashboard)
* **`http://localhost/dashboard`** → **Classificació en Temps Real**.
    * *Què observar:* La taula s'ordena automàticament per punts (3 victòria, 1 empat). Mostra l'edat mitjana de la plantilla i la ratxa dels últims 5 partits amb indicadors visuals (🟢 Guanyat, 🔴 Perdut, 🔵 Empat).

### ⚽ Gestió Esportiva
* **`http://localhost/partits`** → **Calendari i Actes**.
    * *Què observar:* Llistat ordenat cronològicament. Botó **PDF** per descarregar l'acta. Botó **Editar** (només visible si tens permís sobre eixe partit).
* **`http://localhost/equips`** → **Gestió de Clubs**.
    * *Què observar:* Llistat amb escuts. Els botons d'acció "Editar" o "Eliminar" estan protegits i només apareixen si l'usuari té drets sobre l'equip.

### 📬 Eines Externes
* **`http://localhost:8025`** → **Mailpit (Safata de Correu)**.
    * *Què observar:* Ací arriben els correus enviats pel sistema (ex: Resum de la Jornada).

### 🔌 API REST (JSON)
* **`GET /api/equips`** → Llistat complet d'equips en format JSON.
* **`GET /api/equips/{id}`** → Dades detallades d'un equip específic.

---

## 📦 Instal·lació i Desplegament

Per simular un entorn de producció i assegurar que tots els estils (Tailwind CSS) es carreguen correctament, segueix aquests passos:

1.  **Iniciar els contenidors (Docker/Sail):**
    `./vendor/bin/sail up -d`

2.  **Configurar Base de Dades i Usuaris (Seeders):**
    `./vendor/bin/sail artisan migrate:fresh --seed`

3.  **Compilar Estils (CRÍTIC per als colors de la classificació):**
    Si no executes aquest pas, els cercles verds/rojos/blaus de la ratxa no es veuran.
    `./vendor/bin/sail npm run build`
---

## 💻 Comandes Personalitzades (Artisan)

He creat comandes específiques per a tasques automatitzades i manteniment:

* **Enviar correus de la Jornada:**
  Busca partits futurs i envia un resum als mànagers. (Està configurat en "Mode Demo" per enviar només 1 correu i no saturar Mailpit).
  `./vendor/bin/sail artisan jornada:enviar`

* **Executar Tests Automatitzats:**
  Per verificar que la lògica de negoci (creació d'equips, validacions, etc.) funciona correctament.
  `./vendor/bin/sail artisan test`

### Solució de Problemes (Cache)
Si la classificació no s'ordena correctament o els canvis a les rutes no s'apliquen, neteja la memòria cau amb:
`./vendor/bin/sail artisan optimize:clear`

---

## ⚙️ Detalls Tècnics de la Implementació

### 1. Seguretat i Autorització
* **Middleware:** S'utilitza `role:admin,manager,arbitre` al fitxer `web.php` per protegir grups de rutes sencers.
* **Policies & Gates:**
    * **`PartitPolicy`:** Verifica si `$user->id === $partit->arbitre_id`. Això permet que un àrbitre només vega el botó "Editar" en **els seus** partits.
    * **`EquipPolicy`:** Verifica si `$user->team_id === $equip->id`. Això permet que un mànager només puga editar les dades del seu propi club.

### 2. Lògica de Negoci (Models)
Seguint les bones pràctiques MVC, la lògica complexa no està a les Vistes, sinó al Model (`Equip.php`):

* **`getPuntsAttribute()`:** Recorre automàticament tots els partits jugats (com a local i visitant), suma 3 punts per victòria i 1 per empat, i retorna el total. Això permet ordenar la taula fàcilment al controlador.
* **`getRachaAttribute()`:** Analitza els últims 5 partits per data. Desglossa el resultat ("2-1") i retorna un array `['G', 'P', 'E', 'G', 'P']` que la vista transforma en cercles de colors.
* **`getEdatMitjanaAttribute()`:** Calcula l'edat exacta de cada jugadora basant-se en la seua data de naixement i retorna la mitjana de l'equip amb un decimal.

### 3. Funcionalitats Extra
* **PDF:** S'ha utilitzat la llibreria `dompdf` per generar l'acta del partit, dissenyada amb una vista Blade específica (`partits.acta`).
* **Form Requests:** Totes les validacions d'entrada (Crear Jugadora, Actualitzar Partit) es fan en fitxers separats (`StorePartitRequest`, etc.) amb missatges d'error personalitzats en català.
* **Internacionalització:** Selector d'idioma funcional a la barra de navegació que canvia l'idioma de tota la interfície (Valencià / Castellà / Anglès) utilitzant sessions.
