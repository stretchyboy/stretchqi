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
  
 
  require_once('renderer.php');
  
  /**
  * A renderer for the xiangqi board
  *
  * This is the base class for the others
  */
	class renderer
	{
		var $oNotation = null;
		function __construct($pieceMap, $sNotationType)
		{
		  $this->pieceMap = $pieceMap;
			$this->oNotation = xiangqi::getNotation($sNotationType);
		}
		
		/**
		* set the array of pieces in their current position
		* @var array
		*/
		function setPieceMap($pieceMap)
		{
		  $this->pieceMap = $pieceMap;
		}
		
		/**
	  * get the html that represents the piece
	  * @var object pieceinfo
	  * @return string
	  */
		function getPieceHTML($oPiece)
		{
		  throw('Renderer Base class must be extended');
		}
		
		/**
		* get the html that represents the pieceMap we have been given in the notation we have
		* @return string
		*/
	  function getHTML()
	  {
		  throw('Renderer Base class must be extended');
	  }
	}
