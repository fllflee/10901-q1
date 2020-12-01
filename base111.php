<?php
class db{
	//設定屬性
	private $dsn="mysql:host=localhost;charset=urt8;dbname=db88";
	private $root="root";
	private $password="";
	private $table;
	private $pdo;

	//設定建構式
	public function __construct(){
		$this->table=$table;
		$this->pdo=new PDO($this->dsn,$this->root,$this->password);
	}

	//取得全部資料
	public function all(...$arg){
		$sql="select * from $this->table";
		
		if(!empty($arg[0])&& is_array($arg[0])){
			foreach($arg[0] as $key => $value){
				$tmp[]=sprintf("`%s`='%s'",$key,$value);
			}
			$sql=$sql . " where ".implode(" && ",$tmp);
		}

		if(!empty($arg[1])){
			$sql=$sql.$arg[1];
		}
		//echo $sql;這行取消註解可以檢查
		return $this->pdo->query($sql)->fetchAll();

	}



	//取得單筆資料
	public function find($arg){
		$sql="select * from $this->table ";
		
		if(is_array($arg)){
			foreach($arg as $key => $value){
				$tmp[]=sprintf("`%s`='%s'",$key,$value);
			}
			$sql=$sql . " where ".implode(" && ",$tmp);

		}else{

			$sql=$sql. " where `id`='$arg'";
		}
	
		//echo $sql;這行取消註解可以檢查
		return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

	}

	//計算筆數
	public function count(...$arg){
		$sql="select count(*) from $this->table";
		
		if(!empty($arg[0])&& is_array($arg[0])){
			foreach($arg[0] as $key => $value){
				$tmp[]=sprintf("`%s`='%s'",$key,$value);
			}
			$sql=$sql . " where ".implode(" && ",$tmp);
		}

		if(!empty($arg[1])){
			$sql=$sql.$arg[1];
		}
		//echo $sql;這行取消註解可以檢查
		return $this->pdo->query($sql)->fetchcolumn();

	}

	//新增/更新資料

	//刪除資料
	public function del($arg){
		$sql="delete from $this->table ";
		
		if(is_array($arg)){
			foreach($arg as $key => $value){
				$tmp[]=sprintf("`%s`='%s'",$key,$value);
			}
			$sql=$sql . " where ".implode(" && ",$tmp);

		}else{

			$sql=$sql. " where `id`='$arg'";
		}
	
		//echo $sql;這行取消註解可以檢查
		return $this->pdo->exec($sql);

	}



	//萬用語法
function q($sql){
	return $this->pdo->query($sql)->fetchAll();
}

}
function to($url){
	header("location:".$url);
}
?>