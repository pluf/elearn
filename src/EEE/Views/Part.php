<?php
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('EEE_Shortcuts_NormalizeItemPerPage');

class EEE_Views_Part
{
    // *******************************************************************
    // Part of Lesson
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
//         // check lesson
//         if (isset($match['lessonId'])) {
//             $lessonId = $match['lessonId'];
//         } else {
//             $lessonId = $request->REQUEST['lesson'];
//         }
//         $lesson = Pluf_Shortcuts_GetObjectOr404('EEE_Lesson', $lessonId);
//         // create part
//         $p['lesson'] = $lesson->id;
//         $plufService = new Pluf_Views();
//         return $plufService->createObject($request, $match, $p);
    }

    public static function get($request, $match){
//         if (isset($match['lessonId'])) {
//             $lessonId = $match['lessonId'];
//         } else {
//             $lessonId = $request->REQUEST['lessonId'];
//         }
//         $lesson = Pluf_Shortcuts_GetObjectOr404('EEE_Lesson', $lessonId);
//         $part = Pluf_Shortcuts_GetObjectOr404('EEE_Part', $match['partId']);
//         if ($part->lesson !== $lesson->id) {
//             throw new Pluf_Exception_DoesNotExist('Part with id (' . $part->id . ') does not exist in lesson with id (' . $lesson->id . ')');
//         }
//         return new Pluf_HTTP_Response_Json($part);
    }
    
    /**
     *
     * @param Pluf_HTTP_Request $request            
     * @param array $match            
     * @return Pluf_HTTP_Response_Json
     */
    public static function find($request, $match)
    {
        // check for lesson
        if (isset($match['lessonId'])) {
            $lessonId = $match['lessonId'];
        } elseif (isset($request->REQUEST['lessonId'])) {
            $lessonId = $request->REQUEST['lessonId'];
        }
        
        $part = new EEE_Part();
        $paginator = new Pluf_Paginator($part);
        if (isset($lessonId)) {
            $sql = new Pluf_SQL('lesson=%s', array(
                $lessonId
            ));
            $paginator->forced_where = $sql;
        }
        $paginator->list_filters = array(
            'id',
            'name',
            'title',
            'mime_type',
            'creation_dtime',
            'modif_dtime'
        );
        $search_fields = array(
            'name',
            'title',
            'description'
        );
        $sort_fields = array(
            'id',
            'name',
            'title',
            'order',
            'mime_type',
            'lesson',
            'creation_dtime',
            'modif_dtime'
        );
        $paginator->configure(array(), $search_fields, $sort_fields);
        $paginator->items_per_page = EEE_Shortcuts_NormalizeItemPerPage($request);
        $paginator->setFromRequest($request);
        return new Pluf_HTTP_Response_Json($paginator->render_object());
    }

    public static function remove($request, $match)
    {
//         if (isset($match['lessonId'])) {
//             $lessonId = $match['lessonId'];
//         } else {
//             $lessonId = $request->REQUEST['lessonId'];
//         }
//         $lesson = Pluf_Shortcuts_GetObjectOr404('EEE_Lesson', $lessonId);
//         if (isset($match['partId'])) {
//             $partId = $match['partId'];
//         } else {
//             $partId = $request->REQUEST['partId'];
//         }
//         $part = Pluf_Shortcuts_GetObjectOr404('EEE_Part', $partId);
        
//         if ($part->lesson !== $lesson->id) {
//             throw new Pluf_Exception_DoesNotExist('Part with id (' . $partId . ') does not exist in lesson with id (' . $lessonId . ')');
//         }
//         $partCopy = Pluf_Shortcuts_GetObjectOr404('EEE_Part', $partId);
//         $part->delete();
//         return new Pluf_HTTP_Response_Json($partCopy);
    }
    
    public static function update($request, $match, $p)
    {
//         // check lesson
//         if (isset($match['lessonId'])) {
//             $lessonId = $match['lessonId'];
//         } else {
//             $lessonId = $request->REQUEST['lesson'];
//         }
//         $lesson = Pluf_Shortcuts_GetObjectOr404('EEE_Lesson', $lessonId);
//         // create part
//         $p['lesson'] = $lesson->id;
//         $plufService = new Pluf_Views();
//         return $plufService->updateObject($request, $match, $p);
    }
}