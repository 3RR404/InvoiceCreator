<?php 

namespace InvoiceCreator;

require_once 'vendor/autoload.php';

use Exception;
use Latte;

class InvoiceInstruments
{
    public $invoice_number;
    public $company_data;

    function __construct()
    {
        if( !isset( $this->invoice_number ) )
        {
            $this->defaultNumber();
        }

        try{
            $this->getConfig();
        } catch ( Exception $e )
        {
            echo $e->getMessage();
            exit;
        }
    }

    function __get( $name )
    {
        if( isset( $this->{$name} ) && self::isPublic( $this->{$name} ) ) return $this->{$name};
    }

    function __set( $name, $value )
    {
        $this->{$name} = $value;
    }

    function __call( $method, $params )
    {
        if( \method_exists( 'InvoiceCreator\\Invoice', $method ) )
        {
            $class = new Invoice;
            return $class->{$method}( implode( ',', $params ) );
        }
    }

    function getConfig( $config = 'config' )
    {
        if( !isset( $this->company_data ) )
        {
            $file = __DIR__ . '/' . $config . '.json';
            if( \file_exists( $file ) )
            {
                $company_json_data = \json_decode( \file_get_contents( $file ) );
                $this->company_data = $company_json_data->company;
            } else throw new Exception('File config is necesery! Please, create that.', 500);
        }
            
    }

    public function defaultNumber()
    {
        $this->invoice_number = date('Y') . '1001';
    }

}

class InvoiceTemplate
{
    protected $template;
    protected $params;
    protected $file;
    protected $instruments;

    public $template_code;
    public $template_currency;

    function __construct( string $template_code = '', string $template_currency = '' )
    {
        if( isset( $template_code ) ) $this->template_code = $template_code;
        if( isset( $template_currency ) ) $this->template_currency = $template_currency;
    }

    // function __set( $name, $value )
    // {
    //     $instruments = new InvoiceInstruments;
    //     $instruments->{$name} = $value;
    // }

    protected function template()
    {
        $this->file = __DIR__ . '/templates/invoice_' . $this->template_code . '_' . $this->template_currency . '.latte';
        $latte = new Latte\Engine;
        $this->params = ['invoice' => new InvoiceInstruments];
        $this->template = $latte;
    }
    
    public function getTemplate()
    {
        $this->template();
        return $this->template->renderToString( $this->file, $this->params );
    }

    public function print_template()
    {
        $this->template();
        return $this->template->render( $this->file, $this->params );
    }
}

final class Invoice
{

    function __construct()
    {

    }

    function total(){
        echo '0.00';
    }
    
}