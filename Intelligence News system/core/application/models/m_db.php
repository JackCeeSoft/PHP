<?php
include(APPPATH . "/core/base_e_army_model.php");

class M_db extends Base_e_army_model {
    
    var $maintable   = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
}
