=== Worthy - VG-Wort Integration für Wordpress ===
Contributors: tiggerswelt
Donate link: https://wp-worthy.de/
Tags: VG-Wort, T.O.M., METIS, Zählmarke, Zählpixel, Geld, VGW, Verwertungsgesellschaft WORT
Requires at least: 3.7
Tested up to: 4.7.3
Stable tag: 1.4.6.1
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Vereinfache die Arbeit mit VG-Wort und verdiene einfacher Geld mit Deinen
Texten als jemals zuvor.

== Description ==
> **Worthy ist die einzige für Wordpress verfügbare Lösung die alle
> Arbeitsschritte vom Importieren und Zuordnen von Zählmarken bis zur finalen
> Meldung an die VG-Wort in Deinem Wordpress-Admin abbildet und massiv
> vereinfacht - sowohl für Autoren- wie auch Verlags-Konten!**

= Zielgruppe =
Worthy richtet sich an Autoren, die ihre Texte online verfassen und
regelmäßig an die VG-Wort melden oder dies in Zukunft planen.

Worthy vereinfacht die Arbeit mit Zählmarken der VG-Wort indem es in der
Grundversion eine Datenbank mit Zählmarken pflegt, diese Wordpress-Beiträgen
zuordnet und so dafür sorgt, dass diese regelkonform im Blog ausgegeben
werden.
Diverse Werkzeuge vereinfachen die Recherche innerhalb der
Wordpress-Beiträge und der Zählmarken.

Abgerundet wird Worthy durch eine Premium-Funktion, die Dein Wordpress
direkt mit der VG-Wort verbindet und wesentliche Funktionen von dort direkt
in Deinem Wordpress abbildet. Zum Beispiel ist **das Melden von Artikeln**
kein Problem mit Worthy Premium, genau wie die Recherche nach Zählmarken in
Abhängigkeit von ihrem Status.

Über Worthy Premium können Meldungen an die VG-Wort vollkommen automatisiert
durchgeführt werden - auch mit Autoren-Konten und auch wenn dies offiziell
von der VG-Wort nicht unterstützt wird. Einfach magisch!

= Funktionsumfang =

* Unterstützt Blogs mit mehreren Autoren und eigenen oder gemeinsam
genutzten Zählmarken (beide Varainten in einem Blog)
* Separate Übersichten mit den Schwerpunkten Zählmarken wie auch Beiträgen
* Themenspezifische Filter- und Sortier-Funktionen
* Bulk-Funktionen für Beiträge zum Zuordnen von Zählmarken oder Ignorieren
für Worthy
* Integration mit Bewertung in Beitragsübersicht von Wordpress
* Integration in Beitragseditor von Wordpress mit Zeichenzählung
* Import von Zählmarken aus CSV-Datei
* Export von Zählmarken in CSV-Datei, auch mit Beitrags-ID und -Überschrift
* Migration von Beiträgen mit eingebetteten Zählmarken
* Migration aus dem Plugin "VG-Wort Krimskrams"
* Migration aus dem Plugin "WP VG-Wort"
* Migration aus dem Plugin "Prosodia VGW"
* Migration aus dem Plugin "Torben Leuschners VG-Wort"
* Migration und Reparatur von Zählmarken die doppelt vergeben wurden
* Vorschau der zu migrierenden Beiträge
* Nachträglicher Import von privaten Zählmarken (nach Migration aus Quellen
mit nur der öffentlichen Zählmarke)
* Schutz vor mehr als eine Zählmarke in der Blog-Ausgabe
* Unterstützt HTTPS-gesicherte Weblogs
* Ignorieren von Beiträgen und Zählmarken (keine Zählmarke für einen Beitrag
ausgeben)

**Worthy Premium**

* Bestellen von Zählmarken aus Wordpress heraus
* Personalisieren und Importieren von beliebig vielen anonymen Zählmarken
(sofern die VG-Wort dieses Feature anbietet, seit 2016 deaktiviert)
* Synchronisation von Zählmarken
* Recherche nach Zählmarken und Beiträgen anhand des Zählmarken-Status
* Anlegen von Webbereichen
* Automatisches Erstellen von Meldungen
* Kostenlose Testphase

