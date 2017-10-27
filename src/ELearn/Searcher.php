<?php

/**
 * نمایش، فیلتر و جستجو در فهرستی از مدلهای داده
 *
 * یک نمونه استفاده از این کلاس در زیر آورده شده است:
 *
 * <code>
 * $model = new ELearn_Lesson();
 * $lister = new ELearn_Searcher($model);
 * // Get the parameters from the request
 * $lister->setFromRequest($request);
 * print $lister->render();
 * </code>
 *
 *
 * @date 1396 
 *
 * @author hadi <mohammad.hadi.mansouri@dpq.oc.ir>
 */
class ELearn_Searcher
{

    /**
     * این مدل داده‌ای جستجوگر خواهد شد.
     */
    protected $model;

    /**
     * The items being paginated.
     * If no model is given when creating
     * the paginator, it will use the items to list them.
     */
    public $items = null;

    /**
     * List filter.
     *
     * Allow the generation of filtering options for the list. If you
     * provide a list of fields having a "choices" option, you will be
     * able to filter on the choice values.
     */
    public $list_filters = array();

    /**
     * The fields being searched.
     */
    protected $search_fields = array();

    /**
     * The where clause from the search.
     */
    protected $where_clause = null;

    /**
     * The forced where clause on top of the search.
     */
    public $forced_where = null;

    /**
     * نمایشی از مدل داده‌ای را تعیین می‌کند که باید در این صفحه بندی استفاده
     * شود.
     */
    public $model_view = null;

    /**
     * Search string.
     */
    public $search_string = '';

    /**
     * Which fields of the model can be used to sort the dataset.
     * To
     * be useable these fields must be in the $list_display so that
     * the sort links can be shown for the user to click on them and
     * sort the list.
     */
    public $sort_fields = array();

    /**
     * Current sort order.
     * An array with first value the field and
     * second the order of the sort.
     */
    public $sort_order = array();

    /**
     * Keys where the sort is reversed.
     * Let say, you have a column
     * using a timestamp but displaying the information as an age. If
     * you sort "ASC" you espect to get the youngest first, but as the
     * timestamp is used, you get the oldest. But the key here and the
     * sort will be reverted.
     */
    public $sort_reverse_order = array();

    protected $active_list_filter = array();

    /**
     * یک صفحه بند را برای مدل تعیین شده ایجاد می‌کند
     *
     * @param $model مدل
     *            داده‌ای که باید صفحه بندی شود.
     * @param $search_fields فهرست
     *            پارامترهایی که می‌تواند جستجو شود.
     *            
     * @see ELearn_Searcher#$search_fields($search_fields=array(), $sort_fields=array())
     */
    function __construct($model = null, $search_fields = array())
    {
        $this->model = $model;
        $this->configure($search_fields);
    }

    /**
     * صفحه بند را تنظیم می‌کند
     *
     * @param $search_fields فهرست
     *            پارامترهایی که می‌تواند جستجو شود.
     * @param $sort_fields فهرستی
     *            از داده‌ها که قابلیت مرتب شدن را دارند.
     */
    function configure($search_fields = array(), $sort_fields = array())
    {
        if (is_array($search_fields)) {
            $this->search_fields = $search_fields;
        }
        if (is_array($sort_fields)) {
            $this->sort_fields = $sort_fields;
        }
    }

