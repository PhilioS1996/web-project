<?php

//Validating connection with database
$con = mysqli_connect('localhost','root','','web');

if(!$con)
{
    $messages['database'] =  'Please check the connection with database.';
}


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width", initial-scale=1.0>
        <meta http-equiv="X-UA-Compatible" content="ie-edge">
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
        <title>HAR WEB Project 2021</title>
    </head>

    <body>
        
    <form id="upload-form">
        <h2>Please select a .har file:</h2> <br><br>
        <input type="file" id="myfiles" multiple />
        <button id="upload-button">Upload</button><br><br>
        <h3>Would you like to download the clean har or upload it?</h3>
        <button id="download">Download</button> <button id="upload">Upload to server</button>
        Random: <span id="ran"></span>
    </form>


    <script>

    document.getElementById('upload-button').addEventListener('click',loadHAR);
    document.getElementById('myfiles').addEventListener("change", loadHAR, false);

    function loadHAR()
    {
        
        var fileInput = document.querySelector("#myfiles");
        var files = fileInput.files;
        var file = files[0];

        var myjson = [];

        ran.innerHTML = "Hello";
        const reader = new FileReader();
        
        reader.onload=function()
        {

            //har_entries is object
            const har_entries = JSON.parse(reader.result);
            console.log(har_entries);
            
            var req_content, req_cache, req_pragma, req_expires, req_age, req_last, req_host,
                res_content, res_cache, res_pragma, res_expires, res_age, res_last, res_host;
        
            var entries = har_entries.log.entries;

            //ENTRIES i LOOP 
            for (var i = 0; i< entries.length; i++)
            { 
                // REQUEST HEADERS
                var req_headers = entries[i].request.headers;
                for (var j = 0; j< req_headers.length; j++)
                {
                    if (req_headers[j].name == "content-type")
                    {
                        req_content = req_headers[j].value;
                    }
                    if (req_headers[j].name == "cache-control")
                    {
                       req_cache = req_headers[j].value;
                    }
                    if (req_headers[j].name == "pragma")
                    {
                        req_pragma = req_headers[j].value; 
                    }
                    if (req_headers[j].name == "expires")
                    {
                       req_expires = req_headers[j].value;
                    }
                    if (req_headers[j].name == "age")
                    {
                        req_age = req_headers[j].value;
                    }
                    if (req_headers[j].name == "last-modified")
                    {
                        req_last = req_headers[j].value;
                    }
                    if (req_headers[j].name == "host")
                    {
                        req_host = req_headers[j].value;
                    }
                
                }

                //RESPONSE HEADERS
                var res_headers = entries[i].response.headers;
                for (var j = 0; j< res_headers.length; j++)
                {
                    if (res_headers[j].name == "content-type")
                    {
                        res_content = res_headers[j].value;
                    }
                    if (res_headers[j].name == "cache-control")
                    {
                       res_cache = res_headers[j].value;
                    }
                    if (res_headers[j].name == "pragma")
                    {
                        res_pragma = res_headers[j].value; 
                    }
                    if (res_headers[j].name == "expires")
                    {
                       res_expires = res_headers[j].value;
                    }
                    if (res_headers[j].name == "age")
                    {
                        res_age = res_headers[j].value;
                    }
                    if (res_headers[j].name == "last-modified")
                    {
                        res_last = res_headers[j].value;
                    }
                    if (res_headers[j].name == "host")
                    {
                        res_host = res_headers[j].value;
                    }
                }
                //Removing [ ] from serverIPAddress, if necessary
                if ( entries[i].serverIPAddress.indexOf('[')> -1)
                {
                    entries[i].serverIPAddress = entries[i].serverIPAddress.substring(1, entries[i].serverIPAddress.length -1);
                }
                //Keeping only the domain of url
                if (entries[i].request.url.indexOf('.com/') >-1 )
                {
                    entries[i].request.url = entries[i].request.url.substring( 0, entries[i].request.url.indexOf('.com/')+4 ); 
                }
                else if (entries[i].request.url.indexOf('.gr/') > -1 )
                {
                    entries[i].request.url = entries[i].request.url.substring( 0, entries[i].request.url.indexOf('.gr/')+3 ); 
                }

                myjson.push(  
                    {
                        serverIPAdress: entries[i].serverIPAddress,
                        startedDateTime: entries[i].startedDateTime, 
                        timings: { wait: entries[i].timings.wait },
                        request: {
                            method: entries[i].request.method,
                            url: entries[i].request.url,
                            headers: {
                                content_type: req_content,
                                cache_control: req_cache,
                                pragma: req_pragma,
                                expires: req_expires,
                                age: req_age,
                                last_modified: req_last,
                                host: req_host       
                            }
                        },
                        response: {
                            status: entries[i].response.status,
                            statusText: entries[i].response.statusText,
                            headers: {
                                content_type: res_content,
                                cache_control: res_cache,
                                pragma: res_pragma,
                                expires: res_expires,
                                age: res_age,
                                last_modified: res_last,
                                host: res_host 
                            }
                        }
                    }
                );

                req_content = req_cache = req_pragma = req_expires = req_age = req_last = req_host = 0;
                res_content = res_cache = res_pragma = res_expires = res_age = res_last = res_host = 0;
                               
            }//entries
            
            var output = JSON.stringify(myjson);
            console.log(output);
            
            
        }//onload
        reader.readAsText(file);       

    }//loadHAR

    document.getElementById('download').addEventListener('click', downloadJSON);

    function downloadJSON(output)
    {
        document.getElementById('ran').innerHTML = output;
    }




    </script>

    
        


   





    <!--
        <script>

            document.getElementById('button').addEventListener('click',loadHAR);

            function loadHAR(){
                var xhr = new XMLHttpRequest();
                xhr.open('GET','har_entries.json',true);
                xhr.onload = function(){
                    if (this.status == 200)
                    {
                        
                    }
                }
                xhr.send();
            }
        </script>
    -->
    </body>
</html>