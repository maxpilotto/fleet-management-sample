<html>
<?php
session_start();
echo file_get_contents("defaultHead.html");
include_once("connection.php");
?>

<body>
    <!-- Header -->
    <?php
    include("defaultHeader.php");
    include("defaultAuthCheck.php");
    ?>

    <!-- Content -->
    <div id="content-wrapper" class="mui--text-center">
        <div class="mui--appbar-height"></div>
        <br />
        <br />
        <meta charset="utf-8">
        <script type="text/javascript">
        var lastLine = 0;
        var id = getParameterByName("id");

        function getParameterByName(name, url) {
            if (!url){
                url = window.location.href;
            }

            var urlObj = new URL(url);
            var c = urlObj.searchParams.get(name);

            return c;
        }

        function update() {
            $.ajax({
                type: "POST",
                url: "chatCore.php",
                cache: false,
				async: true,
                data: {
                    'method': 'update',
                    'chatId': id,
                    'lastLine': lastLine
                },
                success: function(data) {
                    console.log(data);
					console.log(lastLine);

                    if (data == '[]'){
                        return;
                    }

                    if (data == '[quit]'){
                        window.location.href = "pageNotFound.php";
						return;
                    }

                    var response = JSON.parse(data);

                    for (var i=0; i<response.length; i++){
                        $('#chat').append(response[i]);
                        $('#chat').append("<br />");
						lastLine++;
                    }
					
                    document.getElementById('chat').scrollTop = document.getElementById('chat').scrollHeight;
                },
            });
        }

        function send(message) {
            $.ajax({
                type: "POST",
                url: "chatCore.php",
                cache: false,
				async: true,
                data: {
                    method: "send",
                    chatId: id,
                    message: message
                },
                success: function(data) {
                    $("#text").attr("value", " ");
                },
            });
        }

        function updateStatus(status){
            if (status != 0){
                $.ajax({
                    type:"POST",
                    url:"chatCore.php",
                    cache:false,
                    data:{
                        method: "updateStatus",
                        chatId: id,
                        status: status
                    }
                });
            }
        }

        $(document).ready(function(){
            update();

            $("#send").click(function(){
                send($("#text").val());
            });

            $("#select").on("change",function(){
                updateStatus($("#select").val());
            });

            setInterval(update,1000);
        });
        </script>

        <div class='mui-container'>
            <div class='mui-panel' width="60%">
                <p id="chat" name="chat"></p>
            </div>
            <form class="mui-form" method="post">
                <div class="mui-textfield">
                    <input type="text" name="text" id="text" placeholder="message..."/>
                </div>
            </form>
            <button id="send" class="mui-btn mui-btn--primary">Send</button>
            <br />
            <br />
            Shipment status: <select id="select">
                <option value="0">Select an option...</option>
                <option value="1">Done</option>
                <option value="2">In progress</option>
                <option value="3">Failed</option>
                <option value="4">Waiting</option>
            </select>
        </div>
    </div>

    <!-- Footer -->
    <?php
    echo file_get_contents("defaultFooter.html");
    ?>

</body>
</html>
