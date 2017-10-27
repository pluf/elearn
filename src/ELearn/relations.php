<?php
return array(
    'ELearn_Domain' => array(
        'relate_to' => array()
    ),
    'ELearn_Topic' => array(
        'relate_to' => array(
            'ELearn_Domain',
            'Pluf_User'
        )
    ),
    'ELearn_Course' => array(
        'relate_to' => array(
            'ELearn_Topic'
        ),
        'relate_to_many' => array(
            'Pluf_User'
        )
    ),
    'ELearn_Grade' => array(
        'relate_to_many' => array(
            'ELearn_Course'
        )
    ),
    'ELearn_Lesson' => array(
        'relate_to' => array(
            'ELearn_Course'
        )
    ),
    'ELearn_Part' => array(
        'relate_to' => array(
            'ELearn_Lesson'
        ),
        'relate_to_many' => array(
            'CMS_Content'
        )
    ),
    'ELearn_PartHistory' => array(
        'relate_to' => array(
            'ELearn_Part',
            'Pluf_User'
        )
    ),
    'ELearn_Comment' => array(
        'relate_to' => array(
            'Pluf_User'
        )
    ),
    'ELearn_Vote' => array(
        'relate_to' => array(
            'ELearn_Comment',
            'Pluf_User'
        )
    )

);
