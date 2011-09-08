<?php
/**
 * HTML5Boilerplate ZF edition version 1.0
 *
 */
 
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
 * @version    $Id: ViewScriptFile.php 20096 2010-01-06 02:05:09Z bkarwin $
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
class Zend_Tool_Project_Context_Zf_H5bpViewScriptFile extends Zend_Tool_Project_Context_Filesystem_File
{

    /**
     * @var string
     */
    protected $_filesystemName = 'view.phtml';

    /**
     * @var string
     */
    protected $_forActionName = null;

    /**
     * @var string
     */
    protected $_scriptName = null;

    /**
     * getName()
     *
     * @return string
     */
    public function getName()
    {
        return 'H5bpViewScriptFile';
    }

    /**
     * init()
     *
     * @return Zend_Tool_Project_Context_Zf_ViewScriptFile
     */
    public function init()
    {
        if ($forActionName = $this->_resource->getAttribute('forActionName')) {
            $this->_forActionName = $forActionName;
            $this->_filesystemName = $this->_convertActionNameToFilesystemName($forActionName) . '.phtml';
        } elseif ($scriptName = $this->_resource->getAttribute('scriptName')) {
            $this->_scriptName = $scriptName;
            $this->_filesystemName = $scriptName . '.phtml';
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

        if ($this->_forActionName) {
            $attributes['forActionName'] = $this->_forActionName;
        }

        if ($this->_scriptName) {
            $attributes['scriptName'] = $this->_scriptName;
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
        $contents = '';

        if ($this->_filesystemName == 'error.phtml') {  // should also check that the above directory is forController=error
            $contents .= <<<EOS
<?php \$this->headStyle()->captureStart('SET') ?>
h1 { font-size: 50px; text-align: center }
span[frown] { transform: rotate(90deg); display:inline-block; color: #bbb; }
body { font: 20px Constantia, 'Hoefler Text',  "Adobe Caslon Pro", Baskerville, Georgia, Times, serif; color: #999; text-shadow: 2px 2px 2px rgba(200, 200, 200, 0.5); }
article {width: 600px; margin: 0 auto; }
a { color: rgb(36, 109, 56); text-decoration:none; }
a:hover { color: rgb(96, 73, 141) ; text-shadow: 2px 2px 2px rgba(36, 109, 56, 0.5); }
<?php \$this->headStyle()->captureEnd() ?>
<?php \$this->headTitle('An error has occurred', 'SET')  // Use SET parameter to override headTitle if set in the bootstrap.
           ->headTitle('Epic Fail!');                    // Additional subtiles can be set like so. The default separator is set in Bootstrap.php file.
?>
    <article>
        <h1>An error has occurred <span frown>:(</span></h1>
        <div>
            <p>Sorry, but it appears that the following error has occured:</p>
            <ul>
              <li><?php echo \$this->message ?></li>
            </ul>
        </div>
        
        <?php if (isset(\$this->exception)): ?>
        
        <div>
            <p>Exception information:</p>
            <ul>
              <li><?php echo \$this->exception->getMessage() ?></li>
            </ul>
        </div>
        
        <div>
            <p>Stack trace:</p>
            <pre><?php echo \$this->exception->getTraceAsString() ?></pre>
        </div>
        
        <div>
            <p>Request Parameters:</p>
            <pre><?php echo var_export(\$this->request->getParams(), true) ?></pre>
        </div>
        <?php endif ?>
    </article>

EOS;
        } elseif ($this->_forActionName == 'index' && $this->_resource->getParentResource()->getAttribute('forControllerName') == 'Index') {

            $contents =<<<EOS
<?php \$this->headStyle()->captureStart() ?>
/**
 * Setting css inline so I don't have to edit the public/css/style.css file or create a new css file.
 * Normally you would add all style elements into the style.css file per best practices.
 */
body {color: #444; font-family: "Lucida Grande","Lucida Sans Unicode",Verdana,sans-serif; background-color: #fafafa; font-size: 16px;}
h1, h2 {font-family: Constantia, 'Hoefler Text', "Adobe Caslon Pro", Baskerville, Georgia, Times, serif; text-shadow: 2px 2px 2px rgba(200, 200, 200, 0.5);}
h1 {font-size:40px;background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAACCAIAAAAW4yFwAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAABNJREFUeNpieP3qFcP///8BAgwAFn0FvUDC/nEAAAAASUVORK5CYII=); background-repeat: repeat-x; background-position: bottom;}
h2 {font-size:22px; font-weight: normal;}
h2 em {color: #57A900;}
dt {margin-top: 16px; font-weight: bold;}
dd {padding-bottom: 6px;}
pre {padding: 0; margin: 0; background-color: #F1F0F7;}
a, a:visited {text-decoration: none; color: #444;}
a:hover {text-decoration: underline;}
article {margin: 0 auto; width: 960px; padding-bottom: 24px;}
.smile {padding-left: 16px; background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAJnSURBVDjLpZPNS9RhEMc/z29t1d1tfSmhCAwjioqoKNYuYkRRFB300MWT3eooeMn6C4TunYoiOgSKkGAUhh0SjJCwsBdtfQMN17Ta2v39nueZ6WBtktGh5jLDMPPhC/Mdo6r8T5T93nCPTUqVDhVOi5BRBRVGRBhQ4drGc5pfO2/WKnCPTbMKN0x9Z4OpzqDxWlCPFnL45VHCd91ZEdprWnRoHcANmhatbu4JtrShiSr8t9dIuIS6IpgKgoqdGBsQztwj/DDUWndee0sAO2hqVZmO7b+bkuAzvpgF+wVxIeqLqxBRTHk9sfL9fBq+kBdh+9Y2/RgAqNARbO9KaRwkzIL7ymBfDiQCH/HkIYjN4z6P4cNJEnu6UuLpAAgARDhrahqRYhZ1BVQsx85UomJRb2lqzqMSojaPW3lOWfUuxHN2LWAv5WnErZSWVCzqItRHP2qL+ggJc0CI9zSUACoU1BXBOx71PmXq7dzqorc/csj05BKDD+ZQsaCKCLFfCjxZbAGIc7R5N+9ezTI7uYD6EBXLTHaZiTfLZBrTmCCB+DJsyETJSCL029zowaC6nkRynqNNDYw9m2L8xSx4S7LSkMlUkUzEKEsfoJCbxkb0l8643GPqRHifarydEvsGnx9HohXUhYj7eUaIJXdi0qeYvn8x7yw7Dl3WxQCgplUXRWj/NnELdBuxdCMmVouKgihBfDMb6k6gieMsvezDRrQfuqyL66w8f8ecFM/15N7OhvimfQQbAhCHCz1f59+yMNyddZZLh6/owB9/AWD2pkmJp1OE096TcRE4y4izDDhL95Grf3mmf4nvrQOLvcb/mlMAAAAASUVORK5CYII=) no-repeat scroll 0 50%;}
header, #footer {color: #ddd; background-image: url(data:image/png;base64,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);}
header {height: 65px;}
#footer article {min-height: 130px; padding: 12px 0 24px;}
#footer h2 {color: #ddd;text-shadow: 2px 2px 2px #666;}
#footer a {color: #FFE59E}
#js-error {color: #f00;}
.js #js-error { display: none; visibility: hidden; }
/*
 * jQuery UI CSS Framework 1.8.16
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Theming/API
 */
.ui-helper-hidden { display: none; }
.ui-helper-hidden-accessible { position: absolute !important; clip: rect(1px 1px 1px 1px); clip: rect(1px,1px,1px,1px); }
.ui-helper-reset { margin: 0; padding: 0; border: 0; outline: 0; line-height: 1.3; text-decoration: none; font-size: 100%; list-style: none; }
.ui-helper-clearfix:after { content: "."; display: block; height: 0; clear: both; visibility: hidden; }
.ui-helper-clearfix { display: inline-block; }
* html .ui-helper-clearfix { height:1%; }
.ui-helper-clearfix { display:block; }
.ui-helper-zfix { width: 100%; height: 100%; top: 0; left: 0; position: absolute; opacity: 0; filter:Alpha(Opacity=0); }
.ui-state-disabled { cursor: default !important; }
.ui-icon { display: block; text-indent: -99999px; overflow: hidden; background-repeat: no-repeat; }
.ui-widget-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
.ui-widget .ui-widget { font-size: 1em; }
.ui-widget-content { border: 1px solid #aaaaaa; background-color: #ffffff; color: #222222; }
.ui-widget-content a { color: #222222; }
.ui-widget-header { border: 1px solid #aaaaaa; background-color: #cccccc; color: #222222; font-weight: bold; }
.ui-widget-header a { color: #222222; }
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default { border: 1px solid #d3d3d3; background: #e6e6e6 url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAGQCAYAAABvWArbAAAAMUlEQVQ4T2N6+/btfyYGIBglRolRYtgSP3/+hLIYGRmRWfgJsDogwNA7SowSo8SgIwCUognz12nsyQAAAABJRU5ErkJggg==) 50% 50% repeat-x; font-weight: normal; color: #555555; }
.ui-state-default a, .ui-state-default a:link, .ui-state-default a:visited { color: #555555; text-decoration: none; }
.ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus { border: 1px solid #999999; background: #dadada url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAGQCAYAAABvWArbAAAANklEQVQ4jWN48uTJfyYGBgaGUWKUGCWGLfHt2zcoi5GREYNgYmJCZiG42IiB98woMUqMEtgIAMdjCdyg+eEBAAAAAElFTkSuQmCC) 50% 50% repeat-x; font-weight: normal; color: #212121; }
.ui-state-hover a, .ui-state-hover a:hover { color: #212121; text-decoration: none; }
.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active { border: 1px solid #aaaaaa; background-color: #ffffff; font-weight: normal; color: #212121; }
.ui-state-active a, .ui-state-active a:link, .ui-state-active a:visited { color: #212121; text-decoration: none; }
.ui-widget :active { outline: none; }
.ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-widget-header .ui-state-highlight  {border: 1px solid #fcefa1; background-color: #fbf9ee; color: #363636; }
.ui-state-highlight a, .ui-widget-content .ui-state-highlight a,.ui-widget-header .ui-state-highlight a { color: #363636; }
.ui-state-error, .ui-widget-content .ui-state-error, .ui-widget-header .ui-state-error {border: 1px solid #cd0a0a; background-color: #fef1ec; color: #cd0a0a; }
.ui-state-error a, .ui-widget-content .ui-state-error a, .ui-widget-header .ui-state-error a { color: #cd0a0a; }
.ui-state-error-text, .ui-widget-content .ui-state-error-text, .ui-widget-header .ui-state-error-text { color: #cd0a0a; }
.ui-priority-primary, .ui-widget-content .ui-priority-primary, .ui-widget-header .ui-priority-primary { font-weight: bold; }
.ui-priority-secondary, .ui-widget-content .ui-priority-secondary,  .ui-widget-header .ui-priority-secondary { opacity: .7; filter:Alpha(Opacity=70); font-weight: normal; }
.ui-state-disabled, .ui-widget-content .ui-state-disabled, .ui-widget-header .ui-state-disabled { opacity: .35; filter:Alpha(Opacity=35); background-image: none; }
.ui-icon { width: 16px; height: 16px; }
.ui-state-default .ui-icon { background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAAAhCAYAAABObyzJAAAAp0lEQVR42u2YQQqAMAwEfUbfLP2z9hZoT2XKgjIDAS+mmyVakktEROSX9Ls/I9pXxbcqYL/wOYCBpQHkAOeWFyM2zatEcQNXHS1nYJ07P4OXeQHUxMD5rIl4+64EOjDxBbQrDzfw5C/EW1hERERERMRJBAzSYB4FszCsg2oP7gPXHNxAroFoB/tAXsARA7kJ+X3gyZ1aoANB94f3gUSI+0BvYRERkXO8/vPbZCGlUr4AAAAASUVORK5CYII=); }
.ui-state-hover .ui-icon, .ui-state-focus .ui-icon, .ui-state-active .ui-icon {background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAAAgCAYAAACFM/9sAAAAcklEQVR42u3VwQmAMAwFUMfIQMX9N1J7tSf7BS28BznGJCXEDQAAAAAAAJbW9nZcUas2X8kAPfcewTcqnWOu7hiPiiYD9Jz0Ad/sYSpvjIqTk0bSLX6pdrJE+foGjcQbGAyf9l6f39P0BqY3zF8YgN85AenSo9NvqBoEAAAAAElFTkSuQmCC); }
.ui-icon-triangle-1-n { background-position: 0 -16px; }
.ui-icon-triangle-1-ne { background-position: -16px -16px; }
.ui-icon-triangle-1-e { background-position: -32px -16px; }
.ui-icon-triangle-1-se { background-position: -48px -16px; }
.ui-icon-triangle-1-s { background-position: -64px -16px; }
.ui-corner-all, .ui-corner-top, .ui-corner-left, .ui-corner-tl { -moz-border-radius-topleft: 4px; -webkit-border-top-left-radius: 4px; -khtml-border-top-left-radius: 4px; border-top-left-radius: 4px; }
.ui-corner-all, .ui-corner-top, .ui-corner-right, .ui-corner-tr { -moz-border-radius-topright: 4px; -webkit-border-top-right-radius: 4px; -khtml-border-top-right-radius: 4px; border-top-right-radius: 4px; }
.ui-corner-all, .ui-corner-bottom, .ui-corner-left, .ui-corner-bl { -moz-border-radius-bottomleft: 4px; -webkit-border-bottom-left-radius: 4px; -khtml-border-bottom-left-radius: 4px; border-bottom-left-radius: 4px; }
.ui-corner-all, .ui-corner-bottom, .ui-corner-right, .ui-corner-br { -moz-border-radius-bottomright: 4px; -webkit-border-bottom-right-radius: 4px; -khtml-border-bottom-right-radius: 4px; border-bottom-right-radius: 4px; }
.ui-widget-overlay { background-color: #aaaaaa; opacity: .30;filter:Alpha(Opacity=30); }
.ui-widget-shadow { margin: -8px 0 0 -8px; padding: 8px; background-color: #aaaaaa; opacity: .30;filter:Alpha(Opacity=30); -moz-border-radius: 8px; -khtml-border-radius: 8px; -webkit-border-radius: 8px; border-radius: 8px; }
.ui-accordion { width: 100%; }
.ui-accordion .ui-accordion-header { cursor: pointer; position: relative; margin-top: 1px; zoom: 1; }
.ui-accordion .ui-accordion-li-fix { display: inline; }
.ui-accordion .ui-accordion-header-active { border-bottom: 0 !important; }
.ui-accordion .ui-accordion-header a { display: block; font-size: 1em; padding: .5em .5em .5em .7em; }
.ui-accordion-icons .ui-accordion-header a { padding-left: 2.2em; }
.ui-accordion .ui-accordion-header .ui-icon { position: absolute; left: .5em; top: 50%; margin-top: -8px; }
.ui-accordion .ui-accordion-content { padding: 1em 2.2em; border-top: 0; margin-top: -2px; position: relative; top: 1px; margin-bottom: 2px; overflow: auto; display: none; zoom: 1; }
.ui-accordion .ui-accordion-content-active { display: block; }
<?php \$this->headStyle()->captureEnd() ?>
<?php \$this->headScript()->captureStart() ?>
/*!
 * jQuery UI 1.8.16
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI
 */
(function(c,j){function k(a,b){var d=a.nodeName.toLowerCase();if("area"===d){b=a.parentNode;d=b.name;if(!a.href||!d||b.nodeName.toLowerCase()!=="map")return false;a=c("img[usemap=#"+d+"]")[0];return!!a&&l(a)}return(/input|select|textarea|button|object/.test(d)?!a.disabled:"a"==d?a.href||b:b)&&l(a)}function l(a){return!c(a).parents().andSelf().filter(function(){return c.curCSS(this,"visibility")==="hidden"||c.expr.filters.hidden(this)}).length}c.ui=c.ui||{};if(!c.ui.version){c.extend(c.ui,{version:"1.8.16",
keyCode:{ALT:18,BACKSPACE:8,CAPS_LOCK:20,COMMA:188,COMMAND:91,COMMAND_LEFT:91,COMMAND_RIGHT:93,CONTROL:17,DELETE:46,DOWN:40,END:35,ENTER:13,ESCAPE:27,HOME:36,INSERT:45,LEFT:37,MENU:93,NUMPAD_ADD:107,NUMPAD_DECIMAL:110,NUMPAD_DIVIDE:111,NUMPAD_ENTER:108,NUMPAD_MULTIPLY:106,NUMPAD_SUBTRACT:109,PAGE_DOWN:34,PAGE_UP:33,PERIOD:190,RIGHT:39,SHIFT:16,SPACE:32,TAB:9,UP:38,WINDOWS:91}});c.fn.extend({propAttr:c.fn.prop||c.fn.attr,_focus:c.fn.focus,focus:function(a,b){return typeof a==="number"?this.each(function(){var d=
this;setTimeout(function(){c(d).focus();b&&b.call(d)},a)}):this._focus.apply(this,arguments)},scrollParent:function(){var a;a=c.browser.msie&&/(static|relative)/.test(this.css("position"))||/absolute/.test(this.css("position"))?this.parents().filter(function(){return/(relative|absolute|fixed)/.test(c.curCSS(this,"position",1))&&/(auto|scroll)/.test(c.curCSS(this,"overflow",1)+c.curCSS(this,"overflow-y",1)+c.curCSS(this,"overflow-x",1))}).eq(0):this.parents().filter(function(){return/(auto|scroll)/.test(c.curCSS(this,
"overflow",1)+c.curCSS(this,"overflow-y",1)+c.curCSS(this,"overflow-x",1))}).eq(0);return/fixed/.test(this.css("position"))||!a.length?c(document):a},zIndex:function(a){if(a!==j)return this.css("zIndex",a);if(this.length){a=c(this[0]);for(var b;a.length&&a[0]!==document;){b=a.css("position");if(b==="absolute"||b==="relative"||b==="fixed"){b=parseInt(a.css("zIndex"),10);if(!isNaN(b)&&b!==0)return b}a=a.parent()}}return 0},disableSelection:function(){return this.bind((c.support.selectstart?"selectstart":
"mousedown")+".ui-disableSelection",function(a){a.preventDefault()})},enableSelection:function(){return this.unbind(".ui-disableSelection")}});c.each(["Width","Height"],function(a,b){function d(f,g,m,n){c.each(e,function(){g-=parseFloat(c.curCSS(f,"padding"+this,true))||0;if(m)g-=parseFloat(c.curCSS(f,"border"+this+"Width",true))||0;if(n)g-=parseFloat(c.curCSS(f,"margin"+this,true))||0});return g}var e=b==="Width"?["Left","Right"]:["Top","Bottom"],h=b.toLowerCase(),i={innerWidth:c.fn.innerWidth,innerHeight:c.fn.innerHeight,
outerWidth:c.fn.outerWidth,outerHeight:c.fn.outerHeight};c.fn["inner"+b]=function(f){if(f===j)return i["inner"+b].call(this);return this.each(function(){c(this).css(h,d(this,f)+"px")})};c.fn["outer"+b]=function(f,g){if(typeof f!=="number")return i["outer"+b].call(this,f);return this.each(function(){c(this).css(h,d(this,f,true,g)+"px")})}});c.extend(c.expr[":"],{data:function(a,b,d){return!!c.data(a,d[3])},focusable:function(a){return k(a,!isNaN(c.attr(a,"tabindex")))},tabbable:function(a){var b=c.attr(a,
"tabindex"),d=isNaN(b);return(d||b>=0)&&k(a,!d)}});c(function(){var a=document.body,b=a.appendChild(b=document.createElement("div"));c.extend(b.style,{minHeight:"100px",height:"auto",padding:0,borderWidth:0});c.support.minHeight=b.offsetHeight===100;c.support.selectstart="onselectstart"in b;a.removeChild(b).style.display="none"});c.extend(c.ui,{plugin:{add:function(a,b,d){a=c.ui[a].prototype;for(var e in d){a.plugins[e]=a.plugins[e]||[];a.plugins[e].push([b,d[e]])}},call:function(a,b,d){if((b=a.plugins[b])&&
a.element[0].parentNode)for(var e=0;e<b.length;e++)a.options[b[e][0]]&&b[e][1].apply(a.element,d)}},contains:function(a,b){return document.compareDocumentPosition?a.compareDocumentPosition(b)&16:a!==b&&a.contains(b)},hasScroll:function(a,b){if(c(a).css("overflow")==="hidden")return false;b=b&&b==="left"?"scrollLeft":"scrollTop";var d=false;if(a[b]>0)return true;a[b]=1;d=a[b]>0;a[b]=0;return d},isOverAxis:function(a,b,d){return a>b&&a<b+d},isOver:function(a,b,d,e,h,i){return c.ui.isOverAxis(a,d,h)&&
c.ui.isOverAxis(b,e,i)}})}})(jQuery);
;/*!
 * jQuery UI Widget 1.8.16
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Widget
 */
(function(b,j){if(b.cleanData){var k=b.cleanData;b.cleanData=function(a){for(var c=0,d;(d=a[c])!=null;c++)try{b(d).triggerHandler("remove")}catch(e){}k(a)}}else{var l=b.fn.remove;b.fn.remove=function(a,c){return this.each(function(){if(!c)if(!a||b.filter(a,[this]).length)b("*",this).add([this]).each(function(){try{b(this).triggerHandler("remove")}catch(d){}});return l.call(b(this),a,c)})}}b.widget=function(a,c,d){var e=a.split(".")[0],f;a=a.split(".")[1];f=e+"-"+a;if(!d){d=c;c=b.Widget}b.expr[":"][f]=
function(h){return!!b.data(h,a)};b[e]=b[e]||{};b[e][a]=function(h,g){arguments.length&&this._createWidget(h,g)};c=new c;c.options=b.extend(true,{},c.options);b[e][a].prototype=b.extend(true,c,{namespace:e,widgetName:a,widgetEventPrefix:b[e][a].prototype.widgetEventPrefix||a,widgetBaseClass:f},d);b.widget.bridge(a,b[e][a])};b.widget.bridge=function(a,c){b.fn[a]=function(d){var e=typeof d==="string",f=Array.prototype.slice.call(arguments,1),h=this;d=!e&&f.length?b.extend.apply(null,[true,d].concat(f)):
d;if(e&&d.charAt(0)==="_")return h;e?this.each(function(){var g=b.data(this,a),i=g&&b.isFunction(g[d])?g[d].apply(g,f):g;if(i!==g&&i!==j){h=i;return false}}):this.each(function(){var g=b.data(this,a);g?g.option(d||{})._init():b.data(this,a,new c(d,this))});return h}};b.Widget=function(a,c){arguments.length&&this._createWidget(a,c)};b.Widget.prototype={widgetName:"widget",widgetEventPrefix:"",options:{disabled:false},_createWidget:function(a,c){b.data(c,this.widgetName,this);this.element=b(c);this.options=
b.extend(true,{},this.options,this._getCreateOptions(),a);var d=this;this.element.bind("remove."+this.widgetName,function(){d.destroy()});this._create();this._trigger("create");this._init()},_getCreateOptions:function(){return b.metadata&&b.metadata.get(this.element[0])[this.widgetName]},_create:function(){},_init:function(){},destroy:function(){this.element.unbind("."+this.widgetName).removeData(this.widgetName);this.widget().unbind("."+this.widgetName).removeAttr("aria-disabled").removeClass(this.widgetBaseClass+
"-disabled ui-state-disabled")},widget:function(){return this.element},option:function(a,c){var d=a;if(arguments.length===0)return b.extend({},this.options);if(typeof a==="string"){if(c===j)return this.options[a];d={};d[a]=c}this._setOptions(d);return this},_setOptions:function(a){var c=this;b.each(a,function(d,e){c._setOption(d,e)});return this},_setOption:function(a,c){this.options[a]=c;if(a==="disabled")this.widget()[c?"addClass":"removeClass"](this.widgetBaseClass+"-disabled ui-state-disabled").attr("aria-disabled",
c);return this},enable:function(){return this._setOption("disabled",false)},disable:function(){return this._setOption("disabled",true)},_trigger:function(a,c,d){var e=this.options[a];c=b.Event(c);c.type=(a===this.widgetEventPrefix?a:this.widgetEventPrefix+a).toLowerCase();d=d||{};if(c.originalEvent){a=b.event.props.length;for(var f;a;){f=b.event.props[--a];c[f]=c.originalEvent[f]}}this.element.trigger(c,d);return!(b.isFunction(e)&&e.call(this.element[0],c,d)===false||c.isDefaultPrevented())}}})(jQuery);
;/*
 * jQuery UI Accordion 1.8.16
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Accordion
 *
 * Depends:
 *	jquery.ui.core.js
 *	jquery.ui.widget.js
 */
(function(c){c.widget("ui.accordion",{options:{active:0,animated:"slide",autoHeight:true,clearStyle:false,collapsible:false,event:"click",fillSpace:false,header:"> li > :first-child,> :not(li):even",icons:{header:"ui-icon-triangle-1-e",headerSelected:"ui-icon-triangle-1-s"},navigation:false,navigationFilter:function(){return this.href.toLowerCase()===location.href.toLowerCase()}},_create:function(){var a=this,b=a.options;a.running=0;a.element.addClass("ui-accordion ui-widget ui-helper-reset").children("li").addClass("ui-accordion-li-fix");
a.headers=a.element.find(b.header).addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-all").bind("mouseenter.accordion",function(){b.disabled||c(this).addClass("ui-state-hover")}).bind("mouseleave.accordion",function(){b.disabled||c(this).removeClass("ui-state-hover")}).bind("focus.accordion",function(){b.disabled||c(this).addClass("ui-state-focus")}).bind("blur.accordion",function(){b.disabled||c(this).removeClass("ui-state-focus")});a.headers.next().addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom");
if(b.navigation){var d=a.element.find("a").filter(b.navigationFilter).eq(0);if(d.length){var h=d.closest(".ui-accordion-header");a.active=h.length?h:d.closest(".ui-accordion-content").prev()}}a.active=a._findActive(a.active||b.active).addClass("ui-state-default ui-state-active").toggleClass("ui-corner-all").toggleClass("ui-corner-top");a.active.next().addClass("ui-accordion-content-active");a._createIcons();a.resize();a.element.attr("role","tablist");a.headers.attr("role","tab").bind("keydown.accordion",
function(f){return a._keydown(f)}).next().attr("role","tabpanel");a.headers.not(a.active||"").attr({"aria-expanded":"false","aria-selected":"false",tabIndex:-1}).next().hide();a.active.length?a.active.attr({"aria-expanded":"true","aria-selected":"true",tabIndex:0}):a.headers.eq(0).attr("tabIndex",0);c.browser.safari||a.headers.find("a").attr("tabIndex",-1);b.event&&a.headers.bind(b.event.split(" ").join(".accordion ")+".accordion",function(f){a._clickHandler.call(a,f,this);f.preventDefault()})},_createIcons:function(){var a=
this.options;if(a.icons){c("<span></span>").addClass("ui-icon "+a.icons.header).prependTo(this.headers);this.active.children(".ui-icon").toggleClass(a.icons.header).toggleClass(a.icons.headerSelected);this.element.addClass("ui-accordion-icons")}},_destroyIcons:function(){this.headers.children(".ui-icon").remove();this.element.removeClass("ui-accordion-icons")},destroy:function(){var a=this.options;this.element.removeClass("ui-accordion ui-widget ui-helper-reset").removeAttr("role");this.headers.unbind(".accordion").removeClass("ui-accordion-header ui-accordion-disabled ui-helper-reset ui-state-default ui-corner-all ui-state-active ui-state-disabled ui-corner-top").removeAttr("role").removeAttr("aria-expanded").removeAttr("aria-selected").removeAttr("tabIndex");
this.headers.find("a").removeAttr("tabIndex");this._destroyIcons();var b=this.headers.next().css("display","").removeAttr("role").removeClass("ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content ui-accordion-content-active ui-accordion-disabled ui-state-disabled");if(a.autoHeight||a.fillHeight)b.css("height","");return c.Widget.prototype.destroy.call(this)},_setOption:function(a,b){c.Widget.prototype._setOption.apply(this,arguments);a=="active"&&this.activate(b);if(a=="icons"){this._destroyIcons();
b&&this._createIcons()}if(a=="disabled")this.headers.add(this.headers.next())[b?"addClass":"removeClass"]("ui-accordion-disabled ui-state-disabled")},_keydown:function(a){if(!(this.options.disabled||a.altKey||a.ctrlKey)){var b=c.ui.keyCode,d=this.headers.length,h=this.headers.index(a.target),f=false;switch(a.keyCode){case b.RIGHT:case b.DOWN:f=this.headers[(h+1)%d];break;case b.LEFT:case b.UP:f=this.headers[(h-1+d)%d];break;case b.SPACE:case b.ENTER:this._clickHandler({target:a.target},a.target);
a.preventDefault()}if(f){c(a.target).attr("tabIndex",-1);c(f).attr("tabIndex",0);f.focus();return false}return true}},resize:function(){var a=this.options,b;if(a.fillSpace){if(c.browser.msie){var d=this.element.parent().css("overflow");this.element.parent().css("overflow","hidden")}b=this.element.parent().height();c.browser.msie&&this.element.parent().css("overflow",d);this.headers.each(function(){b-=c(this).outerHeight(true)});this.headers.next().each(function(){c(this).height(Math.max(0,b-c(this).innerHeight()+
c(this).height()))}).css("overflow","auto")}else if(a.autoHeight){b=0;this.headers.next().each(function(){b=Math.max(b,c(this).height("").height())}).height(b)}return this},activate:function(a){this.options.active=a;a=this._findActive(a)[0];this._clickHandler({target:a},a);return this},_findActive:function(a){return a?typeof a==="number"?this.headers.filter(":eq("+a+")"):this.headers.not(this.headers.not(a)):a===false?c([]):this.headers.filter(":eq(0)")},_clickHandler:function(a,b){var d=this.options;
if(!d.disabled)if(a.target){a=c(a.currentTarget||b);b=a[0]===this.active[0];d.active=d.collapsible&&b?false:this.headers.index(a);if(!(this.running||!d.collapsible&&b)){var h=this.active;j=a.next();g=this.active.next();e={options:d,newHeader:b&&d.collapsible?c([]):a,oldHeader:this.active,newContent:b&&d.collapsible?c([]):j,oldContent:g};var f=this.headers.index(this.active[0])>this.headers.index(a[0]);this.active=b?c([]):a;this._toggle(j,g,e,b,f);h.removeClass("ui-state-active ui-corner-top").addClass("ui-state-default ui-corner-all").children(".ui-icon").removeClass(d.icons.headerSelected).addClass(d.icons.header);
if(!b){a.removeClass("ui-state-default ui-corner-all").addClass("ui-state-active ui-corner-top").children(".ui-icon").removeClass(d.icons.header).addClass(d.icons.headerSelected);a.next().addClass("ui-accordion-content-active")}}}else if(d.collapsible){this.active.removeClass("ui-state-active ui-corner-top").addClass("ui-state-default ui-corner-all").children(".ui-icon").removeClass(d.icons.headerSelected).addClass(d.icons.header);this.active.next().addClass("ui-accordion-content-active");var g=this.active.next(),
e={options:d,newHeader:c([]),oldHeader:d.active,newContent:c([]),oldContent:g},j=this.active=c([]);this._toggle(j,g,e)}},_toggle:function(a,b,d,h,f){var g=this,e=g.options;g.toShow=a;g.toHide=b;g.data=d;var j=function(){if(g)return g._completed.apply(g,arguments)};g._trigger("changestart",null,g.data);g.running=b.size()===0?a.size():b.size();if(e.animated){d={};d=e.collapsible&&h?{toShow:c([]),toHide:b,complete:j,down:f,autoHeight:e.autoHeight||e.fillSpace}:{toShow:a,toHide:b,complete:j,down:f,autoHeight:e.autoHeight||
e.fillSpace};if(!e.proxied)e.proxied=e.animated;if(!e.proxiedDuration)e.proxiedDuration=e.duration;e.animated=c.isFunction(e.proxied)?e.proxied(d):e.proxied;e.duration=c.isFunction(e.proxiedDuration)?e.proxiedDuration(d):e.proxiedDuration;h=c.ui.accordion.animations;var i=e.duration,k=e.animated;if(k&&!h[k]&&!c.easing[k])k="slide";h[k]||(h[k]=function(l){this.slide(l,{easing:k,duration:i||700})});h[k](d)}else{if(e.collapsible&&h)a.toggle();else{b.hide();a.show()}j(true)}b.prev().attr({"aria-expanded":"false",
"aria-selected":"false",tabIndex:-1}).blur();a.prev().attr({"aria-expanded":"true","aria-selected":"true",tabIndex:0}).focus()},_completed:function(a){this.running=a?0:--this.running;if(!this.running){this.options.clearStyle&&this.toShow.add(this.toHide).css({height:"",overflow:""});this.toHide.removeClass("ui-accordion-content-active");if(this.toHide.length)this.toHide.parent()[0].className=this.toHide.parent()[0].className;this._trigger("change",null,this.data)}}});c.extend(c.ui.accordion,{version:"1.8.16",
animations:{slide:function(a,b){a=c.extend({easing:"swing",duration:300},a,b);if(a.toHide.size())if(a.toShow.size()){var d=a.toShow.css("overflow"),h=0,f={},g={},e;b=a.toShow;e=b[0].style.width;b.width(parseInt(b.parent().width(),10)-parseInt(b.css("paddingLeft"),10)-parseInt(b.css("paddingRight"),10)-(parseInt(b.css("borderLeftWidth"),10)||0)-(parseInt(b.css("borderRightWidth"),10)||0));c.each(["height","paddingTop","paddingBottom"],function(j,i){g[i]="hide";j=(""+c.css(a.toShow[0],i)).match(/^([\\d+-.]+)(.*)\$/);
f[i]={value:j[1],unit:j[2]||"px"}});a.toShow.css({height:0,overflow:"hidden"}).show();a.toHide.filter(":hidden").each(a.complete).end().filter(":visible").animate(g,{step:function(j,i){if(i.prop=="height")h=i.end-i.start===0?0:(i.now-i.start)/(i.end-i.start);a.toShow[0].style[i.prop]=h*f[i.prop].value+f[i.prop].unit},duration:a.duration,easing:a.easing,complete:function(){a.autoHeight||a.toShow.css("height","");a.toShow.css({width:e,overflow:d});a.complete()}})}else a.toHide.animate({height:"hide",
paddingTop:"hide",paddingBottom:"hide"},a);else a.toShow.animate({height:"show",paddingTop:"show",paddingBottom:"show"},a)},bounceslide:function(a){this.slide(a,{easing:a.down?"easeOutBounce":"swing",duration:a.down?1E3:200})}}})})(jQuery);
;
<?php \$this->headScript()->captureEnd() ?>
<?php \$this->headTitle('HTML5Boilerplate ZF edition', 'SET')  // Sitewide main title is best set initially in the Bootstrap.php file.
           ->headTitle('Victory is mine!');                    // Additional subtiles can be set like so. The default separator is set in Bootstrap.php file.
      \$this->headMeta()->setName('author', 'Chris OConnell')  // This should be set in the Bootstrap.php file
                       ->setName('description', 'This is how you would modify the description for an individual page. To set the description globally, modify the Bootstrap.php file.');
      \$this->headScript()->appendScript('\$(function() {\$( ".accordion" ).accordion({collapsible: true, active: false, autoHeight: false});});');
?>
  <article>

    <h1>Congratulations!</h1>

    <h2>If you can read this then you have successfully installed <strong>HTML5Boilerplate <em>ZF edition</em></strong> version 1.0.</h2>

    <div id="js-error">
        <strong>Javascript was not detected!</strong>
        If your web browser has javascript enabled, then most likely you will need to set the resources.frontController.baseUrl value in the application.ini
        file. Otherwise the path to css and javascript files will not be set right. Make sure to also edit the Bootstrap.php file accordingly
    </div>

    <p>
        This install is complete and no additional steps are needed to start creating your next web application masterpiece!
        However, most people will want to make small changes to the code to tailor it to their specific needs. The most obvious 
        being the author name or footer info which will be the same for every project you create. If you would like to have your
        changes automatically applied every time you create a new project, the info below will help you determine which files you
        need to edit. 
    </p>
        
    <div class="accordion">
        <h3><a href="#">Files located at library/Zend/Tool/Project/Context/Zf</a></h3>
        <div>
        <dl>
            <dt>H5bpJsLibsDirectory.php</dt>
                <dd>Creates the public/js/libs directory.</dd>
            <dt>H5bpJsLibsJqueryFile.php</dt>
                <dd>Creates the public/js/libs/jquery-1.6.2.min.js file.</dd>
                <dd>Contents are unchanged from the HTML5 Boilerplate 2.0 version.</dd>
            <dt>H5bpJsLibsModernizrFile.php</dt>
                <dd>Creates the public/js/libs/modernizr-2.0.6.min.js file.</dd>
                <dd>Contents are unchanged from the HTML5 Boilerplate 2.0 version.</dd>
            <dt>H5bpJsPluginsFile.php</dt>
                <dd>Creates the public/js/plugins.js file.</dd>
                <dd>Contents are unchanged from the HTML5 Boilerplate 2.0 version.</dd>
            <dt>H5bpJsSriptFile.php</dt>
                <dd>Creates the public/js/script.js file.</dd>
                <dd>Contents &mdash; what little there are &mdash; are unchanged from the HTML5 Boilerplate 2.0 version.</dd>
            <dt>H5bpPublicStylesheetsDirectory.php</dt>
                <dd>Creates the public/css directory.</dd>
            <dt>H5bpPublicStylesheetFile.php</dt>
                <dd>Creates the public/css/styles.css file.</dd>
                <dd>Contents are unchanged from the HTML5 Boilerplate 2.0 version.</dd>
            <dt>H5bpPublicRobotsFile.php</dt>
                <dd>Creates the public/robots.txt file.</dd>
                <dd>Contents are unchanged from the HTML5 Boilerplate 2.0 version.</dd>
            <dt>H5bpHtaccessFile.php</dt>
                <dd>Creates the public/.htaccess file.</dd>
                <dd>Includes all the content from the HTML5 Boilerplate 2.0 version plus the rules defined in a standard
                    Zend Framework project.
                </dd>
            <dt>H5bpPublicHumansFile.php</dt>
                <dd>Creates the public/humans.txt file.</dd>
                <dd>Contents are unchanged from the HTML5 Boilerplate 2.0 version.</dd>
            <dt>H5bpPublicImagesDirectory.php</dt>
                <dd>Creates the public/img directory.</dd>
            <dt>H5bpLayoutScriptFile.php</dt>
                <dd>Creates the application/layouts/scripts/layout.phtml file.</dd>
                <dd>Intergrated standard Zend view helpers into layout inplace of hardcoding meta data and css/js files.</dd>
                <dd>Layout script works in conjunction with the bootstrap file to define meta data and css/js files.</dd>
                <dd>The resulting source html will look almost identical to HTML 5 Boilerplate 2.0 index.html file.
                    The biggest difference will be the comments which had to be grouped together.
                </dd>
            <dt>H5bpViewScriptFile.php</dt>
                <dd>Creates the application/views/scripts/index/index.phtml file &mdash; the file you are viewing now <span class="smile">&nbsp;</span></dd>
                <dd>Creates the application/views/scripts/error/error.phtml file &mdash; modified to be a blend of the HTML 5
                    Boilerplate 2.0 404.html file and a standard Zend Framework project error.phtml file.
                </dd>
            <dt>H5bpBootstrapFile.php</dt>
                <dd>Creates the application/Bootstrap.php file.</dd>
                <dd>Added _initViewSettings resource to set layout meta data and define css/js files.</dd>
            <dt>H5bpApplicationConfigFile.php</dt>
                <dd>Creates the application/configs/application.ini file.</dd>
                <dd>Similar to the application.ini file created by the standard Zend project.</dd>
                <dd>Added settings for doctype and charset.</dd>
                <dd>Added setting for baseUrl but left commented out as Zend <em>should</em> be able to auto detected if your
                    VHOST is set properly.
                </dd>
        </dl>
        </div>

        <h3><a href="#">Files located at library/Zend/Tool/Project/Provider</a></h3>
        <div>
        <dl>
            <dt>Project.php</dt>
                <dd>This is the file that sets the file directory structure and calls all of the helper php files above.</dd>
                <dd>If you would like to add or remove files from this project, this file will need to be modified accourdingly.</dd>
            <dt>Manifest.php</dt>
                <dd>This file has not been modified from the original Zend Framework version for this project.</dd>
                <dd>However, if you would like to rename the Project.php file &mdash; to say H5bpProject.php &mdash then you would 
                    have to modify this file.
                </dd>
                <dd>The reason for doing such would be if you wanted to have the command line 
                    <pre>zf create project myProject</pre> create a standerd Zend project. And have the command line
                    <pre>zf create h5bpProject myH5bpProject</pre> create this project.
                </dd>
        </dl>
        </div>
    </div>
    
    <h2>What&rsquo;s not included?</h2>
    <p>
        I&rsquo;ve worked very hard to make this project as complete and thorough as possible. Even still, there were a few 
        files contained in the HTML 5 Boilerplate distribution that I have left out. 
    </p>

    <div class="accordion">
        <h3><a href="#">Files from HTML 5 Boilerplate not included in this project</a></h3>
        <div>
        <dl>
            <dt>apple-touch-icons &amp; favicon</dt>
                <dd>This was because of technical reasons as I don&rsquo;t know how to include non-text files using Zend_Tool.</dd>
                <dd>If you know how to do this please contribute to this project.</dd>
            <dt>build files</dt>
                <dd>Contain exe files which I don&rsquo;t know how to include.</dd>
            <dt>test files</dt>
                <dd>I feel this project will be better served by more Zend Framework specific tests. While the project does
                    create the test folder from a standard Zend Framework project, I feel it is incomplete.</dd>
                <dd>Will impove the test files in future versions of this project.</dd>
        </dl>
        </div>
    </div>
  </article>
    
  <div id="footer">
    <article>
        <h2>For more information on this project:</h2>
        <ul>
            <li><a href="http://html5boilerplate.com/">HTML5 Boilerplate</a></li>
            <li><a href="http://framework.zend.com/">Zend Framework Website</a></li>
            <li><a href="https://chrisoconnell@github.com/chrisoconnell/HTML5Boilerplate-ZF-edition.git">HTML5Boilerplate ZF edition</a>
                &mdash; Official github download site. Got any ideas to make this project better? Contribute here.
            </li>
        </ul>
        <h2>Special thanks to:</h2>
        <ul>
            <li>Harry Roberts for his <a href="http://csswizardry.com/type-tips/">typography quick tips</a>. A collection of good to 
                know tips, because web apps should be functional <em>and</em> beautiful.
            </li>
            <li>Mark James for his <a href="http://www.famfamfam.com/lab/icons/silk/">free icon set</a>.</li>
            <li>Adobe kuler for making it easier to <a href="http://kuler.adobe.com">pick the right color</a>.</li>
        </ul>
    </article>
  </div>
             
EOS;

        } else {
            $contents = '<br /><br /><center>View script for controller <b>' . $this->_resource->getParentResource()->getAttribute('forControllerName') . '</b>'
                . ' and script/action name <b>' . $this->_forActionName . '</b></center>';
        }
        return $contents;
    }

    protected function _convertActionNameToFilesystemName($actionName)
    {
        $filter = new Zend_Filter();
        $filter->addFilter(new Zend_Filter_Word_CamelCaseToDash())
            ->addFilter(new Zend_Filter_StringToLower());
        return $filter->filter($actionName);
    }
    
}
