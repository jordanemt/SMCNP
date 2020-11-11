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
    suffering BIT,
    id_adequacy INT,
    is_imas_benefit BIT,
    is_teenage_father BIT,
    is_working BIT,
    is_sexual_matter BIT,
    is_ethics_matter BIT,
    contact_name VARCHAR(20),
    contact_phone VARCHAR(9),
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
    id_parent)
    VALUES(
        @card, 
        @name, 
        @first_lastname, 
        @second_lastname, 
        @birthdate, 
        @gender, 
        @nationality, 
        @personal_phone, 
        @other_phone, 
        @mep_mail, 
        @other_mail, 
        @id_district, 
        @direction, 
        @suffering, 
        @id_adequacy, 
        @is_imas_benefit, 
        @is_teenage_father, 
        @is_working, 
        @is_sexual_matter, 
        @is_ethics_matter, 
        @contact_name, 
        @contact_phone, 
        @id_parent, 
        1
    );
END//

CREATE PROCEDURE sp_read_student_by_card(
    card VARCHAR(30))
BEGIN
    SELECT* FROM student WHERE card = @card;
END//

CREATE PROCEDURE sp_update_student(
    id INT,
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
    suffering BIT,
    id_adequacy INT,
    is_imas_benefit BIT,
    is_teenage_father BIT,
    is_working BIT,
    is_sexual_matter BIT,
    is_ethics_matter BIT,
    contact_name VARCHAR(20),
    contact_phone VARCHAR(9),
    id_parent INT)
BEGIN
    UPDATE student
    SET name = @name, 
        first_lastname = @first_lastname, 
        second_lastname = @second_lastname, 
        birthdate = @birthdate, 
        gender = @gender, 
        nationality = @nationality, 
        personal_phone = @personal_phone, 
        other_phone = @other_phone, 
        mep_mail = @mep_mail, 
        other_mail = @other_mail, 
        id_district = @id_district, 
        direction = @direction, 
        suffering = @suffering, 
        id_adequacy = @id_adequacy, 
        is_imas_benefit = @is_imas_benefit, 
        is_teenage_father = @is_teenage_father, 
        is_working = @is_working, 
        is_sexual_matter = @is_sexual_matter, 
        is_ethics_matter = @is_ethics_matter, 
        contact_name = @contact_name, 
        contact_phone = @contact_phone, 
        id_parent = @id_parent, 
        is_new_student = 0
    WHERE id = @id;
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
            @card, 
            @full_name, 
            @nacionality, 
            @ocupation, 
            @work_place, 
            @phone) ; 
END//

CREATE PROCEDURE sp_read_parent_by_card(
    card VARCHAR(30))
BEGIN
    SELECT* FROM parent WHERE card = @card;
END//

CREATE PROCEDURE sp_update_parent(
    id INT, 
    full_name VARCHAR(80), 
    nacionality VARCHAR(30), 
    ocupation VARCHAR(30), 
    work_place VARCHAR(30), 
    phone VARCHAR(9))
BEGIN
    UPDATE parent
    SET full_name = @full_name,
        nacionality = @nacionality,
        ocupation = @ocupation,
        work_place = @work_place,
        phone = @phone
    WHERE id = @id;
END//

CREATE PROCEDURE sp_create_student_service(
    id_student INT, 
    id_service INT,
    id_route INT)
BEGIN
    INSERT INTO student_service(id_student, id_service, id_route) VALUES(@id_student, @id_service, @id_route);
END//

CREATE PROCEDURE sp_create_enrollment(
    id_student INT, 
    id_section INT,
    _date DATE,
    repeating_matters VARCHAR(150))
BEGIN
    INSERT INTO enrollment(id_student, id_section, _date, repeating_matters) 
        VALUES(@id_student, @id_section, @_date, @repeating_matters);
    UPDATE section SET current_quota = current_quota -1 WHERE id = @id_section;
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

CREATE PROCEDURE sp_read_all_by_year_section(year int)
BEGIN
    SELECT* FROM section WHERE year = @year;
END//

CREATE PROCEDURE sp_read_all_service()
BEGIN
    SELECT* FROM service;
END//

DELIMITER;