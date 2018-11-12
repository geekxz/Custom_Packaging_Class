<meta charset='utf-8'>
<?php 
	include 'config.php';
	//定义数据库操作模型
	class Model
	{
		public $table;				//表名
		public $link;				//数据库链接
		public $field=array();		//获取表的字段
		public $pk;					//表的主键
		public $where=array();		//搜索条件
		/**
		 * 构造方法
		 * @param 	$table
		 * @param 	$linlk
		 */
		public function __construct($table){
			$this->table=$table;
			//链接数据库
			$this->link = mysqli_connect(HOST,USER,PASS);
			//选择数据库
			mysqli_select_db($this->link,DBNAME);
			//设置字符集
			mysqli_set_charset($this->link,'utf8');
			//获取表的字段
			$this->getField();
		}
		/**
		 * 获取表字段信息   getField()
		 * @param 	$field[]    获取表的字段
		 * @param 	$pk 		表的主键
		 */
		private function getField(){
			//数据验证
			$sql='desc '.$this->table;
			$res = mysqli_query($this->link,$sql);	
			while($row = mysqli_fetch_assoc($res)){
				
				$this->field[]=$row['Field'];
				//获取主键
				if($row['Key']=='PRI'){
					$this->pk=$row['Field'];
				}
			}	
			
		}
		/**
		 * 向数据库添加数据  add()
		 * @param 	Array 	$arr 	要添加的从表单中获取的数据@param 	
		 */
		public function add($arr){
			//数据过滤
			foreach($arr as $key=>$val){
				if(!in_array($key,$this->field)){
						unset($arr[$key]);
				}
			}		
			
			$v=array_values($arr);
			$key=implode(',',array_keys($arr));	
			$val=implode('","',$v);
			$val='"'.$val.'"';	
			//拼接sql语句
			$sql="insert into ".$this->table." (".$key.") values(".$val.")";
			
			$res = mysqli_query($this->link,$sql);
			//判断
			if($res){
				//获取插入的id	
				return mysqli_insert_id($this->link);
			}else{
				return false;
			}	

		}	
		/**
		 * 从数据库删除数据  del()
		 * @param 	Array 	$aid 	要删除的id编号	
		 */
		public function del($id){
			//定义sql语句
			$sql="delete from ".$this->table.' where '.$this->pk.'='.$id;
			
			$res = mysqli_query($this->link,$sql);	

			if($res && mysqli_affected_rows($this->link)>0){
				//返回影响行数
				return mysqli_affected_rows($this->link);	
			}else{
				return false;
			}
		}
		/**
		 * 更新数据库中数据  update()
		 * @param 	Array 	$arr 	要更新的从表单中获取的数据
		 */	
		public function update($arr){
			$arr1=array();
			//封装sql语句
			foreach($arr as $key=>$val){
				if(!in_array($key,$this->field)){
					//非法字段
					unset($arr[$key]);
				}else{
					//合法字段
					if($key!=$this->pk){//过滤主键
						$arr1[]=$key.'="'.$val.'"';
					}
				}
			}
			//var_dump($arr1);		
			$str = implode(',',$arr1);

			//echo $str;
			$sql = 'update '.$this->table.' set '.$str.' where '.$this->pk.'='.$arr[$this->pk];
			
			$res = mysqli_query($this->link,$sql);

			if($res && mysqli_affected_rows($this->link)>0){
				//返回影响行数
				return mysqli_affected_rows($this->link);	
			}else{
				return false;
			}

		}
		/**
		 * 查找数据表中的所有数据   select()
		 * @param 	
		 */
		public function select(){
			$sql='select * from '.$this->table;
			//是否有搜索条件
			if(count($this->where)>0){
				$str = implode(' and ',$this->where);	
				$str=' where '.$str;
				
				$sql=$sql.$str;
				//echo $sql;exit;
			}
			//是否有排序条件
			if($this->order!=null){
				$sql.=' order by '.$this->order;
			}
			//是否有分页条件
			if($this->limit!=null){
				$sql.=' limit '.$this->limit;
			}
			//echo $sql;exit;
			$res = mysqli_query($this->link,$sql);
			$arr=array();
			while($row=mysqli_fetch_assoc($res)){
				$arr[]=$row;
			}
			return $arr;
		}
		/**
		 * 查找数据表中的一条数据   find()
		 * @param 	int 	$id 	要查的id编号
		 */
		public function find($id){
			$sql ='select * from '.$this->table.' where '.$this->pk.'='.$id;
			
			$res = mysqli_query($this->link,$sql);	
			
			if($res->num_rows){
				return mysqli_fetch_assoc($res);
			}else{
				return false;
			}
		}
	
		/**
		 * 统计表数据条数
		 */
		public function count(){
			$sql='select count(*) as c from '.$this->table;
			$res = mysqli_query($this->link,$sql);	
			$arr= mysqli_fetch_assoc($res);
			return $arr['c'];
		}

		public function where($where){
			$this->where[]=$where;
			return $this;
		}	

		public function  limit($limit){
			$this->limit=$limit;	
			return $this;
		}
		public function order($order){
			$this->order=$order;
			return $this;
		}
	}

	$mod = new Model('user');
	echo "<pre>";
	$res = $mod->where('id>48')->order('id desc')->limit('0,5')->select();
	$res = $mod->select();
	var_dump($res);
	//$arr=array('name1'=>'zhangsan','sex'=>'w','classid'=>'lamp141');
	//$res = $mod->add($arr);	
	//var_dump($res);
	//$res = $mod->del(2);
	//var_dump($res);
	//$arr=array('id'=>'1','name'=>'lisi','sex'=>'m','classid'=>'lamp141');

	//$mod->update($arr);
	//$res = $mod->select();
	//var_dump($res);
	//$res = $mod->find(1);
	//var_dump($res);
	//echo $mod->count();