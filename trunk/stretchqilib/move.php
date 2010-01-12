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
  * Representation of a xiangqi move
  */
	class move
	{
	  /** 
	  * Piece name from ("chariot", "horse", "elephant", "advisor", "general", "cannon", "soldier")
	  * @var string
	  */
		var $sPiece = null;
		
		/**
		* Position the Piece starts the move at
		* @var object position
		*/
		var $oFormerPosition = null;
		
		/**
		* Position the Piece should finish the move at
		* @var object position
		*/
		var $oNewPosition = null;
		
		/**
    * color of the Piece being moved
    * @var string
    */
		var $sColor = null;
		
		/**
    * the peices key in the colors pieces array found when move is matched to actual peice
    * @var int
    */
		var $iPieceID = null;
		
		/**
		* @param string
		* @param object position 
		* @param object position
		* @param string
		* @param int
		*/
		function __construct($sPiece, $oFormerPosition, $oNewPosition, $sColor = null, $iPieceID = null)
		{
			$this->sPiece = $sPiece;
			$this->oFormerPosition = $oFormerPosition;
			$this->oNewPosition = $oNewPosition;
			$this->sColor = $sColor;
			$this->iPieceID = $iPieceID;
		}
		
		/**
		* @return object move
		*/
		function copy()
		{
		  return new move($this->sPiece, $this->oFormerPosition, $this->oNewPosition, $this->sColor, $this->iPieceID);
		}
	}
