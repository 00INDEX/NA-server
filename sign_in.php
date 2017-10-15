<?
/**
 *-----------------------------------------------------------------------------------------------------------------------------
 *>接口说明:用户登陆接口
 *<code>
 *URL地址:
 *提交方式:POST
 *参数#1:user,类型:STRING,必须:YES,实例:admin
 *参数#2:password,类型:STRING,必须:YES,实例:admin
 *</code>
 *-----------------------------------------------------------------------------------------------------------------------------
 *@title 用户登陆接口
 *@action
 *params user james STRING
 *params password james STRING
 *@method post
 */
class sign_in externs Demos_App_Server{
//用户登陆逻辑
      $user = $this->params('user');
      $password = $this->params('password');
      if ($user && $password) {
             $customerDao = $this->dao->load('Core_Customer');
             $customer = $customerDao->doAuth($user,$password);
             if ($customer) {
                     $customer['sid'] = session_id();
                     $_SESSION['customer'] = $customer;
                     $this->render('10002','Login Success',array('customer' => $customer));
                     }
             }
      //返回sessionID给客户端
      $customer = array('sid' => seeion_id());
      $this->render('14001','Login Failed',array('Customer' => $customer));
      }
      public function doAuth($user,$password){
      $sql = $this->select()
           ->from($this->t1,'*')
           ->where("{$this->t1}.user = ?",$user)
           ->where("{$this->t1}.password = ?",$password);
      $user = $this->dbr()->fetchRow($sql);
      if ($user) return $user;
      return false;
      }
}
