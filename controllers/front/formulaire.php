<?php

require_once(_PS_ROOT_DIR_.'/modules/js_modulome/classes/maison.php');
require_once(_PS_ROOT_DIR_.'/modules/js_modulome/classes/devis.php');



class js_modulomeFormulaireModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();
        $this->setTemplate('module:js_modulome/views/templates/front/formulaire.tpl');
    }

    public function postProcess()
    {
        $lien = _MODULE_DIR_.'js_modulome/views/images/';
        $this->context->smarty->assign([
            'img_base' => _MODULE_DIR_.'js_modulome/views/images/'.Configuration::get('IMAGE_FORMULAIRE'),
            'lien' => $lien
        ]);
        $maison = new Maison();
        $nbBedrooms = Tools::getValue('nbBedrooms');
        $bedroomSize = array();
        $bathrooms = array();
        $bedroomsPrice = array();
        $bathroomsPrice = 0;
        $price = 0;
        $totalBedrooms = 0;
        /*5
        for ($i=0; $i < 5; $i++) { 
            'bed-'$i => 
        }*/
        if(Tools::isSubmit('submitpart1')){
            //Tools::dieObject($liens);
            //Tools::dieObject($liens);
            //$lien = _MODULE_DIR_.'/js_modulome/views/assets/images/'.$images;
            $this->context->smarty->assign([
                'step' => 1,
                'nbbedrooms' => Tools::getValue('nbBedrooms'),
                'sizes' => $maison->getSizes('4'),
                'images' => $lien,
            ]);
            
        }
        if(Tools::isSubmit('submitpart2')){
            $this->context->smarty->assign([
                'step' => 2,
                'nbbedrooms' => $nbBedrooms
            ]);
            
            for ($i=1; $i <= $nbBedrooms; $i++) { 
                $bedroomSize[] = Tools::getValue('bedroomSize-'.$i);
                $this->context->smarty->assign('bedroomsSizes', $bedroomSize);
                $bedroomsPrice[] =  $maison->getPrice(Tools::getValue('bedroomSize-'.$i), 4, 1);
            }
            foreach ($bedroomsPrice as $value){
                $price += (int)$value[0]['modulome_price'];
            }
            $this->context->smarty->assign('price', $price);
        }
        if(Tools::isSubmit('submitpart3')){
            $this->context->smarty->assign([
                'step' => 3, 
                'nbbedrooms' => $nbBedrooms,
                'price' => Tools::getValue('price')
            ]);
            if(Tools::getValue('livingroomType') === "separated"){
                $this->context->smarty->assign([
                    'kitchenSizes' => $maison->getSizes('6'),
                    'livingSizes' => $maison->getSizes('5'),
                    'livingroomType' => Tools::getValue('livingroomType'),
                ]); 
            }else{
                $this->context->smarty->assign([
                    'livingroomSizes' => $maison->getSizes('2'),
                    'livingroomType' => Tools::getValue('livingroomType'),
                ]); 
            }
            for ($i=0; $i < $nbBedrooms; $i++) { 
                $bedroomSize[] = Tools::getValue('bedroomSize-'.$i);
                $this->context->smarty->assign([
                    'bedroomsSizes' => $bedroomSize
                ]); 
            }
        }
        if(Tools::isSubmit('submitpart4')){
            $this->context->smarty->assign([
                'step' => 4,
                'nbbedrooms' => $nbBedrooms,
                'livingroomType' => Tools::getValue('livingroomType'),
                'price' => Tools::getValue('price')
            ]);
            for ($i=0; $i < $nbBedrooms; $i++) { 
                $bedroomSize[] = Tools::getValue('bedroomSize-'.$i);
                $this->context->smarty->assign('bedroomsSizes', $bedroomSize);
            }
            $price = (int)Tools::getValue('price');
            if(Tools::getValue('livingroomType') === "separated"){
                $this->context->smarty->assign([
                    'livingroomSize' => Tools::getValue('livingroomSize'),
                    'kitchenSize' => Tools::getValue('kitchenSize'),
                ]);
                $livingPrice = $maison->getPrice(Tools::getValue('livingroomSize'), 5, 1);
                $kitchenPrice = $maison->getPrice(Tools::getValue('kitchenSize'), 6, 1);
                $price += (int)$livingPrice;
                $price += (int)$kitchenPrice;
                $this->context->smarty->assign('price', $price);
            }
            if(Tools::getValue('livingroomType') === "open"){
                $this->context->smarty->assign('livingroomSize', Tools::getValue('livingroomSize'));
                $livingPrice = (int)$maison->getPrice(Tools::getValue('livingroomSize'), 2, 1);
                $price += $livingPrice;
                $this->context->smarty->assign('price', $price);
            }
        }
        if(Tools::isSubmit('submitpart5')){
            $price = (int)Tools::getValue('price');
            $this->context->smarty->assign([
                'step' => 5,
                'nbbedrooms' => $nbBedrooms,
                'livingroomType' => Tools::getValue('livingroomType'),
                'equiped' => Tools::getValue('equiped'),
            ]);
            for ($i=0; $i < $nbBedrooms; $i++) { 
                $bedroomSize[] = Tools::getValue('bedroomSize-'.$i);
                $this->context->smarty->assign('bedroomsSizes', $bedroomSize);
            }
            if(Tools::getValue('livingroomType') === "separated"){
                $livingPrice = (int)$maison->getPrice(Tools::getValue('livingroomSize'), 5, 1);
                $kitchenPrice = (int)$maison->getPrice(Tools::getValue('kitchenSize'), 6, 1);
                $price += $livingPrice;
                $price += $kitchenPrice;
                $this->context->smarty->assign([
                    'livingroomSize' => Tools::getValue('livingroomSize'),
                    'kitchenSize' => Tools::getValue('kitchenSize'),
                ]);
            }
            if(Tools::getValue('livingroomType') === "open"){
                $livingPrice = 0;
                $price += $livingPrice;
                $this->context->smarty->assign([
                    'livingroomSize' => Tools::getValue('livingroomSize'),
                ]);
            }
            $this->context->smarty->assign('price', $price);
        }
        if(Tools::isSubmit('submitpart6')){
            $devis = new Devis();
            $this->context->smarty->assign([
                'step' => 6,
                'nbbedrooms' => $nbBedrooms,
                'livingroomType' => Tools::getValue('livingroomType'),
                'equiped' => Tools::getValue('equiped'),
                'nbbathroom' => Tools::getValue('nbbathroom'),
            ]);
            $price = (int)Tools::getValue('price');
            if(Tools::getValue('equiped')){
                $price += (int)$maison->getPrice(0, Tools::getValue('equiped'), 0);
                $this->context->smarty->assign('price', $price);
            }else{
                $this->context->smarty->assign('price', $price);
            }
            for ($i=0; $i < $nbBedrooms; $i++) { 
                $bedroomSize[] = Tools::getValue('bedroomSize-'.$i);
                $this->context->smarty->assign('bedroomsSizes', $bedroomSize);
            }
            if(Tools::getValue('livingroomType') === "separated"){
                $this->context->smarty->assign([
                     'livingroomSize' => Tools::getValue('livingroomSize'),
                     'kitchenSize' => Tools::getValue('kitchenSize')
                ]);
            }
            if(Tools::getValue('livingroomType') === "open"){
                $this->context->smarty->assign('livingroomSize', Tools::getValue('livingroomSize'));
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
            $price = (int)Tools::getValue('price');
            for ($i=0; $i < $nbBedrooms; $i++) { 
                $bedroomSize[] = Tools::getValue('bedroomSize-'.$i);
                $bedroomImg[] = $maison->getBedroomImg(Tools::getValue('bedroomSize-'.$i));
                $this->context->smarty->assign([
                    'bedroomsSizes' => $bedroomSize,
                    'imgBed' => $bedroomImg
                ]);
            }
            $this->context->smarty->assign('bedroomsPrice', $bedroomsPrice);
            if(Tools::getValue('livingroomType') === "separated"){
                $this->context->smarty->assign([
                     'livingroomSize' => Tools::getValue('livingroomSize'),
                     'kitchenSize' => Tools::getValue('kitchenSize'),
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
                $this->context->smarty->assign('bathroomswithtoilet', $bathroomswithtoilet);
                if((int)Tools::getValue('bathroom-'.$j) == '1'){
                    $bathroomsPrice += (int)$maison->getPrice(0, 1, 0);
                }else{
                    $bathroomsPrice += (int)$maison->getBathroomsPrice(0, 3,0);
                }
                $price += $bathroomsPrice;
            }
        }
            $post = $_POST;
            array_pop($post);
            //Tools::dieObject($post);
            foreach ($post as $keykey => $valhue) {
                if(strstr($keykey, 'bedroomSize'))
                {
                    $nbBed = $post['nbBedrooms'];
                    for ($i=0; $i < $nbBed; $i++) 
                    { 
                        if($keykey == "bedroomSize-".$i){
                            $devisQuery = new DbQuery();
                            $devisQuery->select('id_modulome')->from('modulome')->where('modulome_cat_id = 4 AND modulome_size = '.$valhue);
                            $test = Db::getInstance()->executeS($devisQuery);
                            Db::getInstance()->insert('modulome_devis', 
                            [
                                'id_modulome' => $test[0]['id_modulome'],
                                'cust_id' => $this->context->customer->id,
                            ]);
                        }
                    }
                }elseif(strstr($keykey, 'equiped')){
                    Db::getInstance()->insert('modulome_devis', 
                    [
                        'cust_id' => $this->context->customer->id,
                        'equiped_kitchen' => $valhue,
                        'id_modulome' => 12
                    ]);

                }elseif(strstr($keykey, 'livingroomType')){
                    if($valhue == "separated")
                    {
                        $devisQuery = new DbQuery();
                        $devisQuery->select('id_modulome')->from('modulome')->where('modulome_cat_id = 5 AND modulome_size = '.$post['livingroomSize']);
                        $lSize = Db::getInstance()->executeS($devisQuery);
                        $devisQuery2 = new DbQuery();
                        $devisQuery2->select('id_modulome')->from('modulome')->where('modulome_cat_id = 6 AND modulome_size = '.$post['kitchenSize']);
                        $kSize = Db::getInstance()->executeS($devisQuery2);
                        Db::getInstance()->insert('modulome_devis', 
                        [
                            'id_modulome' => $lSize[0]['id_modulome'],
                            'cust_id' => $this->context->customer->id
                        ]);
                        Db::getInstance()->insert('modulome_devis', 
                        [
                            'id_modulome' => $kSize[0]['id_modulome'],
                            'cust_id' => $this->context->customer->id
                        ]);
                    }else{
                        $devisQuery = new DbQuery();
                        $devisQuery->select('id_modulome')->from('modulome')->where('modulome_cat_id = 5 AND modulome_size = '.$post['livingroomSize']);
                        $lSize = Db::getInstance()->executeS($devisQuery);
                        Db::getInstance()->insert('modulome_devis', 
                        [
                            'id_modulome' => $lSize[0]['id_modulome'],
                            'cust_id' => $this->context->customer->id
                        ]);
                    }
                }elseif(strstr($keykey, 'nbbathroom')){
                    if($valhue == 1){
                        $devisQuery = new DbQuery();
                        $devisQuery->select('id_modulome')->from('modulome')->where('modulome_cat_id = 1');
                        $bathOption = Db::getInstance()->executeS($devisQuery);
                        Db::getInstance()->insert('modulome_devis', 
                        [
                            'id_modulome' => $bathOption[0]['id_modulome'],
                            'cust_id' => $this->context->customer->id
                        ]);
                    }else{
                        $devisQuery = new DbQuery();
                        $devisQuery->select('id_modulome')->from('modulome')->where('modulome_cat_id = 3');
                        $bath = Db::getInstance()->executeS($devisQuery);
                        Db::getInstance()->insert('modulome_devis', 
                        [
                            'id_modulome' => $bath[0]['id_modulome'],
                            'cust_id' => $this->context->customer->id
                        ]);
                    }
                }
            }
            
            $this->context->smarty->assign('price', $price);

        
    }

    

    public function setMedia()
    {
        parent::setMedia();
        Media::addJsDef([
            'modulome_ajaxurl' => $this->context->link->getModuleLink('js_modulome', "modulome"),
        ]);

        $this->registerJavascript(
            'modulome_js',
            'modules/'.$this->module->name.'/views/assets/js/modulome.js',
            [
               'priority' => 200,
               'postion' => 'bottom',
            ]
        );
        $this->context->controller->addCSS(_MODULE_DIR_.$this->module->name.'/views/assets/css/modulome.css');
    }

}