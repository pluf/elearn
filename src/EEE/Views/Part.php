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
        // check lesson
        if (isset($match['lessonId'])) {
            $lessonId = $match['lessonId'];
            $request->REQUEST['lesson'] = $lessonId;
        } else {
            $lessonId = $request->REQUEST['lesson'];
        }
        // Check if lesson is existed?
        Pluf_Shortcuts_GetObjectOr404('EEE_Lesson', $lessonId);
        // create part
        $extra = array(
            'user' => $request->user,
            'model' => new EEE_Part()
        );
        // Create part and get its ID
        $form = new EEE_Form_PartCreate($request->REQUEST, $extra);
        // Upload part file and extract information about it (by updating part)
        $extra['model'] = $form->save();
        $form = new EEE_Form_PartUpdate(array_merge($request->REQUEST, $request->FILES), $extra);
        try {
            $part = $form->save();
        } catch (Pluf_Exception $e) {
            $part = $extra['model'];
            $part->delete();
            throw $e;
        }
        return new Pluf_HTTP_Response_Json($part);
    }

    public static function get($request, $match)
    {
        // Check and fetch Lesson
        if (isset($match['lessonId'])) {
            $lessonId = $match['lessonId'];
            Pluf_Shortcuts_GetObjectOr404('EEE_Lesson', $lessonId);
        } else {
            $lessonId = $request->REQUEST['lessonId'];
        }
        $lesson = Pluf_Shortcuts_GetObjectOr404('EEE_Lesson', $lessonId);
        
        // Check and fetch Part
        if (array_key_exists('partId', $match)) {
            $part = Pluf_Shortcuts_GetObjectOr404('EEE_Part', $match['partId']);
            // XXX: maso, 1395: محتوی در ملک باشد
        } else {
            $part = EEE_Shortcuts_GetPartByNameOr404($match['name']);
        }
        if ($part->lesson !== $lesson->id) {
            throw new Pluf_Exception_DoesNotExist('Part with id (' . $part->id . ') does not exist in lesson with id (' . $lesson->id . ')');
        }
        return new Pluf_HTTP_Response_Json($part);
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
        // Check and fetch Lesson
        if (isset($match['lessonId'])) {
            $lessonId = $match['lessonId'];
            $request->REQUEST['lessonId'] = $lessonId;
        } else {
            $lessonId = $request->REQUEST['lessonId'];
        }
        $lesson = Pluf_Shortcuts_GetObjectOr404('EEE_Lesson', $lessonId);
        // Check and fetch Part
        if (isset($match['partId'])) {
            $partId = $match['partId'];
        } else {
            $partId = $request->REQUEST['partId'];
        }
        $part = Pluf_Shortcuts_GetObjectOr404('EEE_Part', $partId);
        
        if ($part->lesson !== $lesson->id) {
            throw new Pluf_Exception_DoesNotExist('Part with id (' . $partId . ') does not exist in lesson with id (' . $lessonId . ')');
        }
        $partCopy = Pluf_Shortcuts_GetObjectOr404('EEE_Part', $partId);
        $part->delete();
        return new Pluf_HTTP_Response_Json($partCopy);
    }

    public static function update($request, $match, $p)
    {
        // check lesson
        if (isset($match['lessonId'])) {
            $lessonId = $match['lessonId'];
            $request->REQUEST['lesson'] = $lessonId;
        } else {
            $lessonId = $request->REQUEST['lesson'];
        }
        Pluf_Shortcuts_GetObjectOr404('EEE_Lesson', $lessonId);
        // Update Part
        $part = Pluf_Shortcuts_GetObjectOr404('EEE_Part', $match['partId']);
        // اجرای درخواست
        $extra = array(
            'model' => $part
        );
        $form = new EEE_Form_PartUpdate(array_merge($request->REQUEST, $request->FILES), $extra);
        $part = $form->save();
        return new Pluf_HTTP_Response_Json($part);
    }

    /**
     *
     * @param Pluf_HTTP_Request $request            
     * @param array $match            
     * @return Pluf_HTTP_Response_File
     */
    public static function download($request, $match)
    {
        // check Lesson
        if (isset($match['lessonId'])) {
            $lessonId = $match['lessonId'];
            $request->REQUEST['lesson'] = $lessonId;
        } else {
            $lessonId = $request->REQUEST['lesson'];
        }
        $lesson = Pluf_Shortcuts_GetObjectOr404('EEE_Lesson', $lessonId);
        // get Part
        $part = Pluf_Shortcuts_GetObjectOr404('EEE_Part', $match['partId']);
        if ($part->lesson !== $lesson->id) {
            throw new Pluf_Exception_DoesNotExist('Part with id (' . $part->id . ') does not exist in lesson with id (' . $lessonId . ')');
        }
        // $part->downloads += 1;
        $part->update();
        $response = new Pluf_HTTP_Response_File($part->getAbsloutPath(), $part->mime_type);
        $response->headers['Content-Disposition'] = sprintf('attachment; filename="%s"', $part->file_name);
        return $response;
    }
    
    public static function updateFile ($request, $match)
    {
        // GET data
        $part = Pluf_Shortcuts_GetObjectOr404('EEE_Part', $match['partId']);
        if (array_key_exists('file', $request->FILES)) {
            // $extra = array(
            // // 'user' => $request->user,
            // 'content' => $content
            // );
            // $form = new CMS_Form_ContentUpdate(
            // array_merge($request->REQUEST, $request->FILES), $extra);
            // $content = $form->update();
            // // return new Pluf_HTTP_Response_Json($content);
            return CMS_Views::update($request, $match);
        } else {
            // Do
            $myfile = fopen($part->getAbsloutPath(), "w") or
            die("Unable to open file!");
            $entityBody = file_get_contents('php://input', 'r');
            fwrite($myfile, $entityBody);
            fclose($myfile);
            // $content->file_size = filesize(
            // $content->file_path . '/' . $content->id);
            $part->update();
        }
        return new Pluf_HTTP_Response_Json($part);
    }
}