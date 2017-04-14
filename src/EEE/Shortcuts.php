<?php

/**
 * 
 * @param string $title
 * @return ArrayObject of items or through an exception if database failure
 */
function EEE_Shortcuts_GetTopicsByTitle($title)
{
    $q = new Pluf_SQL('title=%s', array(
        $title
    ));
    $item = new EEE_Topic();
    $item = $item->getList(array(
        'filter' => $q->gen()
    ));
    return $item;
}

function EEE_Shortcuts_NormalizeItemPerPage($request)
{
    $count = array_key_exists('_px_c', $request->REQUEST) ? intval($request->REQUEST['_px_c']) : 30;
    if ($count > 30)
        $count = 30;
    return $count;
}
