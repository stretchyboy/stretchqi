<?php

	class notation_1
	{
	  var $sStartColor = 'Red';
	  //Tradintional
		var $aPieces = array(
		  "chariot"  => array('車','俥'), //,  Black first
		  "horse"    => array('馬','傌'),
			//"horse"    => array('馬','馬'), //Second traditional notation from wikipedia other red is 傌
			"elephant" => array('象','相'),
			"advisor"  => array('士','仕'),
			"king"     => array('將','帥'),
			"cannon"   => array('砲','炮'),
			"pawn"     => array('卒','兵'),
			);
		
		/*//Simplified
		var $aPieces = array(
		  "chariot"  => array('车','车'), //,  Black first
			"horse"    => array('马','马'),
			"elephant" => array('象','相'),
			"advisor"  => array('士','仕'),
			"king"     => array('将','帅'),
			"cannon"   => array('砲','炮'),,
			"pawn"     => array('卒','兵'),
			);*/
			
		function notation_1()
		{
		  $this->aPieceNames = array(
		                        'Black' => array(),
		                        'Red' => array());
		  
		  foreach($this->aPieces as $sName => $aChars)
		  {
		    $this->aPieceNames['Black'][$aChars[0]] = $sName;
		    $this->aPieceNames['Red'][$aChars[1]] = $sName;
		  }
		}
		
		function getMoves($sText)
		{
		  $aTexts = $this->splitMoveText($sText);
		  $sColor = $this->sStartColor;
		  $aMoves = array();
		  foreach($aTexts as $sText)
		  {
		    $aMoves[] = $this->parseMove(trim($sText), $sColor);
		    $sColor = $sColor == 'Red'?'Black':'Red';
		  }
		  return $aMoves;
		}
		
		function splitMoveText($sText)
		{
		  $sText  = str_replace('–', '-', $sText);
		  $sText  = str_replace("\r", '', $sText);
		  $aLines = split("\n", $sText);
		  //echo "\n<br><pre>\naLines  =" .var_export($aLines , TRUE)."</pre>";
		  $aTexts = array();
		  foreach($aLines as $sLine)
		  {
		    $sLine = trim($sLine);
		    if($sLine)
		    {
		      $aParts = split(',', $sLine);
		      if($aParts[0])
		      {
		        $aTexts[] = trim($aParts[0]);
		      }
		      
		      if(trim($aParts[1]))
		      {
		        $aTexts[] = trim($aParts[1]);
		      }
		    }
		  }
		  return $aTexts;
		}
		
		function parseMove($sText, $sColor)
		{
		  $aMatches = null;
		 // preg_match_all('/(.?)\s+\(([0-9])([0-9])\)\-([0-9])([0-9])/', $sText, $aMatches);
		  preg_match('/(.*)\s+\(([0-9])([0-9])\)\-([0-9])([0-9])/', $sText, $aMatches);
		  //echo "\n<br><pre>\nsText =" .$sText."</pre>";
		  //echo "\n<br><pre>\naMatches =" .var_export($aMatches, TRUE)."</pre>";
		  
		  if(isset($this->aPieceNames[$sColor][$aMatches[1]]))
		  {
		    $sPiece = $this->aPieceNames[$sColor][$aMatches[1]];
		    //echo "\n<br><pre>\nsPiece  =" .$sPiece ."</pre>";
		  }
		  else
		  {
		    //echo "not matched";
		  }
		  //move($sPiece, $oFormerPosition, $oNewPosition, $sColor = null, $iPieceID = null)
		  
		  if($sColor == 'Black')
		  {
        $oFormerPosition = new position($aMatches[2] - 1, $aMatches[3] - 1);
        $oNewPosition = new position($aMatches[4] - 1, $aMatches[5] - 1);
      }
      else
      {
        $oFormerPosition = new position(10 - $aMatches[2], 9 - $aMatches[3]);
        $oNewPosition = new position(10 - $aMatches[4], 9 - $aMatches[5]);
      }
      
		  $oMove = new move($sPiece, $oFormerPosition, $oNewPosition, $sColor);
		  return $oMove;
		}
		
		function getText($oMove)
		{
		  
		}
		
		function getLabel($sAxis, $iPos, $sColor = "Black")
		{
		  
		}
		
		function getPos($sAxis, $sLabel, $sColor = "Black")
		{
		  
		}
	}
