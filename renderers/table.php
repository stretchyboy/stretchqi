<?php

	class renderer_table
	{
		var $oNotation = null;
		function __construct($pieceMap, $sNotationType)
		{
		  $this->pieceMap = $pieceMap;
			$this->oNotation = xiangqi::getNotation($sNotationType);
		}
		
		function setPieceMap($pieceMap)
		{
		  $this->pieceMap = $pieceMap;
		}
		
		function getPieceHTML($oPiece)
		{
		  $sPiecePath = 'pieces/1/';
	    $sName = ($oPiece->color=='Black'?'b':'r').$oPiece->type.'.png';
			return '<img src="'.$sPiecePath.$sName.'"/>'."\n";
		}
		
	  function getHTML()
	  {
	    $sHTML = '<table>';
	    $sHTML .= '<tr><th>&nbsp;</th>';
	    for ($m = 0; $m < 9; $m++)
			{
			  $sHTML .= '<th style="color:red;">'.$this->oNotation->getLabel('col', $m, "Red").'</th>';
			}
	    $sHTML .= '<th>&nbsp;</th></tr>';
	    
	    for ($k = 0; $k < 10; $k++)
			{
			  $sHTML .= '<tr><th style="color:red;" >'.$this->oNotation->getLabel('row', $k, "Red").'</th>';
				for ($m = 0; $m < 9; $m++)
				{
				  $sHTML .= '<td>';
				  $oPiece = $this->pieceMap[$k][$m];
				  if($oPiece)
				  {
				    $sHTML .= $this->getPieceHTML($oPiece);
				  }
				  $sHTML .= '&nbsp;</td>';
				}
				$sHTML .= '<th>'.$this->oNotation->getLabel('row', $k, "Black").'</th></tr>';
			}
			
			$sHTML .= '<tr><th>&nbsp;</th>';
	    for ($m = 0; $m < 9; $m++)
			{
			  $sHTML .= '<th>'.$this->oNotation->getLabel('col', $m, "Black").'</th>';
			}
	    $sHTML .= '<th>&nbsp;</th></tr>';
			
			$sHTML .= '</table>';
			return $sHTML;
	  }
	}
