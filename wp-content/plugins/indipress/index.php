<?php 

/* Plugin name: Indipress
Plugin uri:
Description:
Author: agaliciahernandez@gmail.com
Author URI:
Version: 0.6 */

wp_register_style( 'fontAwesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css');
// wp_register_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
// wp_register_script( 'jBoostrap', 'http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
wp_register_style( 'bootstrap', '/wp-content/themes/salient/css/bootstrap.min.css' );
wp_register_script( 'jBoostrap', '/wp-content/themes/salient/js/bootstrap.min.js');
wp_register_script( 'generics',  '/wp-content/plugins/indipress/assets/app.js');

wp_enqueue_style('bootstrap');
//wp_enqueue_style( "fontAwesome");
wp_enqueue_script('jBoostrap');
wp_enqueue_script( 'generics');

/* Install dbo and init plugin */
add_action( "init", "installIndipress");

/* Add menu navigation */
add_action( "admin_menu", "addMenu");

/* Generic operations */
add_action( 'admin_post_createpost', 'createpost' );
add_action( 'admin_post_updatepost', 'updatepost' );
add_action( 'admin_post_deletecomponent', 'deletecomponent');


/* Generic Class to simplify dbo interaction */
class Indipress{
	
	protected static $instance = NULL;

	public static function get_instance(){
        if ( NULL === self::$instance ){
            self::$instance = new self;
        }
        return self::$instance;
    }
	
	function __construct(){
        global $wpdb;
        $this->db = $wpdb;
    }
    
	function getQuery($table){
		$query = $this->db->get_results("select * from $table", OBJECT);
		return $query;
	}
	
	function singleQuery($table, $params){
		$params = $this->createKeyValue($params);
		$query = $this->db->get_row("select * from $table where $params->key = $params->value ", OBJECT);
	}
	
	function getWhere($table, $params){
		$string = "";
		foreach($params as $key=>$value){
			$string .= " $key = '". $value ."' and";
		}
		$string = substr($string, 0, count($string) - 5);
		$query = $this->db->get_results( "select * from ". $table ." where ". $string , OBJECT);
		return $query;
	}
		
	function getRowWhere($table, $params){
		$string = "";
		foreach($params as $key=>$value){
			$string .= " $key = '". $value ."' and";
		}
		$string = substr($string, 0, count($string) - 5);
		$query = $this->db->get_row( "select * from ". $table ." where ". $string);
		return $query;
	}	
		
	function create($table, $params){
		$this->db->insert($table, $params);
		return true;
	}
	
	function createID($table, $params){
		$this->db->insert($table, $params);
		return $this->db->insert_id;
	}
	
	function createKeyValue($params){
		$value = new stdClass();
		foreach($params as $key=>$value){
			$value->key = $key;
			$value->value = $value;	
		}
		return $value;
	}
	
	function execute($query){
		return $this->db->get_results($query);
	}

	function executeRow($query){
		return $this->db->get_row($query);
	}
	
	function validateSingleField($table, $params){
		$params = $this->createKeyValue($params);
		$query = $this->db->get_row("select count(*) as contador from $table where '". $params->key ."' =  '". $params->$value."' ");
		return $query;
	}
	
	function deleteFromTable($table, $params){
		$query = $this->db->delete($table, $params);
	}

	function update($table, $params){
		$this->db->update( $table, $params, array("id" => $params["id"]) );
		return true;
	}
	
	function createslug($string){
		$invalid = array("á"=>"a","é"=>"e","í"=>"i","ó"=>"o","ú"=>"u"," "=>"-","ñ"=>"n", "Á"=>"a", "É"=>"e", "Í"=>"i", "Ó"=>"o", "Ú"=>"u");
		$slug = strtolower(strtr($string, $invalid));
		return $slug;
	}
}

/* Wordpress actions */

function installIndipress(){
	include("dbo/installer.php");
}

function addMenu(){
	
	/* Visible menu */
	add_menu_page("Indipress",	 "Indipress",	7, 	"perfilados", "perfiladoMenu");
	
	/* Submenu Items */
	add_submenu_page("perfilados",	"Aplicaciones", 		"+ Aplicaciones",					7,	"aplicaciones",		"perfilesApp");

	/* Non visible menu */
	add_submenu_page( "", "", "", 7, "add-app", "addApp");
	add_submenu_page( "", "", "", 7, "edit-app", "editApp");
}

