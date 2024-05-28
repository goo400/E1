from flask import Flask,request,jsonify
from datetime import datetime, timedelta

app = Flask(__name__)

@app.route("/getoccurenceobjectweekly/<start_event>/<end_event>/<end_repeat>/<repeat_days>/<repeateveyweek>")
def home(start_event, end_event, repeat_days, end_repeat,repeateveyweek):


    start_date = datetime.strptime(start_event, "%Y-%m-%dT%H:%M")
    end_date = datetime.strptime(end_event, "%Y-%m-%dT%H:%M")
    end_repeat_date = datetime.strptime(end_repeat, "%Y-%m-%d")
    

    # Convert repeat_days to a list of integers
    repeat_days = [int(day) for day in repeat_days.split(',')]
        
    # # Convert repeateveyweek to an integer
    repeateveyweeklocale = int(repeateveyweek)


    occurrences = []
    
    # Initialize the first week start
    current_date = start_date - timedelta(days=start_date.weekday())
    
    while current_date.date() <= end_repeat_date.date():
        for day in repeat_days:
            event_date = current_date + timedelta(days=day)
            if start_date.date() <= event_date.date() <= end_repeat_date.date():
                event_start = datetime(event_date.year, event_date.month, event_date.day, start_date.hour, start_date.minute)
                event_end = datetime(event_date.year, event_date.month, event_date.day, end_date.hour, end_date.minute)
                occurrences.append((event_start, event_end))
        current_date += timedelta(weeks=repeateveyweeklocale)
    
    return occurrences






@app.route("/getoccurenceibjectweekbynumber/<start_event>/<end_event>/<num_occurrences>/<repeat_days>/<repeateveyweek>")
def home2(start_event,end_event,num_occurrences,repeat_days,repeateveyweek):

    start_date = datetime.strptime(start_event, "%Y-%m-%dT%H:%M")
    end_date = datetime.strptime(end_event, "%Y-%m-%dT%H:%M")
    
    # Convert repeat_days to a list of integers
    repeat_days = [int(day) for day in repeat_days.split(',')]
        
    # Convert repeateveyweek to an integer
    repeateveyweeklocale = int(repeateveyweek)
    # repeateveyweeklocale=repeateveyweek

    num_occurrences= int(num_occurrences)

    occurrences = []
    
    # Initialize the first week start
    current_date = start_date - timedelta(days=start_date.weekday())
    
    count = 0
    while count < num_occurrences:
        for day in repeat_days:
            event_date = current_date + timedelta(days=day)
            if start_date.date() <= event_date.date():
                event_start = datetime(event_date.year, event_date.month, event_date.day, start_date.hour, start_date.minute)
                event_end = datetime(event_date.year, event_date.month, event_date.day, end_date.hour, end_date.minute)
                occurrences.append((event_start, event_end))
                count += 1  # Increment count when an occurrence is added
                if count == num_occurrences:
                    break  # Break the loop if the required number of occurrences is reached
        current_date += timedelta(weeks=repeateveyweeklocale)
    
    return occurrences



@app.route("/getoccurenceobjectmonthbyenddate/<start_event>/<end_event>/<repeatdatenumber>/<repeatevery>/<endrepeat>")
def home3(start_event,end_event,repeatdatenumber,repeatevery,endrepeat):
    start_date = datetime.strptime(start_event, "%Y-%m-%dT%H:%M")
    end_date = datetime.strptime(end_event, "%Y-%m-%dT%H:%M")
    end_repeat_date = datetime.strptime(endrepeat,  "%Y-%m-%d")
    
    occurrences = []
    
    # Initialize the first occurrence date
    current_date = datetime(start_date.year, start_date.month, int(repeatdatenumber), start_date.hour, start_date.minute)
    
    # Loop to generate occurrences
    while current_date <= end_repeat_date:
        # Check if the current date is after the start date
        if current_date >= start_date:
            # Create start and end datetime objects for the occurrence
            event_start = datetime(current_date.year, current_date.month, current_date.day, start_date.hour, start_date.minute)
            event_end = datetime(current_date.year, current_date.month, current_date.day, end_date.hour, end_date.minute)
            occurrences.append((event_start, event_end))
        
        # Move to the next occurrence after specified interval
        next_month = current_date.month + int(repeatevery)
        next_year = current_date.year + next_month // 12
        next_month %= 12
        if next_month == 0:
            next_month = 12
        current_date = current_date.replace(year=next_year, month=next_month)
    
    return occurrences


@app.route("/getoccurenceobjectmonthbyoccurencenumber/<start_event>/<end_event>/<repeat_day>/<repeat_interval>/<num_occurrences>")
def home4(start_event, end_event, repeat_day, repeat_interval, num_occurrences):
    start_date = datetime.strptime(start_event, "%Y-%m-%dT%H:%M")
    end_date = datetime.strptime(end_event, "%Y-%m-%dT%H:%M")
    
    occurrences = []
    
    # Initialize the first occurrence date
    current_date = datetime(start_date.year, start_date.month, int(repeat_day), start_date.hour, start_date.minute)
    
    # Loop to generate occurrences
    count = 0
    while count < int(num_occurrences):
        # Check if the current date is after the start date
        if current_date >= start_date:
            # Create start and end datetime objects for the occurrence
            event_start = datetime(current_date.year, current_date.month, current_date.day, start_date.hour, start_date.minute)
            event_end = datetime(current_date.year, current_date.month, current_date.day, end_date.hour, end_date.minute)
            occurrences.append((event_start, event_end))
            count += 1
        
        # Move to the next occurrence after specified interval
        next_month = current_date.month + int(repeat_interval)
        next_year = current_date.year + next_month // 12
        next_month %= 12
        if next_month == 0:
            next_month = 12
        current_date = current_date.replace(year=next_year, month=next_month)
    
    return occurrences


if __name__ == "__main__":
    app.run(debug=True)