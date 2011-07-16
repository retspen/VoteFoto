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
 | Project:															       |
 +-------------------------------------------------------------------------+
 | This code is designed, written, and maintained by the X-sys Group. See  |
 | about.php and/or the AUTHORS file for specific developer information.   |
 +-------------------------------------------------------------------------+
 | http://www.x-sys.com.ua/                                                |
 +-------------------------------------------------------------------------+
*/

require 'header.php';
require 'include/config.php';

if(isset($_GET['regist'])) {
	$ipaddr	= $_SERVER['REMOTE_ADDR'];
			
	$query = "SELECT `email` FROM `users` WHERE `email`='{$email}' LIMIT 1";
    	$sql = mysql_query($query);
	$rlng = mysql_fetch_row($sql);

	$query = "SELECT `ip` FROM `users` WHERE `ip`='{$ipaddr}' LIMIT 1";
    	$sql = mysql_query($query);
	$ipadd = mysql_fetch_row($sql);
							
	if($rlng[0] != $email && $ipadd[0] != $ipaddr) {					
		if (!empty($email) && !empty($password)) {
			$ipaddr	= $_SERVER['REMOTE_ADDR'];
			$email = mysql_real_escape_string($_POST['email']);
			$password = mysql_real_escape_string($_POST['password']);

			$query = "INSERT INTO `users` (`email`, `password`, `ip`) VALUES ('{$email}', '{$password}', '{$ipaddr}')";
			$sql = mysql_query($query);
			header("Location: /login.php");
                	exit;
		} else {
			?><script language="javascript" type="text/javascript">
			  alert('Вы не ввели пароль или логин!');
			</script><?php
		}
	} else {
		?><script language="javascript" type="text/javascript">
		  alert('Такой логин уже существует или Вы ранее регистрировались с этого IP!');
		</script><?php
	}
} ?>
                <!-- content -->
                <tr>
                    <td valign="top">
                        <table cellspacing="0" border="0" align="center" cellpadding="0" width="670">
                            <!-- article title -->
                            <tr>
                                <td valign="top"> <img src="images/double-line.gif" alt="" style="display: block;" /> </td>
                            </tr>
                            <tr>
                                <td align="center" class="article-title" height="30" valign="middle" style="text-transform: uppercase; font-family: Georgia, serif; font-size: 16px; color: #2b2b2b; font-style: italic; border-bottom: 1px solid #c1c1c1;"> Регистрация </td>
                            </tr>
                            <!-- / article title -->
                            <!-- article -->
                            <tr>
                                <td align="center" class="copy" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #2b2b2b; line-height: 18px;"> <br />
					<p>
					<br /><br />
					<form action="registration.php?regist" method="post" name="cursor">
					<table>
					<tr>
					        <td>Email:</td>
					        <td><input type="email" name="email" /></td>
					</tr>
					<tr>
					        <td>Пароль:</td>
					        <td><input type="password" name="password" /></td>
					</tr>
				        <tr>
  				               <td></td>
					       <td align="center"><input type="submit" value="Регистрация" /></td>
					</tr>
    					</table>
					</form>
					</p>
                                    <br /><br /><br /><br /><br />
                                </td>
                            </tr>
                            <!-- / article -->
                        </table>
                    </td>
                </tr>
                <!-- / content -->
<?php

require 'footer.php';

?>
