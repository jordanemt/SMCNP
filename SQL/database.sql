CREATE TABLE district(
	id INT AUTO_INCREMENT,
    name VARCHAR(30),

    PRIMARY KEY(id)
);

CREATE TABLE adequacy(
	id INT AUTO_INCREMENT,
    name VARCHAR(30),

    PRIMARY KEY(id)
);

CREATE TABLE route(
    id INT AUTO_INCREMENT,
    cod VARCHAR(30),
    description VARCHAR(50),

    PRIMARY KEY(id)
);

CREATE TABLE service(
    id INT AUTO_INCREMENT,
    name VARCHAR(30),
    id_route INT,

    PRIMARY KEY(id),
    FOREIGN KEY(id_route) REFERENCES route(id)
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
    mep_mail VARCHAR(100) UNIQUE,
    other_mail VARCHAR(100),
    id_district INT,
    direction VARCHAR(300),
    suffering BIT,
    id_adequacy INT,
    is_imas_benefit BIT,
    is_teenage_father BIT,
    is_working BIT,
    is_sexual_matter BIT,
    is_ethics_matter BIT,
    contact_name VARCHAR(20),
    contact_phone VARCHAR(9),
    is_new_student BIT,

    PRIMARY KEY(id),
    FOREIGN KEY(id_district) REFERENCES district(id),
    FOREIGN KEY(id_adequacy) REFERENCES adequacy(id)
);

CREATE TABLE student_service(
    id_student INT,
    id_service INT,

    PRIMARY KEY(id_student, id_service),
    FOREIGN KEY(id_student) REFERENCES student(id),
    FOREIGN KEY(id_service) REFERENCES service(id)
);

CREATE TABLE parent(
    id INT AUTO_INCREMENT,
    id_student INT,
    card VARCHAR(30) UNIQUE,
    full_name VARCHAR(60),
    nacionality VARCHAR(30),
    ocupation VARCHAR(30),
    work_place VARCHAR(30),
    phone VARCHAR(9),

    PRIMARY KEY(id),
    FOREIGN KEY(id_student) REFERENCES student(id)
);

CREATE TABLE section(
    id INT AUTO_INCREMENT,
    degree INT,
    name VARCHAR(4),
    workshops VARCHAR(50),
    current_quota INT,

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