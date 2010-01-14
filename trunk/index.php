<?php

/**
 * Stretchqi PHP for representing a xiangqi board from notation
 *
 * This is a demo index page which will be used to show the
 * capabilities of stretchqi
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; version 2
 * of the License.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * @package stretchqi
 * @author Martyn Eggleton, Steve Withington
 * @copyright 2009-2010 Martyn Eggleton, Steve Withington
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GPLv2
 * @version SVN: $Rev$ $Date$
 * @link http://stretchqi.googlecode.com
 */


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!--<link rel="stylesheet" href="css/moosong.css" type="text/css"  media="screen"/>-->
	
	<title>Xiangqi Test</title>
	</head>
	<?php
  //$sText = "炮 (32)–35, 馬 (18)–37";
  //$sNotation = '1';
  //$sText = "C (32)–35, H (18)–37";

  $sText = "Ch3-e3, Hh10-g8";


$sNotation = 'sensible';


  
  if($_GET['moves'])
  {
    $sText = $_GET['moves'];
  }
  
  
  if($_GET['notation'])
  {
    $sNotation = $_GET['notation'];
  }
  
  
  require_once('stretchqilib/xiangqi.php');
  
  $sBoard = '';
  
  $oBoard = new xiangqi();
  $oBoard->parseNotation($sText, $sNotation);
  
  $oRenderer2 = $oBoard->getRenderer('text');
  $sBoard .= '<br /><br />'.$oRenderer2->getHTML();
  
  
  $oRenderer3 = $oBoard->getRenderer('text', '1a');
  $sBoard .= '<br /><br />'.$oRenderer3->getHTML();
  
  $oRenderer = $oBoard->getRenderer();
  $sBoard .= $oRenderer->getHTML();
  
  ?>
  <body>
  
  <form>
  <select value="<?=$sNotation;?>" name="notation"><option value="1">Notional System 1</option>
  <option value="1a">Notional System 1 with English Peice letters</option>
  </select>
  <br />
  <textarea name="moves"><?=$sText;?></textarea>
  <br />
  <input type="submit" />
  </form>
  
  <?=$sBoard;?>
  </body>
  </html>
