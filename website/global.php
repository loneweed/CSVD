<?php

/**
 * 全局设定
 */

//相对路径定义
//define('DS', '/');
//define('DIR_LIB', 'includes');
//define('DIR_DATA', 'content');
//上传文件存储路径
//define('UPLOADFILE_DIR', DIR_DATA . DS . 'files');

// 设定时区
date_default_timezone_set('PRC');

//开启会话
session_start();
//介面語言
if(!isset($_SESSION['csvd_language'])){
     $_SESSION['csvd_language'] = 'en';
}
$language = isset($_GET['pl']) ? $_GET['pl'] : '';
if ($language!=''){
    $_SESSION['csvd_language'] = $_GET['pl'];
}
$language = $_SESSION['csvd_language'];

//當前鏈接
$book_url = '?';
$url = isset($_GET['liber']) ? $_GET['liber'] : '';
if ($url !='') $book_url = '?liber='.$url.'&';

//檢索關鍵字
$query = isset($_GET['q']) ? $_GET['q'] : '';
$query = trim($query);

//頁數
$page  = isset($_GET['p']) ? $_GET['p'] : 1;

//頁面標題
$csvd = array('lt'=>'Centrum Studium Verbum Domini', 
    'zh'=>'&#22307;&#35328;&#30740;&#35835;&#20013;&#24515;', 
    'en'=>'Divine Word Study Centre', 
    'fr'=>'Centre d`&Eacute;tudes Verbum Domini');

//菜單
$menu_item = array('csvd'=>array('lt'=>'Centrum Studium Verbum Domini', 'en'=>'Centrum Studium Verbum Domini', 'zh'=>'聖言研讀中心', 'fr'=>'Centrum Studium Verbum Domini'),
    'bible'=>array('lt'=>'Biblia Sacra', 'en'=>'Holy Bible', 'zh'=>'聖經', 'fr'=>'Bible'), 
    'verbum'=>array('lt'=>'Verbum Diurnum','en'=>'Verbum Diurnum','zh'=>'每日聖言','fr'=>'Verbum Diurnum'),
    'opera'=>array('lt'=>'Opera','en'=>'Works','zh'=>'項目','fr'=>'Opera'), 
    'study'=>array('lt'=>'Studia','en'=>'Study','zh'=>'研讀','fr'=>'Studia'),
    'lang' =>array('lt'=>'LT','en'=>'En','zh'=>'中','fr'=>'FR'),
    'language'=>array('lt'=>'Latina','en'=>'English','zh'=>'中文','fr'=>'Français'),
    'contents'=>array('lt'=>'Bibliotheca','en'=>'&#22307;&#32463;','zh'=>'Table of Contents','fr'=>'Table G&eacute;n&eacute;rale'),
    'intro'=>array('lt'=>'Introduction','en'=>'Introduction','zh'=>'引言','fr'=>'Introduction'),
    'search'=>array('lt'=>'Quære','en'=>'Search','zh'=>'檢索','fr'=>'Rechercher'),
    'all'=>array('lt'=>'Omnis','en'=>'All','zh'=>'-','fr'=>'-'),
    'vt'=>array('lt'=>'VT','en'=>'OT','zh'=>'舊約','fr'=>'AT'),
    'nt'=>array('lt'=>'NT','en'=>'NT','zh'=>'新約','fr'=>'NT'));
//導航菜單
$page_item = array(
    'next'=>array('lt'=>'Caput Priora','cs'=>'下一章','zh'=>'下一章','en'=>'Next Chapter','fr'=>'Chapitre suivant','it'=>'Chapitre Pr&eacute;c&eacute;dent'),
    'prev'=>array('lt'=>'Caput Sequentia','cs'=>'上一章','zh'=>'上一章','en'=>'Previous Chapter','fr'=>'Chapitre Suivant','it'=>'Previous Chapter'),
    'top'=>array('lt'=>'Summa Pagina', 'zh'=>'&#39029;&#39318;', 'en'=>'Top', 'fr'=>'Haut'));

//月份
$month_list = array('jan'=>array("Ianuarii", "&#19968;&#26376;", "January", "Janvier"),
    'feb'=>array("Februarii", "&#20108;&#26376;", "February", "F&eacute;vrier"),
    'mai'=>array("Martii", "&#19977;&#26376;", "March", "Mars"),
    'apr'=>array("Aprilis", "&#22235;&#26376;", "April", "Avril"),
    'mayn'=>array("Maii", "&#20116;&#26376;", "May", "Mai"),
    'jun'=>array("Iunii", "&#20845;&#26376;", "June", "Juin"),
    'jul'=>array("Iulii", "&#19971;&#26376;", "July", "Juillet"),
    'aug'=>array("Augusti", "&#20843;&#26376;", "August", "Ao&ucirc;t"),
    'sep'=>array("Septembris", "&#20061;&#26376;", "September", "Septembre"),
    'oct'=>array("Octobris", "&#21313;&#26376;", "October", "Octobre"),
    'nov'=>array("Novembris", "&#21313;&#19968;&#26376;", "November", "Novembre"),
    'dec'=>array("Decembris", "&#21313;&#20108;&#26376;", "December", "D&eacute;cembre"));

