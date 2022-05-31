<?php 

class Devis extends ObjectModel
{
    public static $definition = 
    [
        'table' => 'modulome',
        'primary' => 'id_modulome',
        'multilang' => false,
        'fields' => 
        [
            'id_modulome_devis' => 
            [
                'type' => self::TYPE_HTML,
                'validate' => 'isInt',
                'required' => true
            ],
            'nbBedrooms' => 
            [
                'type' => self::TYPE_HTML,
                'validate' => 'isInt',
                'required' => true
            ],
            'bedRoom1Size' =>
            [
                'type' => self::TYPE_HTML,
                'validate' => 'isInt',
                'required' => true
            ],
            'bedRoom2Size' =>
            [
                'type' => self::TYPE_HTML,
                'validate' => 'isInt'
            ],
            'bedRoom3Size' =>
            [
                'type' => self::TYPE_HTML,
                'validate' => 'isInt'
            ],
            'bedRoom4Size' =>
            [
                'type' => self::TYPE_HTML,
                'validate' => 'isInt'
            ],
            'bedRoom5Size' =>
            [
                'type' => self::TYPE_HTML,
                'validate' => 'isInt'
            ],
            'livingRoomSize' =>
            [
                'type' => self::TYPE_HTML,
                'validate' => 'isInt',
                'required' => true
            ],
            'kitchenSize' => 
            [
                'type' => self::TYPE_HTML,
                'validate' => 'isInt',
            ],
            'nbBathrooms' => 
            [
                'type' => self::TYPE_HTML,
                'validate' => 'isInt',
                'required' => true
            ],
            'bathroomWithToilet' => 
            [
                'type' => self::TYPE_HTML,
                'validate' => 'isInt'
            ],
            'bathroomwithouttoilet' => 
            [
                'type' => self::TYPE_HTML,
                'validate' => 'isInt'
            ]
        ]
    ];

}
