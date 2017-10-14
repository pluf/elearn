<?php

/**
 * 
 * @param string $title
 * @return ArrayObject of items or through an exception if database failure
 */
function ELearn_Shortcuts_GetTopicsByTitle($title)
{
    $q = new Pluf_SQL('title=%s', array(
        $title
    ));
    $item = new ELearn_Topic();
    $item = $item->getList(array(
        'filter' => $q->gen()
    ));
    return $item;
}

function ELearn_Shortcuts_NormalizeItemPerPage($request)
{
    $count = array_key_exists('_px_c', $request->REQUEST) ? intval($request->REQUEST['_px_c']) : 30;
    if ($count > 30)
        $count = 30;
    return $count;
}

/**
 * یک نام جدید را بررسی می‌کند.
 *
 * نام یک محتوی باید در یک ملک به صورت انحصاری تعیین شود. بنابر این روال
 * بررسی می‌کند که آیا محتویی هم نام با نام در نظر گرفته شده در ملک وجود دارد
 * یا نه.
 *
 * این فراخوانی در فرم‌ها کاربرد دارد.
 *
 * @param string $name            
 * @throws Pluf_Exception
 * @return string
 */
function ELearn_Shortcuts_CleanName($name)
{
    if ($name === 'new' || $name === 'find') {
        throw new Pluf_Exception(__('Part name must not be new, find'));
    }
    $q = new Pluf_SQL('name=%s', array(
        $name
    ));
    $items = Pluf::factory('ELearnPart')->getList(array(
        'filter' => $q->gen()
    ));
    if (! isset($items) || $items->count() == 0) {
        return $name;
    }
    throw new Pluf_Exception(sprintf(__('Part with the same name exist (name: %s'), $name));
}

/**
 * Get content based on name
 *
 * @param string $name
 * @throws CMS_Exception_ObjectNotFound
 * @return ArrayObject
 */
function ELearn_Shortcuts_GetPartByNameOr404 ($name)
{
    $q = new Pluf_SQL('name=%s', array(
        $name
    ));
    $item = new ELearn_Part();
    $item = $item->getList(
        array(
            'filter' => $q->gen()
        ));
    if (isset($item) && $item->count() == 1) {
        return $item[0];
    }
    if ($item->count() > 1) {
        Pluf_Log::error(
            sprintf(
                'more than one Part exist with the name $s', $name));
            return $item[0];
    }
    throw new Pluf_Exception_DoesNotExist("Part not found (Part name:" . $name . ")");
}

/**
 * 
 * @param Pluf_Model $model
 * @param array $filter
 * @param array $sort
 * @return array
 */
function ELearn_Shortcuts_FindAll($model, $filter, $sort){
    $items = $model->getList(
        array(
            'filter' => $filter,
            'sort' => $sort
        ));
    return $items;
}