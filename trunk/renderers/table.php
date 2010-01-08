<?php

	class renderer_table
	{
		var $oNotation = null;
		function renderer_table($pieceMap, $sNotationType)
		{
		  $this->pieceMap = $pieceMap;
			//require_once('notation/'.$sNotationType.'.php');
			$this->oNotation = xiangqi::getNotation($sNotationType);
		}
		
		function setPieceMap($pieceMap)
		{
		  $this->pieceMap = $pieceMap;
		}
		
	  function getHTML()
	  {
	    //$sBoardPath = 'boards/1/';
	    $sPiecePath = 'pieces/1/';
	    //$sSpecs = file_get_contents($sBoardPath.'board.json', FILE_TEXT);
	    //echo "\n<br><pre>\nsSpecs  =" .$sSpecs ."</pre>";
	    //$aSpecs = json_decode($sSpecs);
	    //echo "\n<br><pre>\naSpecs  =" .var_export($aSpecs , TRUE)."</pre>";
	    
	    $sHTML = '<table><tr><th>&nbsp;</th>
	    <th>a</th>
	    <th>b</th>
	    <th>c</th>
	    <th>d</th>
	    <th>e</th>
	    <th>f</th>
	    <th>g</th>
	    <th>h</th>
	    <th>i</th></tr>';
	    
	    //$iStepX = ( $aSpecs->right - $aSpecs->left ) / 9;
	    //$iPieceWidth = $iStepX * 0.5;
	    //$iStartX = $aSpecs->left;// - (0.5 * $iPieceWidth);
	    
	    //$iStepY = ( $aSpecs->bottom - $aSpecs->top ) / 10;
	    //$iStartY = $aSpecs->top;// - (0.5 * $iPieceWidth);
	    
	    for ($k = 0; $k < 10; $k++)
			{
			  $sHTML .= '<tr><th>'.($k+1).'</th>';
				for ($m = 0; $m < 9; $m++)
				{
				  $sHTML .= '<td>';
				  $oPiece = $this->pieceMap[$k][$m];
				  if($oPiece)
				  {
				    $sName = ($oPiece->color=='Black'?'b':'r').$oPiece->type.'.png';
				    $sHTML .= '<img src="'.$sPiecePath.$sName.'"/>'."\n";
				  }
				  $sHTML .= '&nbsp;</td>';
				  
				}
				$sHTML .= '</tr>';
			}
			$sHTML .= '</table>';
			return $sHTML;
	  }
	  
	  }