= Migration von anderen Plugins =
Solltest Du von einem anderen Plugin zu Worthy wechseln wollen oder bisher
Zählmarken direkt in den HTML-Code Deiner Beiträge integriert haben, so
bietet Worthy Dir ein komfortabel zu bedienendes Migrations-Tool. Aktuell
werden folgende Migrationspfade unterstützt:

* Im HTML-Code eingebettete Zählmarken
* Zählmarken aus dem Plugin "VGW (VG-Wort Krimskram)"
* Zählmarken aus dem Plugin "WP VG-Wort"
* Zählmarken aus dem Plugin "Prosodia VGW"
* Zählmarken aus dem Plugin "Torben Leuschners' VG-Wort"

Sobald du die Übersicht von Worthy aufrufst, prüft Worthy automatisch auf zu
migrierende Beiträge und weist dich entsprechend darauf hin.

Wenn Du eine andere Einbettung der Zählmarken vorgenommen hast oder ein
anderes, hier nicht gelistetes Tool verwendet hast, sprich unseren Support
an!

Mit dem Migrations-Tool kannst Du entweder alle Beiträge, nur die eines
bestimmten Plugins bzw. eingebettete Zählmarken bequem über eine
Vorschau-Ansicht migrieren.
Wenn Du alle oder alle Beiträge einer bestimmten Methode migrierst, werden
auch die eventuell vorhandenen freien Zählmarken mit migriert, Du musst also
nicht alles nochmal neu importieren. Anders herum kann Worthy die privaten
Zählmarken nicht erraten, sollten diese (z.B. bei eingebetten Zählmarken)
nicht in Wordpress vorhanden sein. Hierzu kannst Du eventuell vorhandene
CSV-Listen noch einmal importieren und so die privaten Zählmarken ergänzen.  
Nutzer von Worthy Premium erhalten etwaige fehlende private Zählmarken auch
über die Synchronisation der Zählmarken. Diese wird nach der Registrierung
für Worthy Premium automatisch ausgeführt.


Worthy ist ein von der VG-Wort unabhängiges Plugin für Wordpress und wird
von der VG-Wort weder unterstützt noch vertrieben.

== Installation ==
Worthy lässt sich wie jedes normale Plugin aus dem Wordpress Plugin
Repository installieren.

