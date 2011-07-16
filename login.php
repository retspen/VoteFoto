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

session_start();

require 'header.php';
require 'include/config.php';

?>
                <!-- content -->
                <tr>
                    <td valign="top">
                        <table cellspacing="0" border="0" align="center" cellpadding="0" width="670">
                            <!-- article title -->
                            <tr>
                                <td valign="top"> <img src="images/double-line.gif" alt="" style="display: block;" /> </td>
                            </tr>
                            <tr>
                                <td align="center" class="article-title" height="30" valign="middle" style="text-transform: uppercase; font-family: Georgia, serif; font-size: 16px; color: #2b2b2b; font-style: italic; border-bottom: 1px solid #c1c1c1;"> Авторизация </td>
                            </tr>
                            <!-- / article title -->
                            <!-- article -->
                            <tr>
                                <td align="center" class="copy" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #2b2b2b; line-height: 18px;"> <br />
                                    <p>
								<?php
										if (isset($_POST['email']) && isset($_POST['password']))
										{
									    		$email = mysql_real_escape_string($_POST['email']);
										   	$password = mysql_real_escape_string($_POST['password']);

									    		$query = "SELECT `id` FROM `users` WHERE `email`='{$email}' AND `password`='{$password}' LIMIT 1";
									    		$sql = mysql_query($query);
    
											if (mysql_num_rows($sql) == 1) {
									    	    		$row = mysql_fetch_assoc($sql);
									    	    		$_SESSION['user_id'] = $row['id'];
									    	    		header("Location: {$_SERVER['HTTP_REFERER']}");
                										exit;
											} else {
									    	   		 print('<p>Вы ввели не верный email или пароль.</p><p><a href=/lost.php>Забыли пароль</a>?<p>');
    											}
										} 
										if (!isset($_SESSION['user_id']) or $_SESSION['user_id'] == 0) {		
										?>
										
										<br /><br />
										<p>Введите данные который вы ввели при регистрации</p>
										   <form action="login.php" method="post" name="cursor">
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
									           	 <td align="center"><input type="submit" value="Войти" /></td>
										    </tr>
										    </table>
										    </form>					
										    <br /><br /><br />
											
									<?php } else {
											print('<br /><br /><strong><p>Вы авторизированы!</p>
											       <p>Теперь вы можете <a href=/upload.php>загрузить</a> фотку.</p>
											       <p>Для просмотра и голосования перейдите на <a href=/>главную</a> страницу.</p></strong>
											       <p><h2><font color="blue">Внимание!</font></h2><strong>Фото одобряется админом и только<br />
											      после этого попадает на главную страницу.</strong><p/><br /><br /><br />');
										  } ?>
									</p>
                                    <br />
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
