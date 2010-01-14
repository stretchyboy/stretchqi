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
  * Notation Western
  *
  * A modified form sensible chess notation
  * which uses the english piece letters
  *   chariot  = R,
	*		horse    = H
	*		elephant = E
	*		advisor  = A
	*		general  = G
	*		cannon   = C
	*		soldier  = S
	*
	* 
	*
	*
	*
	*
	* @todo implement sensible notation only methods that throw ann error here
  */
	class notation_sensible extends notation
	{
	  /**
		* @var string
		*/
	  var $sStartColor = 'Red';
	  
	  /**
	  * map of piece names to characters for each color (black first)
	  *
		* @var array
		*/
		var $aPieces = array(
		  "chariot"  => array('R','R'),
			"horse"    => array('H','H'),
			"elephant" => array('E','E'),
			"advisor"  => array('A','A'),
			"general"     => array('G','G'),
			"cannon"   => array('C','C'),
			"soldier"     => array('S','S'),
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
		      $aParts = split(' ', $sLine);
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
		* @reparaturn object move
		*/
		function parseMove($sText, $sColor)
		{
			preg_match('/([A-Z])([a-i])([0-9]+)([-x])([A-Z]?)([a-i])([0-9]+)/', $sText, $aMatches);
			echo "<br>$sText<pre>";
			var_dump($aMatches);

			exit;
		  
		  if(isset($this->aPieceNames[$sColor][$aMatches[1]]))
		  {
		    $sPiece = $this->aPieceNames[$sColor][$aMatches[1]];
		  }
		  else
		  {
		   
		  }
		  
		  $oFormerPosition = new position($this->getPos('row', $aMatches[3], $sColor), $this->getPos('col', $aMatches[2], $sColor));
      		  $oNewPosition = new position($this->getPos('row', $aMatches[6], $sColor), $this->getPos('col', $aMatches[7], $sColor));
		  
		  $oMove = new move($sPiece, $oFormerPosition, $oNewPosition, $sColor);
		  $this->getText($oMove);
		  return $oMove;
		}
		
		/**
		* get text representation of move
		* @param object move
		* @return string
		*/
		function getText($oMove)
		{
		  throw('Yet to be implemented for sensible notation');
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
		  throw('Yet to be implemented for sensible notation');
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
		  throw('Yet to be implemented for sensible notation');
		}
	}
