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
  require_once('table.php');
  
  /**
  * A renderer for the xiangqi board
  *
  * This one uses the piece letters from a notation and color
  *
  * It is very heavily based on the table renderer
  * @see renderer_table
  */
	class renderer_text extends renderer_table
	{
	  /**
	  * get the html that represents the piece
	  * @var object pieceinfo
	  */
		function getPieceHTML($oPiece)
		{
		  $sHTML = '<span '.($oPiece->color=='Red'?'style="color:red;"':'').'>';
		  $sHTML .= $this->oNotation->getPieceLetter($oPiece->type, $oPiece->color);
		  $sHTML .= '</span>'."\n";
		  return $sHTML;
		}
	 }
