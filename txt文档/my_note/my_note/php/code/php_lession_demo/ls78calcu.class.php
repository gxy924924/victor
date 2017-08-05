<!--封装-->
<?php
class operService{
	public function getResult($num1,$num2,$oper){
		switch($oper){
		case "+":
			return $num1+$num2;
			break;
		case "-":
			return $num1-$num2;
			break;
		case "*":
			return $num1*$num2;
			break;
		case "/":
			return $num1/$num2;
			break;
		default:
			echo "运算符有误";
		}
	}

}

?>

