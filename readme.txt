=== CustomPress ===
Contributors: DerN3rd (PSOURCE)
Tags: widget, custom,post, wordpress, classicpress
Requires at least: 4.9
Tested up to: 4.9
Stable tag: 1.4.3
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

CustomPress - Benutzerdefinierter Post-, Taxonomie- und Feldmanager.

== Description ==

CustomPress ist das ultimative Plugin, um ClassicPress von einer Blogging-Plattform in ein vollständiges Content-Management-System umzuwandeln.
Bringe ClassicPress mit PSource CustomPress auf die nächste Stufe. Verwalte mehr Inhalte effizienter mit benutzerdefinierten Beitragstypen.

Erstelle benutzerdefinierte Beitragstypen für ein wirklich benutzerdefiniertes CMS.
Macht, Organisation und Kontrolle
Erstelle und sortiere Inhalte in benutzerdefinierten Beitragstypen für alles, von Filmen über Bücher, Immobilienanzeigen bis hin zum Entwerfen von Galerien. 
Füge Kontrolle und Flexibilität für Content Management und Designkonsistenz hinzu.

[POWERED BY PSOURCE](https://github.com/cp-psource)

[Projektseite](https://cp-psource.github.io/custompress/)
[GitHub](hhttps://github.com/piestingtal-source/custompress)

== GUIDE ==

= Zur Installation: =

1. Lade die Plugin-Datei herunter
2. Entpacke die Datei in einen Ordner auf Deiner Festplatte
3. Lade den Ordner „custompress“ in das Verzeichnis „/wp-content/plugins/“ hoch.

= Zur Aktivierung: =

1. Melde Dich bei Deinem Admin-Panel für ClassicPress oder Multisite an und aktiviere das Plugin:

2. Bei regulären ClassicPress-Installationen – besuche Plugins und aktiviere das Plugin.
3. Für ClassicPress-Multisite-Installationen – besuche Netzwerkadministrator -> Plugins und Netzwerk. Aktiviere das Plugin.

= CustomPress und Multisite: =

Durch die Netzwerkaktivierung von CustomPress erhält jede Webseite die Möglichkeit, auf benutzerdefinierte Beitragstypen zuzugreifen. 
Du kannst dies auf eine der folgenden Arten einrichten:

= 1. Netzwerkweite Beitragstypen. =

In diesem Szenario teilen alle Webseiten im Netzwerk einen bestimmten benutzerdefinierten Beitragstyp. 
Wenn Du beispielsweise ein Buchrezensionsnetzwerk betreiben, müssen alle Webseiten Zugriff auf Deinen Beitragstyp „Bücher“ haben. 
So funktioniert CustomPress standardmäßig. Gehe nach der Netzwerkaktivierung einfach zu Netzwerkadministrator->CustomPress->Einstellungen und stelle sicher, dass das Kontrollkästchen neben „Unterwebsite-Inhaltstypen aktivieren“ deaktiviert ist. 
Stelle außerdem sicher, dass das Optionsfeld neben „Netzwerkweite Inhaltstypen auf Unterseiten beibehalten“ aktiviert ist.

= 2. Webseite-für-Webseite-Beitragstypen =

In diesem Szenario kann jede einzelne Webseite in Deinem Netzwerk ihre eigenen benutzerdefinierten Beitragstypen erstellen und verwalten. 
Eine Webseite kann Beitragstypen für Bücher haben, die nächste kann Beitragstypen für Autos haben. 
Gehe dazu nach der Netzwerkaktivierung einfach zu Netzwerkadministrator->CustomPress->Einstellungen und aktiviere das Kontrollkästchen neben „Unterwebseiten-Inhaltstypen aktivieren“. 
Markiere dann das Optionsfeld neben „Netzwerkweite Inhaltstypen von Unterseiten entfernen“.

=  3. Sowohl Netzwerk- als auch Webseite-für-Webseite-Beitragstypen =

Wenn Du schließlich allen Webseiten einen bestimmten Beitragstyp zur Verfügung stellen UND ihnen erlauben möchtest, ihre eigenen zu erstellen, gehe zu „Netzwerkadministrator“ -> „CustomPress“ -> „Einstellungen“ und aktiviere das Kontrollkästchen neben „Unterwebsite-Inhaltstypen aktivieren“. 
Markiere dann das Optionsfeld neben „Netzwerkweite Inhaltstypen auf Unterseiten beibehalten“.

= Andere häufige Fragen: =

= Aber was ist, wenn ich CustomPress nur auf bestimmten Webseiten aktivieren möchte? =

Der einfachste Weg, dies zu tun, besteht darin, sich einfach über FTP bei Deiner Webseite anzumelden und zu wp-content/plugins/custompress/loader.php zu gehen. 
Öffne einfach diese Datei in Deinem bevorzugten Code- oder Texteditor und löschen Sie Zeile 12 – die einfach „Network: true“ enthält
Diese Funktion wird noch getestet und ist daher derzeit standardmäßig auf die Netzwerkaktivierung beschränkt.

= Was ist, wenn ich dieses Plugin nur für Premium-Benutzer mit dem Supporter-Plugin zulassen möchte? =

Du kannst dieselbe oben beschriebene Methode verwenden, um den Abschnitt „Netzwerk: true“ zu löschen und das Plugin dann als „Nur für Unterstützer“ zu markieren.

= Über benutzerdefinierte Beiträge: =

Benutzerdefinierte Beiträge sind eine einfache Möglichkeit, Informationen zu erstellen, zu bearbeiten und zu speichern, genau wie Blog-Beiträge, jedoch mit viel mehr kreativer Kontrolle. 
Sie eignen sich ideal für Situationen, in denen Du Inhalte in verschiedene Kategorien einteilen möchtest.
Beispiele dafür, wo Du einen benutzerdefinierten Beitrag verwenden kannst, sind:

* Filmdatenbank
* Buchdatenbank
* Immobilienangebote
* Designgalerie

Das Erstellen eines benutzerdefinierten Beitrags umfasst vier Schritte:

Schritt 1: Erstelle einen benutzerdefinierten Beitragstyp
Schritt 2: Erstelle Taxonomien
Schritt 3: Erstelle benutzerdefinierten Felder
Schritt 4: Erstelle benutzerdefinierte Vorlage für Deinen benutzerdefinierten Beitragstyp

= So erstellst Du einen benutzerdefinierten Beitragstyp =

Wenn Du mit CustomPress einen benutzerdefinierten Beitragstyp erstellst, ist die Verwaltungsoberfläche dieselbe wie bei Blogbeiträgen und -seiten, außer dass Du auswählst, welche Labels verwendet werden und welche Funktionen enthalten sind.
In diesem Beispiel erstellen wir eine Buchdatenbank, die zum Rezensieren von Büchern verwendet werden kann.

1.  Gehe zu CustomPress -> Inhaltstypen
* Der von Dir erstellte benutzerdefinierte Beitragstyp ist für Deine normalen Webseiten-Benutzer sichtbar.
2. Klicke auf „Beitragstyp hinzufügen“.
3.  Füge Deinen Beitragstyp hinzu. Standardmäßig beginnen Beitragstypen mit einem Großbuchstaben und sind Plural.
* Wähle mit Bedacht aus, denn sobald der Name erstellt wurde, kann er nicht mehr geändert werden
4. Wähle aus, welche Funktionen in Deiner benutzerdefinierten Postverwaltungsoberfläche enthalten sein sollen
5. In den meisten Situationen würdest Du den Kapazitätstyp auf „Post“ belassen.
6.  Füge Deine Labels hinzu – das sind die Namen, die in Deinem benutzerdefinierten Beitragsmenü und Deinen benutzerdefinierten Post-Administratoroberflächen angezeigt werden
7.  Füge eine kurze Beschreibung Deines Beitragstyps hinzu.
8. Wähle aus, wo Dein neues benutzerdefiniertes Beitragsmenü im Dashboard angezeigt werden soll.
9. Füge die URL hinzu, unter der sich Dein Symbol befindet (wenn Du Dein eigenes benutzerdefiniertes Symbol verwenden möchtest).
10. In den meisten Situationen würdest Du die Standardeinstellungen für „Öffentlich“, „Benutzeroberfläche anzeigen“, „Im Navigationsmenü anzeigen“, „Öffentlich abfragbar“, „Von der Suche ausschließen“, „Hierarchisch“, „Umschreiben“, „Abfragevariable“ und „Exportieren“ beibehalten.
11. Klicke unten auf der Seite auf „Beitragstyp hinzufügen“.
12. Dein benutzerdefinierter Beitrag wird nun erstellt und Du solltest die neuen Menüelemente für Deinen benutzerdefinierten Beitrag in Deiner Admin-Oberfläche sehen.

= So erstellst Du Taxonomien =

Taxonomien werden verwendet, um Dinge zu ordnen, zu klassifizieren und zu gruppieren. 
Standardmäßig sind Taxonomien in ClassicPress Tags und Kategorien, die ClassicPress für den Beitrag verwendet. 
Mit benutzerdefinierten Beiträgen kannst Du eigene Taxonomien erstellen.
Der Zweck der benutzerdefinierten Taxonomien besteht darin, Dir die Möglichkeit zu geben, Deine Inhalte so zu organisieren, wie Du es Dir vorstelst.
Für unsere Buchdatenbank werden wir beispielsweise eine Taxonomie für Genre und Autor erstellen.

1.  Gehe zu CustomPress -> Inhaltstypen
2. Klicke auf die Registerkarte „Taxonomien“.
3. Klicke auf Taxonomie hinzufügen
4.  Füge Deine Taxonomie hinzu. Standardmäßig beginnt die Taxonomie normalerweise mit einem Großbuchstaben und ist ein Singular.
* Wähle mit Bedacht aus, denn sobald der Name erstellt wurde, kann er nicht mehr geändert werden
5. Wähle Deinen Beitragstyp aus.
6.  Füge Deine Labels hinzu – das sind die Namen, die in Deinem benutzerdefinierten Beitragsmenü und Deinen benutzerdefinierten Post-Administratoroberflächen angezeigt werden
7. In den meisten Situationen würdest Du die Standardeinstellungen für „Öffentlich“, „Benutzeroberfläche anzeigen“, „Tagcloud anzeigen“, „Im Navigationsmenü anzeigen“, „Hierarchisch“, „Umschreiben“ und „Abfragevariable“ beibehalten.
* Eine wichtige Einstellung ist die Option „Hierarchisch“. 
Wenn Du diesen Wert auf „Wahr“ setzt, funktioniert die Taxonomie wie normale Kategorien. 
Wenn Sie den Wert auf „Falsch“ setzt, funktioniert die Taxonomie wie normale Tags.
8. Klicke unten auf der Seite auf Taxonomie hinzufügen.
9. Deine Taxonomie wird nun erstellt und Du solltest die neuen Menüelemente für Deine Taxonomie in Deiner Admin-Oberfläche sehen.
* Wenn Du Deine neue Taxonomie hinzufügst, wird ein Einbettungscode für Deinen neuen benutzerdefinierten Beitragstyp erstellt.
* Kopiere einfach den Einbettungscode und platziere ihn in Deiner Schleife, um die neue Taxonomie mit Deinem Theme anzuzeigen

= So erstellst Du benutzerdefinierte Felder =

Benutzerdefinierte Felder werden zum Einfügen benutzerdefinierter Benutzereingabefelder verwendet. 
Ihr Ziel ist es, ein Feld zu erstellen, das ausgefüllt werden soll, wenn jemand einen benutzerdefinierten Beitrag schreibt.
Für unsere Buchdatenbank erstellen wir benutzerdefinierte Felder für Jahr und Buchbewertung.

1. Gehe zu CustomPress -> Inhaltstypen
2. Klicke auf die Registerkarte „Benutzerdefinierte Felder“.
3. Klicke auf „Benutzerdefiniertes Feld hinzufügen“.
4. Füge den Feldtitel hinzu
5. Füge den Feldtyp hinzu
6. Wähle einen Beitragstyp aus
7. Klicke auf Benutzerdefiniertes Feld hinzufügen
8. Dein benutzerdefiniertes Feld wird nun erstellt und Du solltest die benutzerdefinierten Felder auf ihrer benutzerdefinierten Post-Administratoroberfläche sehen.
* Wenn Du ein neues benutzerdefiniertes Feld hinzufügst, werden ein Einbettungscode und ein Shortcode für den neuen benutzerdefinierten Beitragstyp erstellt.
* Kopiere einfach den Einbettungscode in Deine Vorlagen und platziere ihn in der Schleife, um das neue benutzerdefinierte Feld mit Deinem Design anzuzeigen
* Verwende den Shortcode in Beiträgen oder Widgets. Beachte, dass der Shortcode auf Multipost-Seiten wie Deiner Blog-Seite oder Archiven nur den letzten Beitrag anzeigt.
* Einbettungscodes und Shortcodes können Metadaten zu Deinem benutzerdefinierten Feld anzeigen. Zum Beispiel
[ct id="_ct_radio_4f64ede7607ee" property="title"] würde den Titel des benutzerdefinierten Feldes anzeigen.
[ct id="_ct_radio_4f64ede7607ee" property="description"] würde die Beschreibung des benutzerdefinierten Feldes anzeigen.
[ct id="_ct_radio_4f64ede7607ee" property="value"] würde den Wert des benutzerdefinierten Feldes anzeigen. Wenn Du die Eigenschaft deaktiviert lässt, zeigt der Code standardmäßig den Wert an.

= So erstellst Du eine benutzerdefinierte Vorlage für Deinen benutzerdefinierten Beitragstyp =

Dieses Plugin bietet die Möglichkeit, eine benutzerdefinierte Vorlage zu erstellen, um Deinen benutzerdefinierten Beitragstyp anzuzeigen. 
Nach der Erstellung kannst Du den Einbettungscode für Deine Taxonomien und Dein benutzerdefiniertes Feld hinzufügen. 
Diese werden im Beitrag angezeigt, wenn Du zur Beitrags-URL gehst.
Der Einfachheit halber verwenden wir in diesem Handbuch den in ClassicPress enthaltenen Theme-Editor, es wird jedoch immer empfohlen, ein geeignetes Code-Bearbeitungsprogramm zu verwenden.

1. Gehe zu CustomPress -> Einstellungen
2. Wähle aus, welche Art von Beiträgen Du auf Deiner Homepage anzeigen möchtest.
3. Wähle den Namen Deines benutzerdefinierten Beitrags aus, für den Du eine Vorlagendatei erstellen möchtest
3. Öffne Dein FTP-Programm und änderedie Berechtigungen für Deinen aktiven Theme-Ordner auf 777.
4. Klicke auf „Änderungen speichern“.
5. Änder die Berechtigungen für Deinen aktiven Theme-Ordner wieder auf 755.
6. Kopiere den Einbettungscode für Deine Taxonomien und Dein benutzerdefiniertes Feld, indem Du zu CustomPress -> Inhaltstypen gehen (klickst auf die Registerkarten „Taxonomien“ und „Benutzerdefinierte Felder“).
7. Gehe zu „Darstellung“ -> „Editor“.
8. Klicke auf Deine neu erstellte benutzerdefinierte Vorlage – in diesem Beispiel ist es single-books.php
9. Platziere Deine Taxonomien und den Einbettungscode für benutzerdefinierte Felder in Deiner Schleife in Deiner neu erstellten benutzerdefinierten Vorlage
10. Klicke auf „Datei aktualisieren“. Wenn Du einen benutzerdefinierten Beitrag veröffentlichen und zur Beitrags-URL gehst, wird nun Deine benutzerdefinierte Beitragsvorlage angezeigt:

= Erfahre mehr über benutzerdefinierte Beiträge: =

Wenn Du ein besseres Verständnis für Folgendes erlangen möchtest:

* Benutzerdefinierte Beitragstypen und ihre Leistungsfähigkeit findest Du in diesem Artikel auf Codex.WordPress.org: http://codex.wordpress.org/Custom_Post_Types
* Benutzerdefinierte Taxonomien und ihre Anwendung findest Du in diesem Artikel auf Codex.WordPress.org: http://codex.wordpress.org/Custom_Taxonomies
* Benutzerdefinierte Felder und ihre Anwendung findest Du in diesem Artikel auf Codex.WordPress.org: http://codex.wordpress.org/Custom_Fields

== ChangeLog ==

= 1.4.4 =

* PhP8 Updates
* jQuery Fixes

= 1.4.3 =

* Updater 1.3
* Textanpassungen

= 1.4.2 =

* Fix: PHP Warning:  Attempt to read property "ID"
* Add: README.md

= 1.4.1 =

* Release 