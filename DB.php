<?php
class database{
    private $host;
    private $dbusername;
    private $dbpassword;
    private $dbname;

    protected function connect(){
        $this->host = 'localhost';
        $this->dbusername = 'root';
        $this->dbpassword = '';
        $this->dbname = 'oopscrud';

        //create a connection
        $con = new mysqli($this->host,$this->dbusername,$this->dbpassword,$this->dbname);
        return $con;
    }
}

class query extends database{
    public function getData($table,$field='*',$condition=[],$like='',$order_by_field='',$order_by_type='ASC',$limit=''){
        $sql = "select $field from $table";

        // print_r($condition);
        if($condition != ''){
            $sql.=" where ";
            $c = count($condition);
            $i = 1;
            foreach($condition as $key=>$val){
                if($i == $c){
                    $sql.="$key='$val'";
                }else{
                    $sql.="$key='$val' and ";
                }
                $i++;
            }
            }

        if($order_by_field != ''){
            $sql.=" order by $order_by_field $order_by_type ";
            }

        if($limit != ''){
        $sql.=" limit $limit ";
        }
        die($sql);
        $result = $this->connect()->query($sql);
        // print_r($result);
        // print_r($result->num_rows);
        if($result->num_rows){
        $arr = array(); //make an array
        while($row = $result->fetch_assoc()){
            // print_r($row);
            $arr[] = $row;//push in the array
        }
        return $arr;
    }else{
        return 0;
    }
        
    }

    public function insertData($table,$condition){

        if($condition!=''){
            
            foreach($condition as $key=>$val){
                $fieldArr[] = $key;
                $valueArr[] = $val;
            }
            $field = implode(',',$fieldArr);
            $value = implode("','",$valueArr);
            $value = "'".$value."'";
            // echo "'".$value."'";
            // die();
            $sql = "insert into $table($field) values($value)";
            $result = $this->connect()->query($sql);
            return $result;
        }
    }
    public function DeleteData($table,$condition){

        if($condition!=''){
            $sql = "delete from $table where ";            
            $c = count($condition);
            $i = 1;
            foreach($condition as $key=>$val){
                if($i == $c){
                    $sql.="$key='$val'";
                }else{
                    $sql.="$key='$val' and ";
                }
                $i++;
            }
            // print_r($sql);
            // die();

            $result = $this->connect()->query($sql);
            return $result;
        }
    }

    public function UpdateData($table,$condition,$where_field,$where_value){

        if($condition!=''){
            $sql = "update $table set ";            
            $c = count($condition);
            $i = 1;
            foreach($condition as $key=>$val){
                if($i == $c){
                    $sql.="$key='$val'";
                }else{
                    $sql.="$key='$val' and ";
                }
                $i++;
            }
            // print_r($sql);
            // die();
            $sql.=" where $where_field='$where_value'";
            $result = $this->connect()->query($sql);
            return $result;
        }
    }
}

//select $field from $table where id='1' and name = 'anand' order by name ASC limit 1
//select $field from $table where $condition orderby $order_by_field $order_by_type limit $order_by_limit
// $field -> * or name ,email
?>