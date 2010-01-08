<?php

  require_once('1.php');  

	class notation_1a extends notation_1
	{
	  var $sStartColor = 'Red';
		var $aPieces = array(
		  "chariot"  => array('R','R'),
			"horse"    => array('H','H'),
			"elephant" => array('E','E'),
			"advisor"  => array('A','A'),
			"king"     => array('G','G'),
			"cannon"   => array('C','C'),
			"pawn"     => array('S','S'),
			);
		
		
		function getText($oMove)
		{
		  
		}
	}
