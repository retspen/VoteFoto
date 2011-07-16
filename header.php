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
 | Project: fotki						           |
 +-------------------------------------------------------------------------+
 | This code is designed, written, and maintained by the X-sys Group. See  |
 | about.php and/or the AUTHORS file for specific developer information.   |
 +-------------------------------------------------------------------------+
 | http://www.x-sys.com.ua/                                                |
 +-------------------------------------------------------------------------+
*/

include("include/config.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>SouthSide Фотки</title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link rel="shortcut icon" href="http://ss.zp.ua/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
</style>
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
<script language="javascript" type="text/javascript">
function setFocus() {
	document.cursor.email.select();
	document.cursor.email.focus();
}
</script>
</head>
<body marginheight="0" topmargin="0" marginwidth="0" bgcolor="#838383" leftmargin="0" onload="javascript:setFocus()">
<table cellspacing="0" border="0" height="100%" style="background-color: #ebebeb;" cellpadding="0" width="100%">
    <tr>
        <td valign="top">
            <!-- main table -->
            <table cellspacing="0" border="0" align="center" cellpadding="0" width="675">
                <!-- note -->
                <tr>
                    <td valign="top">
                        <table cellspacing="0" border="0" align="center" cellpadding="0" width="500">
                            <tr>
                                <td class="note" valign="top" style="text-align: center; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #2b2b2b; line-height: 18px;">
									<?php if (!isset($_SESSION['user_id'])) { ?>
                                    	<a href="login.php" style="color: #3b464f; font-weight: bold;">Войти</a>
                                    	<a href="registration.php" style="color: #3b464f; font-weight: bold;">Регистрация</a>
                                    	<a href="rules.php" style="color: #fe0000; font-weight: bold;">Условия</a>
									<?php } else { ?>
					<a href="upload.php" style="color: #3b464; font-weight: bold;">Загрузить</a>
                                    	<a href="rules.php" style="color: #fe0000; font-weight: bold;">Условия</a>
					<a href="logout.php" style="color: #3b464f; font-weight: bold;">Выйти</a>
									<?php } ?>
                                    <br />
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- / note -->
                <!-- header -->
                <tr>
                    <td valign="top">
                        <table cellspacing="0" border="0" align="center" cellpadding="0" width="665">
                                      <td class="main-title" height="90px" align="center" style="background-image: url('images/header-content.png');"> <a style="color: #163d80; font-family: Georgia, serif; font-size: 41px; font-weight: bold; font-style: italic; text-decoration: none;" href="/">SouthSide Фотки</a> </td>
                        </table>
                    </td>
                </tr>
                <!-- / header -->          
