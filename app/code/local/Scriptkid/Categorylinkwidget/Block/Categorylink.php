<?php
class Scriptkid_Categorylinkwidget_Block_Categorylink
    extends Mage_Core_Block_Abstract
    implements Mage_Widget_Block_Interface
{

	protected $_serializer = null;
  public $_catHelper = false;

	protected function _construct()
	{
		$this->_serializer = new Varien_Object();
    $this->_catHalper = Mage::helper('catalog/output');
		parent::_construct();
	}

	protected function _toHtml()
  {
    $_id = end(explode('/', $this->getData('id_path')));
    $_category = Mage::getModel('catalog/category')->load($_id);
    $_categoryName = $_category->getName();
    if($_category->getIsActive()){

      $_imgHtml   = '';
      if ($_imgUrl = $_category->getImageUrl()) {
        $_imgHtml = '<img class="category-image" src="'.$_imgUrl.'" alt="'.$_categoryName.'" title="'.$_categoryName.'" />';
      }


      $_descriptionHtml = '';
      if($_description = $_category->getDescription()) {
        $_descriptionHtml .= $_description;
      }

      $_categoryNameLink = '';
      $_categoryNameLink .= '<a hrer="/'.$_category->getUrlPath().'" title="'.$_categoryName.'">';
        $_categoryNameLink .= $_categoryName;
      $_categoryNameLink .= '</a>';


  		$html = '<div class="category-item widget categorylink-wrapper">';
        if($_imgHtml != '')
        {
          $html .= '<div class="img-wrapper">';
          $html .= $_imgHtml;
          $html .= '<div class="hover"><a href="/'.$_category->getUrlPath().'" class="link" title="zu '.$_categoryName.' wechseln"><span class="inner">zu '.$_category->getName().' wechseln</span></a></div>';
          $html .= '</div>';
        }
        $html .= '<p class="bold category-name">'.$_categoryNameLink.'</p>';
        $html .= '<p class="category-description">'.$_descriptionHtml.'</p>';

      $html .= '</div>';
    } else {
      $html = '';
    }

		return $html;
  }

}
