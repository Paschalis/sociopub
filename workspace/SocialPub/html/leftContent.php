<?php
/**

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




 * Created by JetBrains PhpStorm.
 * User: paschalis
 * Date: 4/20/13
 * Time: 3:18 PM
 * To change this template use File | Settings | File Templates.
 */

if($_SESSION['loggedin']==1){

?>

<h4>Latest Additions</h4>
<ul class="latestShares">

</ul>
<script>

    $(document).ready(function () {
        // Get latest additions
        $('ul.latestShares').html("");//clear previous additions


        ajaxJsonRequest("scripts/getLatestAdditions.php",
            "",
            gotLatestAdditions,
            ajaxFailed);


        //When a latest addition is clicked
        $("body").on("click", "ul.latestShares li button", function () {

            var url = $(this).attr('data-filter-value');


            previewArticle(this, url);
        });


    });


    /**Got latest additions result */
    function gotLatestAdditions(data) {

        var obj = eval('(' + data + ')');


        var latestAdditions = [];


        // Found latest additions
        if (obj[0]['code'] == 1) {

            for (var i = 1; i < obj.length; i++) {


                // handle cases where title is null
                if (obj[i].title == null || obj[i].title == "")
                    continue;

                var title = "";
                if (obj[i].title.length > 47) {
                    title = obj[i].title.substring(0, 50) + '...';
                }
                else {
                    title = obj[i].title;
                }

                $('ul.latestShares').append('<li><button class="latestArticleButton" data-filter-value="' + obj[i].url + '">' + title + '</button>'
                    + '<div class="likeShares">'
                    + '<button class="badge likes" disabled>+' + obj[i].likes + '</button>'
                    + '<button class="badge shares" disabled>Shares: ' + obj[i].shares + '</button>'
                    + '</div>'
                    + '</li>');

            }

        }


    }


</script>

<?php }  ?>


