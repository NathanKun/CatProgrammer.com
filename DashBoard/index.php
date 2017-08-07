<?php 
    require_once "../config.php";
    require_once (ROOT_DIR.'/includes/verifySession.inc.php'); 
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="keywords" content="index">
    <meta name="description" content="Temperature and humitity chart of some place">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <title>DashBoard</title>
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
    <div>
        <canvas id="tempHumChart"></canvas>
        <div id='list'></div>
    </div>
    <a id='disconnect' href='../disconnect'>Disconnect</a>
    <?php include (ROOT_DIR.'/includes/footer.inc.php'); ?>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/papaparse.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
    <script>
        var json = null;
        var finalList = [];
        var data = {};
        var options = {};
        var ctx = $("#tempHumChart");
        
        window.onload = function() {
            window.myChart = new Chart(ctx, {
                type: 'line',
                data: data,
                options: options
            });
	    $("#tempHumChart").css("display", "inline-block");
        }
        
        // dynamic change data in chart
        function changeData(index) {
            delete data.labels;
            delete data.datasets[0].data;
            delete data.datasets[1].data;
            delete options.title.text;
            
            data['labels'] = finalList.DataList[index].Time;
            data.datasets[0]['data'] = finalList.DataList[index].Temperature;
            data.datasets[1]['data'] = finalList.DataList[index].Humitity;
            window.myChart.options.title['text'] = 'TempHumChart : ' + finalList.DateList[index];
            
            window.myChart.update();
            window.myChart.render();
        }
        
        //$.get("https://nathankun.ddns.net/data.csv", { t: new Date().getTime() }, function(result) {
        $.get("https://catprogrammer.com/DashBoard/data.php", { t: new Date().getTime() }, function(result) {

            //console.log(result);
            Papa.parse(result, {
            //download: true,
            header: true,
            skipEmptyLines: true,
            complete: function(result)
            {
                //console.log(result);
                var dateList = [];
                var dateDataList = [];
                var tempList = [];
                var humList = []
                var timeList = []
            
                var lastDate = "None";
                // loop over json object
                for (var key in result.data) {
                    if (result.data.hasOwnProperty(key)) {
                        // extract data
                        dateTime = result.data[key].DateTime;
                        date = dateTime.split(" ")[0];
                        time = dateTime.split(" ")[1];
                        temp = result.data[key].Temp;
                        hum = result.data[key].Hum;
                        // add complete one day data in list when date changes
                        if($.inArray(date, dateList) == -1) {
                            // ignore first time
                            if(lastDate.localeCompare("None") != 0){
                                dateList.push(date);
                                dateDataList.push({Date: lastDate, Time: timeList, Temperature: tempList, Humitity: humList});
                            }
                            // clean temporary lists
                            tempList = [];
                            humList = [];
                            timeList = [];
                        }
                        // build temporary lists
                        timeList.push(time);
                        tempList.push(temp);
                        humList.push(hum);
                        lastDate = date;
                    }
                }
                // add last day data
                dateDataList.push({Date: lastDate, Time: timeList, Temperature: tempList, Humitity: humList});
                            
                // remove the first, nodata item
                dateDataList.splice(0, 1);
                
                // final list
                finalList = {DateList: dateList, DataList: dateDataList};

		// generate date list for date selection                
                var ul = $("<ul id='dateList' class='col_ul'>").appendTo('#list');
		var counter = 0;
		var subUl = null;
		var li = null;
                $(finalList.DateList).each(function(index, item) {
                    
		    if (counter == 0) {
		        var liForSubUl = $(document.createElement('li'));
		        if (subUl != null) {
		            liForSubUl.append("<span>" + subUl[0].firstChild.innerHTML + "</span>");
		            liForSubUl.append(subUl);
		            ul.append(liForSubUl);
		        }
		        subUl = $(document.createElement('ul'));
		    }
		    li = $(document.createElement('li'));
                    li.text(item);
                    li.click(function(){
                        changeData(index);
                    });
                    subUl.append(li);
		    counter++;
		    if (counter == 10) {
		        counter = 0;
		    }
                });

		// collapsible list
                var li_ul = document.querySelectorAll(".col_ul li  ul");
                 for (var i = 0; i < li_ul.length; i++) {
                     li_ul[i].style.display = "none"
                 };

                 var exp_li = document.querySelectorAll(".col_ul li > span");
                 for (var i = 0; i < exp_li.length; i++) {
                        exp_li[i].style.cursor = "pointer";
                        exp_li[i].onclick = showul;
                 };
                    function showul () {
                        nextul = this.nextElementSibling;
                        if(nextul.style.display == "block")
                        nextul.style.display = "none";
                     else
                        nextul.style.display = "block";
                }
		li_ul[li_ul.length - 1].style.display = "block";
                
                //console.log(finalList);
                
                data = {
                    labels: finalList.DataList[finalList.DataList.length - 1].Time,
                    datasets:[
                        {
                            label:"Temperature", 
                            data: finalList.DataList[finalList.DataList.length - 1].Temperature,
                            backgroundColor: 'rgb(255, 99, 132)',
                            borderColor: 'rgb(255, 99, 132)',
                            fill: false
                        },
                        {
                            label:"Humitity", 
                            data:finalList.DataList[finalList.DataList.length - 1].Humitity,
                            backgroundColor: 'rgb(99, 132, 255)',
                            borderColor: 'rgb(99, 132, 255)',
                            fill: false
                        }
                    ]
                };
                options = {
                    responsive: true,
                    title:{
                        display:true,
                        text:'TempHumChart : ' + finalList.DataList[finalList.DataList.length - 1].Date
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Time'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Value'
                            }
                        }]
                    }
                };
                
                window.myChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });;
            }});
        });
        
        
    </script>
</body>

</html>
