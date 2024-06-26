import pandas as pd
import random
from reportlab.lib.pagesizes import letter
from reportlab.lib import colors
from reportlab.platypus import SimpleDocTemplate, Table, TableStyle

# Charger les données depuis Excel
def load_data_from_excel(file_path):
    classes_df = pd.read_excel(file_path, sheet_name='Classes')
    modules_df = pd.read_excel(file_path, sheet_name='Modules')
    enseignants_df = pd.read_excel(file_path, sheet_name='Enseignants')
    salles_df = pd.read_excel(file_path, sheet_name='Salles')

    print("Classes columns:", classes_df.columns)
    print("Modules columns:", modules_df.columns)
    print("Enseignants columns:", enseignants_df.columns)
    print("Salles columns:", salles_df.columns)

    return classes_df, modules_df, enseignants_df, salles_df

class Classe:
    def __init__(self, nom, nombre_eleves):
        self.nom = nom
        self.nombre_eleves = nombre_eleves
        self.modules = []

    def add_module(self, module):
        self.modules.append(module)

class Module:
    def __init__(self, nom, volume_horaire_cm, volume_horaire_td):
        self.nom = nom
        self.volume_horaire_cm = volume_horaire_cm
        self.volume_horaire_td = volume_horaire_td
        self.classes = []
        self.is_cm = volume_horaire_cm > 0

    def add_class(self, classe):
        self.classes.append(classe)

class Enseignant:
    def __init__(self, nom):
        self.nom = nom
        self.disponibilites = []

    def add_disponibilite(self, disponibilite):
        self.disponibilites.append(disponibilite)

class Salle:
    def __init__(self, numero, capacite):
        self.numero = numero
        self.capacite = capacite

class ElementDeModule:
    def __init__(self, module, jour, periode, salle, enseignant):
        self.module = module
        self.jour = jour
        self.periode = periode
        self.salle = salle
        self.enseignant = enseignant

    def __str__(self):
        return f"Module: {self.module.nom}, Jour: {self.jour}, Période: {self.periode}, Salle: {self.salle.numero}, Enseignant: {self.enseignant.nom}"

class SchoolTimetable:
    def __init__(self, number_of_classes):
        self.school_timetables = [[] for _ in range(number_of_classes)]
        self.fitness = 0

    def add_elements_for_class(self, class_index, elements):
        self.school_timetables[class_index].extend(elements)

    def calculate_fitness(self):
        # Simplified fitness calculation
        self.fitness = random.randint(1, 100)
        return self.fitness

    def get_number_of_classes(self):
        return len(self.school_timetables)

    def get_class_by_index(self, index):
        return self.school_timetables[index]

    def get_elements_for_class_by_index(self, index):
        return self.school_timetables[index]

    def get_timetables(self):
        return self.school_timetables

