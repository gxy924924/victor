<?php
//��Ԫ����
$a=90;$b=180;
$c=$a>$b?  (12-10):"hello";//$c=true/false? true=.../false=...
echo 'c='.$c;
?><br/>
<?php
//�ַ�������
$a="hello world";
$b=123;
$c=$b.$a;//��ʾ����ƴ��
echo $c;
?></br>
<?php
//���������
class Dog{}
class Cat{}
//����һ������
$cat1=new Cat;
var_dump($cat1 instanceof Cat);
if($cat1 instanceof Cat){
	echo '$cat1 ��һֻè';
}
?>