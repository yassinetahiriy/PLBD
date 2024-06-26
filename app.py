from flask import Flask, request, send_file, render_template
import pandas as pd
import random
from collections import namedtuple
import io

app = Flask(__name__)

# Data structures
Class = namedtuple('Class', ['module', 'type', 'professor', 'duration'])
TimeSlot = namedtuple('TimeSlot', ['day', 'time'])
Room = namedtuple('Room', ['name', 'capacity', 'is_amphitheater'])

# Global variables
DAYS = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']
TIMES = ['8:30-10:15', '10:30-12:15', '14:00-15:45', '16:00-17:45']
GROUPS = ['TD1', 'TD2', 'TD3', 'TD4', 'TD5', 'TD6']
ROOMS = [Room('Amphi', 300, True)] + [Room(f'Classroom {i}', 50, False) for i in range(1, 11)]
WEEKS = 18

# Global variables to store data
input_data = None
semester_schedules = None

def parse_excel(file):
    df = pd.read_excel(file)
    classes = []
    for _, row in df.iterrows():
        module = row['Modules']
        professor = row['Resp. Module']
        cm_hours = row['CM'] if not pd.isna(row['CM']) else 0
        td_hours = row['TD/TP'] if not pd.isna(row['TD/TP']) else 0
        
        if cm_hours > 0:
            classes.append(Class(module, 'CM', professor, cm_hours))
        if td_hours > 0:
            classes.append(Class(module, 'TD', professor, td_hours))
    
    return classes

def generate_initial_schedule(classes):
    schedule = {room: {day: {time: None for time in TIMES} for day in DAYS} for room in ROOMS}
    for class_ in classes:
        room = ROOMS[0] if class_.type == 'CM' else random.choice(ROOMS[1:])
        day = random.choice(DAYS)
        time = random.choice(TIMES)
        while schedule[room][day][time]:
            room = ROOMS[0] if class_.type == 'CM' else random.choice(ROOMS[1:])
            day = random.choice(DAYS)
            time = random.choice(TIMES)
        schedule[room][day][time] = class_
    return schedule

def fitness(schedule):
    conflicts = 0
    professor_schedule = {}
    group_schedule = {group: {day: {time: None for time in TIMES} for day in DAYS} for group in GROUPS}
    
    for room in ROOMS:
        for day in DAYS:
            for time in TIMES:
                class_ = schedule[room][day][time]
                if class_:
                    # Check professor conflicts
                    if class_.professor in professor_schedule:
                        if professor_schedule[class_.professor] == (day, time):
                            conflicts += 1
                    professor_schedule[class_.professor] = (day, time)
                    
                    # Check group conflicts
                    if class_.type == 'CM':
                        for group in GROUPS:
                            if group_schedule[group][day][time]:
                                conflicts += 1
                            group_schedule[group][day][time] = class_
                    else:
                        group = random.choice(GROUPS)
                        if group_schedule[group][day][time]:
                            conflicts += 1
                        group_schedule[group][day][time] = class_
    
    return 1 / (1 + conflicts)

def crossover(schedule1, schedule2):
    new_schedule = {room: {day: {time: None for time in TIMES} for day in DAYS} for room in ROOMS}
    for room in ROOMS:
        for day in DAYS:
            for time in TIMES:
                if random.random() < 0.5:
                    new_schedule[room][day][time] = schedule1[room][day][time]
                else:
                    new_schedule[room][day][time] = schedule2[room][day][time]
    return new_schedule

def mutate(schedule):
    room1, day1, time1 = random.choice(ROOMS), random.choice(DAYS), random.choice(TIMES)
    room2, day2, time2 = random.choice(ROOMS), random.choice(DAYS), random.choice(TIMES)
    schedule[room1][day1][time1], schedule[room2][day2][time2] = schedule[room2][day2][time2], schedule[room1][day1][time1]
    return schedule

def genetic_algorithm(classes, population_size=100, generations=1000):
    population = [generate_initial_schedule(classes) for _ in range(population_size)]
    
    for _ in range(generations):
        population = sorted(population, key=fitness, reverse=True)
        new_population = population[:2]  # Keep the two best schedules
        
        while len(new_population) < population_size:
            parent1, parent2 = random.choices(population[:50], k=2)
            child = crossover(parent1, parent2)
            if random.random() < 0.1:  # 10% chance of mutation
                child = mutate(child)
            new_population.append(child)
        
        population = new_population
    
    return max(population, key=fitness)

def schedule_to_dataframe(schedule):
    data = []
    for room in ROOMS:
        for day in DAYS:
            for time in TIMES:
                class_ = schedule[room][day][time]
                if class_:
                    data.append({
                        'Room': room.name,
                        'Day': day,
                        'Time': time,
                        'Module': class_.module,
                        'Type': class_.type,
                        'Professor': class_.professor
                    })
    return pd.DataFrame(data)


@app.route('/profvd4')
def profvd4():
    return render_template('profvd4.php')

@app.route('/profvd2')
def profvd2():
    return render_template('profvd2.php')

@app.route('/profvd3')
def profvd3():
    return render_template('profvd3.php')

@app.route('/admin')
def admin():
    return render_template('admin.php')
@app.route('/saladmin')
def saladmin():
    return render_template('saladmin.php')

@app.route('/profadmin')
def profadmin():
    return render_template('profadmin.php')

@app.route('/clasadmin')
def clasadmin():
    return render_template('clasadmin.php')

@app.route('/edtadmin')
def edtadmin():
    return render_template('edtadmin.php')



@app.route('/import', methods=['POST'])
def import_data():
    global input_data
    if 'file' not in request.files:
        return 'No file part', 400
    file = request.files['file']
    if file.filename == '':
        return 'No selected file', 400
    if file:
        input_data = parse_excel(file)
        return 'Data imported successfully'

@app.route('/generate', methods=['POST'])
def generate():
    global input_data, semester_schedules
    if input_data is None:
        return 'No data imported yet', 400
    
    semester_schedules = []
    for _ in range(WEEKS):
        best_schedule = genetic_algorithm(input_data)
        semester_schedules.append(best_schedule)
    
    return 'Schedules generated successfully'

@app.route('/export_excel')
def export_excel():
    global semester_schedules
    if semester_schedules is None:
        return 'No schedules generated yet', 400
    
    output = io.BytesIO()
    writer = pd.ExcelWriter(output, engine='xlsxwriter')
    
    for week, schedule in enumerate(semester_schedules, 1):
        df = schedule_to_dataframe(schedule)
        df.to_excel(writer, sheet_name=f'Week {week}', index=False)
    
    writer.save()
    output.seek(0)
    
    return send_file(output, mimetype='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', download_name='semester_schedules.xlsx', as_attachment=True)

if __name__ == '__main__':
    app.run(debug=True)
    