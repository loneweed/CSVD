<?php

/**
 * Texte Database Class
 * Version 2.1
 * Update August 5, 2019
 * Author by Joseph Meng (monet@a-oct.com)
 * 
 */
class textdb
{
	
	public $table_bible;	//bible
    public $table_liber;	//liber
    public $table_intro;	//proface

    /**
     * 数据库操作句柄
     * @var coredb
     */
    private $db;

    /**
     * session login变量名称
     * @var string
     */
    private $session_login_name = 'login';
    private $session_login_group = 0;

    /**
     * session login user变量名称
     * @var string
     */
    private $session_login_time_name = 'login_time';

    /**
     * 初始化
     * @param coredb $db 数据库操作句柄
     */
    public function __construct(&$db) {
        $this->db 	= $db;
        $this->table_intro 	=	'cs_intro';
        $this->table_liber 	= 	'cs_liber';
        //$this->table_bible	=	'cs_bible';
        $this->table_texte  =   'cs_texte';
        $this->table_visit	=	'cs_visit';
    }

    /**
     * 返回文本檢索結果紀錄數
     * @param   String  $edition 版本
     * @param   String  $liber 書目
     * @param   int     $caput 章
     * @param   String  $word  關鍵字
     * @return  int     文本紀錄数
     */
    public function find_word_row($edition, $liber=null, $caput=0, $word=null) {

        $result = 0;
        if ($word != null) {
            $where = ' `cs_edition` = :edition AND `cs_cate` = 0';
            if ($liber != null) $where = $where .' AND `cs_liber` = :liber ';
            $where = $where." AND `cs_texte` LIKE '%".$word."%'";

            $sql = 'SELECT COUNT(id) FROM `' . $this->table_texte. '` WHERE '. $where;
            $sth = $this->db->prepare($sql);
            
            $sth->bindParam(':edition', $edition, PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);
            if ($liber != null) $sth->bindParam(':liber', $liber, PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);
            //$sth->bindParam(':word', $word, PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);
            
            if ($sth->execute() == true) {
                return $sth->fetchColumn();
            }
        }
        return $result;
    }

