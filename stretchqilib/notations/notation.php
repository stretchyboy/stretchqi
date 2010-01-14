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
  
  /**
  * Representation of a xiangqi notation
  *
  * this is the base class
  */
	class notation
	{
	  /**
		* @var string
		*/
	  var $sStartColor = 'Red';
	  
	  /**
	  * map of piece names to characters for each color (black first)
	  *
	  * this notation has different letters depending on whether the piece is 
	  * red or black
	  *
		* @var array
		*/
	  var $aPieces = array();
		
		/**
		* local copy of pieces reindexed by color then character
		* @var array
		*/
		var $aPieceNames = array();
		
		/**
	  * positions to labels for each color
	  *
		* @var array
		*/
	  var $aPositions = array();
	  
		function __construct()
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
		
		/**
		* get the letter / symbol from params
		* @param string piece name
		* @param string piece color
		* @return string
		*/
		function getPieceLetter($sName, $sColor)
		{
		  return $this->aPieces[$sName][$sColor == 'black'?0:1];
		}
		
		
		/**
		* Create an array of moves from text
		* 
		* splitting the text into chunks and assuming that each move is by the alternate color
		* @param string
		* @return array
		*/
		function getMoves($sText)
		{
		  $aTexts = $this->splitMoveText($sText);
		  $sMoveColor = $this->sStartColor;
		  $aMoves = array();
		  foreach($aTexts as $sText)
		  {
		    $aMoves[] = $this->parseMove(trim($sText), $sMoveColor);
		    
		    //if move is red make it black if not red make it red 
		    $sMoveColor = ($sMoveColor == 'Red'?'Black':'Red');
		  }
		  return $aMoves;
		}
		
		
		/**
		* split the notation text into indivual moves
		* @param text
		* @return array
		*/
		function splitMoveText($sText)
		{
		  throw('Notation Base class must be extended');
		}
		
		/**
		* create the move object for a text move for a color
		* @param string
		* @param string
		* @reparaturn object move
		*/
		function parseMove($sText, $sColor)
		{
		  throw('Notation Base class must be extended');
		}
		
		/**
		* get text representation of move
		* @param object move
		* @return string
		*/
		function getText($oMove)
		{
		  throw('Notation Base class must be extended');
		}
		
		/**
		* get this notations label for a position along a row or coloum for a color
		* @param string
		* @param int
		* @param string
		* @return string
		*/
		function getLabel($sAxis, $iPos, $sColor = "Black")
		{
		  if($sAxis == 'column')
		  {
		    $sAxis = 'col';
		  }
		  return $this->aPositions[$sAxis][$sColor][$iPos];
		}
		
		/**
		* get stretchqi postion value for this notations label of a position along a row or coloum for a color
		* @param string
		* @param int
		* @param string
		* @return string
		*/
		function getPos($sAxis, $sLabel, $sColor = "Black")
		{
		  if($sAxis == 'column')
		  {
		    $sAxis = 'col';
		  }
		  return array_search($sLabel, $this->aPositions[$sAxis][$sColor]);
		}
	}
