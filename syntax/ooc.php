<?php
/**
 * campaignwiki, ooc syntax component
 *
 * @author  Brend Wanders <brend@13w.nl>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

class syntax_plugin_campaignwiki_ooc extends DokuWiki_Syntax_Plugin {
    public function getType() { return 'formatting'; }
    public function getAllowedTypes() { return array('formatting', 'substition', 'disabled'); }
    public function getPType() { return 'normal'; }
    public function getSort() { return 195; }

    /**
     * Connect lookup pattern to lexer.
     */
    public function connectTo($mode) {
        $this->Lexer->addEntryPattern('<ooc>(?=.*?</ooc>)',$mode,'plugin_campaignwiki_ooc');
    }

    public function postConnect() {
        $this->Lexer->addExitPattern('</ooc>','plugin_campaignwiki_ooc');
    }

    /**
     * Handle matches of the campaignwiki syntax
     *
     * @param string $match The match of the syntax
     * @param int    $state The state of the handler
     * @param int    $pos The position in the document
     * @param Doku_Handler    $handler The handler
     * @return array Data for the renderer
     */
    public function handle($match, $state, $pos, Doku_Handler $handler){
        switch($state) {
            case DOKU_LEXER_ENTER:
                return array($state);

            case DOKU_LEXER_UNMATCHED:
                $handler->_addCall('cdata', array($match), $pos);
                return false;

            case DOKU_LEXER_EXIT:
                return array($state);
        }
    }

    /**
     * Render xhtml output or metadata
     *
     * @param string         $mode      Renderer mode (supported modes: xhtml)
     * @param Doku_Renderer  $renderer  The renderer
     * @param array          $data      The data from the handler() function
     * @return bool If rendering was successful.
     */
    public function render($mode, Doku_Renderer $renderer, $data) {
        if($mode != 'xhtml') return false;
        list($state) = $data;

        switch($state) {
            case DOKU_LEXER_ENTER:
                $renderer->doc .= '<span class="ooc-note">';
                break;

            case DOKU_LEXER_EXIT:
                $renderer->doc .= '</span>';
                break;
        }

        return true;
    }
}