    /**
     * 返回文本檢索結果紀錄集
     * @param   String  $edition 版本
     * @param   String  $liber 書目
     * @param   int     $caput 章
     * @param   String  $word  關鍵字
     * @return  array   文本紀錄集數組
     */
    public function find_word($edition, $liber, $caput=0, $word=null, $page=1, $max=20) {
        $result = 0;
        if ($word != null) {
            $where = ' `cs_edition` = :edition AND `cs_cate` = 0';
            if ($liber != null) $where = $where .' AND `cs_liber` = :liber ';
            $where = $where." AND `cs_texte` LIKE '%".$word."%'";

            $sql = 'SELECT  `id`,`cs_edition`,`cs_vnx`,`cs_links`,`cs_liber`,`cs_caput`,`cs_verse`,`cs_section`,`cs_title`,`cs_texte`,`cs_quote`,`cs_note`,`cs_cate`,`cs_date`,`cs_update` FROM `' . $this->table_texte.'` WHERE '.$where .' LIMIT ' . ($page-1) * $max.','.$max;;
            $sth = $this->db->prepare($sql);
            
            $sth->bindParam(':edition', $edition, PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);
            if ($liber != null) $sth->bindParam(':liber', $liber, PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);

            if ($sth->execute() == true) {
                $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    /**
     * 獲取指定書目的文本
     * @param   String  $edition 版本
     * @param   String  $liber 書目
     * @param   int     $caput 章
     * @param   String  $verse 節
     * @return  array   文本紀錄集數組
     */
    public function read_text($edition, $liber, $caput=0, $verse=null)
    {   
        $result = false;
        $where = 1;

        $where = '`cs_edition` = :edition AND `cs_liber` = :liber AND `cs_caput` = :caput' ;
        if ($verse != null) $where = '`cs_edition` = :edition AND `cs_liber` = :liber AND `cs_caput` = :caput AND `cs_verse` = :verse' ;
        //$sql = 'SELECT `'.$this->table_bible.'` (`id`,`cs_edition`,`cs_vnx`,`cs_links`,`cs_liber`,`cs_caput`,`cs_verse`, `cs_title`,`cs_texte`,`cs_quote`,`cs_note`,`cs_cate`,`cs_date`,`cs_update` WHERE '.$where.' ORDER BY `cs_caput` ASC LIMIT ' .($page-1) * $max. ',' .$max;
        
        $sql = 'SELECT `id`,`cs_edition`,`cs_vnx`,`cs_links`,`cs_liber`,`cs_caput`,`cs_verse`,`cs_section`,`cs_title`,`cs_texte`,`cs_quote`,`cs_note`,`cs_cate`,`cs_date`,`cs_update` FROM `'.$this->table_texte.'` WHERE '.$where.' ORDER BY `cs_section` ASC';

        //$sql = 'SELECT COUNT(id) FROM `' . $this->table_sage . '` WHERE ' . $where;
        $sth = $this->db->prepare($sql);
        //echo $bible . $liber .' - ';
        $sth->bindParam(':edition', $edition,   PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);
        $sth->bindParam(':liber', $liber,   PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);
        $sth->bindParam(':caput', $caput);
        if ($verse != null) $sth->bindParam(':verse', $verse,   PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);
        //echo $sql;

        if ($sth->execute() == true) {
            //$result = $sth->fetchColumn();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }


    /*ADD TEXT
    `cs_edition`
    `cs_vnx`
    `cs_links`
    `cs_liber`
    `cs_caput`
    `cs_verse`
    `cs_title`
    `cs_texte`
    */
    public function add_text($edition, $vnx, $link, $liber, $caput, $verse, $section, $title, $texte, $quote=null, $note=null, $cate = 0)
    {
        $result = 0;

        $str = 'INSERT INTO `'.$this->table_texte.'` (`cs_edition`,`cs_vnx`,`cs_links`,`cs_liber`,`cs_caput`,`cs_verse`,`cs_section`, `cs_title`,`cs_texte`,`cs_quote`,`cs_note`,`cs_cate`) VALUES ';
    	$sql = 'INSERT INTO `'.$this->table_texte.'` 
        (`cs_edition`,`cs_vnx`,`cs_links`,`cs_liber`,`cs_caput`,`cs_verse`,`cs_section`,`cs_title`,`cs_texte`,`cs_quote`,`cs_note`,`cs_cate`) VALUES (:edition,:vnx,:link,:liber,:caput,:verse,:section,:title, :texte,:quote,:note, :cate)';
    	
        $sth = $this->db->prepare($sql);
        $sth->bindParam(':edition', $edition,   PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);
        $sth->bindParam(':vnx',     $vnx,       PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);
        $sth->bindParam(':link',    $link,      PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);
        $sth->bindParam(':liber',   $liber,     PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);
        $sth->bindParam(':caput',   $caput);
        $sth->bindParam(':verse',   $verse,     PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);
        $sth->bindParam(':section', $section);
        $sth->bindParam(':title',   $title,     PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);
        $sth->bindParam(':texte',   $texte,     PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);
        $sth->bindParam(':quote',   $quote,     PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);
        $sth->bindParam(':note',    $note,      PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);
        $sth->bindParam(':cate',    $cate);
        //echo $str ."('".$edition."','".$vnx."','".$link."','".$liber."',".$caput.",'".$verse."',".$section.",'".$title."','".$texte."','".$quote."','".$note."',".$cate.");<br/>";
//echo $sql.'<br/>';;
        if ($sth->execute()) {

            $result = $this->db->lastInsertId();

            //echo $result.'<br/>';
        }
        return $result;
    }

    public function edit_text()
    {


    }

}


/**
 * DATABASE PDO
 */
class coredb extends PDO {

    /**
     * 数据库连接DNS字符串
     * @var string 
     */
    public $dns;

    /**
     * 数据库连接用户名
     * @var string
     */
    public $username;

    /**
     * 数据库连接密码
     * @var string
     */
    public $passwd;

    /**
     * 是否持久化连接
     * @var boolean
     */
    public $persistent;

    /**
     * 数据库连接句柄
     * @var PDO 
     */
    public $link_handle;

    /**
     * 数据库连接状态
     * @var boolean
     */
    public $status;

    /**
     * 表数组
     * @var array
     */
    public $tables = array(
        'ip'    => 'core_ip',
        'log'   => 'core_log',
        'bible' => 'cs_bible',
        'liber' => 'cs_liber',
        'intro' => 'cs_preface');

    /**
     * 字段数组
     * @var array
     */
    public $fields = array(
        'ip' => array('id', 'ip_addr', 'ip_ban'),
        'log' => array('id', 'log_date', 'log_ip', 'log_message'),
        'bible' => array('id','cs_edition','cs_vnx','cs_links','cs_liber','cs_caput','cs_verse', 'cs_title','cs_texte','cs_quote','cs_note','cs_cate','cs_date','cs_update'),
        'liber' => array('id','cs_edition','cs_links','cs_liber','cs_title','cs_subtitle','cs_caput','cs_cate','cs_date','cs_update'), 
        'intro' => array('id','cs_edition','cs_links','cd_index','cs_liber','cs_title','cs_texte','cs_quote','cs_note','cs_cate','cs_date','cs_update'),
        'visit' => array('id','user_ip','user_source','user_page','user_date','user_session§'));

    /**
     * 初始化
     * @param string $dns
     * @param string $username
     * @param string $passwd
     * @param boolean $persistent
     */
    public function __construct($dns, $username, $passwd, $persistent = true) {
        $this->dns = $dns;
        $this->username = $username;
        $this->passwd = $passwd;
        $this->persistent = $persistent;
        $this->connect();
    }

    /**
     * 初始化连接
     * @throws PDOException
     * @return boolean 连接数据库是否成功
     */
    private function connect() {
        $this->status = false;
        try {
            $this->link_handle = parent::__construct($this->dns, $this->username, $this->passwd, array(PDO::ATTR_PERSISTENT => $this->persistent));
            //$this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            //$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->status = true;
        } catch (PDOException $exc) {
            new coreerror('Connect Database error.', 'core-db::connect()::PDOException', 1);
        }
    }

    /**
     * 设定编码
     * @param string $encoding_name 编码名称
     * @return boolean
     */
    public function set_encoding($encoding_name) {
        $set_bool = false;
        if ($this->is_link() == true) {
            $sql_msg = 'SET NAMES ' . $encoding_name;
            $set_bool = $this->exec($sql_msg);
        }
        return $set_bool;
    }

    /**
     * 检查是否连接成功
     * @return boolean
     */
    public function is_link() {
        return $this->status;
    }

    /**
     * 查询列表
     * @since 5
     * @param array $tables 表数组 eg:array('ip','log')
     * @param array $fields 字段数组 eg:array('ip'=>array(0,1,2))
     * @param string $where 条件语句
     * @param int $page 页数
     * @param int $max 页长
     * @param int $order 排序字段键值
     * @param boolean $desc 是否倒序
     * @return boolean|array 查询结果
     */
    public function select($tables, $fields, $where, $page = 1, $max = 1, $order = 0, $desc = false) {
        //合成表部分
        $sql_table = $this->get_tables($tables);
        //合成字段部分
        $sql_field = '';
        $sql_order = '';
        foreach ($fields as $t => $f) {
            foreach ($f as $fv) {
                $sql_field .= ',' . $this->get_fields($t, $fv);
            }
            $sql_order .= ',' . $this->fields[$t][$order];
        }
        $sql_field = substr($sql_field, 1);
        $sql_order = substr($sql_order, 1);
        $sql_desc = $desc ? 'DESC' : 'ASC';
        $sql = 'SELECT ' . $sql_field . ' FROM ' . $sql_table . ' WHERE ' . $where . ' ORDER BY ' . $sql_order . ',' . $sql_desc . ' LIMIT ' . ($page - 1) * $max . ',' . $max;
        $sth = $this->prepare($sql);
        if ($sth->execute() == true) {
            if ($max > 1) {
                return $sth->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return $sth->fetch(PDO::FETCH_ASSOC);
            }
        }
        return false;
    }

    /**
     * 创建新的记录
     * @param string $table 表名
     * @param array $values 数据数组
     * @return int|boolean
     */
    public function insert($table, $values) {
        if (isset($this->tables[$table]) == true) {
            if (count($values) == count($this->fields[$table])) {
                $sql = 'INSERT INTO `' . $this->tables[$table] . '`(`' . implode('`,`', $this->fields[$table]) . '`) VALUES(:' . implode(',:', $this->fields) . ')';
                $sth = $this->prepare($sql);
                if ($sth->execute($values) == true) {
                    return $this->lastInsertId();
                }
            }
        }
        return false;
    }

    /**
     * 更新记录
     * @param string $table 表名
     * @param array $sets 设置值数组
     * @param string $where 条件语句
     * @return boolean
     */
    public function update($table, $sets, $where) {
        $sql = 'UPDATE `' . $this->tables[$table] . '` SET ';
        $set = '';
        foreach ($sets as $k => $v) {
            $set .= $k . ' = :' . $k;
        }
        $sql .= $set . ' WHERE ' . $where;
        $sth = $this->prepare($sql);
        if ($sth->execute($sets) == true) {
            return true;
        }
        return false;
    }

    /**
     * 删除记录
     * @param string $table
     * @param string $where
     * @return boolean
     */
    public function delete($table, $where) {
        $sql = 'DELETE FROM `' . $this->tables[$table] . '` WHERE ' . $where;
        $sql .= $set . ' WHERE ' . $where;
        $sth = $this->prepare($sql);
        return $sth->execute();
    }

    /**
     * 获取条件语句
     * @param int $field 字段键值
     * @param string $e 算数符号
     * @param string $value 值
     * @param string $table 表键值
     * @return string
     */
    public function get_where($field, $e, $value, $table) {
        return $this->fields[$table][$field] . $e . '\'' . $value . '\'';
    }

    /**
     * 合成表部分
     * @param string|array $tables 表列
     * @return string
     */
    private function get_tables($tables) {
        if (is_array($tables) == true) {
            return implode(',', $this->tables[$tables]);
        } else {
            return $this->tables[$tables];
        }
    }

    /**
     * 获取字段
     * @param string $table 表键值
     * @param string $field 字段键值
     * @return string 语句
     */
    private function get_fields($table, $field) {
        return $this->tables[$table] . '.' . $this->fields[$table][$field];
    }

}










