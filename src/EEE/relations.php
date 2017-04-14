<?php
return array(
    'EEE_Domain' => array(
        'relate_to' => array()
    ),
    'EEE_Topic' => array(
        'relate_to' => array(
            'EEE_Domain',
            'Pluf_User'
        )
    ),
    'EEE_Course' => array(
        'relate_to' => array(
            'EEE_Topic'
        ),
        'relate_to_many' => array(
            'Pluf_User'
        )
    ),
    'EEE_Grade' => array(
        'relate_to_many' => array(
            'EEE_Course'
        )
    ),
    'EEE_Lesson' => array(
        'relate_to' => array(
            'EEE_Course'
        )
    ),
    'EEE_Part' => array(
        'relate_to' => array(
            'EEE_Lesson'
        ),
        'relate_to_many' => array(
            'CMS_Content'
        )
    ),
    'EEE_PartHistory' => array(
        'relate_to' => array(
            'EEE_Part',
            'Pluf_User'
        )
    ),
    'EEE_Comment' => array(
        'relate_to' => array(
            'Pluf_User'
        )
    ),
    'EEE_Vote' => array(
        'relate_to' => array(
            'EEE_Comment',
            'Pluf_User'
        )
    )

);
