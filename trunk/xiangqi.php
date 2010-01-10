<?php
/**
 * Stretchqi PHP for representing a xiangqi board from notation
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; version 2
 * of the License.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * @package stretchqi
 * @author Martyn Eggleton, Steve Withington
 * @copyright 2009-2010 Martyn Eggleton, Steve Withington
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GPLv2
 * @version SVN: $Rev$ $Date$
 * @link http://stretchqi.googlecode.com
 */

  require_once('position.php');
  require_once('pieceinfo.php');
  require_once('move.php');
  
  /**
  * Represents the game
  */
  class xiangqi
  {
    /**
    * array of pieceinfo objects representing all pieces foreach color(including taken ones)
    * @var array
    */
    var $playerPieces = array('Red' => array(), 'Black' => array());
    
    /**
    * the fist used notation for this board, there after taken to be the default
    * @var string
    */
    var $sNotationType = null;
    
    /**
    * array of pieceinfo objects representing current positions of pieces on board
    * @var array
    */
    var $pieceMap = array();
    
    
    function __construct()
    {
      $this->reset();
    }
    
    
    /**
		* @return object notation
		*/
    function getNotation($sType)
    {
      $sNotationName = 'notation_'.$sType;
      require_once('notations/'.$sType.'.php');
      $oNotation = new $sNotationName();
      return $oNotation;
    }
    
    /**
    * Parse notation into array of move objects
    * @param string notation to parse
    * @param string notation type (they live in the notations folder)
    * @return array array of move objects
    * @see move
    */
    function parseNotation($sText, $sType = '1')
    {
      if(!$this->sNotationType)
      {
        $this->sNotationType = $sType;
      }
      $oNotation = $this->getNotation($sType);
      $aMoves = $oNotation->getMoves($sText);
      if($aMoves)
      {
        foreach(array_keys($aMoves) as $iMove)
        {
           $oMove = $this->findMovePiece($aMoves[$iMove]);
           if(empty($oMove->iPieceID))
           {
             throw("can't find piece in map");
           }
           
           if(!$this->isValid($oMove))
           {
             throw("move not valid");
           }
           $this->applyMove($oMove);
        }
      }
    }
    
    /**
    * find the piece being refered to in the move in the clors peice list
		* @return object move object with its piece id set
		* @param object move
		*/
    function findMovePiece($oMove)
    {
      $oBoardPiece = $this->pieceMap[$oMove->oFormerPosition->iRow][$oMove->oFormerPosition->iColumn];
      
      $bSuccess = false;
      if($oBoardPiece->type == $oMove->sPiece && $oBoardPiece->color == $oMove->sColor)
      {
        foreach($this->playerPieces[$oMove->sColor] as $iID => $oPieceInfo)
        {
          $bEquals = $oPieceInfo == $oBoardPiece;
          
          if($oPieceInfo == $oBoardPiece)
          {
            $oMove->iPieceID = $iID;
            $bSuccess = true;
          }
        }
      }
      return $oMove;
    }
    
    /**
    * apply one move to the board
    * @param object move
    */
    function applyMove($oMove)
    {
      $oPiece = $this->playerPieces[$oMove->sColor][$oMove->iPieceID]->copy();
      
      $oPiece->setPosition($oMove->oNewPosition);
      
      $this->playerPieces[$oMove->sColor][$oMove->iPieceID] = $oPiece->copy();
      
      $this->pieceMap[$oMove->oNewPosition->iRow][$oMove->oNewPosition->iColumn] = $oPiece->copy();
      $this->pieceMap[$oMove->oFormerPosition->iRow][$oMove->oFormerPosition->iColumn] = null;
    }
    
    /**
    * is this move valid
    * @todo do checking
    * @return bool
    * @param object move
    */
    function isValid($oMove)
    {
      return true;
    }
    
    /**
    * set the games state back to standard starting postions
    */
    function reset()
    {
      $this->playerPieces['Red'][0]  = new PieceInfo("chariot",  "Red", new Position(9, 0));
			$this->playerPieces['Red'][1]  = new PieceInfo("horse",    "Red", new Position(9, 1));
			$this->playerPieces['Red'][2]  = new PieceInfo("elephant", "Red", new Position(9, 2));
			$this->playerPieces['Red'][3]  = new PieceInfo("advisor",  "Red", new Position(9, 3));
			$this->playerPieces['Red'][4]  = new PieceInfo("general",     "Red", new Position(9, 4));
			$this->playerPieces['Red'][5]  = new PieceInfo("advisor",  "Red", new Position(9, 5));
			$this->playerPieces['Red'][6]  = new PieceInfo("elephant", "Red", new Position(9, 6));
			$this->playerPieces['Red'][7]  = new PieceInfo("horse",    "Red", new Position(9, 7));
			$this->playerPieces['Red'][8]  = new PieceInfo("chariot",  "Red", new Position(9, 8));
			$this->playerPieces['Red'][9]  = new PieceInfo("cannon",   "Red", new Position(7, 1));
			$this->playerPieces['Red'][10] = new PieceInfo("cannon",   "Red", new Position(7, 7));

      
			for($soldier = 0; $soldier < 5; $soldier++)
      {
	        	$this->playerPieces['Red'][11 + $soldier] = new PieceInfo("soldier", "Red", new Position(6, 2*$soldier));
			}

			$this->playerPieces['Black'][0]  = new PieceInfo("chariot",  "Black", new Position(0, 0));
			$this->playerPieces['Black'][1]  = new PieceInfo("horse",    "Black", new Position(0, 1));
			$this->playerPieces['Black'][2]  = new PieceInfo("elephant", "Black", new Position(0, 2));
			$this->playerPieces['Black'][3]  = new PieceInfo("advisor",  "Black", new Position(0, 3));
			$this->playerPieces['Black'][4]  = new PieceInfo("general",     "Black", new Position(0, 4));
			$this->playerPieces['Black'][5]  = new PieceInfo("advisor",  "Black", new Position(0, 5));
			$this->playerPieces['Black'][6]  = new PieceInfo("elephant", "Black", new Position(0, 6));
			$this->playerPieces['Black'][7]  = new PieceInfo("horse",    "Black", new Position(0, 7));
			$this->playerPieces['Black'][8]  = new PieceInfo("chariot",  "Black", new Position(0, 8));
			$this->playerPieces['Black'][9]  = new PieceInfo("cannon",   "Black", new Position(2, 1));
			$this->playerPieces['Black'][10] = new PieceInfo("cannon",   "Black", new Position(2, 7));
      for ($soldier = 0; $soldier < 5; $soldier++)
      {
          $this->playerPieces['Black'][11 + $soldier] = new PieceInfo("soldier", "Black", new Position(3, 2*$soldier));
      }
	    
	    $this->pieceMap = array();
			for ($k = 0; $k < 10; $k++)
			{
				$this->pieceMap[$k] = array();
				for ($m = 0; $m < 9; $m++)
				{
					$this->pieceMap[$k][$m] = null;
				}
			}

			$this->pieceMap[0][0] = $this->playerPieces['Black'][0];
			$this->pieceMap[0][1] = $this->playerPieces['Black'][1];
			$this->pieceMap[0][2] = $this->playerPieces['Black'][2];
			$this->pieceMap[0][3] = $this->playerPieces['Black'][3];
			$this->pieceMap[0][4] = $this->playerPieces['Black'][4];
			$this->pieceMap[0][5] = $this->playerPieces['Black'][5];
			$this->pieceMap[0][6] = $this->playerPieces['Black'][6];
			$this->pieceMap[0][7] = $this->playerPieces['Black'][7];
			$this->pieceMap[0][8] = $this->playerPieces['Black'][8];
			$this->pieceMap[2][1] = $this->playerPieces['Black'][9];
			$this->pieceMap[2][7] = $this->playerPieces['Black'][10];
			for ($soldier = 0; $soldier < 5; $soldier++)
			{
	        	$this->pieceMap[3][2*$soldier] = $this->playerPieces['Black'][11 + $soldier];
			}

			$this->pieceMap[9][0] = $this->playerPieces['Red'][0];
			$this->pieceMap[9][1] = $this->playerPieces['Red'][1];
			$this->pieceMap[9][2] = $this->playerPieces['Red'][2];
			$this->pieceMap[9][3] = $this->playerPieces['Red'][3];
			$this->pieceMap[9][4] = $this->playerPieces['Red'][4];
			$this->pieceMap[9][5] = $this->playerPieces['Red'][5];
			$this->pieceMap[9][6] = $this->playerPieces['Red'][6];
			$this->pieceMap[9][7] = $this->playerPieces['Red'][7];
			$this->pieceMap[9][8] = $this->playerPieces['Red'][8];
			$this->pieceMap[7][1] = $this->playerPieces['Red'][9];
			$this->pieceMap[7][7] = $this->playerPieces['Red'][10];
			for($soldier = 0; $soldier < 5; $soldier++)
			{
	        	$this->pieceMap[6][2*$soldier] = $this->playerPieces['Red'][11 + $soldier];
	  	}
	  }
	  
	  /**
	  * get a renderer object and set it with current notation
	  * @param string type of renderer
	  * @param string type of notation
	  * @return object renderer
	  */
	  function getRenderer($sType = 'table', $sNotationType = null)
	  {
	    if(!$sNotationType)
      {
        $sNotationType = $this->sNotationType;
      }
      
      require_once('renderers/'.$sType.'.php');
      $sRenderer = 'renderer_'.$sType;
      $oRenderer = new $sRenderer($this->pieceMap, $sNotationType);
      return $oRenderer;
	  }
	}
