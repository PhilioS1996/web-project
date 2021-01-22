$(document).ready(function()
{
    $("#usr_submit").click(function()
    {
        
        var username = document.getElementById('username').value;
        var newusername = document.getElementById('newusername').value;
        if (username == "" || newusername == "" )
        {
            document.getElementById('user').innerHTML = "Please fill in the blanks.";
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
                        document.getElementById('user').innerHTML = "ERROR. Please try again.";
                    }
                    else if (response == -1 )
                    {
                        document.getElementById('user').innerHTML = "Username already taken.";
                    }
                    else console.log(response);
                }
            });
        }
    });
});



$(document).ready(function()
{
    $("#pass_submit").click(function()
    { 
        var username = document.getElementById('username1').value;
        var oldpassword = document.getElementById('oldpassword').value;
        var newpassword = document.getElementById('newpassword').value;
        var cpassword = document.getElementById('cpassword').value;

        if (username == "" || oldpassword == "" || newpassword == "" || cpassword == "")
        {
            document.getElementById('password').innerHTML = "Please fill in the blanks.";
        }
        else if ( !newpassword.match(cpassword))
        {
            document.getElementById('password').innerHTML = "Passwords do not match.";
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
                        document.getElementById('password').innerHTML = "Error. Please try again.";
                    }
                    else if (response == -1)
                    {
                        document.getElementById('password').innerHTML = "Password should be at least 8 characters, contain an uppercase, a number and a special character.";
                    }
                    else console.log(response);
                }
            });
        }
    });
}); 
