CREATE TABLE students (
    id SERIAL PRIMARY KEY,
    user_id INT UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    roll_number VARCHAR(20) UNIQUE NOT NULL,
    gender VARCHAR(100) NOT NULL,
    address VARCHAR(100) NOT NULL,
    course VARCHAR(20)  NOT NULL,
    email VARCHAR(20)  NOT NULL,
    pasword VARCHAR(20)  NOT NULL,
    role VARCHAR(20)  NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



CREATE TABLE admins (
    id SERIAL PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    pass VARCHAR(100) NOT NULL,
    role VARCHAR(20)  NOT NULL,
);

CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL -- 'admin' or 'student'
);

CREATE TABLE meals (
    id SERIAL PRIMARY KEY,
    student_id INT REFERENCES students(id),
    meal_date DATE DEFAULT CURRENT_DATE,
    meal_type VARCHAR(10),
    attended BOOLEAN DEFAULT FALSE
);

CREATE TABLE meals (
    id SERIAL PRIMARY KEY,
    student_id INT REFERENCES students(id),
    meal_date DATE DEFAULT CURRENT_DATE,
    meal_type VARCHAR(10),
    attended BOOLEAN DEFAULT FALSE,
    CONSTRAINT meal_unique UNIQUE (student_id, meal_date, meal_type)
);


CREATE TABLE stud_meal_charges (
    charge_id SERIAL PRIMARY KEY,
    student_id INT NOT NULL,
    month INT NOT NULL,
    year INT NOT NULL,
    monthly_charge DECIMAL(10, 2) NOT NULL,
    UNIQUE(student_id, month, year),
    FOREIGN KEY (student_id) REFERENCES students(student_id)
);


CREATE TABLE payments (
    payment_id SERIAL PRIMARY KEY,
    student_id INT NOT NULL,
    payment_date DATE NOT NULL,
    amount_paid DECIMAL(10, 2) NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    approved BOOLEAN NOT NULL DEFAULT FALSE,
    FOREIGN KEY (student_id) REFERENCES students(student_id)
);