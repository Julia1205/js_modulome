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
            modulome_type TEXT NOT NULL,
            modulome_name TEXT NOT NULL,
            modulome_image TEXT NOT NULL,
            PRIMARY KEY(id_modulome),
            CONSTRAINT FK_cat FOREIGN KEY (modulome_cat_id) REFERENCES '._DB_PREFIX_.'modulome_category(id_modulome_category)
            )ENGINE = '._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;
        ');
        return $sql;
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

        }
        return $output.$this->displayForm();
    }


    public function displayForm()
    {
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
                    'lien' => $lien
                ]
            );
        }
        return $this->display(__FILE__, 'banner.tpl');
    }

    public function hookActionFrontControllerSetMedia()
    {
        $css = $this->context->controller->registerJavascript('module-module-js', 'modules/'.$this->name.'/views/assets/js/modulome.js' );
        
    }


}