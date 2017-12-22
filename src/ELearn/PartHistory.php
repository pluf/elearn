<?php

class ELearn_PartHistory extends Pluf_Model
{

    /**
     * @brief مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'elearn_parthistory';
        $this->_a['verbose'] = 'ELearn_PartHistory';
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Pluf_DB_Field_Sequence',
                'blank' => false,
                'editable' => false,
                'readable' => true
            ),
            'correct' => array(
                'type' => 'Pluf_DB_Field_Integer',
                'editable' => true,
                'readable' => true
            ),
            'total' => array(
                'type' => 'Pluf_DB_Field_Integer',
                'editable' => true,
                'readable' => true
            ),
            'creation_dtime' => array(
                'type' => 'Pluf_DB_Field_Datetime',
                'blank' => true,
                'editable' => false,
                'readable' => true
            ),
            // relations
            'user' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'User',
                'blank' => false,
                'relate_name' => 'user',
                'editable' => false,
                'readable' => true
            ),
            'part' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'ELearn_Part',
                'blank' => false,
                'relate_name' => 'part',
                'editable' => false,
                'readable' => true
            )
        );
        
//         $this->_a['idx'] = array(
//             'page_class_idx' => array(
//                 'col' => 'title',
//                 'type' => 'unique', // normal, unique, fulltext, spatial
//                 'index_type' => '', // hash, btree
//                 'index_option' => '',
//                 'algorithm_option' => '',
//                 'lock_option' => ''
//             )
//         );
    }

    /**
     * \brief پیش ذخیره را انجام می‌دهد
     *
     * @param $create حالت
     *            ساخت یا به روز رسانی را تعیین می‌کند
     */
    function preSave($create = false)
    {
        if ($this->id == '') {
            $this->creation_dtime = gmdate('Y-m-d H:i:s');
        }
    }

    /**
     * حالت کار ایجاد شده را به روز می‌کند
     *
     * @see Pluf_Model::postSave()
     */
    function postSave($create = false)
    {
        //
    }

    /**
     * \brief عملیاتی که قبل از پاک شدن است انجام می‌شود
     *
     * عملیاتی که قبل از پاک شدن است انجام می‌شود
     * در این متد فایل مربوط به است حذف می شود. این عملیات قابل بازگشت نیست
     */
    function preDelete()
    {
       //
    }
}
