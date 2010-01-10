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
    * array of pieceinfo objects representing all reds pieces (including taken ones)
    * @var array
    */
    var $redPieces = array();
    
    /**
    * array of pieceinfo objects representing all blacks pieces (including taken ones)
    * @var array
    */
    var $blackPieces = array();
    
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
    * Parse notation into array of move objects
    * @param string notation to parse
    * @param string notation type (they live in the notations folder)
    * @return array array of move objects
    * @see move
    */
    function parseNotation($sText, $sType = '1') //types are from wikipedia article http://en.wikipedia.org/wiki/Xiangqi
    {
      if(!$this->sNotationType)
      {
        $this->sNotationType = $sType;
      }
      $oNotation = $this->getNotation($sType);
      $aMoves = $oNotation->getMoves($sText);
      //echo "\n<br><pre>\naMoves  =" .var_export($aMoves , TRUE)."</pre>";
      $aMoves = $this->findMovesPieces($aMoves);
      //echo "\n<br><pre>\naMoves after findMovesPieces =" .var_export($aMoves , TRUE)."</pre>";
      if($aMoves)
      {
        $this->applyMoves($aMoves);
      }
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
    * find all relevant pieces for all the moves
		* @return array the array of move objects with their piece ids set
		* @see move
		*/
    function findMovesPieces($aMoves)
    {
      $aNewMoves = array();
      foreach($aMoves as $oMove)
      {
       $xMove = $this->findMovePiece($oMove);
       //echo "\n<br><pre>\nxMove  =" .var_export($xMove , TRUE)."</pre>";
       if($xMove)
       {
          $aNewMoves[] = $xMove;
       }
       else
       {
         return false;
       }
      }
      return $aNewMoves;
    }
    
    /**
    * find the piece being refered to in the move in the clors peice list
		* @return object move object with its piece id set
		* @var object move
		*/
    function findMovePiece($oMove)
    {
      //echo "\n<br><pre>\noMove =" .var_export($oMove, TRUE)."</pre>";
      $oBoardPiece = $this->pieceMap[$oMove->oFormerPosition->iRow][$oMove->oFormerPosition->iColumn];
      //echo "\n<br><pre>\nthis->pieceMap =" .var_export($this->pieceMap, TRUE)."</pre>";
      
      $bSuccess = false;
      if($oBoardPiece->type == $oMove->sPiece && $oBoardPiece->color == $oMove->sColor)
      {
        if($oMove->sColor == 'Black')
        {
          foreach($this->blackPieces as $iID => $oPieceInfo)
          {
            //echo "\n<br><pre>\noBoardPiece  =" .var_export($oBoardPiece , TRUE)."</pre>";
            //echo "\n<br><pre>\noPieceInfo =" .var_export($oPieceInfo, TRUE)."</pre>";
            $bEquals = $oPieceInfo == $oBoardPiece;
            //echo "\n<br><pre>\nbEquals  =" .var_export($bEquals , TRUE)."</pre>";
            
            if($oPieceInfo == $oBoardPiece)
            {
              $oMove->iPieceID = $iID;
              $bSuccess = true;
            }
          }
        }
        else
        {
          foreach($this->redPieces as $iID => $oPieceInfo)
          {
            //echo "\n<br><pre>\noBoardPiece  =" .var_export($oBoardPiece , TRUE)."</pre>";
            //echo "\n<br><pre>\noPieceInfo =" .var_export($oPieceInfo, TRUE)."</pre>";
            $bEquals = $oPieceInfo == $oBoardPiece;
            //echo "\n<br><pre>\nbEquals  =" .var_export($bEquals , TRUE)."</pre>";
            if($oPieceInfo == $oBoardPiece)
            {
              $oMove->iPieceID = $iID;
              $bSuccess = true;
            }
          }
        }
      }
      if($bSuccess)
      {
        //echo "\n<br><pre>\nbSuccess =" .var_export($bSuccess, TRUE)."</pre>";
        return $oMove;
      }
      return false;
    }
    
    /**
    * apply the array of move object to the board
    * @var array 
    */
    function applyMoves($aMoves)
    {
      foreach($aMoves as $oMove)
      {
        if($this->isValid($oMove))
        {
          $this->_applyMove($oMove);
        }
        else
        {
          return false; 
        }
      }
      
    }
    
    /**
    * apply one move to the board
    */
    function _applyMove($oMove)
    {
      //echo "\n<br><b>_applyMove ".get_class($this)."</b>\n";
      if($oMove->sColor == 'Black')
      {
        $oPiece = $this->blackPieces[$oMove->iPieceID]->copy();
      }
      else
      {
        $oPiece = $this->redPieces[$oMove->iPieceID]->copy();
      }
      
      $oPiece->setPosition($oMove->oNewPosition);
      if($oMove->sColor == 'Black')
      {
        $this->blackPieces[$oMove->iPieceID] = $oPiece->copy();
      }
      else
      {
        $this->redPieces[$oMove->iPieceID] = $oPiece->copy();
      }
      
      $this->pieceMap[$oMove->oNewPosition->iRow][$oMove->oNewPosition->iColumn] = $oPiece->copy();
      $this->pieceMap[$oMove->oFormerPosition->iRow][$oMove->oFormerPosition->iColumn] = null;
    }
    
    /**
    * is this move valid
    * @todo do checking
    * @return bool
    * @var object move
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
      $this->redPieces[0]  = new PieceInfo("chariot",  "Red", new Position(9, 0));
			$this->redPieces[1]  = new PieceInfo("horse",    "Red", new Position(9, 1));
			$this->redPieces[2]  = new PieceInfo("elephant", "Red", new Position(9, 2));
			$this->redPieces[3]  = new PieceInfo("advisor",  "Red", new Position(9, 3));
			$this->redPieces[4]  = new PieceInfo("general",     "Red", new Position(9, 4));
			$this->redPieces[5]  = new PieceInfo("advisor",  "Red", new Position(9, 5));
			$this->redPieces[6]  = new PieceInfo("elephant", "Red", new Position(9, 6));
			$this->redPieces[7]  = new PieceInfo("horse",    "Red", new Position(9, 7));
			$this->redPieces[8]  = new PieceInfo("chariot",  "Red", new Position(9, 8));
			$this->redPieces[9]  = new PieceInfo("cannon",   "Red", new Position(7, 1));
			$this->redPieces[10] = new PieceInfo("cannon",   "Red", new Position(7, 7));
			//echo "\n<br><pre>\nthis->redPieces =" .var_export($this->redPieces, TRUE)."</pre>";
      
			for($soldier = 0; $soldier < 5; $soldier++)
      {
	        	$this->redPieces[11 + $soldier] = new PieceInfo("soldier", "Red", new Position(6, 2*$soldier));
			}

			$this->blackPieces[0]  = new PieceInfo("chariot",  "Black", new Position(0, 0));
			$this->blackPieces[1]  = new PieceInfo("horse",    "Black", new Position(0, 1));
			$this->blackPieces[2]  = new PieceInfo("elephant", "Black", new Position(0, 2));
			$this->blackPieces[3]  = new PieceInfo("advisor",  "Black", new Position(0, 3));
			$this->blackPieces[4]  = new PieceInfo("general",     "Black", new Position(0, 4));
			$this->blackPieces[5]  = new PieceInfo("advisor",  "Black", new Position(0, 5));
			$this->blackPieces[6]  = new PieceInfo("elephant", "Black", new Position(0, 6));
			$this->blackPieces[7]  = new PieceInfo("horse",    "Black", new Position(0, 7));
			$this->blackPieces[8]  = new PieceInfo("chariot",  "Black", new Position(0, 8));
			$this->blackPieces[9]  = new PieceInfo("cannon",   "Black", new Position(2, 1));
			$this->blackPieces[10] = new PieceInfo("cannon",   "Black", new Position(2, 7));
      for ($soldier = 0; $soldier < 5; $soldier++)
      {
          $this->blackPieces[11 + $soldier] = new PieceInfo("soldier", "Black", new Position(3, 2*$soldier));
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

			$this->pieceMap[0][0] = $this->blackPieces[0];
			$this->pieceMap[0][1] = $this->blackPieces[1];
			$this->pieceMap[0][2] = $this->blackPieces[2];
			$this->pieceMap[0][3] = $this->blackPieces[3];
			$this->pieceMap[0][4] = $this->blackPieces[4];
			$this->pieceMap[0][5] = $this->blackPieces[5];
			$this->pieceMap[0][6] = $this->blackPieces[6];
			$this->pieceMap[0][7] = $this->blackPieces[7];
			$this->pieceMap[0][8] = $this->blackPieces[8];
			$this->pieceMap[2][1] = $this->blackPieces[9];
			$this->pieceMap[2][7] = $this->blackPieces[10];
			for ($soldier = 0; $soldier < 5; $soldier++)
			{
	        	$this->pieceMap[3][2*$soldier] = $this->blackPieces[11 + $soldier];
			}

			$this->pieceMap[9][0] = $this->redPieces[0];
			$this->pieceMap[9][1] = $this->redPieces[1];
			$this->pieceMap[9][2] = $this->redPieces[2];
			$this->pieceMap[9][3] = $this->redPieces[3];
			$this->pieceMap[9][4] = $this->redPieces[4];
			$this->pieceMap[9][5] = $this->redPieces[5];
			$this->pieceMap[9][6] = $this->redPieces[6];
			$this->pieceMap[9][7] = $this->redPieces[7];
			$this->pieceMap[9][8] = $this->redPieces[8];
			$this->pieceMap[7][1] = $this->redPieces[9];
			$this->pieceMap[7][7] = $this->redPieces[10];
			for($soldier = 0; $soldier < 5; $soldier++)
			{
	        	$this->pieceMap[6][2*$soldier] = $this->redPieces[11 + $soldier];
	  	}
			//echo "\n<br><pre>\nthis =" .var_export($this, TRUE)."</pre>";
	  }
	  
	  /**
	  * get a renderer object and set it with current notation
	  * @var string type of renderer
	  * @var string type of notation
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
      //echo "\n<br><pre>\nsNotationType =" .$sNotationType."</pre>";
      $oRenderer = new $sRenderer($this->pieceMap, $sNotationType);
      return $oRenderer;
	  }
	}
