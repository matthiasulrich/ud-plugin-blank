# UD Plugin Blank

Minimalistisches Starter-Plugin für Gutenberg-Blockentwicklung mit WordPress.  
Ziel: **klare Trennung von Build-Assets, PHP-Logik und Block-Konfiguration** – ohne Ballast, aber vollständig funktionsfähig.


<pre> ```mermaid flowchart TD A[package.json<br>Herzstück der JavaScript-Toolchain<br>Steuert Build-Prozess] B[webpack.config.js<br>Herzstück Asset-Building<br>Verarbeitet Code & Styles] C[block.json<br>Block-Beschreibung für WordPress<br>Definiert Name, Verhalten, Assets] D[ud-plugin-blank.php<br>Plugin-Initialisierung<br>Registriert Block & lädt PHP-Logik] A --> B --> C --> D ``` </pre>


## 🧱 Zusammenspiel: Build-System & Plugin-Core
<pre> ``` +---------------------------------------------+ | package.json | | Herzstück der JavaScript-Toolchain | | Steuert den gesamten Build-Prozess | +---------------------------------------------+ | v +---------------------------------------------+ | webpack.config.js | | Herzstück des Asset-Buildings | | Definiert, wie Code und Styles | | zu finalen Dateien verarbeitet werden | +---------------------------------------------+ | v +---------------------------------------------+ | block.json | | Block-Beschreibung für WordPress | | Definiert Name, Verhalten, Assets, etc. | | Bindeglied zwischen JS, CSS und PHP | +---------------------------------------------+ | v +---------------------------------------------+ | ud-plugin-blank.php | | Plugin-Initialisierung | | Einstiegspunkt für WordPress | | - Registriert Block via block.json | | - Lädt PHP-Logik (render.php, enqueue.php) | +---------------------------------------------+ ``` </pre>
+--------------------------------------------+
| package.json                               |
| Herzstück der JavaScript-Toolchain         |
| - steuert den gesamten Build-Prozess       |
+--------------------------------------------+
              |
              v
+--------------------------------------------+
| webpack.config.js                          |
| Herzstück des Asset-Buildings              |
| - definiert, wie Code & Styles zu          |
|   finalen Dateien verarbeitet werden       |
+--------------------------------------------+
              |
              v
+--------------------------------------------+
| block.json                                 |
| Block-Beschreibung für WordPress           |
| - definiert Name, Verhalten, Assets, etc.  |
| - Bindeglied zwischen JS, CSS und PHP      |
+--------------------------------------------+
              |
              v
+--------------------------------------------+
| ud-plugin-blank.php                        |
| Plugin-Initialisierung                     |
| Einstiegsdatei für WordPress               |
| - registriert Block via block.json         |
| - lädt PHP-Logik (render.php, enqueue.php) |
+--------------------------------------------+



### 1. `package.json`
Definiert Metadaten, Abhängigkeiten und Scripts für den Build-Prozess:

```json
"scripts": {
  "build": "webpack --config webpack.config.js",
  "start": "webpack --watch --config webpack.config.js"
}
Steuert den Webpack-Workflow
Nutzt @wordpress/scripts zur Unterstützung von Gutenberg-spezifischem JS
2. webpack.config.js
Konfiguriert den Build für Editor- und Frontend-Dateien aus src/:

Kompiliert:
src/js/editor.js → build/editor.js
src/js/frontend.js → build/frontend.js
src/css/editor.scss → build/editor.css
src/css/frontend.scss → build/frontend.css
Diese Ausgabepfade müssen exakt mit den Pfaden in block.json übereinstimmen.
3. block.json
Bindeglied zwischen WordPress und Build-Output – referenziert exakt die von Webpack erzeugten Dateien:

"editorScript": "file:./build/editor.js",
"editorStyle": "file:./build/editor.css",
"style": "file:./build/frontend.css"
Wird von WordPress eingelesen (über register_block_type)
Definiert Block-Name, Kategorie, Icon, Attribute usw.
4. ud-plugin-blank.php
Der Einstiegspunkt für WordPress:

Lädt includes/block.php, welches register_block_type aufruft
Dadurch wird block.json automatisch geparst
WordPress registriert Block und lädt:
die JS/CSS-Bundles (aus build/)
optional den Render-Callback (aus render.php)
Ohne dieses PHP-File wird das Plugin nicht initialisiert.

## ⚙️ Architekturüberblick

Dieses Plugin besteht aus **drei funktional getrennten Ebenen**:

1. **Block-Definition (`block.json`)**
2. **Frontend-/Editor-Code (`src/`)**
3. **PHP-Logik (`includes/`, `ud-plugin-blank.php`)**

---

## 🔄 Zusammenspiel der Komponenten

```text
WordPress -> registriert Plugin (ud-plugin-blank.php)
             └── registriert Block (includes/block.php)
                  └── liest block.json
                  └── registriert Render-Callback (includes/render.php)

Editor/Frontend -> lädt Assets (via includes/enqueue.php)
                  └── Styles/JS aus /build (kompiliert aus /src via Webpack)

REST/Interaktiv -> optionale API-Endpunkte (includes/api.php)
```


## 📦 Projektstruktur
ud-plugin-blank/
├── assets/ # Statische Assets wie Fonts, Icons und Bilder
├── includes/ # PHP-Funktionen: API, Enqueueing, Helpers, Rendering
├── src/ # Quellcode (JS, SCSS) für Gutenberg-Editor & Frontend
├── build/ # Build-Ausgabe durch Webpack
├── ud-plugin-blank.php # Haupt-Plugin-Datei (Entry-Point für WordPress)
├── block.json # Gutenberg-Blockdefinition
├── webpack.config.js # Webpack-Konfiguration
├── package.json # Projekt-Metadaten und Scripts


## 🚀 Schnellstart

### Voraussetzungen

- Node.js (>= 14.x)
- WordPress-Installation (lokal oder remote)

### Installation

```bash
npm install```

#### Entwicklung starten
```npm run start```

#### Für Produktion bauen
```npm run build```



### package.json

Diese Datei gehört zum Entwicklungs-Setup und definiert:
- Name, Version, Lizenz
- Build-Skripte (npm run build)
- Abhängigkeiten für WordPress- und Webpack-Module

Wird von WordPress selbst nicht verwendet


/**
 * Utility-Funktionen für das Plugin.
 *
 * In diesem Verzeichnis liegen kleine Hilfsfunktionen,
 * die mehrfach im Editor- oder Frontend-Code verwendet werden können.
 *
 * Beispiel: Formatierungen, DOM-Helfer, Filterlogik etc.
 */