<?php
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('ELearn_Shortcuts_NormalizeItemPerPage');

class ELearn_Views_Part
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
        Pluf_Shortcuts_GetObjectOr404('ELearn_Lesson', $lessonId);
        // create part
        $extra = array(
            'user' => $request->user,
            'model' => new ELearn_Part()
        );
        // Create part and get its ID
        $form = new ELearn_Form_PartCreate($request->REQUEST, $extra);
        // Upload part file and extract information about it (by updating part)
        $extra['model'] = $form->save();
        $form = new ELearn_Form_PartUpdate(array_merge($request->REQUEST, $request->FILES), $extra);
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
        // Check and fetch Part
        if (array_key_exists('partId', $match)) {
            $part = Pluf_Shortcuts_GetObjectOr404('ELearn_Part', $match['partId']);
            // XXX: maso, 1395: محتوی در ملک باشد
        } else {
            $part = ELearn_Shortcuts_GetPartByNameOr404($match['name']);
        }
        // Check and fetch Lesson
        if (isset($match['lessonId'])) {
            $lessonId = $match['lessonId'];
            Pluf_Shortcuts_GetObjectOr404('ELearn_Lesson', $lessonId);
        } else if (isset($request->REQUEST['lessonId'])) {
            $lessonId = $request->REQUEST['lessonId'];
        }
        if (isset($lessonId)) {
            $lesson = Pluf_Shortcuts_GetObjectOr404('ELearn_Lesson', $lessonId);
            if ($part->lesson !== $lesson->id) {
                throw new Pluf_Exception_DoesNotExist('Part with id (' . $part->id . ') does not exist in lesson with id (' . $lesson->id . ')');
            }
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
        
        $part = new ELearn_Part();
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
        $paginator->items_per_page = ELearn_Shortcuts_NormalizeItemPerPage($request);
        $paginator->setFromRequest($request);
        return new Pluf_HTTP_Response_Json($paginator->render_object());
    }

    public static function remove($request, $match)
    {
        // Check and fetch Part
        if (isset($match['partId'])) {
            $partId = $match['partId'];
        } else {
            $partId = $request->REQUEST['partId'];
        }
        $part = Pluf_Shortcuts_GetObjectOr404('ELearn_Part', $partId);
        // Check and fetch Lesson if is set
        if (isset($match['lessonId'])) {
            $lessonId = $match['lessonId'];
            $request->REQUEST['lessonId'] = $lessonId;
        } else if (isset($request->REQUEST['lesson'])) {
            $lessonId = $request->REQUEST['lesson'];
        }
        if (isset($lessonId)) {
            $lesson = Pluf_Shortcuts_GetObjectOr404('ELearn_Lesson', $lessonId);
            if ($part->lesson !== $lesson->id) {
                throw new Pluf_Exception_DoesNotExist('Part with id (' . $partId . ') does not exist in lesson with id (' . $lessonId . ')');
            }
        }
        $partCopy = Pluf_Shortcuts_GetObjectOr404('ELearn_Part', $partId);
        $part->delete();
        return new Pluf_HTTP_Response_Json($partCopy);
    }

    public static function update($request, $match, $p)
    {
        $part = ELearn_Views_Part::validatePart($request, $match, $match['modelId']);
        // Update Part
        $extra = array(
            'model' => $part
        );
        $form = new ELearn_Form_PartUpdate(array_merge($request->REQUEST, $request->FILES), $extra);
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
        // get Part
        $part = Pluf_Shortcuts_GetObjectOr404('ELearn_Part', $match['partId']);
        // check Lesson if is set
        if (isset($match['lessonId'])) {
            $lessonId = $match['lessonId'];
            $request->REQUEST['lesson'] = $lessonId;
        } else if (isset($request->REQUEST['lesson'])) {
            $lessonId = $request->REQUEST['lesson'];
        }
        if (isset($lessonId)) {
            $lesson = Pluf_Shortcuts_GetObjectOr404('ELearn_Lesson', $lessonId);
            if ($part->lesson !== $lesson->id) {
                throw new Pluf_Exception_DoesNotExist('Part with id (' . $part->id . ') does not exist in lesson with id (' . $lessonId . ')');
            }
        }
        // $part->downloads += 1;
        $part->update();
        $response = new Pluf_HTTP_Response_File($part->getAbsloutPath(), $part->mime_type);
        $response->headers['Content-Disposition'] = sprintf('attachment; filename="%s"', $part->file_name);
        return $response;
    }
    
    public static function updateFile($request, $match)
    {
        if (array_key_exists('file', $request->FILES)) {
            return ELearn_Views_Part::update($request, $match);
        } else {
            $part = ELearn_Views_Part::validatePart($request, $match, $match['partId']);
            // Do
            $myfile = fopen($part->getAbsloutPath(), "w") or die("Unable to open file!");
            $entityBody = file_get_contents('php://input', 'r');
            fwrite($myfile, $entityBody);
            fclose($myfile);
            // $part->file_size = filesize(
            // $part->file_path . '/' . $content->id);
            $part->update();
        }
        return new Pluf_HTTP_Response_Json($part);
    }
    
    /**
     * Validate parameters provided by request and match and return requested ELearn_Part
     * if params are valid.
     * @param  Pluf_HTTP_Request $request
     * @param array $match
     * @param string $id
     * @return ELearn_Part
     */
    private static function validatePart($request, $match, $id){
        $part = Pluf_Shortcuts_GetObjectOr404('ELearn_Part', $id);
        // check lesson
        if (isset($match['lessonId'])) {
            $lessonId = $match['lessonId'];
            $request->REQUEST['lesson'] = $lessonId;
        } else if (isset($request->REQUEST['lesson'])) {
            $lessonId = $request->REQUEST['lesson'];
        }
        if (isset($lessonId)) {
            $lesson = Pluf_Shortcuts_GetObjectOr404('ELearn_Lesson', $lessonId);
            if ($part->lesson !== $lesson->id) {
                throw new Pluf_Exception_DoesNotExist('Part with id (' . $part->id . ') does not exist in lesson with id (' . $lesson->id . ')');
            }
        }
        return $part;
    }
}