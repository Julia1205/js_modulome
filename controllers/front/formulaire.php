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
        
        if(Tools::isSubmit('submitpart1')){
            $this->context->smarty->assign([
                'nbbedrooms' => Tools::getValue('nbBedrooms'),
            ]);
        }
    }

}