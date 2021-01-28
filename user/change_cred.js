
//Change username
$(document).ready(function()
{
    $("#usr-sbt").click(function()
    {
        
        var username = document.getElementById('username').value;
        var newusername = document.getElementById('newusername').value;
        if (username == "" || newusername == "" )
        {
            $("#user-message").html("Please fill in the blanks");
        }
        else
        {
            $.ajax({
                type: "POST",
                url: "change_cred.php",
                data: 
                    { 
                        username: username,
                        newusername: newusername
                    },
                
                success: function (response) 
                {
                    if (response == 1 )
                    {
                        window.location = "user.php";
                    }
                    else if (response == 0 )
                    {
                        $("#user-message").html("ERROR. Please try again.");
                    }
                    else if (response == -1 )
                    {
                        $("#user-message").html("Username already taken");
                    }
                    else console.log(response);
                }
            });
        }
    });
});

//Change password
$(document).ready(function()
{
    $("#pass-sbt").click(function()
    { 
        var username = document.getElementById('username1').value;
        var oldpassword = document.getElementById('oldpassword').value;
        var newpassword = document.getElementById('newpassword').value;
        var cpassword = document.getElementById('cpassword').value;

        if (username == "" || oldpassword == "" || newpassword == "" || cpassword == "")
        {
            $("#pass-message").html("Please fill in the blanks");
        }
        else if ( !newpassword.match(cpassword))
        {
            $("#pass-message").html("Passwords do not match.");
        }
        else
        {
            $.ajax({
                type: "POST",
                url: "change_cred.php",
                data: 
                    { 
                        username: username,
                        oldpassword: oldpassword,
                        newpassword: newpassword,
                        cpassword: cpassword
                    },
                
                success: function (response) 
                {
                    
                    if (response == 1 )
                    {
                        window.location = "user.php";
                    }
                    else if (response == 0 )
                    {	
                        $("#pass-message").html("Error. Please try again.");
                    }
                    else if (response == -1)
                    {
                        $("#pass-message").html("Password should be at least 8 characters, contain an uppercase, a number and a special character.");
                    }
                    else console.log(response);// for debugging reasons
                }
            });
        }
    });
}); 
