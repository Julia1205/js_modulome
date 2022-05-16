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
        $bathrooms = array();
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
                $this->context->smarty->assign([
                    'bedroomsSizes' => $bedroomSize
                ]);
            }
            if(Tools::getValue('livingroomType') === "separated"){
                $this->context->smarty->assign([
                     'livingroomSize' => Tools::getValue('livingroomSize'),
                     'kitchenSize' => Tools::getValue('kitchenSize')
                ]);
            }
            if(Tools::getValue('livingroomType') === "open"){
                $this->context->smarty->assign([
                    'livingroomSize' => Tools::getValue('livingroomSize'),
                ]);
            }
        }
        if(Tools::isSubmit('submitpart5')){
            $this->context->smarty->assign([
                'step' => 5,
                'nbbedrooms' => $nbBedrooms,
                'livingroomType' => Tools::getValue('livingroomType'),
                'equiped' => Tools::getValue('equiped')
            ]);
            for ($i=0; $i < $nbBedrooms; $i++) { 
                $bedroomSize[] = Tools::getValue('bedroomSize-'.$i);
                $this->context->smarty->assign([
                    'bedroomsSizes' => $bedroomSize
                ]);
            }
            if(Tools::getValue('livingroomType') === "separated"){
                $this->context->smarty->assign([
                     'livingroomSize' => Tools::getValue('livingroomSize'),
                     'kitchenSize' => Tools::getValue('kitchenSize')
                ]);
            }
            if(Tools::getValue('livingroomType') === "open"){
                $this->context->smarty->assign([
                    'livingroomSize' => Tools::getValue('livingroomSize'),
                ]);
            }
        }
        if(Tools::isSubmit('submitpart6')){
            $this->context->smarty->assign([
                'step' => 6,
                'nbbedrooms' => $nbBedrooms,
                'livingroomType' => Tools::getValue('livingroomType'),
                'equiped' => Tools::getValue('equiped'),
                'nbbathroom' => Tools::getValue('nbbathroom')
            ]);
            for ($i=0; $i < $nbBedrooms; $i++) { 
                $bedroomSize[] = Tools::getValue('bedroomSize-'.$i);
                $this->context->smarty->assign([
                    'bedroomsSizes' => $bedroomSize
                ]);
            }
            if(Tools::getValue('livingroomType') === "separated"){
                $this->context->smarty->assign([
                     'livingroomSize' => Tools::getValue('livingroomSize'),
                     'kitchenSize' => Tools::getValue('kitchenSize')
                ]);
            }
            if(Tools::getValue('livingroomType') === "open"){
                $this->context->smarty->assign([
                    'livingroomSize' => Tools::getValue('livingroomSize'),
                ]);
            }
        }
        if(Tools::isSubmit('submitpart7')){
            $this->context->smarty->assign([
                'step' => 7,
                'nbbedrooms' => $nbBedrooms,
                'livingroomType' => Tools::getValue('livingroomType'),
                'equiped' => Tools::getValue('equiped'),
                'nbbathroom' => Tools::getValue('nbbathroom')
            ]);
            for ($i=0; $i < $nbBedrooms; $i++) { 
                $bedroomSize[] = Tools::getValue('bedroomSize-'.$i);
                $this->context->smarty->assign([
                    'bedroomsSizes' => $bedroomSize
                ]);
            }
            if(Tools::getValue('livingroomType') === "separated"){
                $this->context->smarty->assign([
                     'livingroomSize' => Tools::getValue('livingroomSize'),
                     'kitchenSize' => Tools::getValue('kitchenSize')
                ]);
            }
            if(Tools::getValue('livingroomType') === "open"){
                $this->context->smarty->assign([
                    'livingroomSize' => Tools::getValue('livingroomSize'),
                ]);
            }
            $nbbathroom = Tools::getValue('nbbathroom');
            for ($j=1; $j <= $nbbathroom; $j++){
                $bathroomswithtoilet[] = (int)Tools::getValue('bathroom-'.$j);
                $this->context->smarty->assign([
                    'bathroomswithtoilet' => $bathroomswithtoilet
                ]);
            }
        }

       
    }

}