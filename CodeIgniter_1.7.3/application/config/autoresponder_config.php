<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Autoresponder class config
|--------------------------------------------------------------------------
*/

// used for development to switch autoresponder emails ON or OFF
$config['autoresponders_enable'] = TRUE;
$config['bcc_notification_email'] = NOTIFICATION_EMAIL;

$config['autoresponders_from_email'] = "info@${_SERVER['HTTP_HOST']}";
$config['autoresponders_from_name'] = "Example website";

/* End of file database_tables.php */
/* Location: ./application/config/database_tables.php */