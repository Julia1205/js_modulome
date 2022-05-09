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

        $this->field_list = 
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
            'modulome_name' =>
            [
                'title' => 'Image du module'
            ]
        ];
        $this->addRowAction('delete');
        $this->addRowAction('edit');
    }

    public function renderForm()
    {
        $moduleCat = new DbQuery();
        $moduleCat->select('modulome_cat_id')->from('modulome');

        $this->fields_form =
        [
            'legend' => 
            [
                'Ajout ou modification d\'un module'
            ],
            'input' => 
            [
                [
                    'type' => 'select',
                    'label' => 'modulome_cat_id',
                    'required' => true,
                    'options' => [
                        'query' => $moduleCat,
                        'id' => 'modulome_cat_id',
                        'name' => 'cat_name'
                    ]
                ]
            ]
        ];
        return parent::renderForm();
    }
}
