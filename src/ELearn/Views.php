<?php

class ELearn_Views{
    
    /**
     * Return list of all instance of the data model defined in $p 
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @param array $p
     * @return Pluf_HTTP_Response_Json
     */
    public static function listAll($request, $match, $p){
        $model = self::getModel($p);
        $object = new $model();
        return new Pluf_HTTP_Response_Json($object->getList());
    }
    
    // TODO: hadi, 2017: document
    private static function getModel ($p)
    {
        if (! isset($p['model'])) {
            throw new Exception(
                'The model class was not provided in the parameters.');
        }
        return $p['model'];
    }
    
}