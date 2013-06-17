425 Project
---------------

Project is hosted on private git repository @bitbucket


Source code folder descriptions:

SQL
.SQL Code
..Creation of tables
...some table atlering
..Functions
..Procedures

Workspace/SocialPub
.PHP STORM workspace
..scripts: php code (the result is the web2.0 API in json)
..isotope: isotope plugin
..html: html parts of webpage (rightbar, leftbar, navbar, maincontent etc)
..css: bootstrap css, isotope css, our css(+overrides on isotope/bootstrap)
..js:
...bootstrap (main js + collapse plugin + other currenlty unused js)
...extra plugins
....html5shiv of google: support html5 on osbolete browsers
....timeago: human readable time
....hirestext.js: some isotope blurry text fixes(eventually not used. changed isotope source and text isnt blurry now)
....jQuery libary
....mainJavascript(our javascript code): most of the client side JS/jQuery (other code may be embedded in webpages)

