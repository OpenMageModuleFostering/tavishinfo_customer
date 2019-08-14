<?php 
/*
 * http://www.magentomodules.in/
 * 
 * @category    Tavish Info
 * @package     Tavish_Info
 * @author      Magento Modules <magentomodules.in@gmail.com>
 * 
 */
require_once Mage::getModuleDir('controllers', 'Mage_Customer').DS.'AccountController.php';

class TavishInfo_Customer_AccountController extends Mage_Customer_AccountController
{

    protected function _loginPostRedirect()
    {    
        $session = $this->_getSession();        
        $moduleStaus = Mage::getStoreConfig('customer/tavishcustomerloginredirect/enable');
        $redirectUrl = trim(Mage::getStoreConfig('customer/tavishcustomerloginredirect/url'));
        
        if($moduleStaus){
            if($session->isLoggedIn()){
                $redirectUrl = Mage::getUrl(ltrim( str_replace(Mage::getBaseUrl(), '', $redirectUrl), '/'));
                $session->setBeforeAuthUrl($redirectUrl);
            }else{
                $session->setBeforeAuthUrl(Mage::helper('customer')->getLoginUrl());
            }
        }else{
            parent::_loginPostRedirect();
			return;
        }  
        $this->_redirectUrl($session->getBeforeAuthUrl(true));        
    }
}
