<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'ben_pc';
$active_record = TRUE;


// database config settings for ceto
$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'team05';
$db['default']['password'] = 'Hcmnws5434';
$db['default']['database'] = 'team05';
$db['default']['dbdriver'] = 'mysqli';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = FALSE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = TRUE;


// database config settings for hal's pc
$db['hal_pc']['hostname'] = 'localhost';
$db['hal_pc']['username'] = 'root';
$db['hal_pc']['password'] = 'rebels';
$db['hal_pc']['database'] = 'ICT333';
$db['hal_pc']['dbdriver'] = 'mysqli';
$db['hal_pc']['dbprefix'] = '';
$db['hal_pc']['pconnect'] = TRUE;
$db['hal_pc']['db_debug'] = FALSE;
$db['hal_pc']['cache_on'] = FALSE;
$db['hal_pc']['cachedir'] = '';
$db['hal_pc']['char_set'] = 'utf8';
$db['hal_pc']['dbcollat'] = 'utf8_general_ci';
$db['hal_pc']['swap_pre'] = '';
$db['hal_pc']['autoinit'] = TRUE;
$db['hal_pc']['stricton'] = TRUE;


// database config settings for ben's pc
$db['ben_pc']['hostname'] = 'localhost';
$db['ben_pc']['username'] = 'root';
$db['ben_pc']['password'] = '';
$db['ben_pc']['database'] = 'team05';
$db['ben_pc']['dbdriver'] = 'mysqli';
$db['ben_pc']['dbprefix'] = '';
$db['ben_pc']['pconnect'] = TRUE;
$db['ben_pc']['db_debug'] = FALSE;
$db['ben_pc']['cache_on'] = FALSE;
$db['ben_pc']['cachedir'] = '';
$db['ben_pc']['char_set'] = 'utf8';
$db['ben_pc']['dbcollat'] = 'utf8_general_ci';
$db['ben_pc']['swap_pre'] = '';
$db['ben_pc']['autoinit'] = TRUE;
$db['ben_pc']['stricton'] = TRUE;


// database config settings for susannah's pc
$db['susannah_pc']['hostname'] = 'localhost';
$db['susannah_pc']['username'] = 'root';  // may need to change these ones
$db['susannah_pc']['password'] = '';  // may need to change these ones
$db['susannah_pc']['database'] = 'team05';  // may need to change these ones
$db['susannah_pc']['dbdriver'] = 'mysqli';
$db['susannah_pc']['dbprefix'] = '';
$db['susannah_pc']['pconnect'] = TRUE;
$db['susannah_pc']['db_debug'] = FALSE;
$db['susannah_pc']['cache_on'] = FALSE;
$db['susannah_pc']['cachedir'] = '';
$db['susannah_pc']['char_set'] = 'utf8';
$db['susannah_pc']['dbcollat'] = 'utf8_general_ci';
$db['susannah_pc']['swap_pre'] = '';
$db['susannah_pc']['autoinit'] = TRUE;
$db['susannah_pc']['stricton'] = TRUE;



/* End of file database.php */
/* Location: ./application/config/database.php */