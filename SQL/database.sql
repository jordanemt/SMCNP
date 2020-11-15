CREATE TABLE district(
	id INT AUTO_INCREMENT,
    name VARCHAR(50),

    PRIMARY KEY(id)
);

CREATE TABLE adequacy(
	id INT AUTO_INCREMENT,
    name VARCHAR(100),

    PRIMARY KEY(id)
);

CREATE TABLE route(
    id INT AUTO_INCREMENT,
    cod VARCHAR(50),
    description VARCHAR(50),

    PRIMARY KEY(id)
);

CREATE TABLE service(
    id INT AUTO_INCREMENT,
    name VARCHAR(50),

    PRIMARY KEY(id)
);

CREATE TABLE parent(
    id INT AUTO_INCREMENT,
    card VARCHAR(30) UNIQUE,
    full_name VARCHAR(80),
    nacionality VARCHAR(30),
    ocupation VARCHAR(30),
    work_place VARCHAR(30),
    phone VARCHAR(9),

    PRIMARY KEY(id)
);

CREATE TABLE student( 
    id INT AUTO_INCREMENT, 
    card VARCHAR(30) UNIQUE, 
    name VARCHAR(40), 
    first_lastname VARCHAR(20), 
    second_lastname VARCHAR(20), 
    birthdate DATE, 
    gender VARCHAR(9),
    nationality VARCHAR(30),
    personal_phone VARCHAR(9),
    other_phone VARCHAR(9),
    mep_mail VARCHAR(100),
    other_mail VARCHAR(100),
    id_district INT,
    direction VARCHAR(300),
    suffering VARCHAR(100),
    id_adequacy INT,
    is_imas_benefit BOOLEAN,
    is_teenage_father BOOLEAN,
    is_working BOOLEAN,
    is_sexual_matter BOOLEAN,
    is_ethics_matter BOOLEAN,
    contact_name VARCHAR(80),
    contact_phone VARCHAR(9),
    id_parent INT,
    id_route INT,
    is_new_student BOOLEAN,

    PRIMARY KEY(id),
    FOREIGN KEY(id_district) REFERENCES district(id),
    FOREIGN KEY(id_adequacy) REFERENCES adequacy(id),
    FOREIGN KEY(id_parent) REFERENCES parent(id),
    FOREIGN KEY(id_route) REFERENCES route(id)
);

CREATE TABLE student_service(
    id_student INT,
    id_service INT,

    PRIMARY KEY(id_student, id_service),
    FOREIGN KEY(id_student) REFERENCES student(id),
    FOREIGN KEY(id_service) REFERENCES service(id)
);

CREATE TABLE section(
    id INT AUTO_INCREMENT,
    degree INT,
    name VARCHAR(5),
    year INT,
    workshops VARCHAR(50),
    current_quota INT CHECK (current_quota>-1),

    PRIMARY KEY(id)
);

CREATE TABLE enrollment(
    id INT AUTO_INCREMENT,
    id_student INT,
    id_section INT,
    _date DATE,
    repeating_matters VARCHAR(150), 

    PRIMARY KEY(id),
    FOREIGN KEY(id_student) REFERENCES student(id),
    FOREIGN KEY(id_section) REFERENCES section(id)
);



SELECT 
	s.card, 
    s.name, 
    s.first_lastname, 
    s.second_lastname,
    sec.name AS 'section',
    e._date AS 'enroll_date',
    e.repeating_matters,
    s.birthdate,
    s.gender,
    s.nationality,
    s.personal_phone,
    s.other_phone,
    s.mep_mail,
    s.other_mail,
    d.name AS 'district',
    s.direction,
    s.suffering,
    a.name AS 'adequacy',
    s.is_imas_benefit,
    s.is_teenage_father,
    s.is_imas_benefit,
    s.is_working,
    s.is_sexual_matter,
    s.is_ethics_matter,
    s.is_new_student
FROM student AS s
	JOIN district AS d
    	ON d.id = s.id_district
       		JOIN adequacy AS a
            	ON a.id = s.id_adequacy
                	JOIN enrollment AS e
                    	ON e.id_student = s.id
                        	JOIN section AS sec
                            	ON sec.id = e.id_section;