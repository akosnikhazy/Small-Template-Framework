# Small-Template-Framework
A small HTML (and other text file) framework for small PHP applications

# Setup
Just copy everything to server :D
index.php is commented and explains everything.

You can create template files in the templates/html folder following
the rules you see in the provided ones. Also, you can template raw
strings. This comes handy when you generate template strings on the
fly (for example, you have two lists of data from a database and use an
ID for template and change it to the data from the other list).

# Make it secure
In the cache, class, require, text folder put a .htaccess file with
deny from all This is extremely important in the cache folder, as it
contains pure HTML of every page/text cached. If you want to cache for
example user profile page that is private: you do not want anyone in
your cache folder.
