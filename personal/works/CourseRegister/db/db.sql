DROP DATABASE IF EXISTS course_register;
CREATE DATABASE IF NOT EXISTS course_register;
USE course_register;

CREATE TABLE person
(
	id INT AUTO_INCREMENT,
	code CHAR(10),
	name CHAR(50),
	lastname CHAR(50),
	
	UNIQUE(code),
	PRIMARY KEY(id)
);

CREATE TABLE users
(
	id INT AUTO_INCREMENT,
	code CHAR(10),
	username CHAR(20) NOT NULL,
	password CHAR(50) NOT NULL,
	role INT NOT NULL,	/*1:admin, 2:StudentAffairs, 3:FacultyMember, 4:Student*/

	UNIQUE (code),
	PRIMARY KEY(id),
	FOREIGN KEY (code) REFERENCES person(code)
);

CREATE TABLE courses
(
	id INT AUTO_INCREMENT,
	code CHAR(10),
	name CHAR(50),
	isMandatory CHAR(1),
	day CHAR(7), /*1..7, MONDAY..SUNDAY*/
	hourFrom CHAR(5), #HH:MM
	hourTo CHAR(5), #HH:MM

	UNIQUE (code),
	PRIMARY KEY(id)
);

CREATE TABLE facultyMembers
(
	id INT AUTO_INCREMENT,
	code CHAR(10),
	name CHAR(50),
	lastname CHAR(50),	
	email CHAR(50),
	startDate CHAR(8), #YYYMMDD

	UNIQUE (code),
	PRIMARY KEY(id),
	FOREIGN KEY (code) REFERENCES person(code)
);

CREATE TABLE classrooms
(
	id INT AUTO_INCREMENT,
	code CHAR(10),
	name CHAR(10),
	parentCode CHAR(10),
	isRoom BOOLEAN, /* 'f' FOR FLOOR, 'r' FOR ROOM*/

	UNIQUE (code),
	PRIMARY KEY(id)
);

CREATE TABLE students
(
	id INT AUTO_INCREMENT,
	code CHAR(10) UNIQUE,
	name CHAR(50),
	lastname CHAR(50),

	UNIQUE (code),
	PRIMARY KEY(id),
	FOREIGN KEY (code) REFERENCES person(code)
);

CREATE TABLE offeredCourses
(
	id INT AUTO_INCREMENT,
	code CHAR(10),
	courseCode CHAR(10),
	facultyMemberCode CHAR(10),
	classroomCode CHAR(10),

	PRIMARY KEY(id),
	UNIQUE (code),
	FOREIGN KEY (courseCode) REFERENCES courses(code),
	FOREIGN KEY (facultyMemberCode) REFERENCES facultyMembers(code),
	FOREIGN KEY (classroomCode) REFERENCES classrooms(code)
);

CREATE TABLE registrations
(
	id INT AUTO_INCREMENT,
	code CHAR(15),
	studentCode CHAR(10),
	offeredCourseCode CHAR(10),

	PRIMARY KEY(id),
	UNIQUE (code),
	FOREIGN KEY (offeredCourseCode) REFERENCES offeredCourses(code) ON UPDATE CASCADE,
	FOREIGN KEY (studentCode) REFERENCES students(code)
);


insert into person (code, name, lastname) values('1', 'Hasan'	, 'Yilmaz');
insert into person (code, name, lastname) values('2', 'Mehtap'	, 'Olmez');
insert into person (code, name, lastname) values('3', 'Ali'	, 'Kervan');
insert into person (code, name, lastname) values('101', 'Ulas Birant'	, 'Kokten');
insert into person (code, name, lastname) values('102', 'Derya'	, 'Pakalin');
insert into person (code, name, lastname) values('103', 'Ozlem'	, 'Aktas');
insert into person (code, name, lastname) values('104', 'Mehmet Hilal'	, 'Ozcanhan');
insert into person (code, name, lastname) values('105', 'Adnan'	, 'Yaman');
insert into person (code, name, lastname) values('1001', 'Hakan', 'Yilmaz');
insert into person (code, name, lastname) values('1002', 'Alp', 'Tekin');
insert into person (code, name, lastname) values('1003', 'Ayse', 'Zorlu');
insert into person (code, name, lastname) values('1004', 'Sevgi', 'Kaya');
insert into person (code, name, lastname) values('1005', 'Emre', 'Oztekin');

