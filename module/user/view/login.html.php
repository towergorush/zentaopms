<?php
/**
 * The html template file of login method of user module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     ZenTaoPMS
 * @version     $Id: login.html.php 5084 2013-07-10 01:31:38Z wyd621@gmail.com $
 */
include '../../common/view/header.lite.html.php';
include '../../common/view/colorbox.html.php';
?>
<form method='post' target='hiddenwin'>
  <table align='center' class='table-4'> 
    <caption id='welcome'><?php printf($lang->welcome, $app->company->name);?></caption>
    <tr>
      <td class='rowhead'><?php echo $lang->user->account;?>：</td>  
      <td><input class='text-2' type='text' name='account' id='account' /></td>
    </tr>  
    <tr>
      <td class='rowhead'><?php echo $lang->user->password;?>：</td>  
      <td><input class='text-2' type='password' name='password' /></td>
    </tr>
    <tr>
      <td class='rowhead' valign='top'>Language:</td>  
      <td><?php echo html::select('lang', $config->langs, $this->app->getClientLang(), 'class=select-2 onchange=selectLang(this.value)');?></td>
    </tr>
    <tr><td></td><td id='keeplogin'><?php echo html::checkBox('keepLogin', $lang->user->keepLogin, $keepLogin);?></td></tr>
    <tr>
      <td colspan='2' class='a-center'>
      <?php 
      echo html::submitButton($lang->login);
      if($app->company->guest) echo html::linkButton($lang->user->asGuest, $this->createLink($config->default->module));
      commonModel::printQRCodeLink('white');
      echo html::hidden('referer', $referer);
      ?>
      </td>
    </tr>  
  </table>

  <?php if(isset($demoUsers)):?>  
  <div id='demoUsers'>  
    <?php
    echo "<span>" . $lang->user->loginWithDemoUser . "</span>";
    $sign = $config->requestType == 'GET' ? '&' : '?';
    if(isset($demoUsers['productManager'])) echo html::a(inlink('login') . $sign . "account=productManager&password=123456", $demoUsers['productManager'], 'hiddenwin');
    if(isset($demoUsers['projectManager'])) echo html::a(inlink('login') . $sign . "account=projectManager&password=123456", $demoUsers['projectManager'], 'hiddenwin');
    if(isset($demoUsers['testManager']))    echo html::a(inlink('login') . $sign . "account=testManager&password=123456",    $demoUsers['testManager'],    'hiddenwin');
    if(isset($demoUsers['dev1']))           echo html::a(inlink('login') . $sign . "account=dev1&password=123456",           $demoUsers['dev1'],           'hiddenwin');
    if(isset($demoUsers['tester1']))        echo html::a(inlink('login') . $sign . "account=tester1&password=123456",        $demoUsers['tester1'],        'hiddenwin');
    ?>  
  </div>  
  <?php endif;?>  

  <div id='poweredby'>
    powered by <a href='http://www.zentao.net' target='_blank'>ZenTaoPMS</a>(<?php echo $config->version;?>)
    <?php echo $lang->donate;?>
    <?php if($config->checkVersion):?>
    <br />
    <iframe id='updater' class='hidden' frameborder='0' scrolling='no' allowtransparency='true' src="http://api.zentao.net/updater-isLatest-<?php echo $config->version;?>-<?php echo $s;?>.html?lang=<?php echo str_replace('-', '_', $this->app->getClientLang())?>"></iframe>
    <?php endif;?>
  </div>

</form>
<?php include '../../common/view/footer.lite.html.php';?>
