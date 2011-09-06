<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Tool
 * @subpackage Framework
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: HtaccessFile.php 20969 2010-02-07 18:20:02Z ralph $
 */

/**
 * @see Zend_Tool_Project_Context_Filesystem_File
 */
require_once 'Zend/Tool/Project/Context/Filesystem/File.php';

/**
 * This class is the front most class for utilizing Zend_Tool_Project
 *
 * A profile is a hierarchical set of resources that keep track of
 * items within a specific project.
 *
 * @category   Zend
 * @package    Zend_Tool
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Tool_Project_Context_Zf_H5bpPublicCrossdomainFile extends Zend_Tool_Project_Context_Filesystem_File
{

    /**
     * @var string
     */
    protected $_filesystemName = 'crossdomain.xml';

    /**
     * getName()
     *
     * @return string
     */
    public function getName()
    {
        return 'H5bpPublicCrossdomainFile';
    }

    /**
     * getContents()
     *
     * @return string
     */
    public function getContents()
    {
        $output = <<<EOS
<?xml version="1.0"?>
<!DOCTYPE cross-domain-policy SYSTEM "http://www.adobe.com/xml/dtds/cross-domain-policy.dtd">
<cross-domain-policy>
  
  
<!-- Read this: www.adobe.com/devnet/articles/crossdomain_policy_file_spec.html -->

<!-- Most restrictive policy: -->
	<site-control permitted-cross-domain-policies="none"/>
	
	
	
<!-- Least restrictive policy: -->
<!--
	<site-control permitted-cross-domain-policies="all"/>
	<allow-access-from domain="*" to-ports="*" secure="false"/>
	<allow-http-request-headers-from domain="*" headers="*" secure="false"/>
-->
<!--
  If you host a crossdomain.xml file with allow-access-from domain="*" 	 	
  and do not understand all of the points described here, you probably 	 	
  have a nasty security vulnerability. ~ simon willison
-->

</cross-domain-policy>

EOS;
        return $output;
    }

}
