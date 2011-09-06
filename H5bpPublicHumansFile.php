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
class Zend_Tool_Project_Context_Zf_H5bpPublicHumansFile extends Zend_Tool_Project_Context_Filesystem_File
{

    /**
     * @var string
     */
    protected $_filesystemName = 'humans.txt';

    /**
     * getName()
     *
     * @return string
     */
    public function getName()
    {
        return 'H5bpPublicHumansFile';
    }

    /**
     * getContents()
     *
     * @return string
     */
    public function getContents()
    {
        $output = <<<EOS
/* the humans responsible & colophon */
/* humanstxt.org */


/* TEAM */
  <your title>: <your name>
  Site: 
  Twitter: 
  Location: 

/* THANKS */
  Names (& URL): 

/* SITE */
  Standards: HTML5, CSS3
  Components: Modernizr, jQuery
  Software:
  

                                    
                               -o/-                       
                               +oo//-                     
                              :ooo+//:                    
                             -ooooo///-                   
                             /oooooo//:                   
                            :ooooooo+//-                  
                           -+oooooooo///-                 
           -://////////////+oooooooooo++////////////::    
            :+ooooooooooooooooooooooooooooooooooooo+:::-  
              -/+ooooooooooooooooooooooooooooooo+/::////:-
                -:+oooooooooooooooooooooooooooo/::///////:-
                  --/+ooooooooooooooooooooo+::://////:-   
                     -:+ooooooooooooooooo+:://////:--     
                       /ooooooooooooooooo+//////:-        
                      -ooooooooooooooooooo////-           
                      /ooooooooo+oooooooooo//:            
                     :ooooooo+/::/+oooooooo+//-           
                    -oooooo/::///////+oooooo///-          
                    /ooo+::://////:---:/+oooo//:          
                   -o+/::///////:-      -:/+o+//-         
                   :-:///////:-            -:/://         
                     -////:-                 --//:        
                       --                       -:        
EOS;
        return $output;
    }

}
