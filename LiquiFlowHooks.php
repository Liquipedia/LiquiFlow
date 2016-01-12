<?php

/**
 * Callback functions for hooks
 *
 * @author Marco Ammon <ammon.marco@t-online.de>
 */
class LiquiFlowHooks {
    
    function __construct(){
        global $wgHooks;
        $wgHooks['GetPreferences'][] = 'LiquiFlowHooks::onGetPreferences';
    }
    
    //Add skin-specific user preferences (registered in skin.json)    
    public static function onGetPreferences($user, &$preferences) {
        //Toggle setting to show dropdown menus on hover instead of click
        $preferences['liquiflow-prefs-show-dropdown-on-hover'] = array(
            'type' => 'check',
            'label-message' => 'liquiflow-prefs-show-dropdown-on-hover', // a system message
            'section' => 'rendering/liquiflow'
        );
        //Default return value for hooks
        return true;
    }

}
