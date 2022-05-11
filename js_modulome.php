<?php

class js_modulome extends Module 
{
    public function __construct()
    {
        $this->name = "js_modulome";
        $this->displayName = "Module formulaire de maison";
        $this->tab = "front_office_features";
        $this->version = "0.0.1";
        $this->author = "Julie Sigrist";
        $this->description = "Module de projet Prestashop";
        $this->bootstrap = true;

        parent::__construct();
    }

    public function install()
    {
        if(!parent::install()
        || !$this->installdb()
        || !$this->registerHook('displayHeader')
        || !$this->registerHook('actionFrontControllerSetMedia')
        || !$this->installTab('AdminCatalog', 'AdminFormulaire', 'Gérer les modules')
        )
        {
            return false;
        }
        return true;
    }

    public function installdb()
    {
        //création des bdd associées
        $sql = Db::getInstance()->execute
        ('
        CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'modulome_category (
            id_modulome_category INT NOT NULL AUTO_INCREMENT,
            cat_name TEXT NOT NULL,
            PRIMARY KEY(id_modulome_category)
            )ENGINE = '._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;
        CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'modulome (
            id_modulome INT NOT NULL AUTO_INCREMENT,
            modulome_cat_id INT NOT NULL,
            modulome_size INT NOT NULL,
            modulome_price TEXT NOT NULL,
            modulome_name TEXT NOT NULL,
            modulome_image TEXT NOT NULL,
            PRIMARY KEY(id_modulome),
            CONSTRAINT FK_cat FOREIGN KEY (modulome_cat_id) REFERENCES '._DB_PREFIX_.'modulome_category(id_modulome_category)
            )ENGINE = '._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;
            INSERT INTO '._DB_PREFIX_.'modulome_category (cat_name) VALUES ("salle de bains"), ("pièce à vivre"), ("salle d\'eau"), ("cuisine"), ("chambre");
            INSERT INTO '._DB_PREFIX_.'modulome (modulome_cat_id, modulome_size, modulome_price, modulome_name, modulome_image) VALUES 
            ((SELECT id_modulome_category FROM '._DB_PREFIX_.'modulome_category WHERE cat_name = "chambre"), 10, 15000, "modulome B10", "test");
        ');
        return $sql;
    }

    public function installTab($parent, $admincontroller, $name)
    {
        $tab = new Tab();
        $tab->id_parent = (int)Tab::getIdFromClassName($parent);
        $tab->name = [];
            foreach(Language::getLanguages(true) as $lang)
            {
                $tab->name[$lang['id_lang']] = $name;
            }

        $tab->class_name = $admincontroller;
        $tab->module = $this->name;
        $tab->active = 1;

        return $tab->add();
}

    public function uninstall()
    {
        //supprimer les champs de configurations
        Configuration::deleteByName('DISPLAY');
        //supprime les bases de données associées au module
        Db::getInstance()->execute('
        ALTER TABLE '._DB_PREFIX_.'modulome DROP FOREIGN KEY FK_cat;
            DROP TABLE IF EXISTS '._DB_PREFIX_.'modulome_category;
            DROP TABLE IF EXISTS '._DB_PREFIX_.'modulome;
        ');
        return parent::uninstall();

    }

    public function getContent()
    {
        $output = "";
        if(Tools::isSubmit('submit_jsmodulome'))
        {
            $display = Tools::getValue('DISPLAY');

            if((empty($display) || $display) && Validate::isBool($display))
            {
                Configuration::updateValue('DISPLAY', $display);
                $output .= $this->displayConfirmation('La donnée du champ "DISPLAY" à bien été enregistrée');
            }
            else
            {
                $output .= $this->displayError('Une erreur est survenue, merci de ré-essayer.');
            }

            $image = Tools::getValue('IMAGE_FORMULAIRE');
            if($image || !empty($image) && Validate::isImageTypeName($image))
            {
                if(!move_uploaded_file($_FILES['IMAGE_FORMULAIRE']['tmp_name'], dirname(__FILE__).'/views/images/'.$image))
                {
                    $output .= $this->displayError('L\'image n\'a pas pû être enregistrée.');
                }else{
                    Configuration::updateValue('IMAGE_FORMULAIRE', $image);
                    $output .= $this->displayConfirmation('C\'est bien enregistré tqt');
                }
            }

        }
        return $output.$this->displayForm();
    }


    public function displayForm()
    {
        if(Configuration::get('IMAGE_FORMULAIRE')){
            $lien = _MODULE_DIR_.$this->name.'/views/images/'.Configuration::get('IMAGE_FORMULAIRE');
        }

        $form_configuration['0']['form'] = 
        [
            'legend' =>[
                'title' => $this->l('Setting'), //la fonction l($string permet de gérer les traductions)
            ],
            'input' => [
                [
                    'type' => 'radio',
                    'label' => $this->l('Souhaitez-vous afficher le formulaire de pré-projet?'),
                    'desc' => $this->l('Choisissez une option'),
                    'name' => 'DISPLAY',
                    'is_bool' => true,
                    'required' => true,
                    'values' =>
                    [
                        [
                            'id' => 'yes',
                            'value' => 1,
                            'label' => $this->l('Oui')
                        ],
                        [
                            'id' => 'no',
                            'value' => 0,
                            'label' => $this->l('Non')
                        ],
                    ]
                ],
                [
                    'type' => 'file', 
                    'label' => $this->l("Image d'accueil du formulaire"),
                    'name' => 'IMAGE_FORMULAIRE',
                    'image' => (isset($lien) && $lien ? '<img src="'.$lien.'" width="200px" height="auto" />': false),
                ]
            ],
            'submit' => [
                'title' => $this->l('Enregistrer'),
                'class' => 'btn btn default pull-right',
            ],
        ];

        //création du formulaire
        $helper = new HelperForm();
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
        $helper->default_form_language = (int)Configuration::get('PS_LANG_DEFAULT');
        $helper->title = $this->displayName;
        $helper->submit_action = 'submit_jsmodulome';

        //remplissage des champs avec les données dans la bdd
        $helper->fields_value['DISPLAY'] = Tools::getValue('DISPLAY', Configuration::get('DISPLAY'));
        $helper->fields_value['IMAGE_FORMULAIRE'] = Tools::getValue('IMAGE_FORMULAIRE', Configuration::get('IMAGE_FORMULAIRE'));


        //génération du formulaire
        return $helper->generateForm($form_configuration);
    }

    public function hookdisplayHeader()
    {

        $params = [
            'nom1' => "1",
            'nom2' => "2"
        ];
        $lien = $this->context->link->getModuleLink('js_modulome', 'formulaire', $params);
        if(Configuration::get('DISPLAY')){
            $this->context->smarty->assign(
                [
                    'lien' => $lien,
                ]
            );
        }
        return $this->display(__FILE__, 'banner.tpl');
    }

    public function hookActionFrontControllerSetMedia()
    {
        $this->context->controller->registerJavascript('module-module-js', 'modules/'.$this->name.'/views/assets/js/modulome.js', [
            'priority' => 200,
            'postion' => 'bottom',
            ] 
        );
    
    }


}