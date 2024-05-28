<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

use Datetime;
use DateInterval;
use Http;

use Carbon\Carbon;

use Illuminate\Support\Str;



class CalendarController extends Controller
{

     // daily with enddate
     public function calculateOccurrencesDate($startDate, $endDate, $repeatEvery, $repeatEnd) {
        $occurrences = [];
        $currentDate = clone $startDate;
    
        // Add one day to repeatEnd to include the last repeat day
        $repeatEndPlusOneDay = clone $repeatEnd;
        $repeatEndPlusOneDay->modify('+1 day');
    
        while ($currentDate <= $repeatEndPlusOneDay) {
            // Format the start and end dates
            $startFormatted = $currentDate->format('Y-m-d H:i:s');
            $endFormatted = $endDate->format('Y-m-d H:i:s');
    
            // Add the formatted date to occurrences array
            $occurrences[] = ['start' => $startFormatted, 'end' => $endFormatted];
    
            // Move to the next occurrence
            $currentDate->modify("+$repeatEvery days");
            $endDate->modify("+$repeatEvery days");
        }
    
        return $occurrences;
    }





    //daily with occurence number
    public function calculateOccurrences($startDate, $endDate, $repeatEvery, $occurrenceCount) {
        $occurrences = array();
        $currentStartDate = clone $startDate; // Clone the start date
        $currentEndDate = clone $endDate; // Clone the end date
    
        for ($i = 0; $i < $occurrenceCount; $i++) {
            // Print the start event and current end event
            // echo $currentStartDate->format('m/d/Y H:i') . " ";
            // echo $currentEndDate->format('m/d/Y H:i') . "\n";
    
            // Add the occurrence to the array
            $occurrences[] = array(
                'start' => $currentStartDate->format('Y-m-d H:i:s'),
                'end' => $currentEndDate->format('Y-m-d H:i:s')
            );
    
            // Move to the next occurrence
            $currentStartDate->modify("+$repeatEvery days");
            $currentEndDate->modify("+$repeatEvery days");
        }
    
        return $occurrences;
    }
    

    public function index()
    {
        $events = array();
        $bookings = Booking::all();
        foreach($bookings as $booking) {

            $events[] = [
                'id'   => $booking->id,
                'title' => $booking->title,
                'start' => $booking->start_date,
                'end' => $booking->end_date,
                'color' => $booking->color,
                'NumReccurence' => $booking->NumReccurence,
                'Frequency'=> $booking->Frequency,
                'repeateverynumber'=> $booking->repeateverynumber,
                'repeatend'=> $booking->repeatend,
                'repeatendoccurence' => $booking->repeatendoccurence,
                'weekdaysstring'=> $booking->weekdaysstring,
                'repeatenddate'=> $booking->repeatenddate,
                'dayofmonth'=> $booking->dayofmonth,



            ];
        }
        return view('calendar.index', ['events' => $events]);
    }



public function storemontlyendbyoccurence(Request $request){ 
    $startDate = $request->start;//date
    $endDate = $request->end;//date
    $specificday = $request->daynumberofmonth;
    $repeatEvery = $request->repeateveryday;
    $occurencenum = $request->numberoccurence;

    $occurrences = Http::get('http://127.0.0.1:5000/getoccurenceobjectmonthbyoccurencenumber/' . $startDate . '/' . $endDate . '/' .  $specificday. '/' .  $repeatEvery.'/' . $occurencenum);

    $occurrences_array = json_decode($occurrences);

    // return  $occurrences_array;

    $randomNumber = rand(1,100000);
         
 
     
 
    $found = false;
    
    while (!$found) {
        $exists = Booking::where('NumReccurence', $randomNumber)->exists();    

        if ($exists) {

            $randomNumber++;

        } else {
    //make your code
    $found = true; 

    $bookings = [];
    foreach ($occurrences_array as $occurrence) {
        $booking = Booking::create([
            'title' => $request->title,
            'start_date' => new DateTime($occurrence[0]),
            'end_date' => new DateTime($occurrence[1]),
            'color' => $request->color,
            'Frequency'  => $request->Frequency,
            'repeateverynumber'  => $request->repeateveryday,
            'repeatend' => $request->repeatend,
            'repeatendoccurence'=> $request->numberoccurence,
            'dayofmonth' => $request->daynumberofmonth,
            'NumReccurence' => $randomNumber,
        ]);
    
    }
        $bookings[] = $booking;
}
    }

    return response()->json($bookings);


}

