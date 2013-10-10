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
define('TABLE_SCENARIO',        'scenario');
define('TABLE_USER_CONFIG',     'user_config');
define('TABLE_STUDY_PARAMETER', 'study_parameter');
define('TABLE_USER',            'user');

// column names
define('COL_USERNAME',          'username');
define('COL_PASSWORD',          'password');
define('COL_MODEL_ID',          'model_id');
define('COL_STUDY_ID',          'study_id');
define('COL_SCENARIO_ID',       'scenario_id');
define('COL_NODE_ID',           'node_id');
define('COL_LINK_NODE_ID',      'link_node_id');
define('COL_PARM_NAME',         'parm_name');
define('COL_QUESTIONS',         'questions');
define('COL_NAME',              'name');
define('COL_DESCRIPTION',       'description');
define('COL_PARMS_JSON',        'parms_json');
define('COL_CREATOR',           'creator');
define('COL_DATE_CREATED',      'date_created');
define('COL_DEFAULT_VALUE',     'default_value');
define('COL_MIN_VALUE',         'min_value');
define('COL_MAX_VALUE',         'max_value');
define('COL_VISIBLE',           'visible');
define('COL_VISIBLE_DEFAULT',   'visible_default');
define('COL_CONTROL_TYPE',      'control_type');


/* End of file constants.php */
/* Location: ./application/config/constants.php */