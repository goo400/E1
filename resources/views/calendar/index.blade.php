<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Full Calendar js</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/locale/fr.js"></script>




  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>

<style>
    .weekDays-selector input {
  display: none!important;
}

.weekDays-selector input[type=checkbox] + label {
  display: inline-block;
  border-radius: 6px;
  background: #dddddd;
  height: 40px;
  width: 30px;
  margin-right: 3px;
  line-height: 40px;
  text-align: center;
  cursor: pointer;
}

.weekDays-selector input[type=checkbox]:checked + label {
  background: #2AD705;
  color: #ffffff;
}
</style>

<style>
    #external-events {
  position: fixed;
  z-index: 2;
  top: 20px;
  left: 20px;
  width: 150px;
  padding: 0 10px;
  border: 1px solid #ccc;
  background: #eee;
}

#external-events .fc-event {
  margin: 1em 0;
  cursor: move;
}
</style>

<!-- Modal popup updateoptionreseizingorchangingplace -->
<div class="modal fade" id="optionupdateoccurence2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Op</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       choisir ce que vous voulez
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="editseanceoccurence2">edit serie</button>
        <button type="button" class="btn btn-danger" id="editseanceappointment2">edit apointement</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal popup updateoptionreseizingorchangingplace -->

<!-- Modal popup updateoption -->
<div class="modal fade" id="optionupdateoccurence" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Op</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       choisir ce que vous voulez
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="editseanceoccurence">edit serie</button>
        <button type="button" class="btn btn-danger" id="editseanceappointment">edit apointement</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal popup update option -->



<!-- Modal popup deletereccurence -->
<div class="modal fade" id="exampleModaloperationdeletereccurence" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Op</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       vous voulez supprimer les seance future
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="editseance22">Non</button>
        <button type="button" class="btn btn-danger" id="deleteseance22">Oui</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal popup click on event -->

<!-- Modalpop up edit -->

<div class="modal fade" id="exampleModaloperation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Op</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       Opération
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="editseance">Edit</button>
        <button type="button" class="btn btn-danger" id="deleteseance">Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- Modalpop up edit -->





<div id='external-events'>
  <p>
    <strong>Draggable Events</strong>
  </p>
  <div class='fc-event' style='background-color:red'>My Event 1</div>
  <div class='fc-event' style='background-color:green'>My Event 2</div>
  <div class='fc-event' style='background-color:blue'>My Event 3</div>
  <div class='fc-event' style='background-color:purple'>My Event 4</div>
  <div class='fc-event' style='background-color:gray'>My Event 5</div>
  <p>
    <input type='checkbox' id='drop-remove' />
    <label for='drop-remove'>remove after drop</label>
  </p>
</div>




  <!-- Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Séance</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
        <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Start time</label>
            <input type="datetime-local" class="form-control" id="start_time">  
          </div>

          <div class="mb-3">
          <label for="birthdaytime">End time</label>
          <input type="datetime-local" class="form-control" id="end_time">           
          </div>

          <div class="mb-3">
            <label for="message-text" class="col-form-label">Description:</label>
            <textarea class="form-control" id="title"></textarea>
            <span id="titleError" class="text-danger"></span>
          </div>

<div class="form-group">
    <label for="exampleFormControlSelect1">Frequency</label>
    <select class="form-control" id="exampleFormControlSelect1">
      <option id="noreccurence" value="noreccurence" selected >Noreccurence</option>
      <option id="daily" value="daily">daily</option>
      <option id="weekly" value="weekly">weekly</option>
      <option id="montly" value="monthly">monthly</option>
    </select>
</div>

<div class="mb-3" style="display:none" id="everymuchday">
          <label for="birthdaytime">repeat every</label>
          <input type="number" class="form-control" id="everytime">           
</div>

<div class="mb-3" style="display:none" id="monthday">
          <label for="repeateveryweek">on day(month)</label>
          <input type="number" class="form-control" id="dayselectionofmonth">           
