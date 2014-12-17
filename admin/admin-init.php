<?php

// Load the TGM init if it exists
if (file_exists(dirname(__FILE__).'/tgm/tgm-init.php')) {
    require_once( dirname(__FILE__).'/tgm/tgm-init.php' );
}
// Load Redux extensions - MUST be loaded before your options are set
if (file_exists(dirname(__FILE__).'/redux-extensions/extensions-init.php')) {
    require_once( dirname(__FILE__).'/redux-extensions/extensions-init.php' );
}    
// Load the embedded Redux Framework
if (file_exists(dirname(__FILE__).'/redux-framework/ReduxCore/framework.php')) {
    require_once( dirname(__FILE__).'/redux-framework/ReduxCore/framework.php' );
}
// Load the theme/plugin options
if (file_exists(dirname(__FILE__).'/options-init.php')) {
    require_once( dirname(__FILE__).'/options-init.php' );
}


if (file_exists(dirname(__FILE__).'/options/00.variable.php')) {
    require_once( dirname(__FILE__).'/options/00.variable.php' );
}
if (file_exists(dirname(__FILE__).'/options/01.theme-setup.php')) {
    require_once( dirname(__FILE__).'/options/01.theme-setup.php' );
}
if (file_exists(dirname(__FILE__).'/options/02.header.php')) {
    require_once( dirname(__FILE__).'/options/02.header.php' );
}
if (file_exists(dirname(__FILE__).'/options/03.index.php')) {
    require_once( dirname(__FILE__).'/options/03.index.php' );
}