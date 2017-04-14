<?php
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('EEE_Shortcuts_NormalizeItemPerPage');

class EEE_Views_Course
{
    // *******************************************************************
    // Course of Topic
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
        // check topic
        if (isset($match['topicId'])) {
            $topicId = $match['topicId'];
            $request->REQUEST['topic'] = $topicId;
        } else {
            $topicId = $request->REQUEST['topic'];
        }
        Pluf_Shortcuts_GetObjectOr404('EEE_Topic', $topicId);
        // create course
        $plufService = new Pluf_Views();
        return $plufService->createObject($request, $match, $p);
    }

    public static function get($request, $match){
        if (isset($match['topicId'])) {
            $topicId = $match['topicId'];
        } else {
            $topicId = $request->REQUEST['topicId'];
        }
        $topic = Pluf_Shortcuts_GetObjectOr404('EEE_Topic', $topicId);
        $course = Pluf_Shortcuts_GetObjectOr404('EEE_Course', $match['courseId']);
        if ($course->topic !== $topic->id) {
            throw new Pluf_Exception_DoesNotExist('Course with id (' . $course->id . ') does not exist in topic with id (' . $topic->id . ')');
        }
        return new Pluf_HTTP_Response_Json($course);
    }
    
    /**
     *
     * @param Pluf_HTTP_Request $request            
     * @param array $match            
     * @return Pluf_HTTP_Response_Json
     */
    public static function find($request, $match)
    {
        // check for topic
        if (isset($match['topicId'])) {
            $topicId = $match['topicId'];
        } elseif (isset($request->REQUEST['topicId'])) {
            $topicId = $request->REQUEST['topicId'];
        }
        
        $course = new EEE_Course();
        $paginator = new Pluf_Paginator($course);
        if (isset($topicId)) {
            $sql = new Pluf_SQL('topic=%s', array(
                $topicId
            ));
            $paginator->forced_where = $sql;
        }
        $paginator->list_filters = array(
            'id',
            'title',
            'creation_dtime'
        );
        $search_fields = array(
            'title',
            'version',
            'abstract'
        );
        $sort_fields = array(
            'id',
            'title',
            'version',
            'topic',
            'creation_dtime'
        );
        $paginator->configure(array(), $search_fields, $sort_fields);
        $paginator->items_per_page = EEE_Shortcuts_NormalizeItemPerPage($request);
        $paginator->setFromRequest($request);
        return new Pluf_HTTP_Response_Json($paginator->render_object());
    }

    public static function remove($request, $match)
    {
        if (isset($match['topicId'])) {
            $topicId = $match['topicId'];
        } else {
            $topicId = $request->REQUEST['topicId'];
        }
        $topic = Pluf_Shortcuts_GetObjectOr404('EEE_Topic', $topicId);
        if (isset($match['courseId'])) {
            $courseId = $match['courseId'];
        } else {
            $courseId = $request->REQUEST['courseId'];
        }
        $course = Pluf_Shortcuts_GetObjectOr404('EEE_Course', $courseId);
        
        if ($course->topic !== $topic->id) {
            throw new Pluf_Exception_DoesNotExist('Course with id (' . $courseId . ') does not exist in topic with id (' . $topicId . ')');
        }
        $courseCopy = Pluf_Shortcuts_GetObjectOr404('EEE_Course', $courseId);
        $course->delete();
        return new Pluf_HTTP_Response_Json($courseCopy);
    }
    
    public static function update($request, $match, $p)
    {
        // check topic
        if (isset($match['topicId'])) {
            $topicId = $match['topicId'];
            $request->REQUEST['topic'] = $topicId;
        } else {
            $topicId = $request->REQUEST['topic'];
        }
        $topic = Pluf_Shortcuts_GetObjectOr404('EEE_Topic', $topicId);
        $course = Pluf_Shortcuts_GetObjectOr404('EEE_Course', $match['modelId']);
        if ($course->topic !== $topic->id) {
            throw new Pluf_Exception_DoesNotExist('Course with id (' . $course->id . ') does not exist in topic with id (' . $topic->id . ')');
        }
        // create course
        $plufService = new Pluf_Views();
        return $plufService->updateObject($request, $match, $p);
    }
}