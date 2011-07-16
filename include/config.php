<?php
/*
 +-------------------------------------------------------------------------+
 | Copyright (C) 2010-2011 The X-sys Group                                 |
 |                                                                         |
 | This program is free software; you can redistribute it and/or           |
 | modify it under the terms of the GNU General Public License             |
 | as published by the Free Software Foundation; either version 2          |
 | of the License, or (at your option) any later version.                  |
 |                                                                         |
 | This program is distributed in the hope that it will be useful,         |
 | but WITHOUT ANY WARRANTY; without even the implied warranty of          |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the           |
 | GNU General Public License for more details.                            |
 +-------------------------------------------------------------------------+
 | Swmon: Solution For Switch Edge-Core ES3528M, ES3552M and ES3510        |
 +-------------------------------------------------------------------------+
 | This code is designed, written, and maintained by the X-sys Group. See  |
 | about.php and/or the AUTHORS file for specific developer information.   |
 +-------------------------------------------------------------------------+
 | http://www.x-sys.com.ua/                                                |
 +-------------------------------------------------------------------------+
*/

//error_reporting(E_ALL);

$homedir = "/var/www/html";

/* make sure these values refect your actual database/host/user/password */
$database_default = "snimok";
$database_hostname = "localhost";
$database_username = "root";
$database_password = "root";

/* db connect */
$dbconnect = mysql_connect($database_hostname,$database_username,$database_password) or die ("Connect on base users failed.");
mysql_select_db($database_default, $dbconnect);

?>

