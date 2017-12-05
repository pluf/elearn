<?php
Pluf::loadFunction('ELearn_Shortcuts_CleanName');

/**
 * ایجاد یک محتوای جدید
 *
 * با استفاده از این فرم می‌توان یک محتوای جدید را ایجاد کرد.
 *
 * @author hadi <mohammad.hadi.mansouri@dpq.co.ir>
 *        
 */
class ELearn_Form_PartCreate extends Pluf_Form_Model
{

    public $tenant = null;

    public $user = null;

    public function initFields($extra = array())
    {
        $this->tenant = Pluf_Tenant::current();
        $this->user = $extra['user'];
        parent::initFields($extra);
    }

    function save($commit = true)
    {
        if (! $this->isValid()) {
            throw new Pluf_Exception_Form('cannot save the Part from an invalid form', $this);
        }
        // Create the part
        $part = new ELearn_Part();
        $part->setFromFormData($this->cleaned_data);
        $part->file_path = Pluf::f('upload_path') . '/' . $this->tenant->id . '/part';
        if (! is_dir($part->file_path)) {
            if (false == @mkdir($part->file_path, 0777, true)) {
                throw new Pluf_Form_Invalid('An error occured when creating the upload path. Please try to send the file again.');
            }
        }
        if ($commit) {
            $part->create();
        }
        return $part;
    }
}