/* Wordpress mini controllers */

function perfiladoMenu(){
	include_once("views/home.php");
}

function perfilesApp(){
	$apps = Indipress::get_instance()->getQuery("_indipress");
	include_once("views/aplicaciones.php");
}


/* Menu actions */

function addApp(){
	wp_enqueue_media();
	$method = "createpost";
	include_once("views/forms/aplicaciones.php");
}

function editApp(){
	wp_enqueue_media();
	$method = "updatepost";
	$profile = Indipress::get_instance()->getRowWhere("_indipress",  array("id" => $_GET["itemid"]));
	include_once("views/forms/aplicaciones.php");
}

/*  Generic Operations */

function createpost(){
	
	$post = (object)$_POST;
	$description = "";
	$attachment = "ND";
	
	$category = 0;
	$parent = 0;
	$featured = 0;
	$description = $post->description;
	
	if(isset($post->json) && $post->json == "ON"){
		$description = json_encode($post->description);
	}
	
	if(isset($post->parent)){
		$parent = $post->parent;
	}
	
	if(isset($post->featured)){
		$featured = $post->featured;
	}
	
	if(isset($post->category)){
		$category = $post->category;
	}

	if(isset($post->parent)){
		$parent = $post->parent;
	}

	if(isset($post->featured)){
		$featured = $post->featured;
	}
	
	if(isset($post->attachment) && !empty($post->attachment)){
		if(isset($post->jsonimg)){
			$attachment = json_encode($post->attachment);
		}else{
			$attachment = $post->attachment;
		}
	}
	$params = array();
	$params["name"] = $post->name;
	$params["description"] = $description;
	$params["category"] = $category;
	$params["slug"] = Indipress::get_instance()->createslug($post->name);
	$params["type"] = $post->type;
	$params["perfilado"] = $post->perfilado;
	$params["featured"] = $featured;
	$params["attachment"] = $attachment;
	
	Indipress::get_instance()->create( "_indipress", $params );
	wp_redirect(admin_url('admin.php?page=' . $post->origin ));
}

function updatepost(){
	$post = (object)$_POST;
	$description = "";
	$attachment = "ND";
	$id= $post->id;
	$category = 0;
	$parent = 0;
	$featured = 0;
	$description = $post->description;
	
	if(isset($post->json) && $post->json == "ON"){
		$description = json_encode($post->description);
	}
	
	if(isset($post->parent)){
		$parent = $post->parent;
	}
	
	if(isset($post->featured)){
		$featured = $post->featured;
	}
	
	if(isset($post->category)){
		$category = $post->category;
	}

	if(isset($post->parent)){
		$parent = $post->parent;
	}

	if(isset($post->featured)){
		$featured = $post->featured;
	}
	
	if(isset($post->attachment) && !empty($post->attachment)){
		if(isset($post->jsonimg)){
			$attachment = json_encode($post->attachment);
		}else{
			$attachment = $post->attachment;
		}
	}
	$params = array();
	$params["id"] = $id;
	$params["name"] = $post->name;
	$params["description"] = $description;
	$params["category"] = $category;
	$params["slug"] = Indipress::get_instance()->createslug($post->name);
	$params["type"] = $post->type;
	$params["perfilado"] = $post->perfilado;
	$params["featured"] = $featured;
	$params["attachment"] = $attachment;
			
	Indipress::get_instance()->update( "_indipress", $params );
	wp_redirect(admin_url('admin.php?page=' . $post->origin ));
}

function deletecomponent(){
	$post = (object)$_POST;	
	Indipress::get_instance()->deleteFromTable("_indipress", array("id" => $post->item));
	echo json_encode(array("message" => "success"));
}


/* Custom pages */

add_action( 'init', 'pagename_init' );
add_action( 'query_vars', 'pagename_query_vars' );
add_action( 'parse_request', 'pagename_parse_request' );

function pagename_init() {
	//add_rewrite_rule( '', 'index.php?&favorites=$match[1]', 'top' );
	add_rewrite_rule( 'favorites/([^/]*)/?', 'index.php?&favorites=$match[1]', 'top' );
}

function pagename_query_vars( $query_vars ){
	$query_vars[] = 'favorites';
  	return $query_vars;
}

function pagename_parse_request( &$wp ){

	if ( $wp->query_vars[favorites] == 1 ) {
		include( dirname( __FILE__ ) . '/views/display.php' );
		exit();
	}
	
}
