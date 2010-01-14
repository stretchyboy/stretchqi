<?php
/**
 * DokuWiki Plugin stretchqi (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Steve Withington <steve@access-space.org>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

if (!defined('DOKU_LF')) define('DOKU_LF', "\n");
if (!defined('DOKU_TAB')) define('DOKU_TAB', "\t");
if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');

require_once(DOKU_PLUGIN.'syntax.php');

class syntax_plugin_stretchqi extends DokuWiki_Syntax_Plugin {

    function getInfo() {
        return confToHash(dirname(__FILE__).'/plugin.info.txt');
    }

    function getType() {
        return 'substition';
    }

    function getPType() {
        return 'block';
    }

    function getSort() {
        return 500;
    }
 
     /**
     * Connect pattern to lexer
     */
    function connectTo($mode) {
        $this->Lexer->addSpecialPattern('<stretchqi.*?>\n.*?\n</stretchqi>',$mode,'plugin_stretchqi');
    }

    function handle($match, $state, $pos, &$handler){
        $data = explode("\n",$data);
        $conf  = array_shift($data);
        array_pop($data);
        $sConf  = trim(substr($conf,10,-1));
	
	$aConfStrings = split(' ', trim($sConf));
	
	$aConf = array(); 
	
	foreach($aConfStrings as $sConfString)
	{
		$aParts = split('=', $sConfString);
		$aConf[$aParts[0]] = $aParts[1];
	}
		

        // parse
        return array(
            'conf'  => $aConf,
            'data'  => join("\n", $data),
            );
    }

    function render($mode, &$renderer, $data) {
        if($mode != 'xhtml') return false;
		
	require_once('stretchqilib/xiangqi.php');
  
  	$oBoard = new xiangqi();
  	$oBoard->parseNotation($data, $conf['notation']);
  
  	$oRenderer = $oBoard->getRenderer($conf['renderer']);
  	$sBoard = $oRenderer->getHTML();
	
	$renderer->doc .= $sBoard;
	
        return true;
    }
}

// vim:ts=4:sw=4:et:enc=utf-8:
