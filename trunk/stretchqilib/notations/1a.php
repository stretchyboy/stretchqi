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
 
  require_once('1.php');  
  
  /**
  * Notation 1a
  *
  * A modified form of "Notational system 1" in Wikipedia
  * which uses the english piece letters
  *   chariot  = R,
	*		horse    = H
	*		elephant = E
	*		advisor  = A
	*		general  = G
	*		cannon   = C
	*		soldier  = S
  * @see notation_1
  */
	class notation_1a extends notation_1
	{
	  /**
	  * map of piece names to characters for each color (black first)
	  *
	  * this notation only differs from notation_1 in that this uses these english letters
	  *
		* @var array
		* @see notation_1
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
	}