class GaAlgorithm:
    def __init__(self):
        self.POPULATION_SIZE = 10
        self.MUTATION_RATE = 0.2
        self.CROSSOVER_RATE = 0.9
        self.MAX_GENERATIONS = 50
        self.population = []
        self.is_terminated = False

    def run_algorithm(self, excel_file_path):
        try:
            classes_df, modules_df, enseignants_df, salles_df = load_data_from_excel(excel_file_path)
            classes = self.initialize_classes(classes_df, modules_df)
            self.initialize_population(classes)
            self.evolve()
            best_timetable = self.get_best_timetable()
            self.print_timetable(best_timetable)
            self.create_pdf(best_timetable, "emploi_du_temps.pdf")
        except Exception as e:
            print(e)

    def initialize_classes(self, classes_df, modules_df):
        classes = []
        for _, row in classes_df.iterrows():
            classe = Classe(row['Nom de la Classe'], row['Nombre d\'Élèves'])
            class_modules = modules_df[modules_df['Classes Associées'] == classe.nom]
            for _, mod_row in class_modules.iterrows():
                module = Module(mod_row['Modules'], mod_row['Heures CM'], mod_row['Heures TD'])
                classe.add_module(module)
            classes.append(classe)
        return classes

    def initialize_population(self, classes):
        for _ in range(self.POPULATION_SIZE):
            timetable = SchoolTimetable(len(classes))
            for i, classe in enumerate(classes):
                elements = self.generate_random_elements_for_class(classe)
                timetable.add_elements_for_class(i, elements)
            self.population.append(timetable)

    def evolve(self):
        for generation in range(self.MAX_GENERATIONS):
            new_population = []
            for _ in range(self.POPULATION_SIZE // 2):
                parent1 = self.select_parent()
                parent2 = self.select_parent()
                children = self.crossover(parent1, parent2)
                self.mutate(children[0])
                self.mutate(children[1])
                new_population.extend(children)
            self.population = new_population
            print(f"Generation {generation} best fitness: {self.get_best_timetable().calculate_fitness()}")

    def select_parent(self):
        return random.choice(self.population)

    def crossover(self, parent1, parent2):
        child1 = SchoolTimetable(len(parent1.school_timetables))
        child2 = SchoolTimetable(len(parent2.school_timetables))
        for i in range(len(parent1.school_timetables)):
            if random.random() < self.CROSSOVER_RATE:
                child1.add_elements_for_class(i, parent1.school_timetables[i])
                child2.add_elements_for_class(i, parent2.school_timetables[i])
            else:
                child1.add_elements_for_class(i, parent2.school_timetables[i])
                child2.add_elements_for_class(i, parent1.school_timetables[i])
        return [child1, child2]

    def mutate(self, timetable):
        for class_timetable in timetable.school_timetables:
            if len(class_timetable) > 1 and random.random() < self.MUTATION_RATE:
                idx1 = random.randint(0, len(class_timetable) - 1)
                idx2 = random.randint(0, len(class_timetable) - 1)
                class_timetable[idx1], class_timetable[idx2] = class_timetable[idx2], class_timetable[idx1]

    def get_best_timetable(self):
        return min(self.population, key=lambda t: t.calculate_fitness())

    def print_timetable(self, timetable):
        for class_timetable in timetable.school_timetables:
            for element in class_timetable:
                print(f"Module: {element.module.nom}, Jour: {element.jour}, Période: {element.periode}")

    def generate_random_elements_for_class(self, classe):
        elements = []
        for module in classe.modules:
            total_cm_hours = module.volume_horaire_cm
            total_td_hours = module.volume_horaire_td
            periods = self.get_periods()
            if module.is_cm:
                while total_cm_hours > 0:
                    element = ElementDeModule(module, self.random_day(), periods[0], self.random_salle(), self.random_enseignant())
                    elements.append(element)
                    total_cm_hours -= 1.75
            while total_td_hours > 0:
                element = ElementDeModule(module, self.random_day(), self.random_period(), self.random_salle(), self.random_enseignant())
                elements.append(element)
                total_td_hours -= 1.75
        return elements

    def random_day(self):
        days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"]
        return random.choice(days)

    def random_period(self):
        periods = ["8h30-10h15", "10h30-12h15", "14h-15h45", "16h-17h45"]
        return random.choice(periods)

    def random_salle(self):
        return Salle(f"Salle {random.randint(1, 10)}", random.randint(20, 40))

    def random_enseignant(self):
        return Enseignant(f"Prof {random.randint(1, 10)}")

    def get_periods(self):
        return ["8h30-10h15", "10h30-12h15", "14h-15h45", "16h-17h45"]

    def create_pdf(self, timetable, filename):
        doc = SimpleDocTemplate(filename, pagesize=letter)
        elements = []

        data = [["Class", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday"]]
        periods = ["8h30-10h15", "10h30-12h15", "14h-15h45", "16h-17h45"]

        for period in periods:
            for class_idx, class_timetable in enumerate(timetable.get_timetables()):
                row = [f"Class {class_idx + 1} ({period})"]
                for day in ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"]:
                    cell_text = ""
                    for element in class_timetable:
                        if element.jour == day and element.periode == period:
                            cell_text += f"{element.module.nom}\n{element.enseignant.nom}\n{element.salle.numero}\n"
                    row.append(cell_text.strip())
                data.append(row)

        table = Table(data)
        table.setStyle(TableStyle([
            ('BACKGROUND', (0, 0), (-1, 0), colors.grey),
            ('TEXTCOLOR', (0, 0), (-1, 0), colors.whitesmoke),
            ('ALIGN', (0, 0), (-1, -1), 'CENTER'),
            ('FONTNAME', (0, 0), (-1, 0), 'Helvetica-Bold'),
            ('BOTTOMPADDING', (0, 0), (-1, 0), 12),
            ('BACKGROUND', (0, 1), (-1, -1), colors.beige),
            ('GRID', (0, 0), (-1, -1), 1, colors.black),
        ]))

        elements.append(table)
        doc.build(elements)

if __name__ == "__main__":
    ga_algorithm = GaAlgorithm()
    ga_algorithm.run_algorithm(r"C:\Users\asus\Desktop\CLASSEUR.xlsx")
