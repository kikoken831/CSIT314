<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<title>Owner Analytics</title>
	</head>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <body>
    <?php
        //db connection initialise
        $servername="localhost";
        $username="root";
        $serverpw="";
        $dbname="restaurant";

        $conn = new mysqli($servername, $username, $serverpw, $dbname);
        if ($conn->connect_error) { die("connection failed"); }
    ?>
    <nav class="navbar navbar-light bg-light">
        <div class="container">
            <span class="navbar-brand mb-0 h1" style="text-align=center">Owner's Dashboard</span>
            <button onclick="window.location.href='login.php'" class="btn btn-outline-danger my-2 my-lg-0" type="submit">Log Out</button>
        </div>
	</nav>
    <!-- get top 3 -->
    <?php
        $sql = "select cartitem.`ITEM ID`, sum(cartitem.QUANTITY) as total, item.`ITEM NAME` from cartitem join item on cartitem.`ITEM ID` = item.`ITEM ID` group by `ITEM ID` order by total desc limit 3";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) 
            {
                while ($row=$result->fetch_array())
                    {
                        //$arr[] = array('name'=>$row['ITEM NAME'], 'count'=>$row['total']);
                        $top3name[] = $row[2];
                        $top3count[] = $row[1];
                    }
            }
        $result -> free_result();
    ?>
    <!-- get accounts -->
    <?php
        $sql = "select
        A.count, B.count 
        from 
        (select count(*) as count from transaction ) A, 
        (select count(*) as count from transaction where `CUSTOMER ID` = 1) B
        ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) 
            {
                while ($row=$result->fetch_array())
                    {
                        $transWAcct[] = $row[0];
                        $transWAcct[] = $row[1];
                    }
            }
        $result -> free_result();
    ?>
    <!-- get avg transaction per day last 30 days -->
    <?php
        $sql = "select DATE(DATETIME)as date, AVG (`TOTAL PRICE`) from transaction group by date order by date;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) 
            {
                while ($row=$result->fetch_array())
                    {
                        $transPerDayDate[] = $row[0];
                        $transPerDayAmt[] = $row[1];
                    }
            }
        $result -> free_result();
    ?>
    <!-- get transaction per day last 30 days -->
    <?php
        $sql = "select DATE(DATETIME)as date, count(`transaction ID`) from transaction group by date order by date;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) 
            {
                while ($row=$result->fetch_array())
                    {
                        $transPerDate[] = $row[0];
                        $transPerAmt[] = $row[1];
                    }
            }
        $result -> free_result();
    ?>
    <!-- display charts -->
    <div>
        <canvas id="avgTransGraph" style="margin:auto;"></canvas>
    </div> 
    <div>
        <canvas id="transGraph" style="margin:auto;"></canvas>
    </div>
    <div style="width: 50%; display: flex">
        <canvas id="topMenu" ></canvas>
        <canvas id="accounts" ></canvas>
    </div>

    <!-- script for average transaction amount per day last 30 days -->
    <script>

    var xValues = <?php echo json_encode($transPerDayDate); ?>;
    var yValues = <?php echo json_encode($transPerDayAmt); ?>;
    var maxAmt = Math.max(...yValues) + 10;
    var minAmt = Math.min(...yValues) - 10;

    new Chart("avgTransGraph", {
    type: "line",
    data: {
        labels: xValues,
        datasets: [{
        label: "Average transaction amount per day (last 30 days)",
        fill: false,
        backgroundColor: "#14213D",
        borderColor: "#FCA311",
        data: yValues,
        pointStyle: "circle"
        }]
    },
    options: {
        legend: {display: true, labels: {usePointStyle: true}},
        scales: {
        yAxes: [{ticks: {min: minAmt, max: maxAmt}}],
        }
    }
    });
    </script>
	
    <!-- script transaction per day last 30 days -->
    <script>

    var xValues = <?php echo json_encode($transPerDate); ?>;
    var yValues = <?php echo json_encode($transPerAmt); ?>;
    var maxAmt = Math.max(...yValues) + 2;
    var minAmt = Math.min(...yValues) - 2;

    new Chart("transGraph", {
    type: "line",
    data: {
        labels: xValues,
        datasets: [{
        label: "Transactions per day (last 30 days)",
        fill: false,
        backgroundColor: "#14213D",
        borderColor: "#FCA311",
        data: yValues,
        pointStyle: "circle"
        }]
    },
    options: {
        legend: {display: true, labels: {usePointStyle: true}},
        scales: {
        yAxes: [{ticks: {min: minAmt, max: maxAmt}}],
        }
    }
    });
    </script>

    <!-- script for top 3 items -->
    <script>
    
    var jsName = <?php echo json_encode($top3name); ?>;
    var jsCount = <?php echo json_encode($top3count); ?>;

    var xValues = [jsName[0], jsName[1], jsName[2]];
    var yValues = [jsCount[0], jsCount[1], jsCount[2]];
    var barColors = [
    "#FCA311",
    "#14213D",
    "#000"
    ];

    new Chart("topMenu", {
    type: "doughnut",
    data: {
        labels: xValues,
        datasets: [{
        backgroundColor: barColors,
        data: yValues
        }]
    },
    options: {
        title: {
        display: true,
        text: "Top 3 Menu Items"
        }
    }
    });
    </script>

    <!-- script for transactions with or without accounts -->
    <script>    
        var jsTransWAcct = <?php echo json_encode($transWAcct); ?>;

        var xValues = ["With Account", "Without Account"];
        var yValues = [(jsTransWAcct[0]-jsTransWAcct[1]), jsTransWAcct[1]];
        var barColors = [
        "#FCA311",
        "#14213D"
        ];

        new Chart("accounts", {
        type: "doughnut",
        data: {
            labels: xValues,
            datasets: [{
            backgroundColor: barColors,
            data: yValues
            }]
        },
        options: {
            title: {
            display: true,
            text: "Percentage of Transaction with Account Users"
            }
        }
        });
    </script>


	</body>
</html>