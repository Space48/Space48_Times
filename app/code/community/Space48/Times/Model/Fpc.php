<?php

class Space48_Times_Model_Fpc extends Enterprise_PageCache_Model_Container_Abstract
{
    protected function _getCacheId()
    {
        return 'CONSTANT_STRING_' . md5($this->_placeholder->getAttribute('cache_id'));
    }

    protected function _renderBlock()
    {
        $block = $this->_placeholder->getAttribute('block');
        $template = $this->_placeholder->getAttribute('template');

        $block = new $block;
        $block->setTemplate($template);
        $block->setLayout(Mage::app()->getLayout());

        return $block->toHtml();
    }

    protected function  _saveCache($data, $id, $tags = array(), $lifetime = null)
    {
        return false;
    }
}