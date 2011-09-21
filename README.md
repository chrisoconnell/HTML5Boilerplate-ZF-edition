#About

Bringing the awesome-ness of HTML5 Boilerplate and the Zend Framework together!

Wouldn't it be nice it you could just type "zf create project MyProject" into the command line and have all of the 
HTML5 Boilerplate goodness *magically* injected into your new Zend project? Well now you can!



##To Install

1. Find the location of your Zend Framework install. Mine is at "/usr/local/zend/share/ZendFramework" but yours could be different.
2. Now go to "library/Zend/Tool/" so your final path should be "/path/to/ZendFramework/library/Zend/Tool/"
3. Make a backup of the Project directory (just in case).
4. Replace the "Project.php" file in the "Project/Provider" directory with the one from HTML5Boilerplate-ZF-edition. 
5. Copy every file beginning with "H5bp" into "Project/Context/Zf"


So if you are doing everything from the command line, it will look like:
     cd /path/to/ZendFramework/library/Zend/Tool/
     cp -r Project Project-old
     cp /path/to/HTML5Boilerplate-ZF-edition/Project.php Project/Provider/
     cp /path/to/HTML5Boilerplate-ZF-edition/H5bp* Project/Context/Zf/



Thats it! Now anytime you create a new Zend Framework project, it will automatically have the HTML 5 Boilerplate template built in.
You do not need to run "zf enable layout" as it is part of the new create project command.

