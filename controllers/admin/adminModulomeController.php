<?php

require_once(_PS_ROOT_DIR_.'/modules/js_modulome/classes/maison.php');

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
            'id_modulome' => 
            [
                'title' => 'ID'
            ],
            'modulome_cat_id' =>
            [
                'title' => 'Catégorie'
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
        $this->addRowAction('delete');
        $this->addRowAction('edit');
    }

    public function renderForm()
    {
        //Tools::dieObject('hello');
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
                    'name' => 'modulome_image' 
                ]
            ],
            'submit' => 
                [
                    'title' => $this->l('Save')
                ]
        ];
        return parent::renderForm();
    }
}
