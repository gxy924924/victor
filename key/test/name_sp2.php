<?php 
namespace sp1;
// include_once 'name_sp1.php';
const FOO = 2;
$b="aa</br>";
function foo() {
	echo "</br>name_sp2->fun.foo</br>";
}
class foo
{
	public static function autoload($class){
		echo $class."</br>";
		$arr=explode("\\", $class);
		$i=count($arr);
		$file=$arr[$i-1];
		$file.=".php";
		var_dump($file);
		require_once $file;
		// 


    }

    static function staticmethod() {
    	echo "foo->static_st..</br>";
    }
}

spl_autoload_register('sp1\\foo::autoload', true, true);//
echo "namespace->".__namespace__."</br>";
// \sp1\name\name_sp1::staticmethod1();
// echo 'name_sp2.php::非限定名称:</br></br>';
// echo FOO;
// foo();
// foo::staticmethod();
// // echo $a;
// echo '</br></br>name_sp2.php::完全限定名称:\sp1\</br></br>';
// echo \sp1\FOO;
// \sp1\foo();
// \sp1\foo::staticmethod();

// echo '</br></br>name_sp2.php::限定名称:name\</br></br>';
// echo name\FOO;
// name\foo();
// name\foo::staticmethod();

// echo '</br></br>name_sp2.php::完全限定名称:\sp1\name\</br></br>';
// echo \sp1\name\FOO;
// \sp1\name\foo();
// \sp1\name\foo::staticmethod();
?>