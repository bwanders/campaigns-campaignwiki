<?php
/**
 * campaignwiki, ic type
 *
 * @author  Brend Wanders <b.wanders@13w.nl>
 */

class plugin_strata_type_ic extends plugin_strata_type_ref {
    function normalize($value, $hint) {
        // let the 'ref' type do all the work
        return parent::normalize($value, 'ic');
    }

    function render($mode, &$R, &$T, $value, $hint) {
        // let the 'ref' type do the work
        return parent::render($mode, $R, $T, $value, 'ic');
    }

    function getInfo() {
        return array(
            'desc'=>'Links to the respective In Character page. The hint is ignored.',
        );
    }
}
