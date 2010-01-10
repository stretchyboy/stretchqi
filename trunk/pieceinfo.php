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
  * Representation of a xiangqi pieces state
  */
	class pieceinfo
	{
	  /** 
	  * Piece type / name from ("chariot", "horse", "elephant", "advisor", "general", "cannon", "soldier")
	  * @var string
	  */
		var $type;
		
		/**
    * color of the Piece
    * @var string
    */
		var $color;
		
		/**
		* Position the Piece is in
		* @var object position
		*/
		var $position;
		
		/**
		* has the piece been captured
		* @var bool
		*/
		var $captured = false;

		/**
		* @param string
		* @param string
		* @param object position
		*/
		function __construct($type, $color, $position)
		{
			$this->type = $type;
			$this->color = $color;
			$this->position = $position->copy();
		}
		
		/**
		* @return object pieceinfo
		*/
		function copy()
		{
			return new PieceInfo($this->type, $this->color, $this->position);
		}
		
		/**
		* @return bool
		*/
		function isCaptured()
		{
		  return $this->bCaptured;
		}
		
		/**
		* @param bool
		*/
		function setCaptured($bVal)
		{
		  $this->bCaptured = $bVal;
		}
		
		/**
		* @param object position
		*/
		function setPosition($newPosition)
		{
			$this->position->iRow = $newPosition->iRow;
			$this->position->iColumn = $newPosition->iColumn;
		}
	}
