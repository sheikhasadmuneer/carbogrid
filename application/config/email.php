<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Email
| -------------------------------------------------------------------------
| This file lets you define parameters for sending emails.
| Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/libraries/email.html
|
*/
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'mail.comfortcars.ro';
$config['smtp_port'] = '26';
$config['smtp_user'] = 'support@comfortcars.ro';
$config['smtp_pass'] = 'comf99super';
$config['priority'] = '5';
$config['charset'] = 'utf-8';
$config['crlf'] = "\r\n";
$config['newline'] = "\r\n";
$config['useragent'] = 'ImAttending Mailer';

$config['mailtype'] = 'html';



/* End of file email.php */
/* Location: ./application/config/email.php */