Alternativ kannst Du auch von [der Worthy-Webseite](https://wp-worthy.de/)
die neuste Version herunterladen und als ZIP-Datei in Wordpress
installieren:

1. Lade das Plugin als ZIP-Datei von [der Worthy-Webseite](https://wp-worthy.de/)
herunter.
2. Lade die ZIP-Datei in Dein Wordpress hoch indem Du im Menü "`Plugins`" > "`Installieren`"
und anschließend "`Plugin hochladen`" wählst.  
Alternativ kannst Du die ZIP-Datei auch auf Deinem Computer entpacken und
per FTP das Verzeichnis `wp-worthy` in das Plugin-Verzeichnis von Wordpress
(`wp-content/plugins`) kopieren
3. Sobald das Plugin in Deinem Wordpress verfügbar ist, kannst Du es im
Plugin-Bereich des Administrationsbackend aktivieren.
4. Alles weitere geschieht automatisch!

> **Systemanforderungen:**  
> Worthy wird stets auf der aktuellsten Wordpress-Version entwickelt, sollte
> aber mit allen Versionen ab 3.8 funktionieren. So oder so ist es aber
> ratsam stets die aktuellste Wordpress-Version zu verwenden.
> Die Entwicklung findet aktuell mit PHP 7.0 statt, gestestet wird aber auch
> auf PHP 5.6 und 5.4, alles ab PHP 5.3 sollte funktionieren.

== Changelog ==
Worthy befindet sich seit Herbst 2013 in der Entwicklung und wurde von zwei
hauptberuflichen Autoren ausgiebig getestet. Wir sind uns relativ sicher,
dass Worthy äußerst bereit für den Einsatz bei anderen Autoren ist.

Um Worthy noch besser zu machen, freuen wir uns über Dein Feedback. Dieses
Changelog soll den Werdegang von Worthy abbilden, auch wenn aktuell das
meiste bereits "im Verborgenen" geschehen ist.

= 1.4.6.1 =
* Veröffentlicht: 21. März 2017 gegen 14:00
* Kompatibilität mit PHP 5.3 wieder hergestellt

= 1.4.6 =
* Veröffentlicht: 17. März 2017 gegen 00:00
* Ausgabe von Zählmarken in Beiträgen überarbeitet und robuster gemacht
* Vorbereitungen für Multi-Site-Unterstützung (nicht abgeschlossen)
* Kleinere Geschwindigkeitsoptimierungen

= 1.4.5 =
* Veröffentlicht: 16. Januar 2017 gegen 22:00
* In der Beitrags-Übersicht kann nach meldefähigen Artikeln gefiltert werden
* Die Anzahl der meldefähigen Beiträge werden nun im Dashboard wie auch in
der Übersicht angezeigt
* In der Übersicht werden nun ein paar Metriken zu Worthy-Premium angezeigt
* In der Vorschau einer Meldung wurde der Autor nicht mehr angezeigt
* Vorläufiger Workaround für Übersetzungs-Probleme

= 1.4.4 =
* Veröffentlicht: 16. Dezember 2016 gegen 10:00
* In der Übersicht werden Zählmarken ohne privatem Identifikationscode nun
pro Benutzer angezeigt
* Die Übersichtstabellen berücksichtigen den Lyrik-Status von Beiträgen und
zeigen hier nicht mehr unnötig eine Warnung an
* Die Zählung freier Zählmarken berückstichtigt nun auch durchgehend den
Status der Zählmarke bei der VG-Wort (Zählmarken mit Zählerstart werden
keinen neuen Beiträgen zugeordnet)
* Kleinere Fehlerkorrekturen und Stabilitätsverbesserungen

= 1.4.3 =
* Veröffentlicht: 10. August 2016 gegen 17:00
* Worthy sucht auch im Excerpt nach eingebetteten Zählmarken
* Autoren-Konflikte für Beiträge ohne Zählmarke wurden nicht korrekt erkannt
* Fehler bei Import von Verlagszählmarken behoben
* Zeichenzähler im Beitrag-Editor wurde verbessert
* Probleme mit dem Worthy-Shop bei abgelaufenen Test-Konten wurden beseitigt
* Das Werkzeug zum indexieren von Beiträgen findet sich nun im Reiter
"Administration"
* Zählmarken ohne Benutzer-Zuordnung können nun einem bestimmten Benutzer
zugeordnet werden
* Kleinere Bug-Fixes
* Worthy-Premium: VG-Wort bietet aus bisher unbekannten Gründen keine
anonymen Zählmarken mehr an und auch keine Möglichkeit diese zu
personalisieren. Eine Meldung muss hier manuell erfolgen.
* Worthy-Premium: Worthy kann nun selbstständig nach fehlenden privaten
Zählmarken suchen und unvollständige Zählmarken so ergänzen.
* Kompatibilität zu Wordpress 4.6 getestet und für gut befunden

= 1.4.2 =
* Veröffentlicht: 28. Juni 2016 gegen 14:00
* Worthy kann nun mehr Beitragstypen als nur "Posts" und "Pages"
berücksichtigen
* Die Worthy-Spalte der Wordpress-Beitrag-Übersicht wurde überarbeitet
* Die Beitrag-Übersicht weißt nun darauf hin, wenn der jeweilige Beitrag von
einem anderen Autor verfasst wurde, zu dem keine Beziehung innerhalb von
Worthy besteht
* In der Zählmarken-Übersicht werden erst einmal nur noch Zählmarken
angezeigt, die nicht irgendwie ignoriert wurden
* In der Zählmarken-Übersicht wird nun ein Hinweis angezeigt, wenn kein
privater Identifikationscode vorhanden ist. Etwaige Worthy-Premium-Aktionen
werden bei fehlendem Identifikationscode ausgeblendet.
* In beiden Übersicht-Tabellen können Beiträge nun direkt und einzeln
ignoriert werden
* Zusätzlicher Schutz zur Verhinderung doppelter Einbindung von Zählmarken
* Bei längeren Dialogen wird eine zusätzliche Navigation eingeblendet
* Kleinere Bug-Fixes
* Worthy-Premium: Es werden auch Zählmarken ohne Zählerstart synchronisiert
* Worthy-Premium: Für Zählmarken mit zugeordnetem Beitrag aber ohne
Zählerstart kann nun auch ein Webbereich angelegt werden
* Worthy-Premium: In der Aktionsspalte der Zählmarken-Übersicht erscheint
nun ein Hinweis wenn der Titel zu lang ist

= 1.4.1 =
* Veröffentlicht: 07. Juni 2016 gegen 16:00
* Zählpixel von Lazy-Loading ausgenommen für bessere Kompatibilität mit
WP-Rocket und MaxCDN
* Fehlerkorrektur für Filter in der Beitrag-Ansicht
* Fehlerkorrektur beim Neuindezieren aller Beiträge
* Fehlerkorrektur bzgl. Beitrag-Formattierung in seltenen Fällen

= 1.4 =
* Veröffentlicht: 12. April 2016 gegen 01:00
* Unterstützung für Meldungen über Verlagskonten
* Wordpress-Benutzern können Name und Karteinummer zugeordnet werden
* Optionen zum Teilen von Zählmarken verbessert, Benutzer können nun
entscheiden, ob sie das Teilen zulassen möchten. Das Teilen kann nun auch
global vom Administrator deaktiviert werden.
* Zeige immer Benutzernamen in Zählmarkenübersicht an, sofern diese nicht
dem aktuellen Benutzer zugeordnet sind
* Kleinerer Bugfix bei der Auswahl zum Gemeinsamen VG-Wort-Zugang
* Zählmarken mit HTTPS werden bei der Migration berücksichtigt
* Beitrag-Tabelle sortiert automatisch absteigend nach Länge, wenn nach zu
kurzen Beiträgen gefiltert wird und keine Sortierung verwendet wird
* Wordpress 4.5-kompatibilität

= 1.3 =
* Veröffentlicht: 17. Dezember 2015 gegen 13:00
* Worthy behandelt nun den Fall, dass in Wordpress ein Benutzer gelöscht
wird, Zählmarken können mit den normalen Wordpress-Bordmitteln auf andere
Benutzer übertragen oder als gelöscht markiert werden
* Nicht alles was so dargestellt wurde ist ein Autoren-Konflikt
* Getestet mit PHP 7.0
* Getestet mit Wordpress 4.4
* Kleinere Bugfixes bei Filtern und einem SQL-Query

= 1.2 =
* Veröffentlicht: 22. September 2015 gegen 15:00
* Premium: Anonyme Zählmarken können personalisiert und importiert werden
* Ungenutzte Zählmarken können nun exportiert werden um sie an anderer
Stelle zu nutzen
* Java-Script-Erweiterung für Beitrag-Editor wurde verbessert
* Bugfix: Beitragsrevisionen erhalten keinen Zählpixel mehr
* Bugfix: CSS-Fehlerkorrektur für unser SVG-Logo

= 1.1.4 =
* Veröffentlicht: 20. August 2015 gegen 23:30
* Beschriftung in der Toolbar angepasst

= 1.1.3 =
* Veröffentlicht: 20. August 2015 gegen 22:15
* HTML-Code wurde für Wordpress 4.3 angepasst
* Über die Beitrags-Ansicht von Wordress konnten keine Zählmarken zugeordnet
werden
* Ein paar mehr Texte auf Wunsch eines Nutzers hinzugefügt
* Das Plugin-Icon wurde getauscht
* Reiter sind nun auch über ein Untermenü aufrufbar
* Diverse Umstrukturierungen im Quellcode
* Nach Registrierung für Premium wird der Status automatisch erstmalig
synchronisiert
* Für Worthy notwendige Berechtigungen wurden angepasst (waren vorher
vollkommen falsch)
* Worthy weißt aggressiver darauf hin, wenn keine Zählmarken mehr verfügbar
sind
* Untere Aktion-Dropdown funktioniert nun wieder
* Die Ausgabe von Zählmarken kann nun komplett unterbunden werden

= 1.1.2 =
* Veröffentlicht: 20. Juli 2015 gegen 15:30
* CSV-Import funktioniert nun auch für Verlagskonten
* Zählpixel können auch in Blogs verwendet werden die HTTPS nutzen (Danke an
Chrisss für die Recherche)
* Wordpress-Nutzer können "zusammengeschaltet" werden
* Präferenz um automatisch Zählmarken zuzurodnen sobald ein Beitrag die
Mindestlänge erreicht (Feature-Wunsch eines Nutzers)
* Die Länger der Überschrift wird im Editor der Meldungsvorschau angezeigt
(Danke an Chrisss für das gemeinsame Brainstorming)
* Der Worthy Premium Shop gibt nun etwas mehr Informationen zu den
verfügbaren Produkten (Feature-Wunsch eines Nutzers)

= 1.1.1 =
* Veröffentlicht: 15. Juli 2015 gegen 23 Uhr
* Kategorien- und Schlagwörter-Spalten in Beitragsansicht waren defekt
(Danke an -thh für den Report)
* Vorbereitung um einzelne Autoren mit anderen zu verknüpfen

= 1.1 =
* Veröffentlicht: 15. Juli 2015 gegen 22:30
* Das Plugin kann nun mehrere Autoren parallel bedienen
* Beitrag-Tabelle weist auf zu lange Überschriften hin
* Beiträge können in Meldungs-Vorschau bearbeitet werden
* Worthy Premium Zählmarken-Synchronisation nicht unnötig oft
* Beiträge die mehr als ein Zählpixel enthalten werden markiert
* Kleinere Fehlerkorrekturen im Plugin
* Kleinere Anpassungen an der readme.txt

= 1.0 =
* Veröffentlicht: 13. Juli 2015 gegen 23 Uhr
* **Erstes öffentliches Release von Worthy**
* Import und Export von CSV-Listen mit Zählmarken von VG-Wort
* Zählen von relevanten Zeichen im Beitrags-Editor
* Ignorieren von Beiträgen für Worthy
* Zuordnen von Zählmarken zu Beiträgen
* Übersicht über alle Zählmarken in der Worthy Datenbank
* Übersicht aller Beiträge mit und ohne Zählmarken mit Filter-Funktion
* Suche nach öffentlichen und privaten Zählmarken
* Zählmarken-Recherche anhand CSV-Liste aus T.O.M.
* Separater Zeichen-Index für Beiträge
* Migrations-Funktionen für eingebettete Zählmarker und die Plugins
VGW (VG-Wort Krimskram), WP VG-Wort, Prosodia VGW sowie Torben Leuschners'
VG-Wort

* **Premium-Features**
  * Gratis Test-Zugang für 7 Tage mit 3 Meldungen an VG-Wort
  * Bestellen des Abonnements direkt über Worthy
  * Synchronisation von Zählmarken-Status
  * Bestellung von neuen Zählmarken
  * Erstellen von Webbereichen
  * Vorschau für Beitragsmeldung
  * Melden von Texten an die VG-Wort
  * Recherche nach Zählmarken-Status
  * Personalisieren und Importieren von beliebig vielen anonymen Zählmarken
(sofern die VG-Wort dies anbietet, Stand Januar 2016 ist dies nicht mehr der
Fall)

== Screenshots ==

1. Worthy: Übersicht - Auf einen Blick alle Zahlen und Fakten
2. Worthy: Zählmarken-Ansicht - Recherche zu allen Worthy bekannten
Zählmarken. Mit Worthy-Premium wird auch der Status der Zählmarke angezeigt
und der Beitrag lässt sich direkt an die VG-Wort melden.
3. Worthy: Beitrag-Ansicht - Recherche zu allen Beiträgen in Wordpress mit
maßgeschneiderten Filtern und Massenoperationen wie z.B. dem Zuordnen von
Zählmarken. Mit Worthy-Premium lassen sich hier auch Texte für die Meldung
oder Sondermeldung recherchieren und direkt melden.
4. Worthy: Im-/Export - Import und Export von Zählmarken, Berichte zum Melden
ohne Worthy Premium sowie die Migration von anderen Plugins nach Worthy. Mit
Worthy Premium könnten hier auch anonyme Zählmarken personalisiert werden
(sofern von der VG-Wort angeboten)
5. Worthy: Einstellungen - Viel zu Vielfältig für eine kurze
Bild-Beschreibung!
6. Wordpress: Post-Übersicht - Worthy integriert sich nahtlos in die bereits
bekannte Post-Übersicht und zeigt alle relevanten Daten direkt an.
7. Wordpress: Post-Editor - Alle Worthy-Einstellungen kompakt und
übersichtlich. Visuelles Feedback und Benutzer-Präferenzen verhindern, dass
man einmal die Zählmarke vergisst.

== Upgrade Notice ==
= Updates für Worthy =
Updates für Worthy selbst werden immer in einer Form bereitgestellt, die ein
vollautomatisches Upgrade zulassen. Du wirst mit einem Versionssprung also
keine Probleme bekommen.

== Frequently Asked Questions ==
= Warum sollte ich Worthy nutzen, wenn ich bereits ein anderes Plugin für VG-Wort nutze? =
Wir haben sehr viel Arbeit in Worthy gesteckt um es zu einem wunderbaren
Plugin für Wordpress zu machen. Die letzten zwei Jahre haben wir eng mit
Autoren zusammen gearbeitet, ihnen bei der Arbeit zugeschaut, um ihre Arbeit
so einfach wie möglich zu gestalten.

Worthy bietet Dir einmalige Funktionen, die es in anderen Plugins einfach
nicht gibt. Zum Beispiel gibt es mit Worthy Premium ein absolutes
Alleinstellungsmerkmal von Worthy, dass Dich die gesamte Arbeit mit T.O.M.
über Dein Wordpress abwickeln lässt.

Auch die Recherche- und Komfort-Funktionen der freien Worthy-Version sind
recht ausgereift und erlauben Dir auch ohne Premium-Abonnement jede Menge
Zeit und Arbeit zu sparen.

= Welche Daten werden wohin übermittelt? =
Worthy in der kostenlosen Version übermittelt keinerlei Daten an irgendwen,
für Premium ist es indes notwendig, dass hier und da Daten übermittelt
werden. Diese Daten werden im wesentlichen zwischen Deinem Wordpress-Blog,
dem Worthy Premium Webservice und T.O.M. von der VG-Wort ausgetauscht.
Bei der Bestellung von Worthy Premium kommen noch die Zahlungsdienstleister
"Giropay" und "Paypal" zum Zuge. Von "Giropay" wird auch das
Bankleitzahlen-Widget direkt in Wordpress eingebunden - aber nur wenn es
wirklich benötigt wird.

Sämtliche Daten werden natürlich SSL/TLS-verschlüsselt übermittelt, sodass
nach aktuellem Standard keine Unbeteiligten Zugriff auf Deine Daten erhalten
können.

Alle Datails zum Umgang mit Deinen Daten findest Du in der
[Datenschutzerklärung zu Worthy Premium](https://wp-worthy.de/api/privacy.de.html)

= Warum kostet Worthy Premium Geld? =
Zunächst: An diesem Projekt sind Autoren und Software-Entwickler beteiligt.
Wir haben sehr viel Arbeit in Worthy investiert und jede Mühe verdient ihren
Lohn. Du wirst mit Worthy sehr viel einfacher Deine etwaigen Ansprüche auf
einen Anteil vom großen Kuchen der VG-Wort realisieren können und
möglicherweise richtig Geld damit verdienen können. Das sollte Dir einfach
eine Kleinigkeit wert sein. Was vorher Wochen dauerte, kann nun in Minuten
erledigt werden.

Worthy Premium ist keine Maschine, die von alleine läuft. Als
WordPress-Anwender weißt Du, wie oft da Updates kommen. Damit Worthy immer
gleichbleibend zuverlässig und reibungslos funktioniert, müssen wir ständig
daran arbeiten.  
Für die Pflege der Software bringen wir viel Zeit, Liebe und Aufmerksamkeit
auf, die Du durch den geringen Premium-Beitrag honorieren kannst.

Aber wir wollen gar nicht, dass Du sofort Geld für Worthy bezahlst! Wir sind
so von Worthy überzeugt, daß wir Dir einen kostenlosen Zugang zu den
Premium-Funktionen schenken! Zeitlich und mengenmäßig begrenzt hast Du so
die Möglichkeit Worthy Premium absolut kostenlos und ohne jede Verpflichtung
auf Herz und Nieren zu testen. Probiere es einfach aus und dann lasse Dein
Bauchgefühl darüber entscheiden, ob Worth Premium nützlich für Dich ist.

= Ich habe ein Problem mit Worthy =
Das sollte nicht sein! Worthy ist dazu da, um Dir das Leben zu erleichtern
und nicht den Tag zu vermiesen. Trotzdem kann es natürlich mal passieren,
dass etwas nicht so funktioniert, wie es sollte.

Lass es uns einfach im Support-Forum wissen, wir versuchen uns so schnell
wie möglich darum zu kümmern.

= Ich vermisse eine Funktion XY in Worthy =
Super, sag uns einfach Bescheid, wir schauen, was wir tun können!

Wir freuen uns über Deinen Beitrag im Support-Forum.
