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
        || !$this->installTab()
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
            id_modulome_category INT(11) NOT NULL AUTO_INCREMENT,
            cat_name TEXT NOT NULL,
            PRIMARY KEY(id_modulome_category)
        )ENGINE = '._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;
        CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'modulome_devis (
            id_modulome_devis INT(11) NOT NULL AUTO_INCREMENT,
            id_modulome INT(11) NOT NULL,
            cust_id INT(11) NOT NULL,
            equiped_kitchen TINYINT,
            PRIMARY KEY(id_modulome_devis)
            )ENGINE = '._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;
        CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'modulome (
            id_modulome INT(11) NOT NULL AUTO_INCREMENT,
            modulome_cat_id INT(11) NOT NULL,
            modulome_size INT(11) NOT NULL,
            modulome_price TEXT NOT NULL,
            modulome_name TEXT NOT NULL,
            modulome_image TEXT NOT NULL,
            PRIMARY KEY(id_modulome)
        )ENGINE = '._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;
        INSERT INTO '._DB_PREFIX_.'modulome_category (cat_name) VALUES ("salle de bains"), ("pièce à vivre"), ("salle d\'eau"), ("chambre"), ("salon"), ("cuisine"), ("kitchenOption"), ("bathroomOption");
        INSERT INTO '._DB_PREFIX_.'modulome (modulome_cat_id, modulome_size, modulome_price, modulome_name, modulome_image) VALUES 
            (4, 10, 10, "modulome B10", "bedroom10squarefeet"),
            (4, 15, 15, "modulome B15", "bedroom15squarefeet"),
            (4, 20, 20, "modulome B20", "bedroom20squarefeet"),
            (1, 8, 15000, "modulome Bath-A", "bathroomwithtoilet"),
            (3, 8, 15000, "modulome Bath-S", "bathseparatedtoilets"),
            (2, 30, 30, "modulome Living30", "livingroom30sqft"),
            (5, 30, 30, "modulome Living30", "30sqftliving"),
            (5, 40, 40, "modulome Living40", "40sqftliving"),
            (6, 10, 10, "modulome Kitchen-10", "10sqftkitchen"),
            (6, 15, 15, "modulome Kitchen-15", "15sqftkitchen"),
            (6, 20, 20, "modulome Kitchen-20", "20sqftkitchen"),
            (7, 20, 20, "modulome Kitchen-option", "20sqftkitchen"),
            (8, 10, 20, "modulome bathroom-option", "separatedToilets")
            
        ');
        return $sql;
    }

    public function installTab()
    {
        //fonction d'installation des onglets
        $parent_tab = new Tab();
        $parent_tab->name = array();
        foreach (Language::getLanguages() as $language) {
            $parent_tab->name[$language['id_lang']] = $this->l('Gestion de modulome');
        }
        $parent_tab->class_name = 'AdminMainModulome'; // pas besoin de créer admincontroller
        $parent_tab->id_parent = 0;
        $parent_tab->module = $this->name;
        $parent_tab->add();

        $tab1 = new Tab();
        $tab1->name = array();
        foreach (Language::getLanguages() as $language) {
            $tab1->name[$language['id_lang']] = $this->l('Gérer les modules');
        }
        $tab1->class_name = 'AdminModulome';
        $tab1->id_parent = $parent_tab->id;
        $tab1->module = $this->name;

        $tab2 = new Tab();
        $tab2->name = array();
        foreach (Language::getLanguages() as $language) {
            $tab2->name[$language['id_lang']] = $this->l('Gérer les devis');
        }
        $tab2->class_name = 'devisModulome';
        $tab2->id_parent = $parent_tab->id;
        $tab2->module = $this->name;

        return $tab1->add() && $tab2->add();

    }

    public function uninstall()
    {
        //supprimer les champs de configurations
        Configuration::deleteByName('DISPLAY');
        Configuration::deleteByName('IMAGE_FORMULAIRE');
        //supprime les bases de données associées au module
        Db::getInstance()->execute('
            DROP TABLE IF EXISTS '._DB_PREFIX_.'modulome_category;
            DROP TABLE IF EXISTS '._DB_PREFIX_.'modulome; 
            DROP TABLE IF EXISTS '._DB_PREFIX_.'modulome_devis;
        ');
        //supression des onglets
        $tabMain = new Tab((int)Tab::getIdFromClassName('AdminMainPersonnalisation'));
        $tabMain->delete();
        $tabMain = new Tab((int)Tab::getIdFromClassName('AdminModulome'));
        $tabMain->delete();
        $tabMain = new Tab((int)Tab::getIdFromClassName('devisModulome'));
        $tabMain->delete();

        return parent::uninstall();
    }

    public function getContent()
    {
        $output = "";
        if(Tools::isSubmit('submit_jsmodulome'))
        {
            //Champ d'affichage ou non du formulaire
            $display = Tools::getValue('DISPLAY');

            if((empty($display) || $display) && Validate::isBool($display)){
                Configuration::updateValue('DISPLAY', $display);
                $output .= $this->displayConfirmation('La donnée du champ "DISPLAY" à bien été enregistrée');
            }else{
                $output .= $this->displayError('Une erreur est survenue, merci de ré-essayer.');
            }
            //
            $image = Tools::getValue('IMAGE_FORMULAIRE');
            if($image || !empty($image) && Validate::isImageTypeName($image))
            {
                if(!move_uploaded_file($_FILES['IMAGE_FORMULAIRE']['tmp_name'], dirname(__FILE__).'/views/images/'.$image))
                {
                    Configuration::updateValue('IMAGE_FORMULAIRE', $image);
                    $output .= $this->displayConfirmation('C\'est bien enregistré tqt');
                }else{
                    $output .= $this->displayError('L\'image n\'a pas pû être enregistrée.');
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
            'legend' =>['title' => $this->l('Setting')],//la fonction l($string permet de gérer les traductions)
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
            'submit' => ['title' => $this->l('Enregistrer'),'class' => 'btn btn default pull-right'],
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
        //affichage du lien dirigeant vers le formulaire
        $lien = $this->context->link->getModuleLink('js_modulome', 'formulaire');
        //verification si la configuration autorise
        if(Configuration::get('DISPLAY')){
            $this->context->smarty->assign('lien', $lien);
        }
        return $this->display(__FILE__, 'banner.tpl');
    }
}