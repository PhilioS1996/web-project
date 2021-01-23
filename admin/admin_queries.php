<?php


include "../config.php";
session_start();

if (isset($_SESSION['username']))
{
    $admin =  $_SESSION['username'];

    if (isset($_GET['data']) && ($_GET['data']) == "total_users")
    {
        $query1 = "SELECT COUNT( * ) AS total_users FROM users";
        $result1 = mysqli_query($con, $query1);

        if($result1)
        {
            $data = mysqli_fetch_assoc($result1);
            echo $data['total_users'];
        }
    }
    if (isset($_GET['data']) && ($_GET['data']) == "entries_per_request")
    {
        $query2 = "SELECT method, COUNT(*) FROM har_entries GROUP BY method";
        $result2 = mysqli_query($con, $query2);

        if ($result2)
        {
            echo "<table border='1' >
            <tr>
            <td align=center><b>Method</b></td>
            <td align=center><b>Count</b></td>";

            while($data2 = mysqli_fetch_row($result2))
            {   
                echo "<tr>";
                echo "<td align=left>$data2[0]</td>";
                echo "<td align=center>$data2[1]</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }

    if (isset($_GET['data']) && ($_GET['data']) == "entries_per_response")
    {
        $query3 = "SELECT status, COUNT(*) FROM har_entries GROUP BY status";
        $result3 = mysqli_query($con, $query3);

        if ($result3)
        {
            echo "<table border='1' >
            <tr>
            <td align=center><b>Status</b></td>
            <td align=center><b>Count</b></td>";

            while($data3 = mysqli_fetch_row($result3))
            {   
                echo "<tr>";
                echo "<td align=center>$data3[0]</td>";
                echo "<td align=center>$data3[1]</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }

    if (isset($_GET['data']) && ($_GET['data']) == "unique_domains")
    {
        $query4 = "SELECT COUNT(DISTINCT url) AS unique_domains FROM har_entries";
        $result4 = mysqli_query($con, $query4);

        if ($result4)
        {
            $data4 = mysqli_fetch_row($result4);
            echo $data4[0];
        }
        
    }
    if (isset($_GET['data']) && ($_GET['data']) == "unique_isps")
    {
        $query5 = "SELECT COUNT(DISTINCT isp) AS unique_isps FROM uploads";
        $result5 = mysqli_query($con, $query5);

        if ($result5)
        {
            $data5 = mysqli_fetch_row($result5);
            echo $data5[0];
        }

    }

    if (isset($_GET['data']) && ($_GET['data']) == "average_age")
    {
        $query6 = "SELECT res_content_type, AVG ( DATEDIFF( res_expires, startedDateTime) ) 
                    FROM har_entries 
                    WHERE res_expires>startedDateTime 
                    GROUP BY res_content_type";
        
        $result6 = $result5 = mysqli_query($con, $query6);

        if ($result6)
        {
            echo "<table border='1' >
            <tr>
            <td align=center><b>Content type</b></td>
            <td align=center><b>Average age</b></td>";

            while($data6 = mysqli_fetch_row($result6))
            {   
                echo "<tr>";
                echo "<td align=center>$data6[0]</td>";
                echo "<td align=center>$data6[1]</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
}
else
{
    header("Location:/index.html");
}
?>