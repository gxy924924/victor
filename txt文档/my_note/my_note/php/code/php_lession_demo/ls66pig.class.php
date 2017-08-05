<?php
	class Pig{
		public $name;
		public $weight;
		public $color;
		public $age;

		//成员方法
		public function addWeight($a){
			$this->weight=$this->weight+$a;
		}
		public function minusWeight($a){
			$this->weight=$this->weight-$a;
		}
		public function showWeight(){
		echo "猪的重量=".$this->weight;
		}

	}
?>