//瞻禮（星期）
$weeks = array('sun'=>array("<font color=red>Dominica</font>","&#26143;&#26399;&#26085;<font color=red>(&#20027;&#26085;)</font>","<font color=red>Sunday</font>","<font color=red>Dimanche</font>","<font color=red>Dimanche</font>"),
    'mon'=>array("Feria secunda","&#26143;&#26399;&#19968;","Monday","Lundi","Lundi"),
    'tue'=>array("Feria tertia","&#26143;&#26399;&#20108;","Tuesday","Mardi","Mardi"),
    'wed'=>array("Feria quarta","&#26143;&#26399;&#19977;","Wednesday","Mercredi","Mercredi"),
    'thu'=>array("Feria quinta","&#26143;&#26399;&#22235;","Thursday","jeudi","jeudi"),
    'fri'=>array("Feria sexta","&#26143;&#26399;&#20116;","Friday","Vendredi","Vendredi"),
    'sat'=>array("Sabbato","&#26143;&#26399;&#20845;","Saturday","Samedi","Samedi"));


//數據庫連結字符串，ID/PW
//eg: mysql:host=127.1.1.0;dbname=personal;charset=utf8
$db_dns = 'mysql:host=127.0.0.1;dbname=csvd;charset=utf8';
$db_username = 'root';
$db_password = 'xiaosan';

/*

$db_dns = 'mysql:host=127.0.0.1;dbname=db-csvd;charset=utf8';
$db_username = '';
$db_password = '';
*/

//數據庫字符編碼<br/>
//PHP某些版本不支持PDO DNS直接设定编码，所以需要单独再设定一次。
$db_encoding = 'utf8';

//是否使用持久化连接
$db_persistent = false;

/**
 * 獲取當前頁面URL
 * @return string URL
 */
function geturl() {
    return 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
}

//異常處理模塊
//require(DIR_LIB . DS . 'core-error.php');

// Import TEXT Class package.
//數據處理模塊
require('cs-textdb.php');
$db = new coredb($db_dns, $db_username, $db_password, $db_persistent);
$db->set_encoding($db_encoding);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$textdb = new textdb($db);


//初始化配置操作句柄
//require(DIR_LIB . DS . 'oa-configs.php');
//$oaconfig = new oaconfigs($db);

//初始化IP地址
//require(DIR_LIB . DS . 'core-ip.php');
//$coreip = new coreip(DIR_DATA . DS . 'configs' . DS . 'qqwry.dat', $db);
//$ip_arr = $coreip->get_ip();

//初始化日志操作
//require(DIR_LIB . DS . 'core-log.php');
//$log = new corelog($ip_arr['addr'], $db, true);

//获取页面基本配置内容
//网站标题
$website_title = "Centrum Studium Verbum Domini";
//页脚信息
$website_footer = '&copy; 2012-'.date("Y").' <b><font color="#0099EE">Autumn</font>.<font color="orange">Digital</font></b>';

/****/
$my_user_id = 0;
$my_user_name = '';
$my_group = 2;
$my_group_name = '';
$my_authority = 0; 	//user_authority
$my_language = 0;

//$authority_list = {Team:'成員', manager:'部門主管',admin:'管理員'};
$authority_list = array(
	array('Member','Stuff','Manage','Admin','Admin','Admin'),
	array('成員','員工','部門主管','管理員','管理員'));

function ip() {
    //strcasecmp 比较两个字符，不区分大小写。返回0，>0，<0。
    if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
        $ip = getenv('HTTP_CLIENT_IP');
    } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
    } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
        $ip = getenv('REMOTE_ADDR');
    } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    $res =  preg_match ( '/[\d\.]{7,15}/', $ip, $matches ) ? $matches [0] : '';
    return $res;
    //dump(phpinfo());//所有PHP配置信息
}


// 工具集
class utils {
    
    public function __construct() {
    //$this->db = $db;
    }
    
    public function guid()
    {
        if (function_exists('com_create_guid') === true)
            return trim(com_create_guid(), '{}');
    
        $data = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
        
        // GUID STRING FORMAT: '%s%s-%s-%s-%s-%s%s%s'
        return vsprintf('%s%s%s%s%s%s%s%s', str_split(bin2hex($data), 4));
    }
    
