<?php
include(APPPATH . "/core/base_e_army_model.php");

class M_user extends Base_e_army_model {
    
    var $maintable   = 'user_account';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
}
