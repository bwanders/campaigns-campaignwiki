<?php
/**
* campaignwiki, imagelink type
*
* @author Brend Wanders <b.wanders@13w.nl>
*/

class plugin_strata_type_imagelink extends plugin_strata_type_page {
    function render($mode, &$R, &$T, $value, $hint) {
        $heading = null;
        $util =& plugin_load('helper','strata_util');

        // only use heading if allowed by configuration
        if(useHeading('content')) {
            $titles = $T->fetchTriples($value, $util->getTitleKey());
            if($titles) {
                $heading = $titles[0]['object'];
            }
        }

        // fall back to using normal page name
        if($heading == null && useHeading('content')) {
            $heading = p_get_first_heading($value);
        }

        // fall back to using page id
        if($heading == null) {
            $heading = $value;
        }

        list($hint_size, $hint_default) = explode('::', $hint, 2);

        $images = $T->fetchTriples($value, 'Image');
        if($images) {
            $image = $images[0]['object'];
        } else {
            $image = $hint_default;
        }

        $size = 48;
        if($hint_size == 'full') $size = null;
        if($hint_size == 'icon') $size = 16;

        if(is_numeric($hint_size)) $size = max(16, min((int)$hint_size, 300) );

        if(preg_match('#^(https?|ftp)#i', $image)) {
            $type = 'externalmedia';
        } else {
            $type = 'internalmedia';
        }

        // render internal link
        // (':' is prepended to make sure we use an absolute pagename,
        // internallink resolves page names, but the name is already resolved.)
        $R->internallink(':'.$value, array(
            'type'=>$type,
            'src'=>$image,
            'title'=>$heading,
            'align'=>null,
            'width'=>$size,
            'height'=>$size,
            'cache'=>null,
            'linking'=>'nolink'
        ));
    }

    function getInfo() {
        return array(
            'desc'=>'Displays the \'Image\' field of the reference as a link, the second hint is the default image.',
            'hint'=>'\'normal\', \'icon\', a number between 16 and 300, or \'full\'. Defaults to \'normal\'.'
        );
    }
}
