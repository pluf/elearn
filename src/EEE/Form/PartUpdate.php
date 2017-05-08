<?php

/**
 * به روزرسانی یک محتوا
 *
 * با استفاده از این فرم می‌توان اطلاعات یک محتوا را به روزرسانی کرد.
 *
 * @author hadi <mohammad.hadi.mansouri@dpq.co.ir>
 *        
 */
class EEE_Form_PartUpdate extends Pluf_Form_Model
{

    public function initFields($extra = array())
    {
        // set lesson field as not required
        $this->model = $extra['model'];
        $this->model->_a['cols']['lesson']['blank'] = true;
        
        parent::initFields($extra);
        
        $this->fields['file'] = new Pluf_Form_Field_File(array(
            'required' => false,
            'max_size' => Pluf::f('upload_max_size', 2097152),
            'move_function_params' => array(
                'upload_path' => $this->model->file_path,
                'file_name' => $this->model->id,
                'upload_path_create' => true,
                'upload_overwrite' => true
            )
        ));
    }

    public function clean_name()
    {
        $name = $this->cleaned_data['name'];
        if (empty($name))
            return null;
            // Note: If old name is same as new name we do not check uniqueness
            // of the name.
        if (strcmp($name, $this->model->name) === 0) {
            return $name;
        }
        return EEE_Shortcuts_CleanName($name);
    }
    

    /**
     *
     * {@inheritdoc}
     *
     * @see Pluf_Form_Model::save()
     */
    function save($commit = true)
    {
        $model = parent::save(false);
        // update the content
        if (array_key_exists('file', $this->cleaned_data)) {
            // Extract information of file
            $myFile = $this->data['file'];
            $model->file_name = $myFile['name'];
        }
        if ($commit) {
            $model->update();
        }
        return $model;
    }
}
