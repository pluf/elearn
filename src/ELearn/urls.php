<?php
return array(
    // ************************************************************* Domain
    array( // Create
        'regex' => '#^/domain/new$#',
        'model' => 'Pluf_Views',
        'method' => 'createObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'ELearn_Domain'
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    array( // Find
        'regex' => '#^/domain/find$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'ELearn_Domain',
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
    array( // List All Domains
        'regex' => '#^/domain/list$#',
        'model' => 'ELearn_Views',
        'method' => 'listAll',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'ELearn_Domain'
        )
    ),
    array( // Get information
        'regex' => '#^/domain/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'ELearn_Domain'
        )
    ),
    array( // Delete
        'regex' => '#^/domain/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObject',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'ELearn_Domain',
            'permanently' => true
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    array( // Update
        'regex' => '#^/domain/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'updateObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'ELearn_Domain'
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    // ************************************************************* Topics of Domain
    array( // Find Topics of Domain
        'regex' => '#^/domain/(?P<domainId>\d+)/topic/find$#',
        'model' => 'ELearn_Views_Topic',
        'method' => 'find',
        'http-method' => 'GET'
    ),
    array( // Create new Topic in Domain
        'regex' => '#^/domain/(?P<domainId>\d+)/topic/new$#',
        'model' => 'ELearn_Views_Topic',
        'method' => 'create',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'ELearn_Topic'
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    array( // Get information
        'regex' => '#^/domain/(?P<domainId>\d+)/topic/(?P<topicId>\d+)$#',
        'model' => 'ELearn_Views_Topic',
        'method' => 'get',
        'http-method' => 'GET'
    ),
    array( // Update a Topic of Domain
        'regex' => '#^/domain/(?P<domainId>\d+)/topic/(?P<modelId>\d+)$#',
        'model' => 'ELearn_Views_Topic',
        'method' => 'update',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'ELearn_Topic'
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    array( // Remove a Topic
        'regex' => '#^/domain/(?P<domainId>\d+)/topic/(?P<topicId>\d+)$#',
        'model' => 'ELearn_Views_Topic',
        'method' => 'remove',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    array( // Remove a Topic
        'regex' => '#^/domain/(?P<domainId>\d+)/topic$#',
        'model' => 'ELearn_Views_Topic',
        'method' => 'remove',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    // ************************************************************* Topics
    array( // Find Topics
        'regex' => '#^/topic/find$#',
        'model' => 'ELearn_Views_Topic',
        'method' => 'find',
        'http-method' => 'GET'
    ),
    array( // List All Topics
        'regex' => '#^/topic/list$#',
        'model' => 'ELearn_Views',
        'method' => 'listAll',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'ELearn_Topic'
        )
    ),
    array( // Create new Topic
        'regex' => '#^/topic/new$#',
        'model' => 'ELearn_Views_Topic',
        'method' => 'create',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'ELearn_Topic'
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    array( // Get information
        'regex' => '#^/topic/(?P<topicId>\d+)$#',
        'model' => 'ELearn_Views_Topic',
        'method' => 'get',
        'http-method' => 'GET'
    ),
    array( // Update Topic
        'regex' => '#^/topic/(?P<modelId>\d+)$#',
        'model' => 'ELearn_Views_Topic',
        'method' => 'update',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'ELearn_Topic'
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    array( // Remove Topic
        'regex' => '#^/topic/(?P<topicId>\d+)$#',
        'model' => 'ELearn_Views_Topic',
        'method' => 'remove',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    // ************************************************************* Course of Topic
    array( // Find Course of Topic
        'regex' => '#^/topic/(?P<topicId>\d+)/course/find$#',
        'model' => 'ELearn_Views_Course',
        'method' => 'find',
        'http-method' => 'GET'
    ),
    array( // Create new Course in Topic
        'regex' => '#^/topic/(?P<topicId>\d+)/course/new$#',
        'model' => 'ELearn_Views_Course',
        'method' => 'create',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'ELearn_Course'
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    array( // Get information
        'regex' => '#^/topic/(?P<topicId>\d+)/course/(?P<courseId>\d+)$#',
        'model' => 'ELearn_Views_Course',
        'method' => 'get',
        'http-method' => 'GET'
    ),
    array( // Update a Course of Topic
        'regex' => '#^/topic/(?P<topicId>\d+)/course/(?P<modelId>\d+)$#',
        'model' => 'ELearn_Views_Course',
        'method' => 'update',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'ELearn_Course'
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    array( // Remove a Course
        'regex' => '#^/topic/(?P<topicId>\d+)/course/(?P<courseId>\d+)$#',
        'model' => 'ELearn_Views_Course',
        'method' => 'remove',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    array( // Remove a Course
        'regex' => '#^/topic/(?P<topicId>\d+)/course$#',
        'model' => 'ELearn_Views_Course',
        'method' => 'remove',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    // ************************************************************* Course
    array( // Find Course
        'regex' => '#^/course/find$#',
        'model' => 'ELearn_Views_Course',
        'method' => 'find',
        'http-method' => 'GET'
    ),
    array( // List All Courses
        'regex' => '#^/course/list$#',
        'model' => 'ELearn_Views',
        'method' => 'listAll',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'ELearn_Course'
        )
    ),
    array( // Create new Course
        'regex' => '#^/course/new$#',
        'model' => 'ELearn_Views_Course',
        'method' => 'create',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'ELearn_Course'
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    array( // Get information
        'regex' => '#^/course/(?P<courseId>\d+)$#',
        'model' => 'ELearn_Views_Course',
        'method' => 'get',
        'http-method' => 'GET'
    ),
    array( // Update Course
        'regex' => '#^/course/(?P<modelId>\d+)$#',
        'model' => 'ELearn_Views_Course',
        'method' => 'update',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'ELearn_Course'
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    array( // Remove Course
        'regex' => '#^/course/(?P<courseId>\d+)$#',
        'model' => 'ELearn_Views_Course',
        'method' => 'remove',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    // ************************************************************* Lesson of Course
    array( // Find Lesson of Course
        'regex' => '#^/course/(?P<courseId>\d+)/lesson/find$#',
        'model' => 'ELearn_Views_Lesson',
        'method' => 'find',
        'http-method' => 'GET'
    ),
    array( // Create new Lesson in Course
        'regex' => '#^/course/(?P<courseId>\d+)/lesson/new$#',
        'model' => 'ELearn_Views_Lesson',
        'method' => 'create',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'ELearn_Lesson'
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    array( // Get information
        'regex' => '#^/course/(?P<courseId>\d+)/lesson/(?P<lessonId>\d+)$#',
        'model' => 'ELearn_Views_Lesson',
        'method' => 'get',
        'http-method' => 'GET'
    ),
    array( // Update a Lesson of Course
        'regex' => '#^/course/(?P<courseId>\d+)/lesson/(?P<modelId>\d+)$#',
        'model' => 'ELearn_Views_Lesson',
        'method' => 'update',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'ELearn_Lesson'
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    array( // Remove a Lesson
        'regex' => '#^/course/(?P<courseId>\d+)/lesson/(?P<lessonId>\d+)$#',
        'model' => 'ELearn_Views_Lesson',
        'method' => 'remove',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    array( // Remove a Lesson
        'regex' => '#^/course/(?P<courseId>\d+)/lesson$#',
        'model' => 'ELearn_Views_Lesson',
        'method' => 'remove',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    // ************************************************************* Lesson
    array( // Find Lesson
        'regex' => '#^/lesson/find$#',
        'model' => 'ELearn_Views_Lesson',
        'method' => 'find',
        'http-method' => 'GET'
    ),
    array( // List All Lessons
        'regex' => '#^/lesson/list$#',
        'model' => 'ELearn_Views',
        'method' => 'listAll',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'ELearn_Lesson'
        )
    ),
    array( // Create new Lesson
        'regex' => '#^/lesson/new$#',
        'model' => 'ELearn_Views_Lesson',
        'method' => 'create',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'ELearn_Lesson'
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    array( // Get information
        'regex' => '#^/lesson/(?P<lessonId>\d+)$#',
        'model' => 'ELearn_Views_Lesson',
        'method' => 'get',
        'http-method' => 'GET'
    ),
    array( // Update Lesson
        'regex' => '#^/lesson/(?P<modelId>\d+)$#',
        'model' => 'ELearn_Views_Lesson',
        'method' => 'update',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'ELearn_Lesson'
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    array( // Remove Lesson
        'regex' => '#^/lesson/(?P<lessonId>\d+)$#',
        'model' => 'ELearn_Views_Lesson',
        'method' => 'remove',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    // ************************************************************* Part of Lesson
    array( // Find Part of Lesson
        'regex' => '#^/lesson/(?P<lessonId>\d+)/part/find$#',
        'model' => 'ELearn_Views_Part',
        'method' => 'find',
        'http-method' => 'GET'
    ),
    array( // Create new Part in Lesson
        'regex' => '#^/lesson/(?P<lessonId>\d+)/part/new$#',
        'model' => 'ELearn_Views_Part',
        'method' => 'create',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'ELearn_Part'
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    array( // Get information
        'regex' => '#^/lesson/(?P<lessonId>\d+)/part/(?P<partId>\d+)$#',
        'model' => 'ELearn_Views_Part',
        'method' => 'get',
        'http-method' => 'GET'
    ),
    array( // Update a Part of Lesson
        'regex' => '#^/lesson/(?P<lessonId>\d+)/part/(?P<partId>\d+)$#',
        'model' => 'ELearn_Views_Part',
        'method' => 'update',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'ELearn_Part'
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    array( // Remove a Part
        'regex' => '#^/lesson/(?P<lessonId>\d+)/part/(?P<partId>\d+)$#',
        'model' => 'ELearn_Views_Part',
        'method' => 'remove',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    array( // Remove a Part
        'regex' => '#^/lesson/(?P<lessonId>\d+)/part$#',
        'model' => 'ELearn_Views_Part',
        'method' => 'remove',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    // Download Part content
    array(
        'regex' => '#^/lesson/(?P<lessonId>\d+)/part/(?P<partId>\d+)/content$#',
        'model' => 'ELearn_Views_Part',
        'method' => 'download',
        'http-method' => 'GET',
        // Cache apram
        'cacheable' => true,
        'revalidate' => true,
        'intermediate_cache' => true,
        'max_age' => 25000
    ),
    // Update content by send content as request body
    array(
        'regex' => '#^/lesson/(?P<lessonId>\d+)/part/(?P<partId>\d+)/content$#',
        'model' => 'ELearn_Views_Part',
        'method' => 'updateFile',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    // ************************************************************* Part
    array( // Find Part
        'regex' => '#^/part/find$#',
        'model' => 'ELearn_Views_Part',
        'method' => 'find',
        'http-method' => 'GET'
    ),
    array( // List All Parts
        'regex' => '#^/part/list$#',
        'model' => 'ELearn_Views',
        'method' => 'listAll',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'ELearn_Part'
        )
    ),
    array( // Create new Part
        'regex' => '#^/part/new$#',
        'model' => 'ELearn_Views_Part',
        'method' => 'create',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'ELearn_Part'
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    array( // Get information
        'regex' => '#^/part/(?P<partId>\d+)$#',
        'model' => 'ELearn_Views_Part',
        'method' => 'get',
        'http-method' => 'GET'
    ),
    array( // Update a Part
        'regex' => '#^/part/(?P<modelId>\d+)$#',
        'model' => 'ELearn_Views_Part',
        'method' => 'update',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'ELearn_Part'
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    array( // Remove a Part
        'regex' => '#^/part/(?P<partId>\d+)$#',
        'model' => 'ELearn_Views_Part',
        'method' => 'remove',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    ),
    // Download Part content
    array(
        'regex' => '#^/part/(?P<partId>\d+)/content$#',
        'model' => 'ELearn_Views_Part',
        'method' => 'download',
        'http-method' => 'GET',
        // Cache param
        'cacheable' => true,
        'revalidate' => true,
        'intermediate_cache' => true,
        'max_age' => 25000
    ),
    // Update content by send content as request body
    array(
        'regex' => '#^/part/(?P<partId>\d+)/content$#',
        'model' => 'ELearn_Views_Part',
        'method' => 'updateFile',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::loginRequired'
        )
    )
);
