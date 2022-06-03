<?php 

class Devis extends ObjectModel
{
    public static $definition = 
    [
        'table' => 'modulome_devis',
        'primary' => 'id_modulome_devis',
        'multilang' => false,
        'fields' => 
        [
            'id_modulome' => 
            [
                'type' => self::TYPE_INT,
                'validate' => 'isInt',
                'required' => true
            ],
            'cust_id' => 
            [
                'type' => self::TYPE_INT,
                'validate' => 'isInt',
                'required' => true
            ]
        ]
    ];

    static function saveItem($cust_id, $id_modulome)
    {
        foreach($bedroomSizes as $bedroomSize){
            Db::getInstance()->execute("
                INSERT INTO "._DB_PREFIX_."modulome_devis (id_modulome, cust_id) VALUES (".$cust_id.", ".$id_modulome.");
            ");
        }
    }

}
