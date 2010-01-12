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
  * A position on the board
  */
	class position
	{
		/**
		* @var int
		*/
	  var $iRow;
		
		/**
		* @var int
		*/
		var $iColumn;
		
		/**
		* @param int
		* @param int
		*/
		function __construct($iRow, $iColumn)
		{
			$this->iRow = $iRow;
			$this->iColumn = $iColumn;
		}
		
		/**
		* @return object position
		*/
		function copy()
		{
			return new Position($this->iRow, $this->iColumn);
		}
	}