insert into facultyMembers (code, name, lastname, email, startDate) values('101', 'Ulas Birant'	, 'Kokten'	, 'ulasbirantkokten@mail.com'	, '20161026');
insert into facultyMembers (code, name, lastname, email, startDate) values('102', 'Derya'		, 'Pakalin'	, 'deryapakalin@mail.com'		, '20161027');
insert into facultyMembers (code, name, lastname, email, startDate) values('103', 'Ozlem'		, 'Aktas'	, 'ozlemaktas@mail.com'			, '20161028');
insert into facultyMembers (code, name, lastname, email, startDate) values('104', 'Mehmet Hilal'	, 'Ozcanhan', 'mehmethilalozcanhan@mail.com', '20161029');
insert into facultyMembers (code, name, lastname, email, startDate) values('105', 'Adnan'	, 'Yaman', 'adnanyaman@mail.com', '20161030');

insert into students (code, name, lastname) values('1001', 'Hakan', 'Yilmaz');
insert into students (code, name, lastname) values('1002', 'Alp', 'Tekin');
insert into students (code, name, lastname) values('1003', 'Ayse', 'Zorlu');
insert into students (code, name, lastname) values('1004', 'Sevgi', 'Kaya');
insert into students (code, name, lastname) values('1005', 'Emre', 'Oztekin');

insert into users(code, username, password, role) values('1', 'hasanYilmaz', '88d4dcac737f73d169aeb30ffc4e13cb', '1');
insert into users(code, username, password, role) values('2', 'mehtapOlmez', 'fbbf377e29d9d8d1f821af58a47ca8ca', '2');
insert into users(code, username, password, role) values('105', 'adnanYaman', 'c52240fb8d89f118cf5b0af872a7f3de', '3');
insert into users(code, username, password, role) values('1001', 'hakanYilmaz', '5160e383891c22b8974f84427e5081ec', '4');
insert into users(code, username, password, role) values('3', 'noRole', '3025d3644295be9c09906298908d2a05', '0');	

insert into classrooms (code, name, parentcode, isRoom) values('1', '1.Kat' ,''	, 0); 
insert into classrooms (code, name, parentcode, isRoom) values('11', '1-A'	, '1'	, 1);
insert into classrooms (code, name, parentcode, isRoom) values('12', '1-B'	, '1'	, 1);	
insert into classrooms (code, name, parentcode, isRoom) values('2', '2.Kat', ''	, 0);
insert into classrooms (code, name, parentcode, isRoom) values('21', '2-A'	, '2'	, 1);
insert into classrooms (code, name, parentcode, isRoom) values('22', '2-B'	, '22'	, 1);

insert into courses (code, name, isMandatory, day, hourFrom, hourTo) values ('201', 'Data Structures', 'y', '1', '08:40', '11:30');
insert into courses (code, name, isMandatory, day, hourFrom, hourTo) values ('202', 'Computer Architecture', 'y', '2', '08:40', '11:30');
insert into courses (code, name, isMandatory, day, hourFrom, hourTo) values ('203', 'Computer Networks', 'y', '3', '08:40', '11:30');
insert into courses (code, name, isMandatory, day, hourFrom, hourTo) values ('204', 'Calculus', 'y', '4', '08:40', '11:30');
insert into courses (code, name, isMandatory, day, hourFrom, hourTo) values ('205', 'Algorithm', 'y', '5', '08:40', '11:30');
insert into courses (code, name, isMandatory, day, hourFrom, hourTo) values ('501', 'Artificial Engineering', 'n', '1', '12:40', '15:30');
insert into courses (code, name, isMandatory, day, hourFrom, hourTo) values ('502', 'Human Computer Interaction', 'n', '2', '12:40', '15:30');
insert into courses (code, name, isMandatory, day, hourFrom, hourTo) values ('503', 'Web Technologies', 'n', '3', '12:40', '15:30');
insert into courses (code, name, isMandatory, day, hourFrom, hourTo) values ('504', 'Game Design', 'n', '4', '12:40', '15:30');
insert into courses (code, name, isMandatory, day, hourFrom, hourTo) values ('505', 'Data Mining', 'n', '5', '12:40', '15:30');


