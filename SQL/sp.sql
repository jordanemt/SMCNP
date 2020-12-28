DELIMITER //

CREATE PROCEDURE sp_create_student( 
    card VARCHAR(30), 
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
    is_imas_benefit VARCHAR(2),
    is_teenage_father VARCHAR(2),
    is_working VARCHAR(2),
    is_sexual_matter VARCHAR(2),
    is_ethics_matter VARCHAR(2),
    contact_name VARCHAR(80),
    contact_phone VARCHAR(9),
    id_route INT,
    id_parent INT)
BEGIN
    INSERT INTO student(
    card, 
    name, 
    first_lastname, 
    second_lastname, 
    birthdate, 
    gender, 
    nationality, 
    personal_phone, 
    other_phone, 
    mep_mail, 
    other_mail, 
    id_district, 
    direction, 
    suffering, 
    id_adequacy, 
    is_imas_benefit, 
    is_teenage_father, 
    is_working, 
    is_sexual_matter, 
    is_ethics_matter, 
    contact_name, 
    contact_phone,
    id_route, 
    id_parent,
    is_new_student)
    VALUES(
        card, 
        name, 
        first_lastname, 
        second_lastname, 
        birthdate, 
        gender, 
        nationality, 
        personal_phone, 
        other_phone, 
        mep_mail, 
        other_mail, 
        id_district, 
        direction, 
        suffering, 
        id_adequacy, 
        is_imas_benefit, 
        is_teenage_father, 
        is_working, 
        is_sexual_matter, 
        is_ethics_matter, 
        contact_name, 
        contact_phone,
        id_route, 
        id_parent, 
        'Sí'
    );
    SELECT LAST_INSERT_ID() as id; 
END//

CREATE PROCEDURE sp_read_student_by_card(
    _card VARCHAR(30))
BEGIN
    SELECT* FROM student WHERE card = _card;
END//

CREATE PROCEDURE sp_update_student(
    _id INT,
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
    is_imas_benefit VARCHAR(2),
    is_teenage_father VARCHAR(2),
    is_working VARCHAR(2),
    is_sexual_matter VARCHAR(2),
    is_ethics_matter VARCHAR(2),
    contact_name VARCHAR(80),
    contact_phone VARCHAR(9),
    id_route INT,
    id_parent INT)
BEGIN
    UPDATE student
    SET name = name, 
        first_lastname = first_lastname, 
        second_lastname = second_lastname, 
        birthdate = birthdate, 
        gender = gender, 
        nationality = nationality, 
        personal_phone = personal_phone, 
        other_phone = other_phone, 
        mep_mail = mep_mail, 
        other_mail = other_mail, 
        id_district = id_district, 
        direction = direction, 
        suffering = suffering, 
        id_adequacy = id_adequacy, 
        is_imas_benefit = is_imas_benefit, 
        is_teenage_father = is_teenage_father, 
        is_working = is_working, 
        is_sexual_matter = is_sexual_matter, 
        is_ethics_matter = is_ethics_matter, 
        contact_name = contact_name, 
        contact_phone = contact_phone, 
        id_parent = id_parent, 
        id_route = id_route,
        is_new_student = 'No'
    WHERE id = _id;
END//

CREATE PROCEDURE sp_read_student_enrollment()
BEGIN
    SELECT
    e.id AS 'enroll_num', 
    s.id,
	s.card, 
    s.name, 
    s.first_lastname, 
    s.second_lastname,
    sec.name AS 'section',
    e._date AS 'enroll_date',
    e.repeating_matters,
    r.description AS 'route',
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
    s.is_working,
    s.is_sexual_matter,
    s.is_ethics_matter,
    s.is_new_student
    FROM student AS s
        LEFT JOIN district AS d
            ON d.id = s.id_district
                LEFT JOIN adequacy AS a
                    ON a.id = s.id_adequacy
                        LEFT JOIN route r
                            ON r.id = s.id_route
                                LEFT JOIN enrollment AS e
                                    ON e.id_student = s.id
                                        LEFT JOIN section AS sec
                                            ON sec.id = e.id_section
                                                ORDER BY e.id;
END//

CREATE PROCEDURE sp_create_parent( 
    card VARCHAR(30), 
    full_name VARCHAR(80), 
    nacionality VARCHAR(30), 
    ocupation VARCHAR(30), 
    work_place VARCHAR(30), 
    phone VARCHAR(9))
BEGIN
    INSERT INTO parent( 
        card, 
        full_name, 
        nacionality, 
        ocupation, 
        work_place, 
        phone) 
        VALUES(
            card, 
            full_name, 
            nacionality, 
            ocupation, 
            work_place, 
            phone); 
    SELECT LAST_INSERT_ID() as id; 
END//

CREATE PROCEDURE sp_read_parent_by_card(
    _card VARCHAR(30))
BEGIN
    SELECT* FROM parent WHERE card = _card;
END//

CREATE PROCEDURE sp_update_parent(
    _id INT, 
    full_name VARCHAR(80), 
    nacionality VARCHAR(30), 
    ocupation VARCHAR(30), 
    work_place VARCHAR(30), 
    phone VARCHAR(9))
BEGIN
    UPDATE parent
    SET full_name = full_name,
        nacionality = nacionality,
        ocupation = ocupation,
        work_place = work_place,
        phone = phone
    WHERE id = _id;
END//

CREATE PROCEDURE sp_create_student_service(
    id_student INT, 
    id_service INT)
BEGIN
    INSERT INTO student_service(id_student, id_service) VALUES(id_student, id_service);
END//

CREATE PROCEDURE sp_delete_student_service_by_student_id(
    id INT)
BEGIN
    DELETE FROM student_service WHERE id_student = id;
END//

CREATE PROCEDURE sp_read_all_service_by_student_id(
    _id INT)
BEGIN
    SELECT
        service.name
    FROM service
        JOIN student_service
            ON service.id = student_service.id_service
    WHERE student_service.id_student = _id;
END//

CREATE PROCEDURE sp_create_enrollment(
    id_student INT, 
    id_section INT,
    _date DATE,
    repeating_matters VARCHAR(150))
BEGIN
    INSERT INTO enrollment(id_student, id_section, _date, repeating_matters) 
        VALUES(id_student, id_section, _date, repeating_matters);
    UPDATE section SET current_quota = current_quota - 1 WHERE id = id_section;
    SELECT LAST_INSERT_ID() as id; 
END//

CREATE PROCEDURE sp_read_all_enrollment()
BEGIN
    SELECT* FROM enrollment;
END//

CREATE PROCEDURE sp_read_all_adequacy()
BEGIN
    SELECT* FROM adequacy;
END//

CREATE PROCEDURE sp_read_all_district()
BEGIN
    SELECT* FROM district;
END//

CREATE PROCEDURE sp_read_all_route()
BEGIN
    SELECT* FROM route;
END//

CREATE PROCEDURE sp_read_all_section()
BEGIN
    SELECT* FROM section;
END//

CREATE PROCEDURE sp_read_all_service()
BEGIN
    SELECT* FROM service;
END//