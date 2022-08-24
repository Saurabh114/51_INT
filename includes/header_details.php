<?php
if (isset($_GET['ajax'])) {                     // I like to tell my script it's reciving AJAX
    $x = $_GET['x'];
    
    // when process an AJAX request, anything that would normally be sent to the screen 
}                                                // is sent back in a response message

// rest of php code here
?>
<html>

<head>
    <title>Example</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
    <script type='text/javascript'>
        $().ready(function() {
            $("#btnSub").click(function() {
                $.get(
                    "", //  target script is "self"
                    {
                        "ajax": 1,
                        "x": $("#x").val()
                    }, // data to send
                   
                )
            })
        })
    </script>
</head>

<body>

    <?php

    $theme = 'Dark';

    if ($theme == 'Dark') {
        echo '<input type="hidden" id="x" value="Light">';
    } else {
        echo '<input type="hidden" id="x" value="Dark">';
    }
    ?>
    <br>
    <label class="switch">

        <?php
        if ($theme == 'Dark') {
            echo '<input id="btnSub" class="theme_btnn" type="checkbox" checked>';
        } else {
            echo '<input id="btnSub" class="theme_btnn" type="checkbox">';
        }
        ?>

        
        <span class="slider round"></span>
    </label>
    <!-- <button id='btnSub'>Get Square</button> -->
    <hr>
    <div id='result'></div>
</body>

</html>