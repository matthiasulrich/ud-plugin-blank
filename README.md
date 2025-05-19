# UD Plugin Blank

Minimalistisches Starter-Plugin für Gutenberg-Blockentwicklung mit WordPress.  
Ziel: **klare Trennung von Build-Assets, PHP-Logik und Block-Konfiguration** – ohne Ballast, aber vollständig funktionsfähig.


## 🧱 Zusammenspiel: Build-System & Plugin-Core
<pre> 
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
</pre>



# Technische Kernpunkte

## package.json
Muss in den scripts-Einträgen (build, start) explizit auf webpack.config.js verweisen:
<pre>
"scripts": {
  "build": "webpack --config webpack.config.js",
  "start": "webpack --watch --config webpack.config.js"
}
</pre>

## webpack.config.js
<strong>Funktioniert nur, wenn Webpack (z. B. über `@wordpress/scripts`) in der `package.json` installiert ist.</strong>

* In `entry` stehen **auch `.scss`-Dateien** – das ist normal.
* Sie werden **trotzdem zu `.css` kompiliert**, nicht zu `.js`.

* Beispiel:
```js
  entry: {
    editor: "src/js/editor.js",
    "editor-style": "src/css/editor.scss"
  }
```

* Im Output entstehen:

  * `build/editor.js`
  * `build/editor-style.css`


## block.json
Muss exakt dieselben Pfade zu JS/CSS referenzieren, die Webpack erzeugt (build/editor.js, etc.).

Beispiel:
```js
    "editorStyle": "file:./build/editor.css",
    "style": "file:./build/frontend.css",
    "editorScript": "file:./build/editor.js",
    "script": "file:./build/frontend.js",
```

## ud-plugin-blank.php
Diese Datei ist der Einstiegspunkt des Plugins und wird von WordPress geladen.  
Sie selbst registriert keinen Block, sondern lädt alle Dateien im `includes/`-Ordner.
