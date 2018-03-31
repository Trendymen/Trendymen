<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <title>无标题文档</title>
    <script language="javascript">
        //var ab = new Array();
        var xmlHttp;

        function createXMLHttpRequest() {
            if (window.ActiveXObject) {
                xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            else if (window.XMLHttpRequest) {
                xmlHttp = new XMLHttpRequest();
            }
        }

        function startRequest() {
            createXMLHttpRequest();
            xmlHttp.onreadystatechange = handleStateChange;
            document.getElementById('select2').options.length = 0;
            var url = document.form1.select1.value;
            var qurl = "ajax_php.php?countryCode="+url;
            xmlHttp.open("GET", qurl, true);
            xmlHttp.send(null);
            //setTimeout("startRequest()",2000);
        }

        function handleStateChange() {
            if(xmlHttp.readyState == 4) {
                if(xmlHttp.status == 200) {
                    var obj = document.getElementById('select2');
                    eval(xmlHttp.responseText);

                }
            }
        }

    </script>
</head>

<body>
<form name="form1" method="post" action="">
    <p>
        <select name="select1" id="select1" onChange="startRequest()">
            <option value="0">选择</option>
            <option value="no">1</option>
            <option value="dk">2</option>
            <option value="us">3</option>
        </select>
    </p>
    <p>
        <select name="select2" id="select2">
        </select>
    </p>
</form>
</body>
</html>