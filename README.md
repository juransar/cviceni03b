# BI-ZNF

## Cvičení 3

Varianta B projektu pro třetí cvičení předmětu BI-ZNF.

1. Naklonujte si a nainstalujte (příkaz "composer install") projekt do vašeho lokálního adresáře.

2. Vytvořte si databázovou strukturu (MySQL) podle přítomného **SQL scriptu** a nastavte přístup k dané databázi v konfiguračním souboru ("app/config/config.local.neon")

3. Doplňte DI (Dependency Injection) do všech presenterů a továrniček pro formuláře

4. V šabloně "default" pro třídu "EmployerPresenter" upravte následující
  * upravte formát ve sloupečku příjmení tak, aby dané příjmení odkazovalo na web www.kdejsme.cz (např. Svoboda bude odkazovat na http://www.kdejsme.cz/prijmeni/Svoboda)
  * upravte formát ve sloupečku jména tak, aby dané jméno odkazovalo na web www.kdejsme.cz (např. Pavel bude odkazovat na http://www.kdejsme.cz/jmeno/Pavel/)
  * upravte formát ve sloupečku Rodné číslo ukazovat vlastní rodné číslo (pozor rodné číslo je nepovinný atribut)  
  

5. V šabloně "default" pro třídu "CompanyPresenter" upravte následující
  * upravte formát ve sloupečku 'Registrace' na český formát datumu (d.m.r - hh:mm:ss)
  * upravte formát ve sloupečku 'Je plátce DPH' na formát ANO-NE
  * Definujte vlastní filtr "phone", který upraví formát českého telefonního čísla +420 123 456 789 (na vstupu je 9 místní řetězec čísel). Pokud vstup není validní, konverze se neprovede a u parametru se objeví !!.
  * upravte formát ve sloupečku 'Telefon' pomocí filtru "phone"
  
6. Doplňte DI (Dependency Injection) do modelu UtilityModelu a doplňte funkcionalitu metody "getBirthDay", která z rodného čísla vrátí datum narození  

7. Definujte vlastní filtr "sex" a "birthday", který z id rodného čísla získá pohlaví resp. datum narození.  Pokud vstup není validní nebo není definován, konverze se neprovede a u parametru se objeví !!.

8. V šabloně „default“ pro třídu „EmployerPresenter“ upravte následující
  * upravte formát ve sloupečku Pohlaví na formát MUŽ, ŽENA, NEDEF
  * upravte formát ve sloupečku datum narození ukazovat datum narození získané z rodného čísla (pozor rodné číslo je nepovinný atribut)

9. (Pokud nestihnete na cvičení) Naformátujte tabulku bez použití tabulky ;->