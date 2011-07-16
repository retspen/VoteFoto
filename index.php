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

if(isset($_GET['voice'])) {
	$ipaddr = $_SERVER['REMOTE_ADDR'];
        $query = "SELECT `user_ip` FROM `voice` WHERE `user_ip`='${ipaddr}' LIMIT 1";
        $select = mysql_query($query);
        $vois = mysql_fetch_row($select);

	if(!empty($vois[0])) {
		;
	} else {
		$ipaddr = $_SERVER['REMOTE_ADDR'];
                $inv = 1;
                $addvoi = "INSERT INTO `voice` (`img_id`, `user_ip`, `voice`) VALUES ('{$id}', '{$ipaddr}', '{$inv}')";
                $sqlvoi = mysql_query($addvoi);
                header("Location: {$_SERVER['HTTP_REFERER']}");
                exit;
        }
}
?>
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

			$query = "SELECT u.email, i.path, i.name, i.id
				  FROM users u
				  LEFT JOIN images i ON u.id=i.user_id
				  WHERE i.show = 1
				  AND i.name != 'NULL'";
			$sql = mysql_query($query);
			$num_images = mysql_num_rows($sql);

			if($num_images == 0){
				if(isset($_SESSION['user_id']) and $_SESSION['user_id'] != 0) {
					echo "<br /><br /><br /><h1>Фоток еще нет.<br /><br />Хотите быть первым?</h1><p><a href=/upload.php><strong>Загрузить</strong></a></p><br /><br /><br />";
				} else {
					echo "<br /><br /><br /><h1>Фоток еще нет.<br /><br />Хотите быть первым?</h1><p><a href=/registration.php><strong>Регистрация</strong></a></p><br /><br /><br />";
				}
			}

		
			while($images = mysql_fetch_row($sql)) {
				?>
				<span class="photo">
                            	    <div><a rel="lightbox" title="Увеличить изображение" href="/photos/<?php echo "$images[1]"; ?>"><div><img width="160px" src="/photos/<?php echo "$images[1]"; ?>" /></div></a></div>
                                    <div style="text-align: left;"><strong><?php echo "$images[0]"; ?></strong></div>
                                    <div style="color:#0c468f; text-align: left;"><?php echo "$images[2]"; ?></div>
                                    <div class="spanvote" style="float: left;">
                                    <?php
	                            $ipaddr = $_SERVER['REMOTE_ADDR'];
                                    $sh_voi = "SELECT `user_ip`, `img_id` FROM `voice` WHERE `user_ip`='${ipaddr}' LIMIT 1";
                                    $srvoi = mysql_query($sh_voi);
                                    $rvoi = mysql_fetch_row($srvoi);
				    
                                    if(empty($rvoi[0])) {
	                            ?><div><a style="color:#E000E9; font-size: 11px;" href="/?voice&id=<?php echo "$images[3]"; ?>">Проголосовать</a></div><?php
                                    } else if($images[3] == $rvoi[1]) {
	                            ?><div style="color:#E000E9; font-size: 11px;">Ваш выбор</div><?php
				    } else {
				    ?><div style="font-size: 11px;">Вы проголосовали</div><?php
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
		<?php }  ?>
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
