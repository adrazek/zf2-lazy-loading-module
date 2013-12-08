<?php

/*
 * This file is part of the ZFMLL package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace ZFMLL\ModuleManager\Listener\Server;

use ZFMLL\ModuleManager\Listener\AbstractListener;

class DomainListener extends AbstractListener
{
    /**
     * Set config
     * @param mixed
     */
    public function setConfig($config)
    {   
    	if(is_string($config)) {
            $config = array($config);
        }
    	return parent::setConfig($config);
    }
    
    /**
     * Authorize a module loading
     * @return boolean 
     */
    public function authorizeModule()
    {
    	$hostname = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : @$_SERVER['HTTP_HOST'];
    	if(isset($this->config['static'])) {
            return $hostname == $this->config['static'];
    	}
    	else if(isset($this->config['regex'])) {
            return preg_match('(^' . $this->config['regex'] . '$)', $hostname);
    	}
        else
            return in_array($hostname, $this->config);
    }
}
