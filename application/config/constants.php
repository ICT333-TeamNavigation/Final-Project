<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');



//------------------------------------------------------------------------------
// database table name and column name constants
//------------------------------------------------------------------------------
// table names
define('TABLE_MODEL',           'model');
define('TABLE_NODE',            'node');
define('TABLE_LINK',            'link');
define('TABLE_PARAMETER',       'parameter');
define('TABLE_STUDY',           'study');
define('TABLE_STUDY_QUESTION',  'study_question');
define('TABLE_USER_STUDY',      'user_study');
define('TABLE_USER_SCENARIO',   'user_scenario');
define('TABLE_USER_CONFIG',     'user_config');
define('TABLE_USER_STUDY_PARM', 'user_study_parm');
define('TABLE_USER',            'user');

// column names
define('COL_USERNAME',          'username');
define('COL_PASSWORD',          'password');
define('COL_MODEL_ID',          'model_id');
define('COL_STUDY_ID',          'study_id');
define('COL_SCENARIO_ID',       'scenario_id');
define('COL_NODE_ID',           'node_id');
define('COL_PARM_NAME',         'parm_name');
define('COL_QUESTION',          'question');


/* End of file constants.php */
/* Location: ./application/config/constants.php */