    // Parsing url request data
    public function param($key, $def){
    
        $param = isset($_GET[$key]) ? $_GET[$key] : $def;
        if (empty($param)){
            $param = isset($_POST[$key]) ? $_POST[$key] : $def;
        }
    
        return $param;
    }
    
    public function microtime_float(){
   list($usec, $sec) = explode(" ", microtime());
   return ((float)$usec + (float)$sec);
   
    }
    
    /** 格式化时间戳，精确到毫秒，x代表毫秒 */
    public function microtime_format($tag, $time){
       list($usec, $sec) = explode(".", $time);
       $date = date($tag,$usec);
       return str_replace('x', $sec, $date);
    }
        
    public function get_user($user, $owner){
        if ($user == 0){
            return false;
        }
        if ($owner == 0){
            $owner = $user;
        }
        
        global $membra;
        global $cat_entry;
        $user_info = $membra->view_account((int)$owner);
            
        if($user_info){
            //echo '$username'; 
            $member['id'] = (int)$owner;
            $member['account'] = $user_info['user_account'];
            $member['name'] = $user_info['user_name'];
            $member['sign'] = $user_info['user_sign'];
            $member['avatar'] = $user_info['user_face'];
            //$likes 
            $member['likes'] = (int)$user_info['user_likes'];
            //$follow 
            $member['follow'] = (int)$user_info['user_follow'];
            //collect
            $member['collect'] = (int)$user_info['user_collect'];
            //$watch
            $member['watch'] = (int)$user_info['user_watch'];
            $member['entry'] = (int)$user_info['user_entry'];;
    
            $member['watched'] = 0;
            if ($user != $owner){
                if( $cat_entry->my_collect($user, $owner, 'watch', 0, 10)){
                    $member['watched'] = 1;
                }
            }
            return $member;
        }else{
            return false;
        }
    }
    
    public function str_datetime($timestamp = '')
    {   
    $timestamp = $this->get_timestamp($timestamp);
    
    if (date('Y-m-d', $timestamp) == date('Y-m-d')){
        return 'Today '.date("H:m", $timestamp);
    }else{
        
        return date("m-d", $timestamp);
    }
    }
    
    public function str_format_time($timestamp = '')
    {   
    return date("m-d H:m", $this->get_timestamp($timestamp));
    }
    
    public function str_format_date($timestamp = '')
    {  
        $timestamp = $this->get_timestamp($timestamp);
    return date("m-d", $this->get_timestamp($timestamp));
    }
    
    
    private function get_timestamp($timestamp = ''){
        
        if (preg_match("/[0-9]{4}-[0-9]{1,2}-[0-9]{1,2} (0[0-9]|1[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])/i", $timestamp)) 
    {
      list($date,$time) = explode(" ",$timestamp);
      list($year,$month,$day) = explode("-",$date);
      list($hour,$minute,$seconds ) = explode(":",$time);
        return gmmktime($hour,$minute,$seconds,$month,$day,$year);
    }
    else
    {
        return time();
    }
    }
    
    public function new_filename(){
        return date('Y').date('m').date('d').date('H').date('m').date('s');
        
    }
}
$utils = new utils($db);


/**
 * 異常處理
 */
class coreerror {

    /**
     * 異常响应页面
     * @var string 
     */
    public $error_page = 'error.html';

    /**
     * 異常日志记录开关
     * @since 2
     * @var type 
     */
    public $log_on = true;

    /**
     * 初始化
     * @param string $msg 消息内容
     * @param string $id 问题标识 eg: core-error::__construct()::return true
     * @param integer $level 级别 eg: 0 - 普通错误 1- 数据库和IO故障 2 - 无法预料的系统故障
     * @param corelog $log 日志操作句柄
     */
    public function __construct($message, $id, $level = 0, $log = null) {
        if ($this->log_on == true && $level == 0 && $log != null) {
            $log->add($id . ' : ' . $message);
        }
        $this->load_page();
    }

    /**
     * 跳转到異常页面
     * @since 3
     */
    private function load_page() {
        try {
            //header('Location:' . $this->error_page);
        } catch (Exception $e) {
                            die();
        }
    }
}

/**
 * 错误接收函数
 * @since 3
 * @param string $errno 错误级别
 * @param string $errstr 错误描述
 * @param string $errfile 错误文件名
 * @param integer $errline 错误发生行
 */
function core_error_handle($errno, $errstr, $errfile, $errline) {
    $message = $errno . ' : ' . $errstr;
    $id = $errfile . '::' . $errline;
    new coreerror($message, $id, 2);
}
/**
 * 设定错误输出函数
 * @since 2
 */
set_error_handler('core_error_handle');


?>
