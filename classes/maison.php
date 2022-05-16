<?php 

class Maison extends ObjectModel
{
    public static $definition = 
    [
        'table' => 'modulome',
        'primary' => 'id_modulome',
        'multilang' => false,
        'fields' => 
        [
            'modulome_cat_id' => 
            [
                'type' => self::TYPE_HTML,
                'validate' => 'isInt',
                'required' => true
            ],
            'modulome_size' => 
            [
                'type' => self::TYPE_HTML,
                'validate' => 'isInt',
                'required' => true
            ],
            'modulome_type' =>
            [
                'type' => self::TYPE_HTML,
                'validate' => 'isCleanHTML',
                'required' => true
            ],
            'modulome_name' => 
            [
                'type' => self::TYPE_HTML,
                'validate' => 'isCleanHTML',
                'required' => true
            ],
            'modulome_image' =>
            [
                'type' => self::TYPE_HTML,
                'validate' => 'isCleanHTML',
                'required' => true
            ]
        ]
    ];

    static function getSizes($catId)
    {
        $sql = new DbQuery();
        $sql->select('modulome_size')->from('modulome', fm)->where('modulome_cat_id = '.$catId);
        return $sql;
    }
}