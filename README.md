# Small-Template-Framework
A small HTML (and other text file) framework for small PHP applications

# Setup
Just copy everything to server :D
index.php is commented and explains everything.

You can create template files in the templates/html folder following
the rules you see in the provided ones.

# Make it secure
In the cache, class, require folder put a .htaccess file with deny from all
This is extremely important at the cache folder, as it contains pure HTML
of every page cached. If you want to cache for example user profile page 
that is private: you do not want anyone in your cache folder.
