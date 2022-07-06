<?php 

class devisModulomeController extends ModuleAdminController
{

    public function __construct()
    {
        $this->table = "modulome";
        $this->className = "Maison";
        $this->bootstrap = true;

        parent::__construct();

        $this->fields_list = 
        [
            'cust_id' => 
            [
                'title' => 'identité du client',
                /*'callback' => 'getClient'*/
            ],
            'id_modulome' => 
            [
                'title' => 'Nom du modulome',
                'callback' => 'getModulomeName'
            ],
            'equiped_kitchen' =>
            [
                'title' => "Cuisine équipée",
                'callback' => 'yesno'
            ]
        ];
        $this->addRowAction('delete');
    }

    /**
     *
     * @param int $id 
     *                     
     * @return varchar $modulome_name
     */

    public function getModulomeName($id)
    {
        $nameQuery = new DbQuery;
        $nameQuery->select('modulome_name')->from('modulome')->where('id_modulome = '.$id);
        $modulomeName = Db::getInstance()->getRow($nameQuery);
        return $modulomeName['modulome_name'];
    }

    public function yesno($val)
    {
        if($val == 1){
            return "Oui";
        }else{
            return "Non";
        }
    }

    /**
     *
     * @param int $id 
     *                     
     * @return varchar $custName
     * 
     */

    public function getClient($id)
    {
        $customerQuery = new DbQuery();
        $customerQuery->select('firstname, lastname')->from('customer')->where('id = '.$id);
        $test = Db::getInstance()->getRow($test);
        return $test;
        Tools::dieObject($test);
    }
}
