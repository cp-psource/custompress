# CustomPress

CustomPress - Benutzerdefinierter Post-, Taxonomie- und Feldmanager.

## CustomPress ist das ultimative Plugin, um WordPress von einer Blogging-Plattform in ein vollständiges Content-Management-System zu verwandeln.

Bringe ClassicPress mit CustomPress auf die nächste Stufe. Verwalte mehr Inhalte effizienter mit benutzerdefinierten Beitragstypen.

![Erstelle benutzerdefinierte Beitragstypen für ein wirklich benutzerdefiniertes CMS.](https://n3rds.work/wp-content/uploads/2024/01/send-email-735x470-1.jpg)

  Erstelle benutzerdefinierte Beitragstypen für ein wirklich individuelles CMS.

### Macht, Organisation und Kontrolle

Erstelle und sortiere Inhalte in benutzerdefinierten Beitragstypen für alles, von Filmen über Bücher und Immobilienangebote bis hin zu Designgalerien. Füge Kontrolle und Flexibilität für die Inhaltsverwaltung und Designkonsistenz hinzu.

### Erstelle Deine eigenen benutzerdefinierten Felder

Unterscheide Deine neuen Beitragstypen mit benutzerdefinierten Feldern. Füge Textfelder, Optionsfelder, Dropdown-Menüs und Kontrollkästchen hinzu. Weise jedem Feld ein eigenes Design zu und integriere Tools, um die Organisation und Verwaltung besser an Deine Bedürfnisse anzupassen.

![Erstelle wunderschöne Designs rund um benutzerdefinierte Felder und Taxonomien.](https://n3rds.work/wp-content/uploads/2024/01/custom-post-type-735x470.jpg)

  Erstelle wunderschöne Designs rund um benutzerdefinierte Felder und Taxonomien.

### Passt zu jedem Theme

Erstelle benutzerdefinierte Beitragstypen, komplett mit Tags, Kategorien, benutzerdefinierten Feldern und Designelementen – einschließlich Dashboard-Symbolen (wir haben an alles gedacht). Die automatisch generierten Designdateien und die Shortcode-Bibliothek erleichtern die Gestaltung für ein perfektes Design.

## Verwendung

_Wenn Du eine **Multisite** verwendest, beachte bitte: Es gibt ZWEI Möglichkeiten, CustomPress zu verwenden:_ 

_**1\. Netzwerk aktivieren.** Im Menü **Netzwerkadministration>CustomPress>Einstellungen** musst Du die Inhalte der Unterseiten aktivieren. Dort gibt es zwei Kontrollkästchen: Erstens wird das Menü „Inhaltstyp“ auf Unterseiten im Abschnitt „CustomPress“ aktiviert. Mit der zweiten Option können Unterwebseiten alle auf Netzwerkebene definierten benutzerdefinierten Typen verwenden. Wenn das Netzwerk aktiviert ist, kannst Du benutzerdefinierte Typen auf Netzwerkebene definieren und diese werden auf allen Unterwebseiten angezeigt. Wenn diese Option aktiviert ist, kannst Du auch benutzerdefinierte Typen auf der Ebene der Unterwebseite definieren. Diese werden dann auf diese Unterwebseite beschränkt._ 

_**2\. Aktiviere Webseite für Webseite.** Jede Webseite erstellt ihren eigenen Inhalt und dieser ist auf diese Site beschränkt._ Wichtig: Wenn Du die Erstellung von Inhaltstypen auf jeder Unterseite zulassen möchtest, wenn das Plugin nicht netzwerkaktiviert ist, musst Du dies tun. Aktiviere es zunächst im Netzwerk und aktiviere die Inhaltstypen der Unterseiten. Anschließend Netzwerk deaktivieren._

**Beachte Folgendes: Inhalte können nach der Erstellung nicht mehr verschoben werden, sodass Du sie löschen und erneut eingeben musst. In den meisten Fällen solltest Du die Aktivierung wahrscheinlich nicht über das Netzwerk, sondern lokal auf denjenigen aktivieren, die CustomPress benötigen.** 

Bevor Du mit der Erstellung Ihrer Beitragstypen und Inhalte beginnst, solltest Du kurz skizzieren, wie Dein Beitragstyp, Deine Taxonomien und benutzerdefinierten Felder zusammenarbeiten. Dadurch sparst Du später Zeit. CustomPress ist ein ziemlich großes Plugin und verfügt über viele Funktionen. Du solltest es nicht unvorbereitet verwenden. Um mehr über Beitragstypen zu erfahren, [HIER KLICKEN](http://codex.wordpress.org/Post_Types). 

OK, weiter! Im Menü **Netzwerkadministration >Inhaltstypen** erstellst Du Deine Netzwerkinhaltstypen.

![Custompress dash](https://n3rds.work/wp-content/uploads/2024/01/Custompress-dash.png)

 Lasse uns ein benutzerdefiniertes Beitragstyp-Setup für eine neue Webseite erstellen. Diese Seite soll ein Leitfaden für Anfänger im Garten sein. Deshalb werde ich meinem eigenen Rat folgen und eine Liste dessen erstellen, was ich benötige, um dies umfassend zu gestalten.

![Post Type outline](https://n3rds.work/wp-content/uploads/2024/01/game-plan.jpg)

 Nachdem ich nun weiß, was ich tun werde, erstellen wir einen Beitragstyp! Das wichtigste zuerst! Benenne Deinen Beitragstyp und stelle sicher, dass er Dir gefällt. **Es kann nicht geändert werden!** Anschließend wähle die Funktionen aus, die Dein Beitragstyp unterstützen soll. Titel und Herausgeber sind Standardeinstellungen, alles andere liegt bei Dir! _**Bei Multisite-Installationen findest Du das Menü „Inhaltstypen“ im Netzwerkadministrator_

![Add post type 1](https://n3rds.work/wp-content/uploads/2024/01/Add-post-type-1.png)


![Add post type 2](https://n3rds.work/wp-content/uploads/2024/01/Add-post-type-2.png)

Kurzer Überblick über die verbleibenden Einstellungen:

* **Unterstützt reguläre Taxonomien:** bedeutet übersetzt „Möchtest Du die Standard-Tags und -Kategorien für diesen Beitragstyp verwenden?“
* **Funktionstyp:** Sollte die Standardeinstellung beibehalten, es sei denn, Du weist, was Du tust. Wenn Du mehr erfahren möchtest, [HIER KLICKEN](http://codex.wordpress.org/Function_Reference/register_post_type#Parameters).
* **Map-Meta-Funktionen:** Fortgeschrittenere Dinge, die Standardeinstellung ist auch hier gut. Wenn Du mehr darüber erfahren möchtest, [HIER KLICKEN](http://codex.wordpress.org/Function_Reference/get_post_type_capabilities).
* **Beschriftungen:** Welche Formulierung Dein Beitragstyp auf Deiner Webseite verwenden wird. Für jeden gibt es eine Erklärung und einen Standardwert.
* **Beschreibung:** Das hier ist ganz einfach! Eine Zusammenfassung des Beitragstyps (nicht erforderlich)
* **Menüposition:** Wo es im Dashboard-Menü angezeigt wird. Der Standardwert liegt direkt über dem ersten Teiler.
* **Menüsymbol:** Optional. Lade ein 16px _x_ 16px-Bild in Deine Medienbibliothek. Kopiere die URL hier.
* **Spalten für benutzerdefinierte Felder anzeigen:** Dies wird erst angezeigt, wenn Du Deinem Beitragstyp benutzerdefinierte Felder hinzugefügt hast.
* **Öffentlich:** Du kannst wählen, ob der Beitragstyp öffentlich sein soll oder nicht. Wenn Du eine detaillierte Kontrolle über die Sichtbarkeit wünschst, kannst Du die folgenden 4 Parameter festlegen, indem Du _Erweitert_ auswählst.
* **Benutzeroberfläche anzeigen, In Navigationsmenüs anzeigen, Öffentlich abfragbar** und **Von der Suche ausschließen:** sind alle grau und ahmen die Einstellung „Wahr“ oder „Falsch“ in der Menüoption **Öffentlich** nach. Sie können individuell geändert werden, wenn Du im Menü **Öffentlich** die Option _Erweitert_ auswählst.
* **Hierarchisch**: Verwendet Dein Beitragstyp eine Hierarchie? Bei regulären Beitragstypen ist dies nicht der Fall. Wenn Du einen einfachen einzelnen Beitragstyp erstellst, belasse diesen Wert auf „Falsch“.
* **Hat Archiv:** legt fest, ob der Beitragstyp so behandelt wird, als ob er über ein eigenes Archiv verfügt.
* **Umschreiben:** Permalinks können jederzeit umgeschrieben werden.
* **EP-Maske:** Aktiviert Endpunktmasken für Permalinks.
* **Query Var:** ermöglicht die Abfrage Deines Beitrags.
* **Kann exportieren:** Noch eine einfache Möglichkeit. Möchtest Du diese exportieren können?

PHU! Okay, fertig! Es ist nicht so schwer, wie Du dachtest, aber Du bist noch nicht fertig! Ich brauche eine Möglichkeit, meinen Plant-Beitragstyp zu kategorisieren. Ich brauche also eine Taxonomie. Was für eine Taxonomie sagst Du? Nun, ich werde es dir sagen! Ich verwende eine hierarchische Taxonomie (ausgefallener Ausdruck für Kategorie!). Ich benötige keine nicht-hierarchische Taxonomie (ein anderes schickes Wort für Tags), da ich für diesen Beitragstyp die WP-Tags verwende. Erinnere Dich an die Einstellung „**Reguläre Taxonomien unterstützen:**“? Aha! Es macht jetzt doch Sinn, nicht wahr? Also hier bin ich mit meiner Taxonomie [

![Taxonomie 1 hinzufügen](https://n3rds.work/wp-content/uploads/2024/01/Add-Taxonomy-1.png)


![Taxonomie 2 hinzufügen](https://n3rds.work/wp-content/uploads/2024/01/Add-Taxonomy-2.png)

  Die meisten dieser Einstellungen hast Du bereits gesehen. Wählen wir also die aus, die wir noch nicht angesprochen haben. _Sie hängen alle zusammen, sodass Du dieselben Regeln siehst, die Du im Beitragstyp gesehen hast, die jetzt nur auf Deine Taxonomie angewendet werden._ 
  
  **Beitragstyp:** Du musst einen Beitragstyp auswählen, dem Du diese Taxonomie zuweisen möchtest. Ja, Du kannst mehr als eine auswählen. FESTHALTEN! Ich sehe, wie sich diese Räder drehen, bleib einfach bei mir! Wir müssen noch etwas tun, bevor wir mit der Erstellung benutzerdefinierter Beiträge beginnen können. 
  _**Denke daran**, dass die hierarchische Einstellung hier bestimmt, ob sich Deine Taxonomie wie Kategorien oder Tags verhält._ 
  OK, gehe zum letzten Mal die benutzerdefinierten Felder durch. Ich habe tatsächlich einige in meinem Beitragstyp, aber wir müssen uns nur eines ansehen, die Einstellungen sind für alle gleich. Nur die Art und Weise, wie Du sie verwendest, wird sich ändern. [

![Add Custom Field](https://n3rds.work/wp-content/uploads/2024/01/Add-Custom-Field.png)

  Das ganze Einbettungs-Zeug oben ist wichtig, aber wir brauchen es noch nicht, daher ist es in Ordnung, es jetzt zu überspringen. Vergiss es einfach nicht! **Feldtitel:** Hier legst Du Deinen Titel fest und ob es sich um ein Pflichtfeld handelt. Du kannst auch anderen Plugins oder Beiträgen erlauben oder verweigern, dieses Feld zu verwenden. **Feldtyp:** Deine Eingabemethode. Zu den Optionen gehören Text, mehrzeiliger Text, Optionsfelder, Kontrollkästchen, Dropdown-Auswahl, Mehrfachauswahl und Datumsauswahl. Wähle einfach die entsprechenden Optionen oder Parameter aus und füge sie hinzu. Siehst Du, Du bist jetzt ein Profi darin, Du weist bereits, was die letzten beiden Felder bewirken! Schauen wir uns jetzt an, was wir haben! [

![neue Pflanze](https://n3rds.work/wp-content/uploads/2024/01/new-plant.png)

![Typen](https://n3rds.work/wp-content/uploads/2024/01/types.png)

  Der Inhaltsteil ist fertig! Easy Peasy, oder? Jetzt soll es unseren Benutzern auf unserer Webseite angezeigt werden. Im Moment haben wir viele tolle Informationen, die aber noch nicht im Frontend angezeigt werden. Wir müssen es zu unserer Seitenvorlage hinzufügen. Du kannst dies tun, indem Du den Einbettungscode verwenden, der erstellt wird, wenn Du einen neuen Inhaltstyp erstellst. Da die Option „Beitragstyp“ beim Erstellen die standardmäßigen Beitragswerte verwendet, müssen wir nichts Besonderes tun, damit sie angezeigt wird. Hier ist ein Screenshot, wie es jetzt aussieht: [

![Beitrag vor dem Einbetten](https://n3rds.work/wp-content/uploads/2024/01/POST-TYPE-5.jpg)

  Wie Du sehen kannst, werden der Beitragstitel, der Inhalt, die Tags und die standardmäßigen Beitragselemente gut angezeigt, unsere benutzerdefinierten Taxonomien und benutzerdefinierten Felder werden jedoch nicht angezeigt. Wir verwenden die **Einbettungscodes**, die bei der Erstellung unserer benutzerdefinierten Inhalte erstellt wurden, damit diese auf der Beitragsseite angezeigt werden. Du findest die Einbettungscodes, indem Du mit der Maus über das Element fährst, das Du zur Seitenvorlage hinzufügen möchtest, und auf **Einbettungscode** klickst. Du findest dies sowohl in Taxonomien als auch in benutzerdefinierten Feldern sowie einige zusätzliche Informationen zur Verwendung dieser Codes auf der Registerkarte „Benutzerdefinierte Felder“.

![1\. Einbettungscode 2\. Shortcode](https://n3rds.work/wp-content/uploads/2024/01/codes1.png)

  1\. Code einbetten
 
  2\. Shortcode

  **Du kannst diese Einbettungscodes auf zwei Arten verwenden:**

1. Gib einfach den auf einer beliebigen Seite oder einem Beitrag erstellten Shortcode direkt im WordPress-Editor ein oder

2. Du kannst den PHP-Einbettungscode in die Seitenvorlage einbetten, sodass Du den Shortcode nicht manuell zu jedem Beitrag hinzufügen musst. Befolge dazu die folgenden Anweisungen:

Zuerst musst Du die Seitenvorlage finden, in die Du diese einbetten möchtest. Du kannst Deine eigene Datei von Grund auf erstellen oder Deine vorhandene single.php kopieren und das Format „single-[post_type].php“ verwenden. Dies geht ganz einfach, indem Du über FTP eine Verbindung zu Deiner Webseite herstellst und Deine single.php-Vorlage für das aktive Design in einem Notepad-Editor öffnest und „Speicherst unter“ den neuen Dateinamen. Dann legst Du es einfach per FTP zurück in Deinen Theme-Ordner. Es gibt einen integrierten Vorlagenersteller, der das tut, was ich gerade oben beschrieben habe. Du findest ihn im Menü **CustomPress>Einstellungen**. Es macht nur das, was ich oben beschrieben habe, es werden Deine benutzerdefinierten Taxonomien oder Felder **NICHT** eingebettet. Am besten erstellst Du die Vorlage selbst, wenn Du damit vertraut bist.

![Seitenvorlage](https://n3rds.work/wp-content/uploads/2024/01/POST-TYPE-6.jpg)

  Jetzt betten wir einfach die PHP-Codes irgendwo [in The Loop] in unsere neue Seitenvorlage ein (http://codex.wordpress.org/The_Loop#Using_The_Loop).

_Mit benutzerdefinierten Feldern hast Du die Möglichkeit, Deine Artikel alle mit einem Shortcode anzuzeigen. Dies erspart Dir die verschiedenen Gesamtheiten, die Du für jeden Shortocode erstellen musst, um die Bezeichnung und den Wert jeweils einzeln anzuzeigen._


![block](https://n3rds.work/wp-content/uploads/2024/01/block.png)

  Hier ist es in meiner Vorlage: [

![1\. Die Schleife 2\. Der Shortcode](https://n3rds.work/wp-content/uploads/2024/01/codes21.png)

  1\. Die Schleife
 
  2\. Der Shortcode

  Speichere die Änderungen und lade sie per FTP hoch. Mal sehen, wie es auf der Webseite aussieht!

![Shortcode auf der Webseite](https://n3rds.work/wp-content/uploads/2024/01/custompress-shortcode-site.jpg)

  Nicht so schlecht! Ein paar CSS-Änderungen und wir sehen gut aus! :) CustomPress bietet auch ein paar zusätzliche Shortcodes. Du kannst diese auf der Registerkarte **Shortcodes** im CustomPress-Menü sehen (was? zu offensichtlich?). Sie gibt Dir eine etwas erweiterte Kontrolle über die benutzerdefinierte Feldeingabe und die benutzerdefinierten Feldfilter und benutzerdefinierte Feldblöcke. Und das ist es! Nicht so schlimm, oder?!