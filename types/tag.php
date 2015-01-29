<?php
/**
 * campaignwiki, tag type
 *
 * @author  Brend Wanders <b.wanders@13w.nl>
 */

class plugin_strata_type_tag extends plugin_strata_type_ref {
    function normalize($value, $hint) {
        // let the 'ref' type do all the work
        return parent::normalize($value, 'tags');
    }

    function render($mode, &$R, &$T, $value, $hint) {
        // let the 'ref' type do the work
        return parent::render($mode, $R, $T, $value, 'tags');
    }

    function getInfo() {
        return array(
            'desc'=>'Links to the respective tags page. The hint is ignored.',
        );
    }
}
