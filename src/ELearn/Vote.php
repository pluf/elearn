<?php

class ELearn_Vote extends Pluf_Model
{

    /**
     * @brief مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'elearn_vote';
        $this->_a['verbose'] = 'ELearn_Vote';
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Pluf_DB_Field_Sequence',
                'blank' => false,
                'editable' => false,
                'readable' => true
            ),
            'vote' => array(
                'type' => 'Pluf_DB_Field_Boolean',
                'editable' => true,
                'readable' => true
            ),
            'creation_dtime' => array(
                'type' => 'Pluf_DB_Field_Datetime',
                'blank' => true,
                'editable' => false
            ),
            'modif_dtime' => array(
                'type' => 'Pluf_DB_Field_Datetime',
                'blank' => true,
                'editable' => false
            ),
            'model_id' => array(
                'type' => 'Pluf_DB_Field_Integer',
                'blank' => false,
                'editable' => true,
                'readable' => true
            ),
            'model_class' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => false,
                'size' => 50,
                'editable' => true,
                'readable' => true
            ),
            // relations
            'comment' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'ELearn_Comment',
                'blank' => false,
                'relate_name' => 'comment',
                'editable' => true,
                'readable' => true
            ),
            'user' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'User',
                'blank' => false,
                'relate_name' => 'user',
                'editable' => true,
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
        $this->modif_dtime = gmdate('Y-m-d H:i:s');
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
