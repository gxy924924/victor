<?php 
namespace sp1\name;
include_once 'name_sp2.php';
const FOO = 1;
function foo() {
	echo "</br>name_sp1->fun.foo</br>";
}
class foo
{
    static function staticmethod() {
    	echo "name_sp1->foo->static_st..</br>";
    }
}

function name_sp1() {
	echo "</br>name_sp1->fun.foo</br>";
}
class foo
{
    static function staticmethod() {
    	echo "name_sp1->foo->static_st..</br>";
    }
}


// echo '</br></br>name_sp2.php::完全限定名称:\sp1\</br></br>';
// echo \sp1\FOO;
// \sp1\foo();
// \sp1\foo::staticmethod();
 ?>