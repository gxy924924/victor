<?php
//它的一个对象实例就表示adm表的一条记录
class admin{
  private $id;
  private $name;
  private $password;
/**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

/**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

/**
     * @return the $password
     */
    public function getPassword()
    {
        return $this->password;
    }

/**
     * @param field_type $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

/**
     * @param field_type $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

/**
     * @param field_type $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }


  
}
?>