<?php
	class move
	{
		var $sPiece = null;
		var $oFormerPosition = null;
		var $oNewPosition = null;
		var $sColor = null;
		var $iPieceID = null;
		
		function __construct($sPiece, $oFormerPosition, $oNewPosition, $sColor = null, $iPieceID = null)
		{
			$this->sPiece = $sPiece;
			$this->oFormerPosition = $oFormerPosition;
			$this->oNewPosition = $oNewPosition;
			$this->sColor = $sColor;
			$this->iPieceID = $iPieceID;
		}
		
		function copy()
		{
		  return new move($this->sPiece, $this->oFormerPosition, $this->oNewPosition, $this->sColor, $this->iPieceID);
		}
	}
