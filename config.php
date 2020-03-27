<?php
require 'environment.php';

global $config;
global $db;

$config = array();
if(ENVIRONMENT == 'development') {
	define("BASE_URL", "http://localhost/loja/");
	$config['dbname'] = 'force_bulls';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
} else {
	define("BASE_URL", "http://localhost/loja/");
	$config['dbname'] = 'force_bulls';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
}

$config['default_lang'] = 'pt-br';
$config['cep_origin'] = '87595000';

$config['pagseguro_seller'] = 'evandro_aurelio12@hotmail.com';

// Informações do MercadoPago
$config['mp_appid'] = '4669392126020833';
$config['mp_key'] = 'TqOaf8auhvmcR1ICT14DRPo0Q4Y93P7i';

//Informações do PayPal
$config['paypal_clientid'] = 'AdLJZ8jlHf_hg86WwuWX--JqjkmHFLnDs6RDIAQirNDN7loP84M6_1eHZdw2C5xTItfx33vCPKXCgeWD';
$config['paypal_secret'] = 'EMWVCjuCHIViuiLscBptKMhbrohdv2LQCbpjPpRZa6ecq9TyMce6RHJg6_ep7F3t5hP-M8GEHgngpwwt';

//Informações do Gerencianet
$config['gerencianet_clientid'] = 'Client_Id_daea5c8355e93949ec45c8b1dddac049762f8dd7';
$config['gerencianet_secret'] = 'Client_Secret_a6484ac7bf2e8cba1ff2d31efaba6893575eebc7';
$config['gerencianet_sandbox'] = true;

$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

\PagSeguro\Library::initialize();
\PagSeguro\Library::cmsVersion()->setName("ForceBulls")->setRelease("1.0.0");
\PagSeguro\Library::moduleVersion()->setName("ForceBulls")->setRelease("1.0.0");

\PagSeguro\Configuration\Configure::setEnvironment('sandbox');
\PagSeguro\Configuration\Configure::setAccountCredentials('evandro_aurelio12@hotmail.com', '8B33E4BD190C453FB5C2736EF4B52A8B');
\PagSeguro\Configuration\Configure::setCharset('UTF-8');
\PagSeguro\Configuration\Configure::setLog(true, 'pagseguro.log');
?>