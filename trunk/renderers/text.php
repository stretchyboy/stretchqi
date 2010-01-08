<?php

  require_once('table.php');
  
	class renderer_text extends renderer_table
	{
		var $oNotation = null;
		function renderer_text($pieceMap, $sNotationType)
		{
		  parent::renderer_table($pieceMap, $sNotationType);
		}
		
		function getPieceHTML($oPiece)
		{
		  $sHTML = '<span '.($oPiece->color=='Red'?'style="color:red;"':'').'>';
		  $sHTML .= $this->oNotation->getPieceLetter($oPiece->type, $oPiece->color);
		  $sHTML .= '</span>'."\n";
		  return $sHTML;
		}
	 }
