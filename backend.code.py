import random
from collections import defaultdict

class TimeSlot:
    def __init__(self, week, day, start_time):
        self.week = week
        self.day = day
        self.start_time = start_time

class Room:
    def __init__(self, name, is_lecture_theatre, capacity):
        self.name = name
        self.is_lecture_theatre = is_lecture_theatre
        self.capacity = capacity

class Teacher:
    def __init__(self, name, subjects):
        self.name = name
        self.subjects = subjects

class Class:
    def __init__(self, subject, class_type, group, teacher, room, time_slot):
        self.subject = subject
        self.class_type = class_type  # 'CM' or 'TD'
        self.group = group  # None for CM, 'TD1', 'TD2', etc. for TD
        self.teacher = teacher
        self.room = room
        self.time_slot = time_slot

class Schedule:
    def __init__(self):
        self.classes = []

    def add_class(self, new_class):
        self.classes.append(new_class)

    def get_conflicts(self):
        conflicts = 0
        room_usage = defaultdict(list)
        teacher_usage = defaultdict(list)
        group_usage = defaultdict(list)
        subject_hours_per_day = defaultdict(lambda: defaultdict(int))

        for class_ in self.classes:
            key = (class_.time_slot.week, class_.time_slot.day, class_.time_slot.start_time)
            
            # Check room conflicts
            if key in room_usage[class_.room.name]:
                conflicts += 1
            room_usage[class_.room.name].append(key)

            # Check teacher conflicts
            if key in teacher_usage[class_.teacher.name]:
                conflicts += 1
            teacher_usage[class_.teacher.name].append(key)

            # Check group conflicts (including CM which affects all groups)
            if class_.class_type == 'CM':
                for group in GROUPS:
                    if key in group_usage[group]:
                        conflicts += 1
                    group_usage[group].append(key)
            else:
                if key in group_usage[class_.group]:
                    conflicts += 1
                group_usage[class_.group].append(key)

            # Check subject hours per day
            day_key = (class_.time_slot.week, class_.time_slot.day)
            subject_hours_per_day[class_.subject][day_key] += 2
            if subject_hours_per_day[class_.subject][day_key] > 4:
                conflicts += 1

            # Check for classes on Thursday and Friday evenings
            if class_.time_slot.day in ['Thursday', 'Friday'] and class_.time_slot.start_time in ['14:00', '16:00']:
                conflicts += 1

        # Check if the number of sessions for each subject is correct
        session_counts = defaultdict(lambda: {'CM': 0, 'TD': 0})
        for class_ in self.classes:
            session_counts[class_.subject][class_.class_type] += 1

        for subject in SUBJECTS:
            if session_counts[subject]['CM'] != 5:
                conflicts += abs(session_counts[subject]['CM'] - 5)
            if session_counts[subject]['TD'] != 20:  # 4 sessions * 5 groups
                conflicts += abs(session_counts[subject]['TD'] - 20)

        # Check if TD groups study different subjects in one session
        for week in [1, 2]:
            for day in DAYS:
                for time in TIMES:
                    td_classes = [c for c in self.classes if c.time_slot.week == week and 
                                  c.time_slot.day == day and c.time_slot.start_time == time and 
                                  c.class_type == 'TD']
                    subjects = set(c.subject for c in td_classes)
                    if len(subjects) > 1:
                        conflicts += len(subjects) - 1

        return conflicts

# Global variables
SUBJECTS = ["Statistics", "Probability", "MMC", "MSE"]
DAYS = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"]
TIMES = ["08:00", "10:00", "14:00", "16:00"]
GROUPS = ["TD1", "TD2", "TD3", "TD4", "TD5"]

ROOMS = [Room("Lecture Theatre", True, 200)] + [Room(f"Classroom {i}", False, 40) for i in range(1, 11)]
TEACHERS = [
    Teacher("Dr. Smith", ["Statistics", "Probability"]),
    Teacher("Prof. Johnson", ["MMC", "Statistics"]),
    Teacher("Dr. Williams", ["MSE", "Probability"]),
    Teacher("Prof. Brown", ["MMC", "MSE"]),
    Teacher("Dr. Davis", ["Statistics", "MMC"]),
    Teacher("Prof. Miller", ["Probability", "MSE"])
]

