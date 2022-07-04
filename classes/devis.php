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
}
