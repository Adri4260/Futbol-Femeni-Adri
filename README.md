# 📄 README.md: Projecte Futbol Femení (Part 3)
## Autor: Adrián Becerra Pérez
---

# Projecte Futbol Femení

## Descripció
Aquest projecte és una aplicació web completa construïda amb **Laravel 12** i **PHP 8.4** per a la gestió d'un club o lliga de futbol femení.

Aquesta entrega final (**Part 3**) integra funcionalitats avançades sobre la base anterior, incloent-hi **autenticació amb rols** (Admin/Manager), **API REST**, **generació de PDF** (actes), **enviaments de correu**, interfícies dinàmiques amb **Livewire** i un entorn optimitzat per a **producció**.

---

## 🔑 Credencials d'Accés (Informació per al Tutor)

Per accedir a l'aplicació i provar els diferents nivells de permisos, s'han generat els següents usuaris mitjançant els *Seeders*.

| Rol | Email (Usuari) | Contrasenya | Permisos Principals |
| :--- | :--- | :--- | :--- |
| **Administrador** | `admin@futbolfemeni.com` | `password` | Accés total. Pot crear, editar i eliminar Equips, Jugadores, Estadis i Partits. |
| **Manager** | `manager@futbolfemeni.com` | `password` | Gestió d'Equips i Jugadores. Rep correus de la jornada. No pot gestionar Estadis/Partits. |
| **Usuari Normal** | (Registre nou) | (A triar) | Només lectura. Pot veure les dades però no modificar res. |

> **Nota:** Si la base de dades es regenera (`migrate:fresh --seed`), aquests usuaris es tornaran a crear amb aquesta contrasenya per defecte.

---

## 🚀 Noves Funcionalitats (Part 3)

### 1. Seguretat i Rols
* **Autenticació:** Sistema complet de Login/Registre utilitzant **Laravel Breeze**.
* **Gestió de Rols:** Implementació de Middleware (`role:admin,manager`) per protegir rutes crítiques.
* **Policies:** Ocultació de botons (Editar/Eliminar) a la interfície segons el rol de l'usuari connectat.

### 2. Funcionalitats Avançades
* **Generació de PDF:** Descàrrega de l'acta oficial del partit des del llistat de partits (`/partits`), incloent-hi resultat i alineacions.
* **Enviaments de Correu:** Sistema automàtic per notificar als mànagers sobre els partits de la pròxima jornada.
    * Comanda manual: `php artisan jornada:enviar`
* **Interactivitat (Livewire):** Nova secció "Històric" amb filtres en temps real per equip i data sense recarregar la pàgina.
* **Internacionalització:** Suport per a **Valencià/Català (CA)** i **Castellà (ES)**, canviant des de la barra de navegació.

### 3. API REST
S'ha creat una API pública per permetre la consulta de dades des d'aplicacions externes.
* **Llistat d'equips:** `GET /api/equips`
* **Detall d'un equip:** `GET /api/equips/{id}`
* Respostes en format JSON netejades mitjançant *API Resources*.

---

## 📦 Desplegament i Execució (Molt Important)

Per a aquesta entrega, s'ha configurat el projecte per a simular un entorn de **Producció** real. Això millora el rendiment i la seguretat, però requereix passos específics perquè els estils (CSS) es carreguen correctament.

### Passos per a executar el projecte:

1.  **Iniciar els contenidors (Docker/Sail):**
    ```bash
    ./vendor/bin/sail up -d
    ```

2.  **Instal·lar dependències (si és la primera vegada):**
    ```bash
    ./vendor/bin/sail composer install
    ./vendor/bin/sail npm install
    ```

3.  **Configurar la Base de Dades i Usuaris:**
    ```bash
    ./vendor/bin/sail artisan migrate:fresh --seed
    ```

4.  **Compilar els Estils per a Producció:**
    **⚠️ Pas Crític:** Si no s'executa, la web es veurà sense format.
    ```bash
    ./vendor/bin/sail npm run build
    ```

5.  **Optimitzar la Memòria Cau:**
    ```bash
    ./vendor/bin/sail artisan config:cache
    ./vendor/bin/sail artisan view:cache
    ```

6.  **Accés:**
    Obrir el navegador a `http://localhost`.

---

## 🧪 Tests Automatitzats

S'han inclòs proves unitàries i de funcionalitat per garantir la robustesa del codi.
* Ús de base de dades en memòria (SQLite) per a una execució ràpida.
* Tests de serveis (`EquipService`) utilitzant *Mockery* per aïllar la lògica de la base de dades.

Per executar els tests:
```bash
./vendor/bin/sail artisan test
