<?php
include(APPPATH . "/core/base_e_army_model.php");

class M_diagram_person extends Base_e_army_model {
    
    var $maintable   = 'm_diagram_person';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
}
