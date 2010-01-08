<?php
	
	class PieceInfo
	{
		var $type;
		var $color;
		var $position;

		var $captured = false;

		function __construct($type, $color, $position)
		{
			$this->type = $type;
			$this->color = $color;
			$this->position = $position->copy();
		}

		function copy()
		{
			return new PieceInfo($this->type, $this->color, $this->position);
		}

		function isCaptured() { return $this->bCaptured; }
		function setCaptured($bVal) { $this->bCaptured = $bVal; }

		function setPosition($newPosition)
		{
			$this->position->iRow = $newPosition->iRow;
			$this->position->iColumn = $newPosition->iColumn;
		}
	}
