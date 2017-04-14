<?php
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('EEE_Shortcuts_NormalizeItemPerPage');

class EEE_Views_Topic
{

    // *******************************************************************
    // Topics of Domain
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
        // check domain
        if (isset($match['domainId'])) {
            $domainId = $match['domainId'];
            $request->REQUEST['domain'] = $domainId;
        } else {
            $domainId = $request->REQUEST['domain'];
        }
        $request->REQUEST['owner'] = $request->user->id;
        Pluf_Shortcuts_GetObjectOr404('EEE_Domain', $domainId);
        // create topic
        $plufService = new Pluf_Views();
        return $plufService->createObject($request, $match, $p);
    }

    public static function get($request, $match){
        if (isset($match['domainId'])) {
            $domainId = $match['domainId'];
        } else {
            $domainId = $request->REQUEST['domainId'];
        }
        $domain = Pluf_Shortcuts_GetObjectOr404('EEE_Domain', $domainId);
        $topic = Pluf_Shortcuts_GetObjectOr404('EEE_Topic', $match['topicId']);
        if ($topic->domain !== $domain->id) {
            throw new Pluf_Exception_DoesNotExist('Topic with id (' . $topic->id . ') does not exist in domain with id (' . $domain->id . ')');
        }
        return new Pluf_HTTP_Response_Json($topic);
    }
    
    /**
     *
     * @param Pluf_HTTP_Request $request            
     * @param array $match            
     * @return Pluf_HTTP_Response_Json
     */
    public static function find($request, $match)
    {
        // check for domain
        if (isset($match['domainId'])) {
            $domainId = $match['domainId'];
        } elseif (isset($request->REQUEST['domainId'])) {
            $domainId = $request->REQUEST['domainId'];
        }
        
        $topic = new EEE_Topic();
        $paginator = new Pluf_Paginator($topic);
        if (isset($domainId)) {
            $sql = new Pluf_SQL('domain=%s', array(
                $domainId
            ));
            $paginator->forced_where = $sql;
        }
        $paginator->list_filters = array(
            'id',
            'title',
            'creation_dtime',
            'modif_dtime'
        );
        $search_fields = array(
            'title',
            'description'
        );
        $sort_fields = array(
            'id',
            'title',
            'owner',
            'domain',
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
        if (isset($match['domainId'])) {
            $domainId = $match['domainId'];
        } else {
            $domainId = $request->REQUEST['domainId'];
        }
        $domain = Pluf_Shortcuts_GetObjectOr404('EEE_Domain', $domainId);
        if (isset($match['topicId'])) {
            $topicId = $match['topicId'];
        } else {
            $topicId = $request->REQUEST['topicId'];
        }
        $topic = Pluf_Shortcuts_GetObjectOr404('EEE_Topic', $topicId);
        
        if ($topic->domain !== $domain->id) {
            throw new Pluf_Exception_DoesNotExist('Topic with id (' . $topicId . ') does not exist in domain with id (' . $domainId . ')');
        }
        $topicCopy = Pluf_Shortcuts_GetObjectOr404('EEE_Topic', $topicId);
        $topic->delete();
        return new Pluf_HTTP_Response_Json($topicCopy);
    }
    
    public static function update($request, $match, $p)
    {
        // check domain
        if (isset($match['domainId'])) {
            $domainId = $match['domainId'];
            $request->REQUEST['domain'] = $domainId;
        } else {
            $domainId = $request->REQUEST['domain'];
        }
        $domain = Pluf_Shortcuts_GetObjectOr404('EEE_Domain', $domainId);
        $topic = Pluf_Shortcuts_GetObjectOr404('EEE_Topic', $match['modelId']);
        if ($topic->domain !== $domain->id) {
            throw new Pluf_Exception_DoesNotExist('Topic with id (' . $topic->id . ') does not exist in domain with id (' . $domain->id . ')');
        }
        // create topic
        $plufService = new Pluf_Views();
        return $plufService->updateObject($request, $match, $p);
    }
}