insert into offeredCourses(code, courseCode, facultyMemberCode, classroomCode) values('20110111', '201', '101', '11');
insert into offeredCourses(code, courseCode, facultyMemberCode, classroomCode) values('20210212', '202', '102', '12');
insert into offeredCourses(code, courseCode, facultyMemberCode, classroomCode) values('20310321', '203', '103', '21');
insert into offeredCourses(code, courseCode, facultyMemberCode, classroomCode) values('20410422', '204', '104', '22');
insert into offeredCourses(code, courseCode, facultyMemberCode, classroomCode) values('20510511', '205', '105', '11');

insert into offeredCourses(code, courseCode, facultyMemberCode, classroomCode) values('50110111', '501', '101', '11');
insert into offeredCourses(code, courseCode, facultyMemberCode, classroomCode) values('50210212', '502', '102', '12');
insert into offeredCourses(code, courseCode, facultyMemberCode, classroomCode) values('50310321', '503', '103', '21');
insert into offeredCourses(code, courseCode, facultyMemberCode, classroomCode) values('50410422', '504', '104', '22');
insert into offeredCourses(code, courseCode, facultyMemberCode, classroomCode) values('50510511', '505', '105', '11');

insert into registrations (code, studentCode, offeredCourseCode) values('100120110111', '1001', '20110111');
insert into registrations (code, studentCode, offeredCourseCode) values('100120210212', '1001', '20210212');
insert into registrations (code, studentCode, offeredCourseCode) values('100120310321', '1001', '20310321');
insert into registrations (code, studentCode, offeredCourseCode) values('100150110111', '1001', '50110111');
insert into registrations (code, studentCode, offeredCourseCode) values('100150310321', '1001', '50310321');

insert into registrations (code, studentCode, offeredCourseCode) values('100220110111', '1002', '20110111');
insert into registrations (code, studentCode, offeredCourseCode) values('100220210212', '1002', '20210212');
insert into registrations (code, studentCode, offeredCourseCode) values('100220310321', '1002', '20310321');
insert into registrations (code, studentCode, offeredCourseCode) values('100250110111', '1002', '50110111');
insert into registrations (code, studentCode, offeredCourseCode) values('100250310321', '1002', '50310321');

insert into registrations (code, studentCode, offeredCourseCode) values('100320110111', '1003', '20110111');
insert into registrations (code, studentCode, offeredCourseCode) values('100320210212', '1003', '20210212');
insert into registrations (code, studentCode, offeredCourseCode) values('100320310321', '1003', '20310321');
insert into registrations (code, studentCode, offeredCourseCode) values('100350110111', '1003', '50110111');
insert into registrations (code, studentCode, offeredCourseCode) values('100350310321', '1003', '50310321');

insert into registrations (code, studentCode, offeredCourseCode) values('100420110111', '1004', '20110111');
insert into registrations (code, studentCode, offeredCourseCode) values('100420210212', '1004', '20210212');
insert into registrations (code, studentCode, offeredCourseCode) values('100420310321', '1004', '20310321');
insert into registrations (code, studentCode, offeredCourseCode) values('100450110111', '1004', '50110111');
insert into registrations (code, studentCode, offeredCourseCode) values('100450310321', '1004', '50310321');

insert into registrations (code, studentCode, offeredCourseCode) values('100520110111', '1005', '20110111');
insert into registrations (code, studentCode, offeredCourseCode) values('100520210212', '1005', '20210212');
insert into registrations (code, studentCode, offeredCourseCode) values('100520310321', '1005', '20310321');
insert into registrations (code, studentCode, offeredCourseCode) values('100550110111', '1005', '50110111');
insert into registrations (code, studentCode, offeredCourseCode) values('100550310321', '1005', '50310321');


