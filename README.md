# InvoiceCreator
Vytváranie faktúr, vkladanie šablón pre faktúry, export faktúr.

## Description
Finálna verzia je zatiaľ v nedohľadne. Toto je len začiatok.
Plánované možnosti:
- úprava dát vkladaných do faktúry ako "Dodávateľ" (momentálne len v config.json)
- úprava dát vkladaných do FA ako Odberateľ
- pridávanie položiek, cien, hmotnostných jednotiek
- zmena čísla FA
- šablóny pre rôzne meny, rôzne krajiny
- ukladanie faktúr do databázy - správa faktúr
- ukladanie faktúr do csv - správa faktúr
- export FA do PDF

Šablóny faktúr momentálne používajú jednu menu a to EUR, a fá naštýlované podľa zákonov SR. Do budúcna sa plánuje rozšíriť šablóny aj na iné krajiny, či meny.
šablóny sú vytvorené v (https://latte.nette.org "latte")

## Use
```php
require_once('invoice.php');

use InvoiceCreator\Invoice;
use InvoiceCreator\InvoiceTemplate;
use InvoiceCreator\InvoiceInstruments;

$invoice = new Invoice;

// Template settings
$template = new InvoiceTemplate();
$template->template_code = 'sk';
$template->template_currency = 'EUR';
// OR
// $template = new InvoiceTemplate( 'sk', 'EUR' );
// AND render template into doc
$template->print_template();
```