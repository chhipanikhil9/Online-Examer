CREATE TABLE users(
	rollno varchar(15),
    email varchar(40) PRIMARY KEY,
    course varchar(20),
    sem varchar(10),
    contact varchar(15),
    pwd varchar(512),
    name varchar(40)
);

CREATE TABLE constants(
	email varchar(40),
    istattempted varchar(10)
);

CREATE TABLE questions(
	numb int AUTO_INCREMENT PRIMARY KEY,
    ques varchar(512),
    option1 varchar(512),
    option2 varchar(512),
    option3 varchar(512),
    option4 varchar(512),
    correct varchar(5)
);

CREATE TABLE user_test(
    email varchar(40) PRIMARY KEY,
    strt TIMESTAMP,
    answers varchar(30)
);