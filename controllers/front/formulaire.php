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
        $bedroomSize = array();
        $sql = new DbQuery();
        $result = $sql->select('*')->from('modulome_category')->where('cat_name = "chambre"');
        //Tools::dieObject($result);
        $sql1 = new DbQuery(); 
        $sql->select('*')->from('modulome')->where('modulome_cat_id = '.$sql);
        if(Tools::isSubmit('submitpart1')){
            $this->context->smarty->assign([
                'step' => 1,
                'nbbedrooms' => Tools::getValue('nbBedrooms'),
            ]);
        }
        if(Tools::isSubmit('submitpart2')){
            for ($i=1; $i <= $nbBedrooms; $i++) { 
                $bedroomSize[] = Tools::getValue('bedroomSize-'.$i);
                var_dump($bedroomSize);
                $this->context->smarty->assign([
                    'step' => 2,
                    'nbbedrooms' => $nbBedrooms,
                    'bedroomsSizes' => $bedroomSize
                ]);
            }
        }
        if(Tools::isSubmit('submitpart3')){
            for ($i=0; $i < $nbBedrooms; $i++) { 
                $bedroomSize[] = Tools::getValue('bedroomSize-'.$i);
                var_dump($bedroomSize);
                $this->context->smarty->assign([
                    'step' => 3,
                    'nbbedrooms' => $nbBedrooms,
                    'bedroomsSizes' => $bedroomSize,
                    'livingroomType' => Tools::getValue('livingroomType')
                ]);
            }
        }
        if(Tools::isSubmit('submitpart4')){
            $this->context->smarty->assign([
                'step' => 4,
                'nbbedrooms' => $nbBedrooms,
                'livingroomType' => Tools::getValue('livingroomType'),
            ]);
            for ($i=0; $i < $nbBedrooms; $i++) { 
                $bedroomSize[] = Tools::getValue('bedroomSize-'.$i);
                var_dump($bedroomSize);
                $this->context->smarty->assign([
                    'bedroomsSizes' => $bedroomSize
                ]);
            }
            if(Tools::getValue('livingroomType') === "separated"){
                $this->context->smarty->assign([
                    'LivingroomSize' => Tools::getValue('LivingroomSize'),
                    'KitchenSize' => Tools::getValue('KitchenSize')
                ]);
            }
            if(Tools::getValue('livingroomType') === "open"){
                for ($i=0; $i < $nbBedrooms; $i++) { 
                    $bedroomSize[] = Tools::getValue('bedroomSize-'.$i);
                    var_dump($bedroomSize);
                    $this->context->smarty->assign([
                        'step' => 4,
                        'nbbedrooms' => $nbBedrooms,
                        'bedroomsSizes' => $bedroomSize,
                        'livingroomType' => Tools::getValue('livingroomType'),
                        'LivingroomSize' => Tools::getValue('LivingroomSize'),
                    ]);
                }
            }
        }
        if(Tools::isSubmit('submitpart5')){
            Tools::dieObject(Tools::getValue('equiped'));
        }
       
    }

}