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

session_start();

require 'header.php';
require 'include/config.php';
require 'include/func.php';

if(isset($_GET['del'])) {
	if (isset($_SESSION['user_id'])) {
		$usr_id = $_SESSION['user_id'];
										        
		$query = "SELECT `path` FROM `images` WHERE `user_id`='$usr_id'";
		$select = mysql_query($query);
		$delpic = mysql_fetch_row($select);
										
		$query = "DELETE FROM `images` WHERE `user_id`='$usr_id'";
		$delete = mysql_query($query);
		unlink("$homedir/photos/$delpic[0]");
		header("Location: {$_SERVER['HTTP_REFERER']}");
                exit;
	}
}
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
                                <td align="center" class="article-title" height="30" valign="middle" style="text-transform: uppercase; font-family: Georgia, serif; font-size: 16px; color: #2b2b2b; font-style: italic; border-bottom: 1px solid #c1c1c1;"> Загрузить фотку </td>
                            </tr>
                            <!-- / article title -->
                            <!-- article -->
                            <tr>
                                <td align="center" class="copy" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #2b2b2b; line-height: 18px;"> <br />
							<?php if (isset($_SESSION['user_id']) and $_SESSION['user_id'] != 0) {
                                   					$usr_id = $_SESSION['user_id'];
									$query = "SELECT `path`, `show` FROM `images` WHERE `user_id`='$usr_id'";
									$select = mysql_query($query);
									$pic = mysql_fetch_row($select);
									
									if(mysql_num_rows($select) == 1) {
										print("<p>Ваше загруженное фото!</p>");
									
										if($pic[1] == 0) {
											echo "Статус: <strong>Не одобрено</strong>\n";
										} else {
											echo "Статус: <strong>Одобрено</strong>\n";
										}

										print("<p><a rel=\"lightbox\" title=\"Увеличить изображение\" href=\"/photos/$pic[0]\">
										       <img width=\"160px\" src=/photos/$pic[0] /></a></p>");
										?>
										<form action="/upload.php?del" method="post">
										<input type="submit" value="Удалить" onclick="return confirm('Вы уверены?')">
										</form>
										<br /><br/>
										<?php								
									} else if (!$userfile) {
										if (!isset($_SESSION['user_id']) and $_SESSION['user_id'] == 0) {
											print("<p><strong>Загружать фотки могут только зарегистрированные пользователи!</strong></p><br />");
										} else {
										?>
										<br />
										<p><strong>Загружаймая фотка или картинка не должна превышать размер 2Мб.</strong></p>
										<br />
										
										<form enctype="multipart/form-data" action="/upload.php" method="post">
										<table>
										        <tr>
										        <td>Название: <input type="text" name="picname" /><td>
											<td><input type="hidden" name="MAX_FILE_SIZE" value="2048000"></td>
											</tr>
											<tr>
											<td><input name="userfile" type="file"></td>
											</tr>
											<tr>
											<td align="center"><input type="submit" value="Загрузить"></td>
											</tr>
										</table>
										</form>
										
										<br />
										<br />
										<br />
										<br />
									<?php }
									}
									
								} else {
									print("<p><strong>Загружать фотки могут только зарегистрированные пользователи!</strong></p><br />");
								}
									
									if($userfile) {
										$ext = array ('image/gif', 'image/jpeg', 'image/jpg');
										$type_file = $_FILES['userfile']['type'];
										
										if ($type_file != $ext[0] && $type_file != $ext[1] && $type_file != $ext[2]) {
											print('<p><strong>Файл не является форматом JPEG или GIF!</strong></p>');
										} else {
											if (!empty($picname)) {
												$fl_name = $_FILES['userfile']['name'];
												$reg = explode(".",$fl_name);
												$gn = gename();
												$fnm = "$gn.$reg[1]";
											
												$uploaddir = "$homedir/upload/";
											
												if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir .$fnm)) {

													$query = "INSERT INTO `images` (`user_id`, `name`, `path`) VALUES ('$usr_id', '$picname', '$fnm')";
									       				$load = mysql_query($query);
									       			
									       				$image = new SimpleImage();
									       				$image->load("$homedir/upload/$fnm");
									       				$image->resizeToWidth(640);
									       				$image->save("$homedir/photos/$fnm");
									       			
									        			print("<p><strong>Спасибо!</strong> Фотка успешно загружена.
									        			       <br />Фото появится на главной странице после одобрения ее админом.</p>
									        			       <p><img width=\"320px\" src=/photos/$fnm /></p>
									        			       <p>Перейдите на <a href=/>Главную</a> страницу<p/>");
												} else {
										    			print('<p>Возникла ошибка при загрузке, проверьте размер файла!</p>');
												}
											} else {
												print("<p><strong>Введите название!</strong></p><p>Вернуться <a href=/upload.php>назад</a></p>");
											}
										}
									} ?>
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
