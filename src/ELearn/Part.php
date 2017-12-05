<?php

class ELearn_Part extends Pluf_Model
{

    /**
     * @brief مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'elearn_part';
        $this->_a['verbose'] = 'ELearn_Part';
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Pluf_DB_Field_Sequence',
                'blank' => false,
                'editable' => false,
                'readable' => true
            ),
            'order' => array(
                'type' => 'Pluf_DB_Field_Integer',
                'editable' => true,
                'readable' => true
            ),
            /*'name' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => false,
                'size' => 100,
                'editable' => true,
                'readable' => true
            ),*/
            'title' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'size' => 250,
                'editable' => true,
                'readable' => true
            ),
            'description' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'size' => 1024,
                'editable' => true,
                'readable' => true
            ),
            'mime_type' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'size' => 100,
                'default' => 'application/octet-stream',
                'editable' => true,
                'readable' => true
            ),
            'file_path' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'size' => 250,
                'editable' => false,
                'readable' => false
            ),
            'file_name' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'size' => 250,
                'default' => 'noname',
                'editable' => false
            ),
            'file_size' => array(
                'type' => 'Pluf_DB_Field_Integer',
                'blank' => true,
                'editable' => false
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
            // relations
            'lesson' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'ELearn_Lesson',
                'blank' => false,
                'relate_name' => 'lesson',
                'editable' => true,
                'readable' => true
            ),
            'attachments' => array(
                'type' => 'Pluf_DB_Field_Manytomany',
                'model' => 'CMS_Content',
                'relate_name' => 'attachments',
                'editable' => true,
                'readable' => true
            )
        );
        
        $this->_a['idx'] = array(
            'part_name_idx' => array(
                'col' => 'name',
                'type' => 'normal', // normal, unique, fulltext, spatial
                'index_type' => '', // hash, btree
                'index_option' => '',
                'algorithm_option' => '',
                'lock_option' => ''
            ),
            'part_mime_type_idx' => array(
                'col' => 'mime_type',
                'type' => 'normal', // normal, unique, fulltext, spatial
                'index_type' => '', // hash, btree
                'index_option' => '',
                'algorithm_option' => '',
                'lock_option' => ''
            )
        );
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
        // File path
        $path = $this->getAbsloutPath();
        // file size
        if (file_exists($path)) {
            $this->file_size = filesize($path);
        } else {
            $this->file_size = 0;
        }
        // mime type (based on file name)
        $fileInfo = Pluf_FileUtil::getMimeType($this->file_name);
        $this->mime_type = $fileInfo[0];
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
        // remove related file
        unlink($this->file_path . '/' . $this->id);
    }
    
    /**
     * مسیر کامل محتوی را تعیین می‌کند.
     *
     * @return string
     */
    public function getAbsloutPath ()
    {
        return $this->file_path . '/' . $this->id;
    }
}
