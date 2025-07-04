simple_smarty_php
=================
A boilerplate for a Smarty-based PHP project. A one pager to get things going. Just pull and create Smarty templates. 

The purpose of this little project is to get up and running as quickly and transparently as possible. For some simple projects that consist mostly of UI pages, putting together a set of HTML pages is the easiest. But HTML is tedious, so for even quicker spin-up, you can use [Smarty](http://www.smarty.net) templates. This is the kind of project that this project enables. It is a boilerplate for creating quick, simple projects that are Smarty-based. Of course you can drop additional resource (e.g., HTML, CSS, etc.) files into the public directory, as desired. 

The goal is to keep this dead-simple. It can be use for quick proof-of-concept. For more advanced or thorough projects, you should use a full framework—for better extensibility and managability. 

Installation — In 5 Steps
-------------------------
1. Get this project.
2. Locate or download the [Smarty source](http://www.smarty.net/download).
3. Point the Smarty link to the `smarty-.../libs` directory (you may need to delete the exist symlink).

        ln -s .../Smarty-3.1.14/libs Smarty
    
4. Point a link from your public web root to the `public` directory (or move the directory and adjust the `index.php` to refer to your base code. 
5. Ready to go: create your template files.

Installation Notes
------------------
If you want to blindly create template files, you can do so. If you create a `templates` directory, you can put them in there (but that isn't necessary).

### OSX Apache
You may need to adjust your Web Server installation. Depending on how you have your symlinks set and read/write access to your project directories there are two things  you may need to account for:

* Locating your sources via symlinks.
* Write access to your application directory.

Using OSX's built-in web-server, I had to adjust the configuration to allow symlinks to find my public directory and … well, it was just easiest to change the user to my user/group. 

### public/
The contents of the public directory are intended to be exposed to the public. Resources within that directory are publicly accessible. Create `img`, `css`, etc. directories as necessary. This directory can be moved and renamed in a directory that is accessible by the web-server or you can create a link from a web-server accessible directory to the `public` directory, leaving the `public` directory in place.

In `htdocs/`

	ln -s /path/to/app/dir/public appname
`appname` is the name in part of the URL that refers to the corresponding app (regardless of the directory name) and determines how the app is accessed by URL, i.e., `http://domain.com/appname`.

### index.php
If you move the `public` directory, then you'll need to adjust the `index.php` file to include the primary file from the application's source directory, `app.php`. 

	<?php
	require_once('/path/to/app/dir/app.php');
	?>

This file is just a pointer to the application's logic, which is hidden from public view. 

### .htaccess
Depending on how Apache is set-up, this may need to be adjusted. The purpose of the `.htaccess` is to direct all URIs rooted at the app to be routed through to the `index.php` in the `public` directory. Uncommenting the `RewriteBase` statement may fix things—set the value to the URI offset of where the app's home page is located, `/` if at the root. If the root URI to get to the app's pages starts at my_app (as in http://domain.com/my_app), then the value should be `/my_app`. You'll know that you need to set this if any URI other than the root of your app results in a 404, "Page Not Found."

	RewriteEngine On

	#RewriteBase /

	# if a directory or a file exists, use it directly
	RewriteCond %{REQUEST_FILENAME} !-f
	RewriteCond %{REQUEST_FILENAME} !-d

	# otherwise forward it to index.php
	RewriteRule .* index.php/$0

### app.php
This file is written as cleanly and minimally as I could. It is for the purpose of creating a very transparent, simple way to get something not-quite-trivial in place. It reads like a config file, of sorts, including definitions to take advantage of contemporary PHP usage (except for functions and classes). Each step is meant to be minimal but extensible, if necessary. It provides enough so that a non-trivial application can be built. 

This file is basically a dispatcher to other files that do the application's work; but this is the starting point. 


CONCEPTS
========
* Separate public resources from application code implementation (by keeping the `public` resources separate from the application logic.
* Allow the `public` side of the application to reside anywhere in the URL tree. Its location acts as the "root" of for the application without having to recode if the application's accessibiliy is moved. That is, the application should be able to work whether it is at the actual root (http://domain.com) or somewhere deeper (http://domain.com/myapp). It should operate even if accessible from both URLs in the same installation. 

File Structure
--------------
* public/	index.php
         	.htaccess
* Smarty/	...
* app.php
* index.tpl
* template.inc

The public directory 

HISTORY
=======
It's funny… I've been working on a PHP framework for quite an while. It is progressing nicely, but I still haven't gotten it into a repository, yet. But then I was doing some contract work and I had to start a small project from scratch. So, with the concepts I'd instilled in my framework in mind, I deconstructed those ideas, picking only some of the most essential ones. 

To Dos
------
* Consider embedding a copy of Smarty to simplify installation.
* Add dispatch to php files so that they can be included in the app directory rather than having to be in the public directory.

Changes
-------
2013-09-19 Initial repository
