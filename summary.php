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
 | Project: fotki 						           |
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
                            <!-- article -->
                            <tr>
                                <td  class="copy" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #2b2b2b; line-height: 18px;">
								<center><?php  	
										$query = "SELECT id FROM images";
										$sql = mysql_query($query);
										$num_row = mysql_num_rows($sql);
										echo "Фото: Голоса:<br />";
										
										for($i=1; $num_row >= $i; $i++) {

											$query = "SELECT sum(voice) FROM voice WHERE img_id='$i'";
											$sql = mysql_query($query);
											$voi = mysql_fetch_row($sql);
											if(!isset($voi[0])) { $voice = 0; } else { $voice = $voi[0]; } 
											echo "<b>№:$i - $voice</b><br />\n";
										} ?>
								</center>
                                    <br />
                                    </center>
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
