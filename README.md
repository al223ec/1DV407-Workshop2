1DV407-Workshop2
================

Workshop 2 Design
<h2>För Betyg 3 Krävs</h2>
<p>Designa och implementera ett enkelt medlemsregister med CRUD (Create, Retrieve, Update, Delete) funktionalitet. Implementation samt klass- och interaktionsdiagram skall skapas och presenteras. Interaktionsdiagram skall visa hur modell-vy separation uppnås och hur de olika kraven tillgodoses. Design och implementation skall överensstämma. Spara undan modeller och implementation i din egna portfolio. Fokus ligger inte på användarvänlighet eller snyggt gränssnitt utan att ha en robust väldokumenterad design som klarar förändring och följer GRASP. Jag rekommenderar er att göra något konsolbaserat.</p>
<p>OBS: Det är inte tillåtet att använda något färdigt ramverk för arkitekturen, dock är det tillåtet att använda klassbibliotek, api:er etc.</p>
<p>Följande krav avgränsar uppgiften:</p>
<ol>
<li>Skapa en ny medlem med namn, personnummer och unikt medlemsnummer skall genereras.</li>
<li>Lista alla medlemmar på två sätt:
<ol>
<li>&#8220;kompakt lista&#8221;; med namn, medlemsnummer och antal båtar</li>
<li>&#8220;fullständig lista&#8221;; med namn, personnummer, medlemsnummer och båtar med båtinformation.</li>
</ol>
</li>
<li>Ta bort en medlem</li>
<li>Ändra en medlems uppgifter</li>
<li>Titta på en specifik medlems uppgifter</li>
<li>Registrera en ny båt på en medlem med båttyp (Segelbåt, Motorseglare, Motorbåt, Kajak/Kanot, Övrigt) och längd</li>
<li>Ta bort en båt</li>
<li>Ändra en båt</li>
<li>Persistens (dvs registret skall sparas och laddas t.ex. från en textfil)</li>
<li>Strikt Model-Vy separation (d.v.s. Modellen skall ej innehålla några som helst kopplingar till vyn, eller användargränssnittet, användargränssnittet skall ej utföra domänfunktioner)</li>
<li>God kodkvalité (t.ex. konsekvent kodstandard, ingen kodduplicering)</li>
<li>Objektorienterad Design och Implementation. Detta innefattar men är inte begränsat till:
<ul>
<li>Objekt kopplas samman med associationer inte med text eller sifferbaserade nycklar.</li>
<li>Klasser har hög sammanhängighet (high cohesion) och är inte onödigt stora eller har onödigt mycket ansvar.</li>
<li>Klasser har låg kopplingsgrad (low coupling) och är inte kopplade till onödigt mycket.</li>
<li>Statiska variabler eller operationer används inte.</li>
<li>Det finns inga dolda beroenden.</li>
<li>Information skall vara inkapslad.</li>
<li>Designen är naturlig och man kan se &#8220;domänmodellen&#8221; i designen</li>
</ul>
<li>Enkel felhantering. Applikationen ska inte krascha vid felaktig inmatning men det behövs ingen användarvänlig felhantering.</li>
</ol>
<h3>Följande delar skall finnas i din portfolio och de ska givetvis vara konsekventa med varandra</h3>
<ul>
<li>Enkelt körbar version av applikationen. D.v.s en .exe fil, url till webbsite, etc. Är det inte uppenbart hur applikationen skall köras så bifoga körinstruktioner, länkar till ev. emulatorer etc som kan behövas.</li>
<li>Källkod för hela applikationen och ev. instruktioner för hur den skall kompileras beroenden till api:er etc.</li>
<li>Ett klassdiagram för hela applikationen</li>
<li>Fullständiga sekvensdiagram som täcker in kraven, i detta fall är det nog smidigast att göra ett diagram per krav (kompakt lista, fullständig lista, titta, ta bort, lägg till)</li>
<li>Gör en kort redovisning på workshoptillfället (problematiska/intressanta delar) och lämna in uppgiften INNAN deadline för examination.
</ul>
<p>Tips på verktyg för diagram är yuml.me och websequencediagrams.com som verkar täcka våra behov och är smidiga att arbeta med. Vissa versioner av Visual Studio har också en del verktyg för generering av diagram givet kod vilket kan vara smidigt, samt att man kan skapa UML projekt.</p>
<h2>Requirements for grade 4</h2>
<ul>
<li>Gör det som anges för betyg 3</li>
<li>Utöka design och implementation med följande krav:
<ol>
<li>Enkel autentisering; detta innebär att en användare måste vara &#8220;inloggad&#8221; för att få skapa, ändra och ta bort information (medlemmar och båtar), dock skall &#8220;anonyma användare&#8221; kunna lista, söka (se nedan) och se medlemmars detaljerade information.</li>
<li>Enkelt urval/sökning bland medlemmar. Dvs en delmängd av medlemmarna skall listas t.ex. medlemmar med ett namn som börjar med &#8220;ni&#8221;, medlemmar som är äldre än en viss ålder, medlemmar som är födda en viss månad, har en viss typ av båt, etc. Ett <strong>designmönster skall användas</strong> för att lösa detta problem och det skall vara enkelt att lägga till nya sökkriterier, dvs visa tydligt i designen vad som behöver förändras när ett nytt sökkriterie tillkommer. Implementation av alla ovanstående exempel behövs alltså inte.</li>
</ol>
</li>
<li>Lämna in uppgiften INNAN deadline</li>
</ul>
<h2>För Betyg 5 Krävs</h2>
<ul>
<li>Gör det som anges för betyg 3</li>
<li>Gör det som anges för betyg 4</li>
<li>Utöka design och implementation med följande krav:
<ol>
<li>Datavalidering/felhantering med felmeddelanden till användare. Felhanteringen skall undvika kodduplicering och vara så flexibel som möjligt.</li>
<li>Komplexa urval/sökning bland medlemmar. Modellen skall kunna utföra godtyckligt komplexa urval av typen: alla som är födda en viss månad eller har ett namn som börjar på &#8220;ni&#8221; och är äldre än en viss ålder. Dvs: (månad == Jan || (namn == &#8220;ni*&#8221; &amp;&amp; ålder &gt; 18)). <strong>Ett designmönster skall användas</strong> och det räcker att visa en flexibel och utbyggbar lösning på modell-sidan, dvs. inget användargränssnitt/inmatning från användaren krävs för detta. Det räcker alltså med att du &#8220;hårdkodar&#8221; in några exempel på sökningar</li>
</ol>
</li>
<li>Lämna in uppgiften INNAN deadline</li>
</ul>
testa