</div>


<div class="weekDays-selector" style="display:none" id="daysofweeks">
  <input type="checkbox" id="weekday-0" class="weekday" value='0' />
  <label for="weekday-mon">L</label>
  <input type="checkbox" id="weekday-1" class="weekday" value='1'  />
  <label for="weekday-tue">M</label>
  <input type="checkbox" id="weekday-2" class="weekday" value='2' />
  <label for="weekday-wed">M</label>
  <input type="checkbox" id="weekday-3" class="weekday" value='3' />
  <label for="weekday-thu">J</label>
  <input type="checkbox" id="weekday-4" class="weekday" value='4'  />
  <label for="weekday-fri">V</label>
  <input type="checkbox" id="weekday-5" class="weekday" value='5' />
  <label for="weekday-sat">S</label>
  <input type="checkbox" id="weekday-6" class="weekday" value='6' />
  <label for="weekday-sun">D</label>
</div>



<div class="mb-3" id="boxreccurence" style="display:none" >
<div class="mb-3">
        <label for="birthdaytime">repeat end</label>
        <select class="form-control" id="exampleFormControlSelect2">
        <option id="noenddate" value="noenddate">no end date</option>
      <option id="endafter"value="Endafter(occurences)" >Endafter(occurences)</option>
      <option id="endby" value="endby">endby</option>
    </select>          
</div>

<div class="mb-3" style="display:none" id="endafterdate" >
<input type="date" class="form-control" id="inputendafterdate">           
</div>

<div class="mb-3" style="display:none" id="endbyreccurence">
<input type="number" class="form-control" id="inputendbyreccurence">           
</div>

</div>

        <div class="mb-3">
            <label for="exampleColorInput" class="form-label">Color picker</label>
            <input type="color" class="form-control form-control-color" id="exampleColorInput" value="#563d7c" title="Choose your color">
        </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="closeBtn" data-bs-dismiss="modal">Close</button>
        <button type="button" id="saveBtn" class="btn btn-primary">Send message</button>
        <button type="button" id="enregistermodificationbtn" class="btn btn-success">enregistrer</button>
      </div>
    </div>
  </div>
</div>


    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="text-center mt-5">FullCalendar js Laravel series with Career Development Lab</h3>
                <div class="col-md-11 offset-1 mt-5 mb-5">

                    <div id="calendar">

                    </div>

                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  
    <script src=""></script>
  
  <script>

