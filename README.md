simple_smarty_php
=================
A template for a Smarty-based PHP project. A one pager to get things going. Just pull and create Smarty templates. 

The purpose of this little project is to get up and running as quickly and transparently as possible. For some, simple projects that consist mostly of UI pages, putting together a set of HTML pages is the easiest. But HTML is tedious, so for even quicker spin-up, you can use [Smarty](http://www.smarty.net) templates. So this is what this project enables. It is a boilerplate for creating quick, simple projects that are Smarty-based. Of course you can drop addiitonal resource (e.g., PHP, HTML, CSS, etc.) files into the public directory, as desired. 

The goal is to keep this dead-simple. It can be use for quick proof-of-concept. For more advanced or thorough projects, you should use a full framework—for better extensibility and managability. 

Installation — In 5 Steps
-------------------------
1. Get this project.
2. Locate or download the [Smarty source](http://www.smarty.net/download).
3. Point the Smarty link to the `smarty-.../libs` directory (you may need to delete the exist symlink).

        ln -s .../Smarty-3.1.14/libs Smarty
    
4. Point a link from your public web root to the `public` directory (or move the directory and adjust the `index.php` to refer to your base code. 
5. Ready to go: create your template files.

Creating Project Files
----------------------
If you want to blindly create template files, you can do so. If you create a `templates` directory, you can put them in there (but that isn't necessary).

Adjustments to Installation
---------------------------
You may need to adjust your Web Server installation. Depending on how you have your symlinks set and read/write access to your project directories there are two things  you may need to account for:

* Locating your sources via symlinks.
* Write access to your application directory.

Using OSX's built-in web-server, I had to adjust the configuration to allow symlinks to find my public directory and … well, it was just easiest to change the user to my user/group. 

HISTORY
=======
To Dos
------
* Consider embedding a copy of Smarty to simplify installation.
* Add dispatch to php files so that they can be included in the app directory rather than having to be in the public directory.

Changes
-------
2013-09-19 Initial repository
