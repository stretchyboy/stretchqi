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
  
  require_once('notation.php');  
  
 
  /**
  * Notation 1.
  * 
  * Taken from "The Chess of China"  "Notational system 1" in Wikipedia
  * @link http://en.wikipedia.org/wiki/Xiangqi#Notational_system_1
  */
	class notation_1 extends notation
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
	  var $aPieces = array(
		  "chariot"  => array('車','俥'), //,  Black first
		  "horse"    => array('馬','傌'),
			//"horse"    => array('馬','馬'), //Second traditional notation from wikipedia other red is 傌
			"elephant" => array('象','相'),
			"advisor"  => array('士','仕'),
			"general"  => array('將','帥'),
			"cannon"   => array('砲','炮'),
			"soldier"  => array('卒','兵'),
			);
		
		/**
	  * positions to labels for each color
	  *
		* @var array
		*/
	  var $aPositions = array(
	    'row' => array(
	      'Black' => array(
	        '1',
	        '2',
	        '3',
	        '4',
	        '5',
	        '6',
	        '7',
	        '8',
	        '9',
	        '10'),
	      'Red' => array(
	        '10',
	        '9',
	        '8',
	        '7',
	        '6',
	        '5',
	        '4',
	        '3',
	        '2',
	        '1'),
	      ),
	    'col' => array(
	      'Black' => array('1','2','3','4','5','6','7','8','9'),
	      'Red'   => array('9','8','7','6','5','4','3','2','1')
	      )
	    );
	   
		
		/**
		* split the notation text into indivual moves
		* @param text
		* @return array
		*/
		function splitMoveText($sText)
		{
		  $sText  = str_replace('–', '-', $sText);
		  $sText  = str_replace("\r", '', $sText);
		  $aLines = split("\n", $sText);
		  $aTexts = array();
		  foreach($aLines as $sLine)
		  {
		    $sLine = trim($sLine);
		    if($sLine)
		    {
		      $aParts = split(',', $sLine);
		      if($aParts[0])
		      {
		        $aTexts[] = trim($aParts[0]);
		      }
		      
		      if(trim($aParts[1]))
		      {
		        $aTexts[] = trim($aParts[1]);
		      }
		    }
		  }
		  return $aTexts;
		}
		
		/**
		* create the move object for a text move for a color
		* @param string
		* @param string
		* @return object move
		*/
		function parseMove($sText, $sColor)
		{
		  preg_match('/(.*)\s+\(([0-9])([0-9])\)\-([0-9])([0-9])/', $sText, $aMatches);
		  
		  if(isset($this->aPieceNames[$sColor][$aMatches[1]]))
		  {
		    $sPiece = $this->aPieceNames[$sColor][$aMatches[1]];
		  }
		  else
		  {
		   
		  }
		  
		  $oFormerPosition = new position($this->getPos('row', $aMatches[2], $sColor), $this->getPos('col', $aMatches[3], $sColor));
      $oNewPosition = new position($this->getPos('row', $aMatches[4], $sColor), $this->getPos('col', $aMatches[5], $sColor));
		  
		  $oMove = new move($sPiece, $oFormerPosition, $oNewPosition, $sColor);
		  $this->getText($oMove);
		  return $oMove;
		}
		
		/**
		* get text representation of move
		* @param object position
		* @return string
		*/
		function getText($oMove)
		{
		  $sMove  = $this->getPieceLetter($oMove->sPiece, $oMove->sColor). " ";
		  $sMove .= '('.$this->getLabel('row', $oMove->oFormerPosition->iRow, $oMove->sColor);
		  $sMove .= $this->getLabel('col', $oMove->oFormerPosition->iColumn, $oMove->sColor).')-';
		  $sMove .= $this->getLabel('row', $oMove->oNewPosition->iRow, $oMove->sColor);
		  $sMove .= $this->getLabel('col', $oMove->oNewPosition->iColumn, $oMove->sColor);
		  
			return $sMove;
		}
	}
