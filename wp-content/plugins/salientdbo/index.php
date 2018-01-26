<?php 

/* Plugin name: Salient DBO
	Plugin uri:
	Description: Activa la conectividad para la base de datos remota;
	Author:agaliciahernandez@gmail.com
	Author URI: mirrorlinux.net
	Version: 0.1 */

	
	/* Generic Class to simplify dbo interaction */
	
	class Salientdbo{
		
		protected static $instance = NULL;
	
		public static function get_instance(){
	        if ( NULL === self::$instance ){
	            self::$instance = new self;
	        }
	        return self::$instance;
	    }
		
		function __construct(){
			
			$host = $_SERVER['SERVER_ADDR'];

			// if($host == "::1"){
			// 	$this->host = "localhost";
			// 	$this->dbo = "bancomer";
			// 	$this->user = "root";
			// 	$this->pass  = "root";
		//	}else{
				//$this->host = "173.194.240.247"; Anterior
				$this->host = "173.194.254.4";
				$this->dbo = "suiterrhhdb";
				$this->user = "admin";
				$this->pass  = "admin";
			//}
			
	    }
	    
	    function conexion(){
			$con  = mysqli_connect( $this->host, $this->user, $this->pass, $this->dbo ) or die ( $con->connect_error);
			mysqli_set_charset($con, 'utf8');
			return $con;
	    }
	    
	    function simpleQuery(){
		    
		    $response = array();
		    $con = $this->conexion();
		    
		    $query = mysqli_query($con, "select * from tsrh_regiones");
		    $response = mysqli_fetch_object($query);
		    
		    mysqli_close($con);
		    return $response;
		    
	    }
	    
	    function simpleUnique($field, $table){
		    $response = array();
		    $con = $this->conexion();
		    
			$query = mysqli_query($con, "select distinct( $field ) from $table ");
			$response = mysqli_fetch_object($query);
		    
		    mysqli_close($con);
		    return $response;
	    }
	    
	    
		function createKeyValue($params){
			$values = new stdClass();
			foreach($params as $key=>$value){
				$values->key = $key;
				$values->value = $value;	
			}
			return $values;
		}
		
		function execute($sql){
			
			$con = $this->conexion();
			
			$response = array();

			$query = mysqli_query($con, $sql);
			
			while($current = mysqli_fetch_object($query)){
				array_push($response, $current);
			};

			mysqli_close($con);
			return $response;
		}

		function executeObject($sql){
			
			$con = $this->conexion();

			$response = mysqli_query($con, $sql);
			
			return $response;
		}
	
		function executeRow($sql){
			$con = $this->conexion();
			$response = array();
			
			$query = mysqli_query($con, $sql);
			$response = mysqli_fetch_object($query);

			mysqli_close($con);
			return $response;
		}
		
		function deleteFromTable($table, $params){

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
