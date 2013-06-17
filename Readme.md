
Copyright 2013 Paschalis Mpeis

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.



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

