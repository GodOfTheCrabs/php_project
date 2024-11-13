<?php

class Pagination extends Event {

    private $table;
    private $total;
    private $perpage;
    private $params;

    private $sqlForTotal;
    public $page;
    public $pages;
    private $offset;
    public $elements;
    public $next;
    public $prev;
    public $category;
    public $title;
    public $sort;
    public $user_id;

    public function __construct($perpage, $page, $table, $category = null, $title = null, $sort = null, $user_id = null) {
        self::connect();
        $this->perpage = $perpage;
        $this->page = $page;
        $this->table = $table;
        $this->category = $category;
        $this->title = $title;
        $this->sort = $sort;
        $this->user_id = $user_id;
        $this->params = [];
        $this->getTotal();
        $this->countPages();
        $this->countOffset();
        $this->getElements();
        $this->getNext();
        $this->getPrev();
    }
    
    public function getFilter() {
        $filter = '';
        if($this->category) {
            $filter .= " AND `category`=:category";
            $this->params["category"] = $this->category;
        } 
        if ($this->title) {
            $filter .= " AND `title` LIKE :title";
            $this->params["title"] = '%' . $this->title . '%';
        }
    
        if($this->user_id) {
            $filter .= ' AND `id` IN (SELECT `event_id` FROM `followed_events` WHERE `user_id` = :user_id)';
            $this->params["user_id"] = $this->user_id;
        }

        switch ($this->sort) {
            case 'title_asc':
                $filter .= " ORDER BY `title` ASC ";
                break;
            case 'date_asc':
                $filter .=" ORDER BY `date` ASC ";
                break;
            case 'title_desc':
                $filter .= " ORDER BY `title` DESC ";
                break;
            case 'date_desc':
                $filter .=" ORDER BY `date` DESC ";
                break;
        }


        if($filter == ''){
            return $filter;
        } else {
            return ' WHERE 1=1 ' . $filter;
        }
    }
    public function getSqlForTotal() {
        $sql = "SELECT COUNT(*) FROM " . $this->table;
        $sql .= $this->getFilter();
        return $sql;
    }
    public function getTotal() {
        $sql = $this->getSqlForTotal();
        $stmt = self::$db->prepare($sql);
        $stmt->execute($this->params);
        $this->total = $stmt->fetchColumn();
    }

    public function countPages() {
        $this->pages = ceil($this->total / $this->perpage);
    }

    public function countOffset() {
        $this->offset = ($this->page-1)* $this->perpage;
    }

    public function getElements() {
        $sql = $this->getSqlByFilter();
        $stmt = self::$db->prepare($sql);
        $stmt->execute($this->params);
        $this->elements = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNext() 
    {
        $this->next = ($this->page == $this->pages) ? 1 : $this->page + 1;
    }

    public function getPrev() 
    {
        $this->prev = ($this->page == 1) ? $this->pages : $this->page - 1;
    }
    public function getVisiblePages() {
        $visiblePages = [];
    
        if ($this->pages > 5 && $this->page > 3) {
            $visiblePages[] = 1;
            $visiblePages[] = '...';
        }
    
        for ($i = max(1, $this->page - 2); $i <= min($this->pages, $this->page + 2); $i++) {
            $visiblePages[] = $i;
        }
    
        if ($this->pages > 5 && $this->page < $this->pages - 2) {
            $visiblePages[] = '...';
            $visiblePages[] = $this->pages;
        }
    
        return $visiblePages;
    }

    public function getSqlByFilter() {
        $sql = "SELECT * FROM " . $this->table;
        $sql .= $this->getFilter();
        $sql .= " LIMIT " . $this->perpage . " OFFSET " . $this->offset;
        return $sql;
    }
}