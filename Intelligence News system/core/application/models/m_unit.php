<?php
include(APPPATH . "/core/base_e_army_model.php");

class M_unit extends Base_e_army_model {
    
    var $maintable   = 'unit';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
}
