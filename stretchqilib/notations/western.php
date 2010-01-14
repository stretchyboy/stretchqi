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
	  * positions to labels for each color
	  *
		* @var array
		*/
	  var $aPositions = array(
	    'row' => array(
	      'Black' => array(
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
	      'Black' => array('a','b','c','d','e','f','g','h','i'),
	      'Red'   => array('a','b','c','d','e','f','g','h','i')
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
		* @return object move
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
	}
