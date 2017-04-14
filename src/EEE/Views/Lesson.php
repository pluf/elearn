<?php
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('EEE_Shortcuts_NormalizeItemPerPage');

class EEE_Views_Lesson
{
    // *******************************************************************
    // Lesson of Course
    // *******************************************************************
    /**
     *
     * @param Pluf_HTTP_Request $request            
     * @param array $match            
     * @param array $p            
     * @return Pluf_HTTP_Response
     */
    public static function create($request, $match, $p)
    {
        // check course
        if (isset($match['courseId'])) {
            $courseId = $match['courseId'];
            $request->REQUEST['course'] = $courseId;
        } else {
            $courseId = $request->REQUEST['course'];
        }
        Pluf_Shortcuts_GetObjectOr404('EEE_Course', $courseId);
        // create lesson
        $plufService = new Pluf_Views();
        return $plufService->createObject($request, $match, $p);
    }

    public static function get($request, $match){
        if (isset($match['courseId'])) {
            $courseId = $match['courseId'];
        } else {
            $courseId = $request->REQUEST['courseId'];
        }
        $course = Pluf_Shortcuts_GetObjectOr404('EEE_Course', $courseId);
        $lesson = Pluf_Shortcuts_GetObjectOr404('EEE_Lesson', $match['lessonId']);
        if ($lesson->course !== $course->id) {
            throw new Pluf_Exception_DoesNotExist('Lesson with id (' . $lesson->id . ') does not exist in course with id (' . $course->id . ')');
        }
        return new Pluf_HTTP_Response_Json($lesson);
    }
    
    /**
     *
     * @param Pluf_HTTP_Request $request            
     * @param array $match            
     * @return Pluf_HTTP_Response_Json
     */
    public static function find($request, $match)
    {
        // check for course
        if (isset($match['courseId'])) {
            $courseId = $match['courseId'];
        } elseif (isset($request->REQUEST['courseId'])) {
            $courseId = $request->REQUEST['courseId'];
        }
        
        $lesson = new EEE_Lesson();
        $paginator = new Pluf_Paginator($lesson);
        if (isset($courseId)) {
            $sql = new Pluf_SQL('course=%s', array(
                $courseId
            ));
            $paginator->forced_where = $sql;
        }
        $paginator->list_filters = array(
            'id',
            'title',
            'course',
            'creation_dtime'
        );
        $search_fields = array(
            'title',
            'abstract'
        );
        $sort_fields = array(
            'id',
            'title',
            'order',
            'course',
            'creation_dtime'
        );
        $paginator->configure(array(), $search_fields, $sort_fields);
        $paginator->items_per_page = EEE_Shortcuts_NormalizeItemPerPage($request);
        $paginator->setFromRequest($request);
        return new Pluf_HTTP_Response_Json($paginator->render_object());
    }

    public static function remove($request, $match)
    {
        if (isset($match['courseId'])) {
            $courseId = $match['courseId'];
        } else {
            $courseId = $request->REQUEST['courseId'];
        }
        $course = Pluf_Shortcuts_GetObjectOr404('EEE_Course', $courseId);
        if (isset($match['lessonId'])) {
            $lessonId = $match['lessonId'];
        } else {
            $lessonId = $request->REQUEST['lessonId'];
        }
        $lesson = Pluf_Shortcuts_GetObjectOr404('EEE_Lesson', $lessonId);
        
        if ($lesson->course !== $course->id) {
            throw new Pluf_Exception_DoesNotExist('Lesson with id (' . $lessonId . ') does not exist in course with id (' . $courseId . ')');
        }
        $lessonCopy = Pluf_Shortcuts_GetObjectOr404('EEE_Lesson', $lessonId);
        $lesson->delete();
        return new Pluf_HTTP_Response_Json($lessonCopy);
    }
    
    public static function update($request, $match, $p)
    {
        // check course
        if (isset($match['courseId'])) {
            $courseId = $match['courseId'];
            $request->REQUEST['course'] = $courseId;
        } else {
            $courseId = $request->REQUEST['course'];
        }
        $course = Pluf_Shortcuts_GetObjectOr404('EEE_Course', $courseId);
        $lesson = Pluf_Shortcuts_GetObjectOr404('EEE_Lesson', $match['modelId']);
        if ($lesson->course !== $course->id) {
            throw new Pluf_Exception_DoesNotExist('Lesson with id (' . $lesson->id . ') does not exist in course with id (' . $course->id . ')');
        }
        // create lesson
        $p['course'] = $course->id;
        $plufService = new Pluf_Views();
        return $plufService->updateObject($request, $match, $p);
    }
}