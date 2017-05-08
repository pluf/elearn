<?php
return array(
    // ************************************************************* Domain
    array( // Create
        'regex' => '#^/domain/new$#',
        'model' => 'Pluf_Views',
        'method' => 'createObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'EEE_Domain'
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Find
        'regex' => '#^/domain/find$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'EEE_Domain',
            'listFilters' => array(
                'id',
                'title'
            ),
            '$searchFields' => array(
                'title',
                'description'
            ),
            'sortFields' => array(
                'id',
                'title',
                'creation_date',
                'modif_dtime'
            )
        )
    ),
    array( // Get information
        'regex' => '#^/domain/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'EEE_Domain'
        )
    ),
    array( // Delete
        'regex' => '#^/domain/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObject',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'EEE_Domain',
            'permanently' => true
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Update
        'regex' => '#^/domain/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'updateObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'EEE_Domain'
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    // ************************************************************* Topics of Domain
    array( // Find Topics of Domain
        'regex' => '#^/domain/(?P<domainId>\d+)/topic/find$#',
        'model' => 'EEE_Views_Topic',
        'method' => 'find',
        'http-method' => 'GET'
    ),
    array( // Create new Topic in Domain
        'regex' => '#^/domain/(?P<domainId>\d+)/topic/new$#',
        'model' => 'EEE_Views_Topic',
        'method' => 'create',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'EEE_Topic'
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Get information
        'regex' => '#^/domain/(?P<domainId>\d+)/topic/(?P<topicId>\d+)$#',
        'model' => 'EEE_Views_Topic',
        'method' => 'get',
        'http-method' => 'GET'
    ),
    array( // Update a Topic of Domain
        'regex' => '#^/domain/(?P<domainId>\d+)/topic/(?P<modelId>\d+)$#',
        'model' => 'EEE_Views_Topic',
        'method' => 'update',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'EEE_Topic'
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Remove a Topic
        'regex' => '#^/domain/(?P<domainId>\d+)/topic/(?P<topicId>\d+)$#',
        'model' => 'EEE_Views_Topic',
        'method' => 'remove',
        'http-method' => 'DELETE',
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Remove a Topic
        'regex' => '#^/domain/(?P<domainId>\d+)/topic$#',
        'model' => 'EEE_Views_Topic',
        'method' => 'remove',
        'http-method' => 'DELETE',
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    // ************************************************************* Topics
    array( // Find Topics
        'regex' => '#^/topic/find$#',
        'model' => 'EEE_Views_Topic',
        'method' => 'find',
        'http-method' => 'GET'
    ),
    array( // Create new Topic
        'regex' => '#^/topic/new$#',
        'model' => 'EEE_Views_Topic',
        'method' => 'create',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'EEE_Topic'
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Get information
        'regex' => '#^/topic/(?P<topicId>\d+)$#',
        'model' => 'EEE_Views_Topic',
        'method' => 'get',
        'http-method' => 'GET'
    ),
    array( // Update Topic
        'regex' => '#^/topic/(?P<modelId>\d+)$#',
        'model' => 'EEE_Views_Topic',
        'method' => 'update',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'EEE_Topic'
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Remove Topic
        'regex' => '#^/topic/(?P<topicId>\d+)$#',
        'model' => 'EEE_Views_Topic',
        'method' => 'remove',
        'http-method' => 'DELETE',
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    // ************************************************************* Course of Topic
    array( // Find Course of Topic
        'regex' => '#^/topic/(?P<topicId>\d+)/course/find$#',
        'model' => 'EEE_Views_Course',
        'method' => 'find',
        'http-method' => 'GET'
    ),
    array( // Create new Course in Topic
        'regex' => '#^/topic/(?P<topicId>\d+)/course/new$#',
        'model' => 'EEE_Views_Course',
        'method' => 'create',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'EEE_Course'
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Get information
        'regex' => '#^/topic/(?P<topicId>\d+)/course/(?P<courseId>\d+)$#',
        'model' => 'EEE_Views_Course',
        'method' => 'get',
        'http-method' => 'GET'
    ),
    array( // Update a Course of Topic
        'regex' => '#^/topic/(?P<topicId>\d+)/course/(?P<modelId>\d+)$#',
        'model' => 'EEE_Views_Course',
        'method' => 'update',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'EEE_Course'
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Remove a Course
        'regex' => '#^/topic/(?P<topicId>\d+)/course/(?P<courseId>\d+)$#',
        'model' => 'EEE_Views_Course',
        'method' => 'remove',
        'http-method' => 'DELETE',
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Remove a Course
        'regex' => '#^/topic/(?P<topicId>\d+)/course$#',
        'model' => 'EEE_Views_Course',
        'method' => 'remove',
        'http-method' => 'DELETE',
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    // ************************************************************* Course
    array( // Find Course
        'regex' => '#^/course/find$#',
        'model' => 'EEE_Views_Course',
        'method' => 'find',
        'http-method' => 'GET'
    ),
    array( // Create new Course
        'regex' => '#^/course/new$#',
        'model' => 'EEE_Views_Course',
        'method' => 'create',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'EEE_Course'
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Get information
        'regex' => '#^/course/(?P<courseId>\d+)$#',
        'model' => 'EEE_Views_Course',
        'method' => 'get',
        'http-method' => 'GET'
    ),
    array( // Update Course
        'regex' => '#^/course/(?P<modelId>\d+)$#',
        'model' => 'EEE_Views_Course',
        'method' => 'update',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'EEE_Course'
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Remove Course
        'regex' => '#^/course/(?P<courseId>\d+)$#',
        'model' => 'EEE_Views_Course',
        'method' => 'remove',
        'http-method' => 'DELETE',
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    // ************************************************************* Lesson of Course
    array( // Find Lesson of Course
        'regex' => '#^/course/(?P<courseId>\d+)/lesson/find$#',
        'model' => 'EEE_Views_Lesson',
        'method' => 'find',
        'http-method' => 'GET'
    ),
    array( // Create new Lesson in Course
        'regex' => '#^/course/(?P<courseId>\d+)/lesson/new$#',
        'model' => 'EEE_Views_Lesson',
        'method' => 'create',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'EEE_Lesson'
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Get information
        'regex' => '#^/course/(?P<courseId>\d+)/lesson/(?P<lessonId>\d+)$#',
        'model' => 'EEE_Views_Lesson',
        'method' => 'get',
        'http-method' => 'GET'
    ),
    array( // Update a Lesson of Course
        'regex' => '#^/course/(?P<courseId>\d+)/lesson/(?P<modelId>\d+)$#',
        'model' => 'EEE_Views_Lesson',
        'method' => 'update',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'EEE_Lesson'
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Remove a Lesson
        'regex' => '#^/course/(?P<courseId>\d+)/lesson/(?P<lessonId>\d+)$#',
        'model' => 'EEE_Views_Lesson',
        'method' => 'remove',
        'http-method' => 'DELETE',
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Remove a Lesson
        'regex' => '#^/course/(?P<courseId>\d+)/lesson$#',
        'model' => 'EEE_Views_Lesson',
        'method' => 'remove',
        'http-method' => 'DELETE',
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    // ************************************************************* Lesson
    array( // Find Lesson
        'regex' => '#^/lesson/find$#',
        'model' => 'EEE_Views_Lesson',
        'method' => 'find',
        'http-method' => 'GET'
    ),
    array( // Create new Lesson
        'regex' => '#^/lesson/new$#',
        'model' => 'EEE_Views_Lesson',
        'method' => 'create',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'EEE_Lesson'
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Get information
        'regex' => '#^/lesson/(?P<lessonId>\d+)$#',
        'model' => 'EEE_Views_Lesson',
        'method' => 'get',
        'http-method' => 'GET'
    ),
    array( // Update Lesson
        'regex' => '#^/lesson/(?P<modelId>\d+)$#',
        'model' => 'EEE_Views_Lesson',
        'method' => 'update',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'EEE_Lesson'
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Remove Lesson
        'regex' => '#^/lesson/(?P<lessonId>\d+)$#',
        'model' => 'EEE_Views_Lesson',
        'method' => 'remove',
        'http-method' => 'DELETE',
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    // ************************************************************* Part of Lesson
    array( // Find Part of Lesson
        'regex' => '#^/lesson/(?P<lessonId>\d+)/part/find$#',
        'model' => 'EEE_Views_Part',
        'method' => 'find',
        'http-method' => 'GET'
    ),
    array( // Create new Part in Lesson
        'regex' => '#^/lesson/(?P<lessonId>\d+)/part/new$#',
        'model' => 'EEE_Views_Part',
        'method' => 'create',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'EEE_Part'
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Get information
        'regex' => '#^/lesson/(?P<lessonId>\d+)/part/(?P<partId>\d+)$#',
        'model' => 'EEE_Views_Part',
        'method' => 'get',
        'http-method' => 'GET'
    ),
    array( // Update a Part of Lesson
        'regex' => '#^/lesson/(?P<lessonId>\d+)/part/(?P<partId>\d+)$#',
        'model' => 'EEE_Views_Part',
        'method' => 'update',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'EEE_Part'
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Remove a Part
        'regex' => '#^/lesson/(?P<lessonId>\d+)/part/(?P<partId>\d+)$#',
        'model' => 'EEE_Views_Part',
        'method' => 'remove',
        'http-method' => 'DELETE',
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Remove a Part
        'regex' => '#^/lesson/(?P<lessonId>\d+)/part$#',
        'model' => 'EEE_Views_Part',
        'method' => 'remove',
        'http-method' => 'DELETE',
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    // Download Part content
    array(
        'regex' => '#^/lesson/(?P<lessonId>\d+)/part/(?P<partId>\d+)/content$#',
        'model' => 'EEE_Views_Part',
        'method' => 'download',
        'http-method' => 'GET',
        // Cache apram
        'cacheable' => true,
        'revalidate' => true,
        'intermediate_cache' => true,
        'max_age' => 25000
    ),
    // ************************************************************* Part
    array( // Find Part
        'regex' => '#^/part/find$#',
        'model' => 'EEE_Views_Part',
        'method' => 'find',
        'http-method' => 'GET'
    ),
    array( // Create new Part
        'regex' => '#^/part/new$#',
        'model' => 'EEE_Views_Part',
        'method' => 'create',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'EEE_Part'
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Get information
        'regex' => '#^/part/(?P<partId>\d+)$#',
        'model' => 'EEE_Views_Part',
        'method' => 'get',
        'http-method' => 'GET'
    ),
    array( // Update a Part
        'regex' => '#^/part/(?P<modelId>\d+)$#',
        'model' => 'EEE_Views_Part',
        'method' => 'update',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'EEE_Part'
        ),
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    array( // Remove a Part
        'regex' => '#^/part/(?P<partId>\d+)$#',
        'model' => 'EEE_Views_Part',
        'method' => 'remove',
        'http-method' => 'DELETE',
        'precond' => array(
            'Pluf_Precondition::loginRequired',
            'Pluf_Precondition::memberRequired'
        )
    ),
    // Download Part content
    array(
        'regex' => '#^/part/(?P<partId>\d+)/content$#',
        'model' => 'EEE_Views_Part',
        'method' => 'download',
        'http-method' => 'GET',
        // Cache apram
        'cacheable' => true,
        'revalidate' => true,
        'intermediate_cache' => true,
        'max_age' => 25000
    )
);
