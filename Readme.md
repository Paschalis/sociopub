Sociopub - Social Publishing System
========


	
	Copyright 2013, Internet Technologies course Team, at Computer Science Dept., University of Cyprus,

    Members:
    Dr. Marios Dikaiakos,
    Dimitris Christofi, Paschalis Mpeis, Pampos Charalambous.
	
	Licensed under the Apache License, Version 2.0 (the "License");
	you may not use this file except in compliance with the License.
	You may obtain a copy of the License at
	
	http://www.apache.org/licenses/LICENSE-2.0
	
	Unless required by applicable law or agreed to in writing, software
	distributed under the License is distributed on an "AS IS" BASIS,
	WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	See the License for the specific language governing permissions and
	limitations under the License.


---


Sociopub
=======

A system that will enable people to publish personal journals, where the articles are ranked and placed according to their popularity.

References:
--------
Fliboard, Personspot, paper.li, bit.ly.
Technologies:
HTML, CSS, PhP, Javascript(Ajax, jQuery, Bootstrap, Isotope), MySQL.


Repository structure:
--------
* SQL
	* SQL Code
		* Creation of tables
			* some table atlering
		* Functions
		* Procedures

* Workspace/SocialPub
	* PHP STORM workspace
		* scripts: php code (the result is the web2.0 API in json)
		* isotope: isotope plugin
		* html: html parts of webpage (rightbar, leftbar, navbar, maincontent etc)
		* css: bootstrap css, isotope css, our css(+overrides on isotope/bootstrap)
		* js:
			* bootstrap (main js + collapse plugin + other currenlty unused js)
			* mainJavascript(our javascript code): most of the client side JS/jQuery (other code may be embedded in webpages)
			* extra plugins
				* html5shiv of google: support html5 on osbolete browsers
				* timeago: human readable time
				* jQuery libary