    /**
     * بر اساس تقاضای دریافت شده پارامترها را تنظیم می‌کند
     *
     * این پارامترها برای ایجاد یک فهرست از داده‌ها به کار گرفته می‌شوند. تمام
     * پارامترهای
     * ممکن برای این کلاس عبارتند از:
     *
     * _px_q : Query string to search.
     * _px_sk : Sort key.
     * _px_so : Sort order.
     * _px_fk : Filter key.
     * _px_fv : Filter value.
     *
     * @param
     *            Pluf_HTTP_Request The request
     */
    function setFromRequest($request)
    {
        if (isset($request->REQUEST['_px_q'])) {
            $this->search_string = $request->REQUEST['_px_q'];
        }
        if (isset($request->REQUEST['_px_sk']) and in_array($request->REQUEST['_px_sk'], $this->sort_fields)) {
            $this->sort_order[0] = $request->REQUEST['_px_sk'];
            $this->sort_order[1] = 'ASC';
            if (isset($request->REQUEST['_px_so']) and ($request->REQUEST['_px_so'] == 'd')) {
                $this->sort_order[1] = 'DESC';
            }
        }
        if (isset($request->REQUEST['_px_fk']) and in_array($request->REQUEST['_px_fk'], $this->list_filters) and isset($request->REQUEST['_px_fv'])) {
            // We add a forced where query
            $sql = new Pluf_SQL($request->REQUEST['_px_fk'] . '=%s', $request->REQUEST['_px_fv']);
            if (! is_null($this->forced_where)) {
                $this->forced_where->SAnd($sql);
            } else {
                $this->forced_where = $sql;
            }
            $this->active_list_filter = array(
                $request->REQUEST['_px_fk'],
                $request->REQUEST['_px_fv']
            );
        }
    }

    /**
     * ترجمه و ایجاد آرایه
     *
     * آرایه ایجاد شده هیچ محدودیتی ندارد و شامل تمام مواردی است که قبل در
     * سیستم ایجاد می‌شود.
     * علاوه بر این داده‌هایی که از پایگاه داده به دست آمده اند به صورت مستقیم
     * برگردانده می‌شوند و شامل هیچ ساختاری نیستند.
     * این روش برای استفاده از داده‌ها در ساختارهایی مانند JSON بسیار مناسب
     * خواهد بود.
     *
     * @return Array.
     */
    function render_array()
    {
        if (count($this->sort_order) != 2) {
            $order = null;
        } else {
            $s = $this->sort_order[1];
            if (in_array($this->sort_order[0], $this->sort_reverse_order)) {
                $s = ($s == 'ASC') ? 'DESC' : 'ASC';
            }
            $order = $this->sort_order[0] . ' ' . $s;
        }
        if (! is_null($this->model)) {
            $items = $this->model->getList(array(
                'view' => $this->model_view,
                'filter' => $this->filter(),
                'order' => $order
            ));
        } else {
            $items = $this->items;
        }
        $out = array();
        foreach ($items as $item) {
            $idata = array();
            $idata = $item->id;
            $out[] = $idata;
        }
        return $out;
    }

    /**
     * تمام گزینه‌های یافت شده را تعیین می‌کند
     *
     * با استفاده از این فراخوانی می‌توان به فهرست تمام موجودیت‌ها دست یافت.
     *
     * @return unknown
     */
    function render_object()
    {
        if (count($this->sort_order) != 2) {
            $order = null;
        } else {
            $s = $this->sort_order[1];
            if (in_array($this->sort_order[0], $this->sort_reverse_order)) {
                $s = ($s == 'ASC') ? 'DESC' : 'ASC';
            }
            $order = $this->sort_order[0] . ' ' . $s;
        }
        if (! is_null($this->model)) {
            $items = $this->model->getList(array(
                'view' => $this->model_view,
                'filter' => $this->filter(),
                'order' => $order,
            ));
        } else {
            $items = $this->items;
        }
        /**
         * ایجاد ساختار داده‌ای نهایی
         */
        return $items->getArrayCopy();
    }

    /**
     * Generate the where clause.
     *
     * @return string The ready to use where clause.
     */
    function filter()
    {
        if (strlen($this->where_clause) > 0) {
            return $this->where_clause;
        }
        if (! is_null($this->forced_where) or (strlen($this->search_string) > 0 && ! empty($this->search_fields))) {
            $lastsql = new Pluf_SQL();
            $keywords = $lastsql->keywords($this->search_string);
            foreach ($keywords as $key) {
                $sql = new Pluf_SQL();
                foreach ($this->search_fields as $field) {
                    $sqlor = new Pluf_SQL();
                    $sqlor->Q($field . ' LIKE %s', '%' . $key . '%');
                    $sql->SOr($sqlor);
                }
                $lastsql->SAnd($sql);
            }
            if (! is_null($this->forced_where)) {
                $lastsql->SAnd($this->forced_where);
            }
            $this->where_clause = $lastsql->gen();
            if (strlen($this->where_clause) == 0)
                $this->where_clause = null;
        }
        return $this->where_clause;
    }
}

