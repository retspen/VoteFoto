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
require 'include/func.php';

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
                                <td align="center" class="article-title" height="30" valign="middle" style="text-transform: uppercase; font-family: Georgia, serif; font-size: 16px; color: #2b2b2b; font-style: italic; border-bottom: 1px solid #c1c1c1;"> Восстановление пароля </td>
                            </tr>
                            <!-- / article title -->
                            <!-- article -->
                            <tr>
                                <td align="center" class="copy" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #2b2b2b; line-height: 18px;"> <br />
							<?php
							if(isset($_GET['send'])) {
								$query = "SELECT `password` FROM `users` WHERE `email`='{$email}' LIMIT 1";
								$sql = mysql_query($query);
								$mail = mysql_fetch_row($sql);
								
								if(empty($mail[0])) {
									echo "<p><font color='red'>Такого почтового ящика не найдено</font>.</p>";
								} else {
									$subject = "Пароль для SS Фотки";
								        $message = "Для входа используйте: <br />" . "\r\n" .
								        	   "<br />" . "\r\n" .
								              	   "пароль: $mail[0] <br />" . "\r\n" .
								              	   "<br />" . "\r\n" .
								              	   "<a href=http://fotki.ss.zp.ua>http://fotki.ss.zp.ua</a> <br />" . "\r\n";

									send_mime_mail('SS Фотки',
	               								       	'admin@ss.zp.ua',
		               								'',
											$email,
											'utf-8',
		  									'windows-1251',
	          									$subject,
	          									$message);
								
									echo "<p><font color='red'>Пароль отправлен на почту</font>.</p><p>Перейдите на страницу <a href=/login.php>авторизации</a><p>";
								}
							}
							?>
									<br /><br />
									<form enctype="multipart/form-data" action="/lost.php?send" method="post" name="cursor">
									<table>
										        <tr>
										        <td>Введите email который Вы ввели при регистрации</td>
										        </tr>
										        <tr>
										        <td align=center>Email: <input type="text" name="email" /><td>
										        </tr>
											<tr>
											<td align="center"><input type="submit" value="Отпавить"></td>
											</tr>
									</table>
									</form>
                                    <br /><br /><br />
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
