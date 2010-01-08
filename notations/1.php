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
			"general"  => array('將','帥'),
			"cannon"   => array('砲','炮'),
			"soldier"  => array('卒','兵'),
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
		
		function getPieceLetter($sName, $sColor)
		{
		  return $this->aPieces[$sName][$sColor == 'black'?0:1];
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
		  //echo "\n<br><pre>\nsText =" .$sText."</pre>";
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
		  
		  $oFormerPosition = new position($this->getPos('row', $aMatches[2], $sColor), $this->getPos('col', $aMatches[3], $sColor));
      $oNewPosition = new position($this->getPos('row', $aMatches[4], $sColor), $this->getPos('col', $aMatches[5], $sColor));
		  
		  $oMove = new move($sPiece, $oFormerPosition, $oNewPosition, $sColor);
		  $this->getText($oMove);
		  return $oMove;
		}
		
		function getText($oMove)
		{
		  $sMove  = $this->getPieceLetter($oMove->sPiece, $oMove->sColor). " ";
		  $sMove .= '('.$this->getLabel('row', $oMove->oFormerPosition->iRow, $oMove->sColor);
		  $sMove .= $this->getLabel('col', $oMove->oFormerPosition->iColumn, $oMove->sColor).')-';
		  
		  $sMove .= $this->getLabel('row', $oMove->oNewPosition->iRow, $oMove->sColor);
		  $sMove .= $this->getLabel('col', $oMove->oNewPosition->iColumn, $oMove->sColor);
		  //echo "\n<br><pre>\ngetText sMove  =" .$sMove ."</pre>";
		  
			return $sMove;
		}
		
		function getLabel($sAxis, $iPos, $sColor = "Black")
		{
		  if($sColor == 'Black')
		  {
        return $iPos + 1;
      }
      else
      {
        if($sAxis =='row')
        {
          return 10 - $iPos;
        }
        else
        {
          return 9 - $iPos;
        }
      }
		}
		
		function getPos($sAxis, $sLabel, $sColor = "Black")
		{
		  if($sColor == 'Black')
		  {
        return $sLabel - 1;
      }
      else
      {
        if($sAxis =='row')
        {
          return 10 - $sLabel;
        }
        else
        {
          return 9 - $sLabel;
        }
      }
		}
	}
