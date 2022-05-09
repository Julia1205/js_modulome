<?php

require_once(_PS_ROOT_DIR_.'/modules/js_modulome/classes/maison.php');

class AdminFormulaireController extends ModuleAdminController
{
    public function __construct()
    {
        $this->table = "modulome";
        $this->className = "Maison";
        $this->bootstrap = true;

        parent::__construct();

    }
}