    public function storemontlyendbydate(Request $request){

        $startDate = $request->start;//date
        $endDate = $request->end;//date
        $specificday = $request->daynumberofmonth;
        $repeatEvery = $request->repeateveryday;
        $endreccurence = $request->inputendafterdate;//date


        $occurrences = Http::get('http://127.0.0.1:5000/getoccurenceobjectmonthbyenddate/' . $startDate . '/' . $endDate . '/' .  $specificday. '/' .  $repeatEvery.'/' . $endreccurence);

        $occurrences_array = json_decode($occurrences);

        // return  $occurrences_array;

        $randomNumber = rand(1,100000);
         
        $found = false;
        
        while (!$found) {
            $exists = Booking::where('NumReccurence', $randomNumber)->exists();    

            if ($exists) {

                $randomNumber++;

            } else {
        //make your code
        $found = true; 

        $bookings = [];
        foreach ($occurrences_array as $occurrence) {
            $booking = Booking::create([
                'title' => $request->title,
                'start_date' => new DateTime($occurrence[0]),
                'end_date' => new DateTime($occurrence[1]),
                'color' => $request->color,
                'Frequency'  => $request->Frequency,
                'repeateverynumber'  => $request->repeateveryday,
                'repeatend' => $request->repeatend,
                'repeatenddate'=> $request->inputendafterdate,
                'dayofmonth' => $request->daynumberofmonth,
                'NumReccurence' => $randomNumber,
            ]);
        
        }
            $bookings[] = $booking;
    }
        }

        return response()->json($bookings);




    }



    public function store5(Request $request){

        $startDate = $request->start;//date
        $endDate = $request->end;//date
        $repeatEvery = $request->repeateveryday;


        $daysofweek = $request->daysofweek;
        $daysofweek = $request->daysofweek;
        $daysofweekString = implode(',', $daysofweek);



        $numberoccurence = $request->numberoccurence;

        $occurrences = Http::get('http://127.0.0.1:5000/getoccurenceibjectweekbynumber/'. $startDate . '/' . $endDate  . '/'. $numberoccurence .'/'.$daysofweekString  .'/'.$repeatEvery);

        // return  $occurrences;


        $occurrences_array = json_decode($occurrences);

        $randomNumber = rand(1,100000);
         
 
     
 
        $found = false;
        
        while (!$found) {
            $exists = Booking::where('NumReccurence', $randomNumber)->exists();    

            if ($exists) {

                $randomNumber++;

            } else {
        //make your code
        $found = true; 

        $bookings = [];

        foreach ($occurrences_array as $occurrence) {
            $booking = Booking::create([
                'title' => $request->title,
                'start_date' => new Datetime($occurrence[0]),
                'end_date' => new DateTime($occurrence[1]),
                'color' => $request->color,
                'Frequency'  => $request->Frequency,
                'repeateverynumber'  => $request->repeateveryday,
                'repeatend' => $request->repeatend,
                'repeatendoccurence'=> $request->numberoccurence,
                'weekdaysstring' =>$daysofweekString,
                'NumReccurence' => $randomNumber,
            ]);
        }
            // Store the created booking in an array
            $bookings[] = $booking;

    }
        }
              // Return the JSON response with all created bookings
        return response()->json($bookings);


    
}

    public function store4(Request $request){

        $startDate = $request->start;//date
        $endDate = $request->end;//date
        $repeatEvery = $request->repeateveryday;


        $daysofweek = $request->daysofweek;
        // Convert the array to a comma-separated string
        $daysofweekString = implode(',', $daysofweek);

        

        // return $daysofweekString;
        $inputendafterdate = $request->inputendafterdate;//date


        $occurrences = Http::get('http://127.0.0.1:5000/getoccurenceobjectweekly/'. $startDate . '/' . $endDate  . '/'. $inputendafterdate .'/'.$daysofweekString  .'/'.$repeatEvery);

        $occurrences_array = json_decode($occurrences);

        // return  $occurrences_array;

         // Calculate occurrences
        //  $occurrences = $this->calculateOccurrences($startDate, $endDate, $repeatEvery, $numberoccurence);


         // return $occurrences;
 
         $randomNumber = rand(1,100000);
         
 
     
 
         $found = false;
         
         while (!$found) {
             $exists = Booking::where('NumReccurence', $randomNumber)->exists();    
 
             if ($exists) {
 
                 $randomNumber++;
 
             } else {
         //make your code
         $found = true; 

        $bookings = [];
        foreach ($occurrences_array as $occurrence) {
            $booking = Booking::create([
                'title' => $request->title,
                'start_date' => new DateTime($occurrence[0]),
                'end_date' => new DateTime($occurrence[1]),
                'color' => $request->color,
                'Frequency'  => $request->Frequency,
                'repeateverynumber'  => $request->repeateveryday,
                'repeatend' => $request->repeatend,
                'repeatenddate'=> $request->inputendafterdate,
                'weekdaysstring' => $daysofweekString,
                'NumReccurence' => $randomNumber,

            ]);
        }

            $bookings[] = $booking;
    }
        }

        return response()->json($bookings);



    }

