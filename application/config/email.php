<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Email COnfiguration
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.hostinger.com';
$config['smtp_port'] = 465;
$config["smtp_crypto"] = "ssl";

// $config['smtp_port'] = 587;
// $config["smtp_crypto"] = "tls";

$config['smtp_user'] = 'admin@shareget.in';
$config['smtp_pass'] = 'Sharegetin@123';
$config['mailtype'] = 'html';
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;


/* End of file email.php */
/* Location: ./application/config/email.php */