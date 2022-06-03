<?php
include(APPPATH . "/core/base_e_army_model.php");

class M_user_group extends Base_e_army_model {
    
    var $maintable   = 'user_group';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
}
