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

#hi steve
 
  require_once('western.php');  
  
  /**
  * Notation Sensible
  *
  * A modified form of the Western chess notation
  * which uses the english piece letters and full representation of cordinates all the time
	*
	* @todo implement sensible notation only methods that throw ann error here
  */
	class notation_sensible extends notation_western
	{
		/**
		* create the move object for a text move for a color
		* @param string
		* @param string
		* @reparaturn object move
		*/
		function parseMove($sText, $sColor)
		{
			preg_match('/([A-Z])([a-i])([0-9]+)([-x])([A-Z]?)([a-i])([0-9]+)/', $sText, $aMatches);
			
		  if(isset($this->aPieceNames[$sColor][$aMatches[1]]))
		  {
		    $sPiece = $this->aPieceNames[$sColor][$aMatches[1]];
		  }
		  else
		  {
		   
		  }
		  
		  $oFormerPosition = new position($this->getPos('row', $aMatches[3], $sColor), $this->getPos('col', $aMatches[2], $sColor));
		  $oNewPosition = new position($this->getPos('row', $aMatches[7], $sColor), $this->getPos('col', $aMatches[6], $sColor));
      
		  $oMove = new move($sPiece, $oFormerPosition, $oNewPosition, $sColor);
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
	}
