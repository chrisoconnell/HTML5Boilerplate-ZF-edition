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
 * @version    $Id: ViewScriptFile.php 18386 2009-09-23 20:44:43Z ralph $
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
class Zend_Tool_Project_Context_Zf_H5bpLayoutScriptFile extends Zend_Tool_Project_Context_Filesystem_File
{

    /**
     * @var string
     */
    protected $_filesystemName = 'layout.phtml';

    /**
     * @var string
     */
    protected $_layoutName = null;

    /**
     * getName()
     *
     * @return string
     */
    public function getName()
    {
        return 'H5bpLayoutScriptFile';
    }

    /**
     * init()
     *
     * @return Zend_Tool_Project_Context_Zf_ViewScriptFile
     */
    public function init()
    {
        if ($layoutName = $this->_resource->getAttribute('layoutName')) {
            $this->_layoutName = $layoutName;
        } else {
            throw new Exception('Either a forActionName or scriptName is required.');
        }

        parent::init();
        return $this;
    }

    /**
     * getPersistentAttributes()
     *
     * @return unknown
     */
    public function getPersistentAttributes()
    {
        $attributes = array();

        if ($this->_layoutName) {
            $attributes['layoutName'] = $this->_layoutName;
        }

        return $attributes;
    }

    /**
     * getContents()
     *
     * @return string
     */
    public function getContents()
    {
        $contents = <<<EOS
<?php echo \$this->doctype(); ?>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <?php echo \$this->headMeta(); ?>
    
    <!-- Use the .htaccess file and remove the <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
         line to avoid edge case issues. More info: h5bp.com/b/378 -->
    <!-- Mobile viewport optimized: j.mp/bplateviewport -->
    
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->
    
    <?php echo \$this->headTitle(); ?>
    
    <?php echo \$this->headLink(); ?>
    
    <?php echo \$this->headStyle(); ?>
    
    
    <!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->
    
    <!-- All JavaScript at the bottom, except for Modernizr / Respond.
         Modernizr enables HTML5 elements & feature detects; Respond is a polyfill for min/max-width CSS3 Media Queries
         For optimal performance, use a custom Modernizr build: www.modernizr.com/download/ -->
    <script src="<?php echo \$this->baseUrl('js/libs/modernizr-2.0.6.min.js'); ?>"></script>

</head>

<body>

  <div id="container">
    <header>

    </header>
    <div id="main" role="main">
        <?php echo \$this->layout()->content; ?>
        
    </div>
    <footer>

    </footer>
  </div> <!--! end of #container -->


  <!-- JavaScript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="<?php echo \$this->baseUrl('js/libs/jquery-1.6.2.min.js'); ?>"><\/script>')</script>

  <!-- scripts concatenated and minified via ant build script-->
  <?php echo \$this->headScript(); ?>
  
  <!-- end scripts-->
  

  <!-- Change UA-XXXXX-X to be your site's ID -->
  <script>
    window._gaq = [['_setAccount','UAXXXXXXXX1'],['_trackPageview'],['_trackPageLoadTime']];
    Modernizr.load({
      load: ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js'
    });
  </script>


  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
  
</body>
</html>

EOS;

        return $contents;
    }

}
