<?php
/**
 * Created by JetBrains PhpStorm.
 * User: paschalis
 * Date: 4/20/13
 * Time: 3:18 PM
 * To change this template use File | Settings | File Templates.
 */

if($_SESSION['loggedin']==1){

?>

<h4>Latest</h4>
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
        $("body").on("click", "ul.latestShares li a", function () {

            var url = $(this).attr('data-filter-value');

            previewArticle(url);
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

                $('ul.latestShares').append('<li><a  href="#" data-filter-value="' + obj[i].url + '">' + title + '</a>'
                    + '<div class="likeShares">'
                    + '<button class="badge likes">+' + obj[i].likes + '</button>'
                    + '<button class="badge shares" >Shares: ' + obj[i].shares + '</button>'
                    + '</div>'
                    + '</li>');

            }

        }


    }


</script>

<?php }  ?>


