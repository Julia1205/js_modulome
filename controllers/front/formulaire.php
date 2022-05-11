<?php

class js_modulomeFormulaireModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();
        $this->setTemplate('module:js_modulome/views/templates/front/formulaire.tpl');
    }

    public function postProcess()
    {
        $nbBedrooms = Tools::getValue('nbBedrooms');
        $sql = new DbQuery();
        $result = $sql->select('*')->from('modulome_category')->where('cat_name = "chambre"');
        //Tools::dieObject($result);
        $sql1 = new DbQuery(); 
        $sql->select('*')->from('modulome')->where('modulome_cat_id = '.$sql);
        
        if(Tools::isSubmit('submitpart1')){
            $this->context->smarty->assign([
                'step' => 2,
                'nbbedrooms' => Tools::getValue('nbBedrooms'),
            ]);
        }
    }

}