def generate_random_schedule():
    schedule = Schedule()
    for subject in SUBJECTS:
        # Add CM classes
        for _ in range(5):
            teacher = random.choice([t for t in TEACHERS if subject in t.subjects])
            week = random.choice([1, 2])
            day = random.choice(DAYS)
            time = random.choice(TIMES)
            if day in ['Thursday', 'Friday'] and time in ['14:00', '16:00']:
                time = random.choice(['08:00', '10:00'])
            time_slot = TimeSlot(week, day, time)
            new_class = Class(subject, 'CM', None, teacher, ROOMS[0], time_slot)
            schedule.add_class(new_class)
        
        # Add TD classes
        for group in GROUPS:
            for _ in range(4):
                teacher = random.choice([t for t in TEACHERS if subject in t.subjects])
                room = random.choice(ROOMS[1:])  # Classrooms only
                week = random.choice([1, 2])
                day = random.choice(DAYS)
                time = random.choice(TIMES)
                if day in ['Thursday', 'Friday'] and time in ['14:00', '16:00']:
                    time = random.choice(['08:00', '10:00'])
                time_slot = TimeSlot(week, day, time)
                new_class = Class(subject, 'TD', group, teacher, room, time_slot)
                schedule.add_class(new_class)
    
    return schedule

def calculate_fitness(schedule):
    return 1 / (1 + schedule.get_conflicts())

def select_parents(population):
    return random.choices(
        population,
        weights=[calculate_fitness(schedule) for schedule in population],
        k=len(population)
    )

def crossover(parent1, parent2):
    child1, child2 = Schedule(), Schedule()
    for i in range(len(parent1.classes)):
        if random.random() < 0.5:
            child1.add_class(parent1.classes[i])
            child2.add_class(parent2.classes[i])
        else:
            child1.add_class(parent2.classes[i])
            child2.add_class(parent1.classes[i])
    return child1, child2

def mutate(schedule):
    if random.random() < 0.1:  # 10% chance of mutation
        class_to_mutate = random.choice(schedule.classes)
        if class_to_mutate.class_type == 'CM':s
            class_to_mutate.room = ROOMS[0]
        else:
            class_to_mutate.room = random.choice(ROOMS[1:])
        week = random.choice([1, 2])
        day = random.choice(DAYS)
        time = random.choice(TIMES)
        if day in ['Thursday', 'Friday'] and time in ['14:00', '16:00']:
            time = random.choice(['08:00', '10:00'])
        class_to_mutate.time_slot = TimeSlot(week, day, time)
        class_to_mutate.teacher = random.choice([t for t in TEACHERS if class_to_mutate.subject in t.subjects])
    return schedule

def genetic_algorithm():
    population_size = 100
    max_generations = 10000
    
    population = [generate_random_schedule() for _ in range(population_size)]
    
    best_schedule = None
    best_fitness = 0
    
    for generation in range(max_generations):
        parents = select_parents(population)
        
        new_population = []
        for i in range(0, len(parents), 2):
            child1, child2 = crossover(parents[i], parents[i+1])
            new_population.extend([mutate(child1), mutate(child2)])
        
        population = new_population
        
        current_best = max(population, key=calculate_fitness)
        current_fitness = calculate_fitness(current_best)
        
        if current_fitness > best_fitness:
            best_schedule = current_best
            best_fitness = current_fitness
        
        if generation % 100 == 0:
            print(f"\nGeneration {generation}: Best fitness = {best_fitness}")
            print(f"Number of conflicts: {best_schedule.get_conflicts()}")
            print("\nCurrent best schedule:")
            print_schedule(best_schedule)
            
            user_input = input("\nDo you want to continue? (y/n): ")
            if user_input.lower() != 'y':
                break
    
    return best_schedule
sS

def print_schedule(schedule):
    for week in [1, 2]:
        print(f"\nWeek {week}:")
        for day in DAYS:
            print(f"\n  {day}:")
            for time in TIMES:
                classes = [c for c in schedule.classes if c.time_slot.week == week and 
                           c.time_slot.day == day and c.time_slot.start_time == time]
                if classes:
                    print(f"    {time}:")
                    for class_ in classes:
                        print(f"      {class_.subject} ({class_.class_type}{' ' + class_.group if class_.group else ''}): "
                              f"{class_.teacher.name}, {class_.room.name}")

# Run the genetic algorithm
best_schedule = genetic_algorithm()

# Print the best schedule found
print("\nBest Schedule Found:")
print_schedule(best_schedule)
print(f"\nFitness of this schedule: {calculate_fitness(best_schedule)}")
print(f"Number of conflicts: {best_schedule.get_conflicts()}")