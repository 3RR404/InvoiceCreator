<?php

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

?>

