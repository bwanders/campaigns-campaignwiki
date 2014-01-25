<?php
/**
 * campaignwiki, rule type
 *
 * @author  Brend Wanders <b.wanders@13w.nl>
 */

class plugin_strata_type_rule extends plugin_strata_type_ref {
    function normalize($value, $hint) {
        // let the 'ref' type do all the work
        return parent::normalize($value, 'rules');
    }

    function render($mode, &$R, &$T, $value, $hint) {
        // let the 'ref' type do the work
        return parent::render($mode, $R, $T, $value, 'rules');
    }

    function getInfo() {
        return array(
            'desc'=>'Links to the respective rules page. The hint is ignored.',
        );
    }
}
