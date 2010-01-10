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
  * A modified form western chess notation
  * which uses the english piece letters
  *   chariot  = R,
	*		horse    = H
	*		elephant = E
	*		advisor  = A
	*		general  = G
	*		cannon   = C
	*		soldier  = S
	*
	* @todo implement western notation only methods that throw ann error here
  */
	class notation_western extends notation
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
		  throw('Yet to be implemented for western notation');
		}
		
		/**
		* create the move object for a text move for a color
		* @param string
		* @param string
		* @reparaturn object move
		*/
		function parseMove($sText, $sColor)
		{
		  throw('Yet to be implemented for western notation');
		}
		
		/**
		* get text representation of move
		* @param object move
		* @return string
		*/
		function getText($oMove)
		{
		  throw('Yet to be implemented for western notation');
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
		  throw('Yet to be implemented for western notation');
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
		  throw('Yet to be implemented for western notation');
		}
	}
