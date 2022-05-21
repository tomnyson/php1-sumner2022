<?php
// khai báo hằng số c1
define("USERNAME", "admin");
define("PASSWORD", "123456");
class Account
{
  /**
   * public: ở bên ngoài có thể truy xuất được thuộc tính của class
   * private: bên ngoài ko thể truy xuất thuộc tính của class
   */
  private $userName;
  public $password;
  public $email;
  public $role;
  const DEFAULT_USERNAME = 'admin';
  const DEFAULT_PASSWORD = '123456';
  // hàm khởi tạo ban đầu
  function __construct($userName, $password, $email, $role)
  {
    $this->userName = $userName;
    $this->password = $password;
    $this->email = $email;
    $this->role = $role;
  }
  //get
  function getUserName()
  {
    return $this->userName;
  }
  //set
  function setUserName($name)
  {
    $this->userName = $name;
  }

  function xuatThongTin()
  {
    echo "username: " . $this->userName . "</br>";
    echo "password: " . $this->password . "</br>";
    echo "role: " . $this->role . "</br>";
    echo "email: " . $this->email . "</br>";
  }
  function isLogin($username, $password)
  {
    //c1
    if ($username == USERNAME && $password == PASSWORD) {
      return true;
    } else {
      return false;
    }
    //c2
    // if ($username == self::DEFAULT_USERNAME && $password == self::DEFAULT_PASSWORD) {
    //   return true;
    // } else {
    //   return false;
    // }
  }
}


$admin = new Account("admin", "123456", "admin@gmail.com", "admin");
echo "test: " . $admin->getUserName() . "</br>";
$admin->xuatThongTin();
echo "---------------------- </br>";
$user =  new Account("user", "123456", "user@gmail.com", "user");
$user->xuatThongTin();

$check_user = "admin1";
$check_password = "123456";
echo "default pass:" . Account::DEFAULT_PASSWORD;
if ($admin->isLogin($check_user, $check_password)) {
  echo "Đăng nhập thành công";
} else {
  echo "tài khoản or mật khẩu sai";
}