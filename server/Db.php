<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class Db{
    private $host    = "localhost";
    private $user    = "root";
    private $pass    = "";
    private $dbname  = "tienda";
    public $dbHandle;
    public function __construct(){
        $this->dbHandle = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->user, $this->pass);
        $this->dbHandle->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->dbHandle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        //$this->conexion->set_charset("utf8");
    }
    public function update_recursive($data1, $data2){
        $this->set_charset();
        $rs = $this->dataRead($data1);
        $upd = '';
        $this->dbHandle->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
        foreach ($rs as $key => $value) {
          $upd= ' UPDATE '.$data2['tabla'].' SET ';
          $i = 0;
          foreach ($data1['copy'] as $k => $field) {
            if (isset($data1['cond'])) {
              $strcond = ''; $j = 0;
              foreach ($data1['cond'] as $kc => $valcond) {
                  if ($i != 0) {
                    $upd.= ',';
                  }
                  if ($j != 0) {
                    $strcond.= ',';
                  }
                  $cond = is_numeric($value[$valcond]) && !isset($data1['stringall']) ? $valcond.' = '.$value[$valcond] : $valcond.'="'.$value[$valcond].'"';
                  $strcond.= $cond;
                  if (is_numeric($value[$valcond])) {
                    $digitos = strlen($value[$valcond]);
                    $datnum = str_pad($value[$valcond], 9, "0", STR_PAD_LEFT);
                    $strcond.= !isset($data1['stringall']) ? ' OR '.$valcond.' = '.$datnum : ' OR '.$valcond.' = "'.$datnum.'"';
                  }
                  $j++;
                  $dato = is_numeric($value[$field]) ? $value[$field] : '"'.$value[$field].'"';
                  $upd.= $field.'='.$dato.' WHERE '.$strcond;
                  $i++;
              }
            }else {
              $upd.= $field.'='.$value[$field];
              $i++;
            }
          }
          $upd.=';';
          echo $i.':'.$upd.' ';
          $rs = $this->prepareSql($upd);
          //var_dump($rs);
          //echo $upd; exit;
        }
        // $fh = fopen("test.sql", 'w') or die("Se produjo un error al crear el archivo");
        // fwrite($fh, $upd) or die("No se pudo escribir en el archivo");
        // fclose($fh);
        //echo $upd; //exit;
        //$rs = $this->prepare($upd);
        //var_dump($rs);
        echo 'listo';
        exit;
    }
    public function dataRead($data){
      $fields = implode(',',$data['fields']);
      return $this->prepare("SELECT ".$fields." FROM ".$data['tabla']);
    }
    public function set_charset(){
      $sql = "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'";
      $this->prepare($sql);
    }
    public function insert($data,$table){
      $sql = 'INSERT INTO '.$table.' ';
      $col = '(';
      $row = ' VALUES (';
      if ($data) {
        $i = 0;
        $j = 0;
        $k = 0;
        foreach ($data as $key => $value) {
          if (is_array($value)) {
            $j = 0;
            if ($k != 0) {
              $row.= ',(';
            }
            foreach ($value as $k => $item) {
              if ($j != 0) {
                $row.= ',';
              }
              $row.= is_numeric($item) ? $item : "'".$item."'";
              $j++;
            }
            $row.= ')';
            $k++;
          }else{
            if ($i != 0) {
              $col.= ',';
              $row.= ',';
            }
            $col.= $key;
            $row.= is_numeric($value) ? $value : "'".$value."'";
            $i++;
          }

        }
        $col.=')';
      }
      if ($k == 0) {
        $sql.= $col;
        $row.=')';
      }
      $sql.= $row;
      echo $sql;
      $rs = $this->prepareSql($sql);
      return $rs;
    }
    public function prepareSql($sql){
        $stmt = $this->dbHandle->prepare($sql);
        if ($stmt->execute()) {
           return true;
        } else {
           return false;
        }
    }
    public function listarDatos($informacion){
        $stmt = $this->dbHandle->prepare($informacion);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rs;
    }
    public function prepare($sql){
        $stmt = $this->dbHandle->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if($stmt) {
          return $stmt;
        }
        else{
            return false;
          }
    }
}

?>
