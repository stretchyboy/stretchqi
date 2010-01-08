<?php

	class Position
	{
		var $iRow;
		var $iColumn;

		function position($iRow, $iColumn)
		{
			$this->iRow = $iRow;
			$this->iColumn = $iColumn;
		}
		
		function copy()
		{
			return new Position($this->iRow, $this->iColumn);
		}

		function getString($sFormat = 'chess')
		{
			if($sFormat == 'chess')
			{
				return "[" . $iRow . "," . chr(97 + $iColumn) . "]";
			}
		}
	}
