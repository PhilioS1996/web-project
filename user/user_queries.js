//Global variable
var myjson = []; 
var access_key  = 'a0f5fb790437ca75820165bbd684e45b';

//FUNCTION: loadHAR
$(document).ready(function()
{
    $("#upload-btn").click(function()
    {
        
        var fileInput = document.querySelector("#myfiles");
        var files = fileInput.files;
        var file = files[0];
        var filepath = fileInput.value;
               
        

        var allowed_type = /(\.har)$/i; 

        if (!allowed_type.exec(filepath))
        {
            alert("Only HAR files are allowed. Please try again.");
        }
        else document.getElementById('message').innerHTML = "The file has been successfully uploaded!";

        const reader = new FileReader();
        
        
        reader.onload=function()
        {
            //har_entries is object
            const har_entries = JSON.parse(reader.result);
            
            var req_content = req_cache = req_pragma = req_expires = req_age = req_last = req_host =
                res_content = res_cache = res_pragma = res_expires = res_age = res_last = res_host = 0 ;

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
                        const day = new Date(req_headers[j].value);
                        req_last = day.toISOString();
                    }
                    if (req_headers[j].name == "age")
                    {
                        req_age = req_headers[j].value;
                    }
                    if (req_headers[j].name == "last-modified")
                    {
                        const day = new Date(req_headers[j].value);
                        req_last = day.toISOString();
                    }
                    if (req_headers[j].name == "Host")
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
                        const day = new Date(res_headers[j].value);
                        res_expires = day.toISOString();
                    }
                    if (res_headers[j].name == "age")
                    {
                        res_age = res_headers[j].value;
                    }
                    if (res_headers[j].name == "last-modified")
                    {
                        const day = new Date(res_headers[j].value);
                        res_last = day.toISOString();
                    }
                    if (res_headers[j].name == "Host")
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
                var full_url = entries[i].request.url ;
                var sub_url = full_url.slice(8); //Removing the "https://"
                var index = sub_url.indexOf("/"); //index = position of "/"
                var full_url = full_url.substring(0, index + 8); 
               
                if (entries[i].serverIPAddress == "")
                {
                    var geo_coord = {"latitude":0 ,"longitude":0};
                }
                else var geo_coord = JSON.parse(getGeoCoordinates(entries[i].serverIPAddress) );
                
                myjson.push(  
                    {
                        serverIPAdress: entries[i].serverIPAddress,
                        serversLatitude: geo_coord.latitude,
                        serversLongitude: geo_coord.longitude,
                        startedDateTime: entries[i].startedDateTime, 
                        timings: { wait: entries[i].timings.wait },
                        request: {
                            method: entries[i].request.method,
                            url: full_url,
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
           console.log(myjson);
        }//onload
        reader.readAsText(file);   
    });
});    
//loadHAR

//Global variable
var empty = "[]";

//FUNCTION: downloadJSON
$(document).ready(function()
{
    $("#download").click(function()
    {
        var output = JSON.stringify(myjson);
        if (output == empty)
        {
            alert("Please upload a file first.");
        }
        else
        {
            output = [output];
            var blob1 = new Blob(output, { type: "application/json" });

            var isIE = false || !!document.documentMode;

            if (isIE) {
                window.navigator.msSaveBlob(blob1, "output.json");
            } else {
                var url = window.URL || window.webkitURL;
                link = url.createObjectURL(blob1);
                var a = document.createElement("a");
                a.download = "output.json";
                a.href = link;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            }
        }
    });
});

//FUNCTION: upload
$(document).ready(function()
{
    $("#upload").click(function()
    {
        
        var jsonString = JSON.stringify(myjson);
        var usersIPData = getUsersIPData();

        if (jsonString == empty)
        {
            alert("Please upload a file first.");
        }
        else
        {
            //HAR ENTRIES UPLOAD
            $.ajax({
                type: "POST",
                url: "user_queries.php",
                data: { har_data: jsonString,
                        users_data: usersIPData },
                    success: function(response){
                        document.getElementById('server').innerHTML = "Your file has been uploaded to server.";
                }
            });
        }
    });
});

  
//LAST UPLOAD
$(document).ready(function() 
{
    $("#last_button").click(function() 
    {
        $.ajax({
            type: "GET",
            url: "user_queries.php",
            data: { data: "last_updated"},
            success:function(response)
            {
                $("#show_lastupdated").html(response);
            }
        }); 
    });
});  

//TOTAL UPLOADS
$(document).ready(function() 
{
    $("#total_button").click(function() 
    {
        $.ajax({
            type: "GET",
            url: "user_queries.php",
            data: { data: "total_uploads"},
            success:function(response)
            {
                $("#show_total").html(response);
            }
        }); 
    });
});  

function getUsersIPData()
{
    var ip = $.ajax({ 
        url: 'https://ipapi.co/ip', 
        async: false,
    }).responseText;

    var city = $.ajax({ 
        url: 'https://ipapi.co/city', 
        async: false,
    }).responseText;

    var isp = $.ajax({ 
        url: 'https://ipapi.co/org', 
        async: false,
    }).responseText;
    
    return {ip, city, isp} ;
}


function getGeoCoordinates(ip)
{    
    var lat = $.ajax({ 
        url: 'http://api.ipstack.com/' + ip + '?access_key=' + access_key +'&fields=latitude,longitude', 
        async: false,
    }).responseText;
    return lat;
}


  