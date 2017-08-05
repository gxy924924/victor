<!--封装-->
<?php
class Person{
	public $name;
	protected $age;
	private $salary;

	function __construct($name,$age,$salary){
	$this->name=$name;
	$this->age=$age;
	$this->salary=$salary;
	}

	function showInfo(){
		//这里说明在本类中可以使用	public protected private 
		echo $this->name."||".$this->age."||".$this->salary."</br>";
	}
	//我们可以通过方法来访问protected 和private
	public function getSalary(){
		return $this->salary;
	}
	public function setAge($age){
		if($age>1&&$age<120){
		$this->age=$age;
		}else {
			echo "超出年龄范围请重输";
		}
	}
	public function getAge(){
		echo "年龄=".$this->age;
	}
	function test11(){
		//函数之间可以任意调用，但是要用this
		$this->test12();
		}
	function test12(){
		echo "test12";
	}
}
/*
$p1=new Person("孙悟空",30,1000);
//$p1->showInfo();//内部类中都可以访问
echo $p1->name;
//echo $p1->age;//这里不能能访问protected $age;
//echo $p1->salary;//这里不能能访问private $salary;

echo "工资=".$p1->getSalary();
$p1->setAge(20);
$p1->getAge();
$p1->setAge(-2);
$p1->test11();
*/
?>

<!--继承.........................................-->

<?php
//父类
class Stu{
public $name;
protected $age;
protected $grade;
	public function showInfo(){
		echo $this->name."||".$this->grade;
	}
}
//子类extends Stu表示继承
class pupil extends Stu{
	public function testing(){
		echo "研究生考试。。。";
	}
}
class Graduate extends Stu{
	public function testing(){
		echo "小学生考试。。。";
	}
}
//
$stu1=new pupil();
$stu1->name="小明";
$stu1->testing();
$stu1->showInfo();
$stu2=new Graduate();
$stu2->name="老命";
$stu2->testing();
$stu2->showInfo();

?>