    public function store3(Request $request){
        // Create DateTime objects from the request
        $startDate = new DateTime($request->start);
        $endDate =  new DateTime($request->end);
        $repeatEvery = $request->repeateveryday;
        $numberoccurence =  $request->numberoccurence;


        // Calculate occurrences
        $occurrences = $this->calculateOccurrences($startDate, $endDate, $repeatEvery, $numberoccurence);


        // return $occurrences;

        $randomNumber = rand(1,100000);
        

    

        $found = false;
        
        while (!$found) {
            $exists = Booking::where('NumReccurence', $randomNumber)->exists();    

            if ($exists) {

                $randomNumber++;

            } else {
        //make your code
        $found = true; 

        // Save occurrences to the database
        $bookings = [];
        foreach ($occurrences as $occurrence) {
            $booking = Booking::create([
                 'title' => $request->title,
                 'start_date' => $occurrence['start'],
                 'end_date' => $occurrence['end'],
                 'color' => $request->color,
                 'Frequency'  => $request->Frequency,
                 'repeateverynumber'  => $request->repeateveryday,
                 'repeatend' => $request->repeatend,
                 'repeatendoccurence'=> $request->numberoccurence,
                 'NumReccurence' => $randomNumber,
            ]);
        
        }
            // Store the created booking in an array
            $bookings[] = $booking;
    }
        }
        
        // Return the JSON response with all created bookings
        return response()->json($bookings);
    }







    //daily with enddate    
    public function store2(Request $request){
         // Create DateTime objects from the request
         $startDate = new DateTime($request->start_date);
         $endDate =  new DateTime($request->end_date);
         $repeatEvery = $request->repeateveryday;
         $inputendafterdate = new DateTime($request->inputendafterdate);


        
 
         // Calculate occurrences
         $occurrences = $this->calculateOccurrencesDate($startDate, $endDate, $repeatEvery, $inputendafterdate);
 
 
        //  return $occurrences;

        $randomNumber = rand(1,100000);
        

    

        $found = false;
        
        while (!$found) {
            $exists = Booking::where('NumReccurence', $randomNumber)->exists();    

            if ($exists) {

                $randomNumber++;

            } else {
               //make your code
                $found = true; 

        // Save occurrences to the database
        $bookings = [];
        foreach ($occurrences as $occurrence) {
            $booking = Booking::create([
                'title' => $request->title,
                'start_date' => $occurrence['start'],
                'end_date' => $occurrence['end'],
                'color' => $request->color,
                'Frequency'  => $request->Frequency,
                'repeateverynumber'  => $request->repeateveryday,
                'repeatend' => $request->repeatend,
                'repeatenddate'=> $request->inputendafterdate,
                'NumReccurence' => $randomNumber,
      ]);
            }
        }
       
         
             // Store the created booking in an array
             $bookings[] = $booking;
         }
         
         // Return the JSON response with all created bookings
         return response()->json($bookings);
    }



    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string'
        ]);

        
        $booking = Booking::create([
            'title' => $request->title,
            'start_date' => $request->start,
            'end_date' => $request->end,
            'color' => $request->color,
            'Frequency' => $request->Frequency,
        ]);


        return response()->json([
            'id' => $booking->id,
            'start' => $booking->start_date,
            'end' => $booking->end_date,
            'title' => $booking->title,
            'color' => $booking->color,
            'Frequency' => $booking->Frequency,

        ]);
    }











    public function update(Request $request ,$id)
    {
        $booking = Booking::find($id);
        if(! $booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $booking->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'title' =>$request->title,
            'color' =>$request->color,
        ]);
        return response()->json('Event updated');
    }








    public function destroyallfutureevents($Numreccurence){

        $currentDateTime = Carbon::now();

         $booking = Booking::where('NumReccurence', $Numreccurence)
        ->where('start_date', '>', $currentDateTime)
        ->get();

        if(! $booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $booking->delete();
        return true;

    }





    public function destroy($id)
    {
        $booking = Booking::find($id);
        if(! $booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $booking->delete();
        return $id;
    }
}