$(document).ready(function() {



///////////////////////////////////////////////

    $('#noreccurence').click(function(){
        $('#everymuchday').hide();
        $("#boxreccurence").hide();
        $('#daysofweeks').hide();
        $('#monthday').hide();
    })

    $("#daily").click(function() {
            $('#everymuchday').show();
            $("#boxreccurence").show();
            $('#daysofweeks').hide();
            $('#monthday').hide();
            // $('#everytime').val('1');
        });


    $("#weekly").click(function(){
        $('#everymuchday').show();
        $('#daysofweeks').show();
        $('#boxreccurence').show();
        $('#monthday').hide();
    });

    $('#montly').click(function(){
        $('#everymuchday').show();
        $('#monthday').show();
        $('#boxreccurence').show();
        $('#daysofweeks').hide();
    })

////////////////////////////////////////////////////

    $("#endafter").click(function() {
    $('#endafterdate').hide();
    $('#endbyreccurence').show();
    $('#inputendafterdate').val('');
  
});

$("#endby").click(function() {
    $('#endbyreccurence').hide();
    $('#endafterdate').show();
    $("#inputendbyreccurence").val('');

});

$("#noenddate").click(function() {
    $('#endafterdate').hide();
    $('#endbyreccurence').hide();
    $("#inputendbyreccurence").val('');
    $('#inputendafterdate').val('');

});



//////////////////////////////////





$("#closeBtn").click(function() {
            $('#title').val("");
            });


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$('#external-events .fc-event').each(function() {

$(this).data('event', {
  title: $.trim($(this).text()), 
  color: $.trim($(this).css('background-color')), // Utilisez la méthode css() pour obtenir la couleur de fond
  stick: true
});


$(this).draggable({
  zIndex: 999,
  revert: true,    
  revertDuration: 0  

});





var booking = @json($events);

$('#calendar').fullCalendar({
    header: {
        left: 'prev, next today',
        center: 'title',
        right: 'month,agendaWeek, agendaDay',
    },
    defaultView : 'agendaWeek',
    lang: 'fr',
    events: booking,
    droppable: true,
    eventReceive:function(info){

var title = info.title;
var color =info.color;
var start =   info.start.format();
var end   =  info.end.format();

$.ajax({
                url:"{{ route('calendar.store') }}",
                type:"POST",
                dataType:'json',
                data:{ title,start, end, color },
                success:function(response)
                {
                    $('#title').val("");
                    location.reload();
                },
                error:function(error)
                {
                    if(error.responseJSON.errors) {
                        $('#titleError').html(error.responseJSON.errors.title);
                    }
                },
            });

    },

    drop: function() {
      if ($('#drop-remove').is(':checked')) {
        $(this).remove();
      }
    },
    buttonIcons: false,
    editable: true,
    selectable: true,
    forceEventDuration: true,
    selectHelper: true,
    select: function(start,end) {

        $('#bookingModal').modal('toggle');

        $("#enregistermodificationbtn").css("display", "none");
        $("#saveBtn").css("display", "block");


        if(! start.format().includes("T")){
            var start2 = start.format() +"T00:00:00";
            var end2 = end.subtract(1,'days').format() +"T00:00:00";
            console.log(start);
            console.log(end2);
            $('#start_time').val(start2);
            $('#end_time').val(end2);
        }else{
            $('#start_time').val(start.toISOString());
            $('#end_time').val(end.toISOString());
        }

        $('#saveBtn').click(function() {
            var title = $('#title').val();
            var color = $('#exampleColorInput').val();
            var start =   $('#start_time').val();
            var end   =   $('#end_time').val();


            var Frequency = $('#exampleFormControlSelect1').val();
            var repeateveryday = $('#everytime').val();
            var repeatend = $('#exampleFormControlSelect2').val();
            var inputendafterdate = $('#inputendafterdate').val();
            var numberoccurence = $('#inputendbyreccurence').val();

            ///week
            var daysofweek = [];

            $('.weekday').each(function() {
                if ($(this).is(':checked')) {
                var checkboxValue = $(this).val();
                daysofweek.push(checkboxValue);
            }
            });

            ///month
            var daynumberofmonth = $('#dayselectionofmonth').val();


////////////////////////////////

  
if(Frequency=="daily" && repeatend=="endby"){
                $.ajax({
                url:"{{ route('calendar.store2') }}",
                type:"POST",
                dataType:'json',
                data:{ title,start, end, color ,Frequency,repeateveryday,repeatend,inputendafterdate },
                success:function(response)
                {
                    $('#bookingModal').modal('hide');
                    $('#title').val("");
                    location.reload();
                },
                error:function(error)
                {
                    if(error.responseJSON.errors) {
                        $('#titleError').html(error.responseJSON.errors.title);
                    }
                },
            });
        }
        else if(Frequency=="daily" && repeatend=="Endafter(occurences)"){
            console.log(title,start, end, color ,Frequency,repeateveryday,repeatend,numberoccurence);
            $.ajax({
                url:"{{ route('calendar.store3') }}",
                type:"POST",
                dataType:'json',
            
                data:{  title,start, end, color ,Frequency,repeateveryday,repeatend,numberoccurence },
                success:function(response)
                {
                    $('#bookingModal').modal('hide');
                    $('#title').val("");
                    location.reload();
                },
                error:function(error)
                {
                    if(error.responseJSON.errors) {
                        $('#titleError').html(error.responseJSON.errors.title);
                    }
                },
            });
        }
        else if(Frequency=="weekly" && repeatend=="endby"){
            $.ajax({
                url:"{{ route('calendar.store4') }}",
                type:"POST",
                dataType:'json',
                data:{ title,start, end, color ,Frequency,repeateveryday,repeatend ,inputendafterdate,daysofweek },
                success:function(response)
                {
                console.log(reponse);
                    $('#bookingModal').modal('hide');
                    $('#title').val("");
                    location.reload();
                },
                error:function(error)
                {
                    if(error.responseJSON.errors) {
                        $('#titleError').html(error.responseJSON.errors.title);
                    }
                },
            });
        }
        
        else if(Frequency=="weekly" && repeatend=="Endafter(occurences)"){
            $.ajax({
                url:"{{ route('calendar.store5') }}",
                type:"POST",
                dataType:'json',
                data:{  title,start, end, color ,Frequency,repeateveryday,repeatend ,numberoccurence ,daysofweek  },
                success:function(response)
                {
                    $('#bookingModal').modal('hide');
                    $('#title').val("");
                    location.reload();
                },
                error:function(error)
                {
                    if(error.responseJSON.errors) {
                        $('#titleError').html(error.responseJSON.errors.title);
                    }
                },
            });

        }
        ///montly
        else if(Frequency=="monthly" && repeatend=="endby"){
            $.ajax({
                url:"{{ route('calendar.storemontlyendbydate') }}",
                type:"POST",
                dataType:'json',
                data:{ title,start, end, color ,Frequency ,repeateveryday,repeatend ,inputendafterdate ,daynumberofmonth },
                success:function(response)
                {
                    $('#bookingModal').modal('hide');
                    $('#title').val("");
                    location.reload();
                },
                error:function(error)
                {
                    if(error.responseJSON.errors) {
                        $('#titleError').html(error.responseJSON.errors.title);
                    }
                },
            });

        } else if(Frequency=="monthly" && repeatend=="Endafter(occurences)"){
            $.ajax({
                url:"{{ route('calendar.storemontlyendbyoccurence') }}",
                type:"POST",
                dataType:'json',
                data:{ title,start, end, color ,Frequency ,repeateveryday,repeatend ,numberoccurence ,daynumberofmonth  },
                success:function(response)
                {
                    $('#bookingModal').modal('hide');
                    $('#title').val("");
                    location.reload();
                },
                error:function(error)
                {
                    if(error.responseJSON.errors) {
                        $('#titleError').html(error.responseJSON.errors.title);
                    }
                },
            });

        }
        else{
            $.ajax({
                url:"{{ route('calendar.store') }}",
                type:"POST",
                dataType:'json',
                data:{ title,start, end, color , Frequency },
                success:function(response)
                {
                    $('#bookingModal').modal('hide');
                    
                    $('#title').val("");
                    
                    $('#calendar').fullCalendar('renderEvent', {
                        'id': response.id,
                        'title': response.title,
                        'start' : response.start,
                        'end'  : response.end,
                        'color' : response.color,
                        'Frequency':response.Frequency
                    });
                },
                error:function(error)
                {
                    if(error.responseJSON.errors) {
                        $('#titleError').html(error.responseJSON.errors.title);
                    }
                },
            });
        }
          
        });
    },
    eventStartEditable:true,


    eventResize: function(event) {
        var id = event.id;
        var start_date = event.start.format();
        var end_date =   event.end.format();

        $("#optionupdateoccurence").modal('show');
        
        $.ajax({
                url:"{{ route('calendar.update', '') }}" +'/'+ id,
                type:"PATCH",
                dataType:'json',
                data:{start_date , end_date  },
                success:function(response)
                {

                    swal("Good job!", "Event Updated!", "success");
                },
                error:function(error)
                {
                    console.log(error)
                },
            });
    },

    eventDrop: function(event) {
        var id = event.id;
        var start_date = event.start.format();
        var end_date =   event.end.format();
        
        $("#optionupdateoccurence").modal('show');

        $.ajax({
                url:"{{ route('calendar.update', '') }}" +'/'+ id,
                type:"PATCH",
                dataType:'json',
                data:{start_date , end_date  },
                success:function(response)
                {
                    swal("Good job!", "Event Updated!", "success");
                },
                error:function(error)
                {
                    console.log(error)
                },
            });
    },
    eventClick: function(event){
        var numreccurence = event.NumReccurence;
        var id = event.id;
        var title = event.title;
        var startdatetime = event.start;
        var enddatetime = event.end;
        var color = event.color;
        var Frequency = event.Frequency;
        var repeateverynumber = event.repeateverynumber;
        var repeatend = event.repeatend;
        var repeatendoccurence = event.repeatendoccurence;
        var weekdaysstring = event.weekdaysstring;
        var repeatenddate = event.repeatenddate;
        var dayofmonth = event.dayofmonth;
        var NumReccurence = event.NumReccurence;


        $("#exampleModaloperation").modal('show');
        $("#deleteseance").click(function(){
            if(numreccurence != null){
                $("#exampleModaloperation").modal('hide');
                $("#exampleModaloperationdeletereccurence").modal("toggle");
            }
        });

        $("#editseance").click(function(){

            $("#exampleModaloperation").modal('hide');
            $("#bookingModal").modal("show");


               ///assign value to field:
            $("#start_time").val(startdatetime.format("YYYY-MM-DD HH:mm"));
            $("#end_time").val(enddatetime.format("YYYY-MM-DD HH:mm"));
            $("#title").val(title);

           if(Frequency == "daily" || Frequency == "weekly" || Frequency == "monthly" ){
            $("#exampleFormControlSelect1").val(Frequency);
            $("#everymuchday").css("display", "block");
            $("#everytime").val(repeateverynumber);
            $("#boxreccurence").css("display","block");

          


           if(repeatend == "Endafter(occurences)"){
            $("#exampleFormControlSelect2").val(repeatend);
            $("#endbyreccurence").css("display","block");
           }

           if(repeatend == "endby"){

            $("#exampleFormControlSelect2").val(repeatend);
            $("#endafterdate").css("display","block");

           }

           if(Frequency == "weekly"){

            $("#daysofweeks").css("display","block");

            var weekdaysArray = weekdaysstring.split(',');

            weekdaysArray.forEach(function(weekdayValue) {

            var checkboxId = "weekday-" + weekdayValue;

            $("#" + checkboxId).prop("checked", true);
            });
            
           }

           
           if(Frequency == "monthly"){
            $("#monthday").css("display","block");
          }

          $("#dayselectionofmonth").val(dayofmonth);

           }

//fin


            $("#enregistermodificationbtn").css("display", "block");
            $("#saveBtn").css("display", "none");
        });


        



        $("#enregistermodificationbtn").click(function(){
            $("#bookingModal").modal("hide");
            $("#saveBtn").css("display", "block");
            $("#optionupdateoccurence").modal("show");

            if(Frequency == "daily"){

              var id_old= id;
              var title_old = title;
              var startdate_old = startdatetime;
              var enddate_old = enddatetime;
              var color_old = color;
              var Frequency_old = Frequency;


              var repeateverynumber_old = repeateverynumber;
              var repeatend_old = repeatend;
              var repeatendoccurence_old = repeatendoccurence;
              var repeatenddate_old = repeatenddate;
              var NumReccurence = NumReccurence;

             

                $("#editseanceoccurence2").click(function(){

                //appliquer les changeemtns sur toutes les events:

                // var currentdatetime = new Date();
                var Numreccurence = NumReccurence;

                $.ajax({
                url:"{{ route('calendar.destroyallfutureevents', '') }}" +'/'+Numreccurence ,
                type:"DELETE",
                dataType:'json',
                success:function(response)
                {
                    $('#calendar').fullCalendar('removeEvents', response);
                    // swal("Good job!", "Event Deleted!", "success");
                },
                error:function(error)
                {
                    console.log(error)
                },
                });
                });
            

              $("#editseanceappointment2").click(function(){

              });

            }
            
            else if(Frequency == "weekly"){

              $("#editseanceoccurence2").click(function(){

            });

            $("#editseanceappointment2").click(function(){

            });
            } 


            
            else if(Frequency == "monthly"){
            $("#editseanceappointment2").click(function(){
               
            //create another one but not occurence with else as store normale:
              if(Frequency=="daily" && repeatend=="endby"){
                $.ajax({
                url:"{{ route('calendar.store2') }}",
                type:"POST",
                dataType:'json',
                data:{ title,start_date, end_date, color ,Frequency,repeateveryday,repeatend,inputendafterdate },
                success:function(response)
                {
                    $('#bookingModal').modal('hide');
                    $('#title').val("");
                    location.reload();
                },
                error:function(error)
                {
                    if(error.responseJSON.errors) {
                        $('#titleError').html(error.responseJSON.errors.title);
                    }
                },
            });
        }
        else if(Frequency=="daily" && repeatend=="Endafter(occurences)"){
            $.ajax({
                url:"{{ route('calendar.store3') }}",
                type:"POST",
                dataType:'json',
            
                data:{  title,start_date, end_date, color ,Frequency,repeateveryday,repeatend,numberoccurence },
                success:function(response)
                {
                    $('#bookingModal').modal('hide');
                    $('#title').val("");
                    location.reload();
                },
                error:function(error)
                {
                    if(error.responseJSON.errors) {
                        $('#titleError').html(error.responseJSON.errors.title);
                    }
                },
            });
        }
        else if(Frequency=="weekly" && repeatend=="endby"){
            $.ajax({
                url:"{{ route('calendar.store4') }}",
                type:"POST",
                dataType:'json',
                data:{ title,start_date, end_date, color ,Frequency,repeateveryday,repeatend ,inputendafterdate,daysofweek },
                success:function(response)
                {
                console.log(reponse);
                    $('#bookingModal').modal('hide');
                    $('#title').val("");
                    location.reload();
                },
                error:function(error)
                {
                    if(error.responseJSON.errors) {
                        $('#titleError').html(error.responseJSON.errors.title);
                    }
                },
            });
        }
        
        else if(Frequency=="weekly" && repeatend=="Endafter(occurences)"){
            $.ajax({
                url:"{{ route('calendar.store5') }}",
                type:"POST",
                dataType:'json',
                data:{  title,start_date, end_date, color ,Frequency,repeateveryday,repeatend ,numberoccurence ,daysofweek  },
                success:function(response)
                {
                    $('#bookingModal').modal('hide');
                    $('#title').val("");
                    location.reload();
                },
                error:function(error)
                {
                    if(error.responseJSON.errors) {
                        $('#titleError').html(error.responseJSON.errors.title);
                    }
                },
            });

        }
      
        else if(Frequency=="monthly" && repeatend=="endby"){
            $.ajax({
                url:"{{ route('calendar.storemontlyendbydate') }}",
                type:"POST",
                dataType:'json',
                data:{ title,start_date, end_date, color ,Frequency ,repeateveryday,repeatend ,inputendafterdate ,daynumberofmonth },
                success:function(response)
                {
                    $('#bookingModal').modal('hide');
                    $('#title').val("");
                    location.reload();
                },
                error:function(error)
                {
                    if(error.responseJSON.errors) {
                        $('#titleError').html(error.responseJSON.errors.title);
                    }
                },
            });

        } 
        
        else if(Frequency=="monthly" && repeatend=="Endafter(occurences)"){
            $.ajax({
                url:"{{ route('calendar.storemontlyendbyoccurence') }}",
                type:"POST",
                dataType:'json',
                data:{ title,start_date, end_date, color ,Frequency ,repeateveryday,repeatend ,numberoccurence ,daynumberofmonth  },
                success:function(response)
                {
                    $('#bookingModal').modal('hide');
                    $('#title').val("");
                    location.reload();
                },
                error:function(error)
                {
                    if(error.responseJSON.errors) {
                        $('#titleError').html(error.responseJSON.errors.title);
                    }
                },
            });

        }
        else{

          $.ajax({
                url:"{{ route('calendar.store') }}",
                type:"POST",
                dataType:'json',
                data:{ title,start_date, end_date, color , Frequency },
                success:function(response)
                {
                    $('#bookingModal').modal('hide');
                    
                    $('#title').val("");
                    
                    $('#calendar').fullCalendar('renderEvent', {
                        'id': response.id,
                        'title': response.title,
                        'start' : response.start,
                        'end'  : response.end,
                        'color' : response.color,
                        'Frequency':response.Frequency
                    });
                },
                error:function(error)
                {
                    if(error.responseJSON.errors) {
                        $('#titleError').html(error.responseJSON.errors.title);
                    }
                },
            });

        }



            });
            }


            else
            {
              var id_old= id;
              var title_old = title;
              var startdate_old = startdatetime;
              var enddate_old = enddatetime;
              var color_old = color;
              var Frequency_old = Frequency;

            var title = $('#title').val();
            var color = $('#exampleColorInput').val();
            var start_date =   $('#start_time').val();
            var end_date   =   $('#end_time').val();


            var Frequency = $('#exampleFormControlSelect1').val();
            var repeateveryday = $('#everytime').val();
            var repeatend = $('#exampleFormControlSelect2').val();
            var inputendafterdate = $('#inputendafterdate').val();
            var numberoccurence = $('#inputendbyreccurence').val();

            ///week
            var daysofweek = [];

            $('.weekday').each(function() {
                if ($(this).is(':checked')) {
                var checkboxValue = $(this).val();
                daysofweek.push(checkboxValue);
            }
            });

            ///month
            var daynumberofmonth = $('#dayselectionofmonth').val();

            // console.log(start);
              

      if($("#exampleFormControlSelect1").val()=="noreccurence"){
                $.ajax({
                url:"{{ route('calendar.update', '') }}" +'/'+ id_old,
                type:"PATCH",
                dataType:'json',
                data:{start_date , end_date,title,color},
                success:function(response)
                {
                    swal("Good job!", "Event Updated!", "success");
                },
                error:function(error)
                {
                    console.log(error)
                },
            });


              }
              else {

                //supprimer seance
                $.ajax({
                url:"{{ route('calendar.destroy', '') }}" +'/'+ id_old,
                type:"DELETE",
                dataType:'json',
                success:function(response)
                {
                    $('#calendar').fullCalendar('removeEvents', response);
                    // swal("Good job!", "Event Deleted!", "success");
                },
                error:function(error)
                {
                    console.log(error)
                },
            });


            //apres on fait la creation du reccurence:

            if(Frequency=="daily" && repeatend=="endby"){
                $.ajax({
                url:"{{ route('calendar.store2') }}",
                type:"POST",
                dataType:'json',
                data:{ title,start_date, end_date, color ,Frequency,repeateveryday,repeatend,inputendafterdate },
                success:function(response)
                {
                    $('#bookingModal').modal('hide');
                    $('#title').val("");
                    location.reload();
                },
                error:function(error)
                {
                    if(error.responseJSON.errors) {
                        $('#titleError').html(error.responseJSON.errors.title);
                    }
                },
            });
        }
        else if(Frequency=="daily" && repeatend=="Endafter(occurences)"){
            $.ajax({
                url:"{{ route('calendar.store3') }}",
                type:"POST",
                dataType:'json',
            
                data:{  title,start_date, end_date, color ,Frequency,repeateveryday,repeatend,numberoccurence },
                success:function(response)
                {
                    $('#bookingModal').modal('hide');
                    $('#title').val("");
                    location.reload();
                },
                error:function(error)
                {
                    if(error.responseJSON.errors) {
                        $('#titleError').html(error.responseJSON.errors.title);
                    }
                },
            });
        }
        else if(Frequency=="weekly" && repeatend=="endby"){
            $.ajax({
                url:"{{ route('calendar.store4') }}",
                type:"POST",
                dataType:'json',
                data:{ title,start_date, end_date, color ,Frequency,repeateveryday,repeatend ,inputendafterdate,daysofweek },
                success:function(response)
                {
                console.log(reponse);
                    $('#bookingModal').modal('hide');
                    $('#title').val("");
                    location.reload();
                },
                error:function(error)
                {
                    if(error.responseJSON.errors) {
                        $('#titleError').html(error.responseJSON.errors.title);
                    }
                },
            });
        }
        
        else if(Frequency=="weekly" && repeatend=="Endafter(occurences)"){
            $.ajax({
                url:"{{ route('calendar.store5') }}",
                type:"POST",
                dataType:'json',
                data:{  title,start_date, end_date, color ,Frequency,repeateveryday,repeatend ,numberoccurence ,daysofweek  },
                success:function(response)
                {
                    $('#bookingModal').modal('hide');
                    $('#title').val("");
                    location.reload();
                },
                error:function(error)
                {
                    if(error.responseJSON.errors) {
                        $('#titleError').html(error.responseJSON.errors.title);
                    }
                },
            });

        }
        ///montly
        else if(Frequency=="monthly" && repeatend=="endby"){
            $.ajax({
                url:"{{ route('calendar.storemontlyendbydate') }}",
                type:"POST",
                dataType:'json',
                data:{ title,start_date, end_date, color ,Frequency ,repeateveryday,repeatend ,inputendafterdate ,daynumberofmonth },
                success:function(response)
                {
                    $('#bookingModal').modal('hide');
                    $('#title').val("");
                    location.reload();
                },
                error:function(error)
                {
                    if(error.responseJSON.errors) {
                        $('#titleError').html(error.responseJSON.errors.title);
                    }
                },
            });

        } 
        
        else if(Frequency=="monthly" && repeatend=="Endafter(occurences)"){
            $.ajax({
                url:"{{ route('calendar.storemontlyendbyoccurence') }}",
                type:"POST",
                dataType:'json',
                data:{ title,start_date, end_date, color ,Frequency ,repeateveryday,repeatend ,numberoccurence ,daynumberofmonth  },
                success:function(response)
                {
                    $('#bookingModal').modal('hide');
                    $('#title').val("");
                    location.reload();
                },
                error:function(error)
                {
                    if(error.responseJSON.errors) {
                        $('#titleError').html(error.responseJSON.errors.title);
                    }
                },
            });

        }

             
              }

            }
        });



        
        // console.log(numreccurence);
        // console.log(id);
        // if(confirm('Are you sure want to remove it')){
        //     $.ajax({
        //         url:"{{ route('calendar.destroy', '') }}" +'/'+ id,
        //         type:"DELETE",
        //         dataType:'json',
        //         success:function(response)
        //         {
        //             $('#calendar').fullCalendar('removeEvents', response);
        //             // swal("Good job!", "Event Deleted!", "success");
        //         },
        //         error:function(error)
        //         {
        //             console.log(error)
        //         },
        //     });
        // }

    },
    selectAllow: function(event)
    {
        return moment(event.start).utcOffset(false).isSame(moment(event.end).subtract(1, 'second').utcOffset(false), 'day');
    },



});


$("#bookingModal").on("hidden.bs.modal", function () {
    $('#saveBtn').unbind();
});

// $('.fc-event').css('font-size', '13px');
// $('.fc-event').css('width', '20px');
// $('.fc-event').css('border-radius', '50%');
});
});
   

    </script>
</body>
</html>