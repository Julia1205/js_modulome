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
        if(Tools::isSubmit('submitpart1')){
            Tools::dieObject($_POST);
        }
    }

}