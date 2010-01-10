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
  * This one uses a table to place png images
  */
	class renderer_table extends renderer
	{
		var $oNotation = null;
		
		/**
		* @param array
		* @param string
		*/
		function __construct($pieceMap, $sNotationType)
		{
		  $this->pieceMap = $pieceMap;
			$this->oNotation = xiangqi::getNotation($sNotationType);
		}
		
		/**
	  * get the html that represents the piece
	  * @param object pieceinfo
	  * @return string
	  */
		function getPieceHTML($oPiece)
		{
		  $sPiecePath = 'pieces/1/';
	    $sName = ($oPiece->color=='Black'?'b':'r').$oPiece->type.'.png';
			return '<img src="'.$sPiecePath.$sName.'" alt="'.$this->oNotation->getPieceLetter($oPiece->type, $oPiece->color).'" title="'.ucwords($oPiece->type).' ('.$this->oNotation->getPieceLetter($oPiece->type, $oPiece->color).')"/>'."\n";
		}
		
		/**
		* get the html that represents the pieceMap we have been given in the notation we have
		* @return string
		*/
	  function getHTML()
	  {
	    $sHTML = '<table>';
	    $sHTML .= '<tr><th>&nbsp;</th>';
	    for ($m = 0; $m < 9; $m++)
			{
			  $sHTML .= '<th style="color:red;">'.$this->oNotation->getLabel('col', $m, "Red").'</th>';
			}
	    $sHTML .= '<th>&nbsp;</th></tr>';
	    
	    for ($k = 0; $k < 10; $k++)
			{
			  $sHTML .= '<tr><th style="color:red;" >'.$this->oNotation->getLabel('row', $k, "Red").'</th>';
				for ($m = 0; $m < 9; $m++)
				{
				  $sHTML .= '<td>';
				  $oPiece = $this->pieceMap[$k][$m];
				  if($oPiece)
				  {
				    $sHTML .= $this->getPieceHTML($oPiece);
				  }
				  $sHTML .= '&nbsp;</td>';
				}
				$sHTML .= '<th>'.$this->oNotation->getLabel('row', $k, "Black").'</th></tr>';
			}
			
			$sHTML .= '<tr><th>&nbsp;</th>';
	    for ($m = 0; $m < 9; $m++)
			{
			  $sHTML .= '<th>'.$this->oNotation->getLabel('col', $m, "Black").'</th>';
			}
	    $sHTML .= '<th>&nbsp;</th></tr>';
			
			$sHTML .= '</table>';
			return $sHTML;
	  }
	}
