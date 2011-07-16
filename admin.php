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

if(isset($_GET['approv'])) {
	$query = "UPDATE `images` SET `show`=1 WHERE `id`='${id}' LIMIT 1";
        $update = mysql_query($query);
	header("Location: {$_SERVER['HTTP_REFERER']}");
	exit;
} else if(isset($_GET['noapprov'])) {
	$query = "UPDATE `images` SET `show`=0 WHERE `id`='${id}' LIMIT 1";
	$update = mysql_query($query);
        header("Location: {$_SERVER['HTTP_REFERER']}");
	exit;
} ?>
                <!-- content -->
                <tr>
                    <td valign="top">
                        <table cellspacing="0" border="0" align="center" cellpadding="0" width="670">
                            <!-- article -->
                            <tr>
                                <td class="copy" valign="top" style="text-align: center; font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #2b2b2b; line-height: 18px;">
				<p>
				<div class="photokonkurs">
			<?php

			$query = "SELECT u.email, i.path, i.name, i.id, i.show
				  FROM users u
				  LEFT JOIN images i ON u.id=i.user_id
				  WHERE i.name != 'NULL'";
			$sql = mysql_query($query);
			$num_images = mysql_num_rows($sql);
		
			while($images = mysql_fetch_row($sql)) {
				?>
				<span class="photo">
                            	    <div><a rel="lightbox" title="Увеличить изображение" href="/photos/<?php echo "$images[1]"; ?>"><div><img width="160px" src="/photos/<?php echo "$images[1]"; ?>" /></div></a></div>
                                    <divi style="text-align: left;"><strong><?php echo "$images[0]"; ?></strong></div>
                                    <div style="color:#0c468f; text-align: left;"><?php echo "$images[2]"; ?></div>
                                    <div class="spanvote" style="float: left;">
                                    <?php
                                    if($images[4] == 0) {
	                            ?><div><a style="color:#E000E9; font-size: 11px;" href="/admin.php?approv&id=<?php echo "$images[3]"; ?>">Одобрить</a></div><?php
				    } else {
				    ?><div><a style="color:#E000E9; font-size: 11px;" href="/admin.php?noapprov&id=<?php echo "$images[3]"; ?>">Отклонить</a></div><?php
				    }
 	                            ?>
 				    </div>
        			    <div style="float: right;">
        			    <?php 
        				$query_v = "SELECT sum(voice) FROM voice WHERE img_id=$images[3]";
					$sql_v = mysql_query($query_v);
					$voice = mysql_fetch_row($sql_v);
				    ?>
            			    <div style="float: right; font: bold 11px arial;"><?php if(empty($voice[0])) { echo "0"; } else { echo "$voice[0]"; } ?></div>
            			    <div style="float: right; font: normal 11px arial;">Голосов:&nbsp;</div>
            			    </div>
                		</span>
		<?php } ?>
				</div>
				</p>
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
