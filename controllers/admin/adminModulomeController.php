<?php

require_once(_PS_ROOT_DIR_.'/modules/js_modulome/classes/maison.php');
require_once(_PS_ROOT_DIR_.'/modules/js_modulome/classes/categorie.php');


class AdminModulomeController extends ModuleAdminController
{
    public function __construct()
    {
        $this->table = "modulome";
        $this->className = "Maison";
        $this->bootstrap = true;

        parent::__construct();

        $this->fields_list = 
        [   
            'modulome_cat_id' =>
            [
                'title' => 'Catégorie',
                'callback' => 'catname'
            ],
            'modulome_size' =>
            [
                'title' => 'Surface du module'
            ],
            'modulome_price' =>
            [
                'title' => 'Prix du module'
            ],
            'modulome_name' =>
            [
                'title' => 'Nom du module'
            ],
            'modulome_image' =>
            [
                'title' => 'Image du module'
            ]
        ];
        $this->addRowAction('edit');
        $this->addRowAction('delete');
    }

    public function renderForm()
    {
        $maison = new maison();
        if(Tools::getValue('id_modulome')){
            $imgName = $maison::getImageById(Tools::getValue('id_modulome'));
            $lien = __PS_BASE_URI__."\modules\js_modulome/views/images/".$imgName;
        }

        $query = new DbQuery();
        $query->select('id_modulome_category, cat_name')->from('modulome_category');
        $moduleCat = Db::getInstance()->executeS($query);
        //Tools::dieObject($moduleCat);
        $this->fields_form =
        [
            'legend' => 
            [
                'title' => 'Ajout ou modification d\'un module'
            ],
            'input' => 
            [
                [
                    'type' => 'select',
                    'label' => 'Catégorie du module',
                    'name' => 'modulome_cat_id',
                    'required' => true,
                    'options' => 
                        [
                            'query' => $moduleCat,
                            'id' => 'id_modulome_category',
                            'name' => 'cat_name'
                        ]
                ],
                [
                    'type' => 'text',
                    'label' => 'Surface du module',
                    'required' => true,
                    'name' => 'modulome_size' 
                ],
                [
                    'type' => 'text',
                    'label' => 'Prix du module',
                    'required' => true,
                    'name' => 'modulome_price' 
                ],
                [
                    'type' => 'text',
                    'label' => 'Nom du module',
                    'required' => true,
                    'name' => 'modulome_name' 
                ],
                [
                    'type' => 'file',
                    'label' => 'Image du module',
                    'required' => true,
                    'name' => 'modulome_image',
                    'image' => (isset($lien) && $lien ? '<img src="'.$lien.'" width="200px" height="auto" />': false)
                ]
            ],
            'submit' => 
                [
                    'title' => $this->l('Save')
                ]
        ];
        return parent::renderForm();
    }

    public function afterUpdate($object)
    {
        $image = $_FILES['modulome_image']['name'];
        $chemin = move_uploaded_file($_FILES['modulome_image']['tmp_name'], _PS_CORE_DIR_."\modules\js_modulome/views/images/".$image);
        return $chemin;
    }

    public function afterAdd($object)
    {
        $image = $_FILES['modulome_image']['name'];
        $chemin = move_uploaded_file($_FILES['modulome_image']['tmp_name'], _PS_CORE_DIR_."\modules\js_modulome/views/images/".$image);
        return $chemin;
    }

    public function processUpdate()
    {
        //Récupère le nom de l'image avant la MAJ de l'item.
        $id_modulome = Tools::getValue('id_modulome');
        $maison = new maison();
        $image_name = maison::getImageById($id_modulome); //méthode qui permet de récupérer le nom de l'image actuelle
        parent::processUpdate();
        $maison = new maison($id_modulome); //hydrate un nouvel objet
        if(empty (Tools::getValue('modulome_image'))){
            $maison->modulome_image = $image_name;
        }else{
            $maison->modulome_image = Tools::getValue('modulome_image');
        }
        $maison->save();

    }

    static function catname($cat_id)
    {
        $categorie = new Categorie($cat_id);
        return $categorie->cat_name;
    }
}
