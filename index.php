<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!--<link rel="stylesheet" href="css/moosong.css" type="text/css"  media="screen"/>-->
	
	<title>Xiangqi Test</title>
	</head>
	<?php
  $sText = "炮 (32)–35, 馬 (18)–37";
  $sNotation = '1';
  //$sText = "C (32)–35, H (18)–37";
  
  if($_GET['moves'])
  {
    $sText = $_GET['moves'];
  }
  
  
  if($_GET['notation'])
  {
    $sNotation = $_GET['notation'];
  }
  
  
  require_once('xiangqi.php');
  
  $oBoard = new xiangqi();
  $oBoard->parseNotation($sText, $sNotation);
  
  
  $oRender = $oBoard->getRenderer();
  $sBoard = $oRender->getHTML();
  
  $oRender2 = $oBoard->getRenderer('text');
  $sBoard .= '<br /><br />'.$oRender2->getHTML();
  
  
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
