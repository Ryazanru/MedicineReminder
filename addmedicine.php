
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>addmedicine</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/calender.css">


    <script src="assets/js/all.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <link href="assets/css/mobiscroll.javascript.min.css" rel="stylesheet" />
    <script src="assets/js/mobiscroll.javascript.min.js"></script>
    

    <style>
        .formstyle{
            display: flex;
            flex-direction: column;
            border: black solid thin;
            margin-left: 25%;
            margin-right: 25%;
            padding: 20px;
            margin-top: 2%;
            background-color: #87b0f3;
        }

        label{
            text-decoration: underline;
        }

        .mbsc-datepicker-control-calendar{
            margin-right: 10px;
        }

        .mbsc-datepicker-control-time{
            height: 350px;
        }

        input[type="checkbox"] {
            zoom: 1.6;
            vertical-align: text-top;
        }

        .checkboxname{
            text-decoration: none;
            font-size:20px;
        }
    </style>

</head>

<body>
        <?php include_once "logout.php" ?>
    <form action="addnewmedicine.php" method="post" class="formstyle" id="mainform" onsubmit="return fetchschedule()">
        <div class="mb-3">
            <h3 style="text-decoration: underline;"> Add New Medicine</h3>
        </div>
        <div class="mb-3">
            <label for="medname" class="form-label">Medicine Name</label>
            <input type="text" class="form-control" id="medname" name="medname">

        </div>
        <div class="mb-3">
            <label for="medtype" class="form-label">Medicine Type</label>
            <input type="text" class="form-control" id="medtype" name="medtype">
        </div>
        <div class="mb-3">
            <label for="dosage" class="form-label">Dosage</label>
            <input type="text" class="form-control" id="dosage" name="dosage">
        </div>
        <div class="mb-3">
            <label for="frequency" class="form-label"> Frequency</label>
            <!-- types: 1 time, multiple days, multiple times per day, specified days per week -->
            <select class="form-select" aria-label="Default select example" id="selectmenu" name="selecttype" onchange="calender(this)">
                <option selected>Choose Option</option>
                <option value="1">One Time</option> <!-- single choice -->
                <option value="2">Multiple Days(nonrepetitive)</option> <!-- multiple choice-->
                <option value="3">Certain Days Per Week</option> <!-- multiple choice-->
                <option value="4">Daily</option> <!-- multiple choice-->
            </select>
        </div>
        <div class="mb-3">
            <div class="mbsc-grid">
                <div class="mbsc-row">

                    <div>
                        <div class="mbsc-form-group">
                            <div class="mbsc-form-group-title" id="selecttitle">Select Dates</div>
                            <div style="display: flex;">
                            <input type="hidden" name = "dates" id="demo-counter"></input>
                            <!-- <span id="demo-counter"></span> -->
                            <input type="hidden" name = "times" id="time-counter"></input>
                            <!-- <span id="time-counter"></span> -->
                            <div id="checkboxchart" style="display:none; margin-top: 60px;">
                                
                                <ul type="none">
                                    <li>
                                        <input class="weekcheck" type="checkbox" id="Monday" name="Monday" value="Monday">
                                        <label class="checkboxname" for="Monday">Monday</label>
                                    </li>
                                    <li>
                                        <input class="weekcheck" type="checkbox" id="Tuesday" name="Tuesday" value="Tuesday">
                                        <label class="checkboxname" for="Tuesday">Tuesday</label>
                                    </li>
                                    <li>
                                        <input class="weekcheck" type="checkbox" id="Wednesday" name="Wednesday" value="Wednesday">
                                        <label class="checkboxname" for="Wednesday">Wednesday</label>
                                    </li>
                                    <li>
                                        <input class="weekcheck" type="checkbox" id="Thursday" name="Thursday" value="Thursday">
                                        <label class="checkboxname" for="Thursday">Thursday</label>
                                    </li>
                                    <li>
                                        <input class="weekcheck" type="checkbox" id="Friday" name="Friday" value="Friday">
                                        <label class="checkboxname" for="Friday">Friday</label>
                                    </li>
                                    <li>
                                        <input class="weekcheck" type="checkbox" id="Saturday" name="Saturday" value="Saturday">
                                        <label class="checkboxname" for="Saturday">Saturday</label>
                                    </li>
                                    <li>
                                        <input class="weekcheck" type="checkbox" id="Sunday" name="Sunday" value="Sunday">
                                        <label class="checkboxname" for="Sunday">Sunday</label>
                                    </li>
                                </ul>
                            </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="time" id="time555">
        <input type="hidden" name="weekdays" id="weekdays">
        

        <button type="submit" name="submit" class="btn btn-success">Submit</button>
    </form>

    <script>
    function calender(option) {
        var selected = option.value;

        mobiscroll.setOptions({
            theme: 'ios',
            themeVariant: 'light'
        });

        if (selected == "1") {
             

            mobiscroll.datepicker('#demo-counter', {
                controls: ['calendar'],
                display: 'inline',
                selectMultiple: false,
                selectCounter: true,
                min: Date.now(),
                max: '2050-01-01'
            });


        } else if(selected == "2"){



            mobiscroll.datepicker('#demo-counter', {
                controls: ['calendar'],
                display: 'inline',
                selectMultiple: true,
                selectCounter: true,
                min: new Date().toISOString().slice(0,10),
                max: '2050-01-01'
            });
        }
        else if(selected == "3"){
            document.getElementById("checkboxchart").style.display = "inline";
            document.getElementById("selecttitle").innerText = "Select Time and Days of Week";
            document.getElementById("mainform").setAttribute("onsubmit","return verifyweekdays()")
        }
        
        mobiscroll.datepicker('#time-counter', {
                controls: ['time'],
                display: 'inline',
                selectMultiple: false,
                timeFormat: 'HH:MM'
            });
    }

    function fetchschedule(){
        // var monthT = {
        //      "January": "01", "February": "02", "March": "03", "April": "04", "May": "05", "June": "06", "July": "07", "August": "08", "September": "09", "October": "10", "November": "11", "December": "12"
        //  }
        // var selected = document.getElementById("selectmenu").value;
        // if(selected == "1"){
            
        //  var day = document.getElementsByClassName('mbsc-selected')[0].innerText;
        //  var month = monthT[document.getElementsByClassName('mbsc-calendar-month')[0].innerText];
        //  var year = document.getElementsByClassName('mbsc-calendar-year')[0].innerText;
        //  var hour = document.getElementsByClassName('mbsc-selected')[1].innerText;
        //  var minute = document.getElementsByClassName('mbsc-selected')[2].innerText;
        
        //  var date = year+"-"+month+"-"+day+"T"+hour+":"+minute;
         
        //  date = date.replace(/TRIAL\n/g, '');
        //  console.log(date);
        //  document.getElementById('date555').value=date;
        // }
        // else if(selected == "2"){
        //     // loop over mbsc selected except last 2(times), in each loop get date time and year and store into dates array.
        //     // store date format into dates array.
        //     var label = document.getElementsByClassName("mbsc-selected")[0].ariaLabel // (Monday, November 15)

        //     var month = label.substring(label.indexOf(" ")+1, label.lastIndexOf(" "))
        // }
         
         

         var temp = document.getElementsByClassName("mbsc-selected"); // array
         var hour = temp[temp.length - 2].innerText;
         var minute = temp[temp.length - 1].innerText;
         var time = hour+":"+minute;
         time = time.replace(/TRIAL\n/g, '');
         console.log(time);
         

         var dates = document.getElementById("demo-counter").value.split(", ");
         var schedules = "";
         for(var i = 0; i < dates.length; i++){
             var currdate = dates[i]; // m/d/y
             var elements = currdate.split("/");
             var date = elements[2]+"-"+elements[0]+"-"+elements[1]+"T"+time; // y/m/d
             schedules = schedules + date+" ";
         }   

         console.log(schedules);
         document.getElementById('time555').value=schedules;



         


        
        return true;
    }

    function verifyweekdays(){
        var temp = document.getElementsByClassName("mbsc-selected"); // array
         var hour = temp[temp.length - 2].innerText;
         var minute = temp[temp.length - 1].innerText;
         var time = hour+":"+minute;
         time = time.replace(/TRIAL\n/g, '');
         console.log(time);

         document.getElementById('time555').value=time;

        var weekdays = "";

            var checkboxes = document.getElementsByClassName("weekcheck");
                for (var checkbox of checkboxes){
                    if (checkbox.checked) {
                        weekdays = weekdays + checkbox.value + " ";
                    }
                }
                document.getElementById("weekdays").value = weekdays;
                console.log(weekdays);

                return true;
    }
    </script>

</body>

</html>