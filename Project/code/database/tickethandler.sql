PRAGMA foreign_keys = ON;

.mode columns
.headers on
.nullvalue NULL

DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Department;
DROP TABLE IF EXISTS Ticket;
DROP TABLE IF EXISTS TicketSorted;
DROP TABLE IF EXISTS FAQ;
DROP TABLE IF EXISTS Message_;

CREATE TABLE User (
    user_id INTEGER PRIMARY KEY AUTOINCREMENT,
    username VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    usertype INT NOT NULL
);



CREATE TABLE Department (
    name_department VARCHAR(100) NOT NULL,
    PRIMARY KEY (name_department)
);

CREATE TABLE Ticket (
    ID_ticket INTEGER PRIMARY KEY AUTOINCREMENT,
    department VARCHAR(255),
    title_ticket VARCHAR(255),
    description VARCHAR(255),
    client_id VARCHAR(20) NOT NULL,
    agent_id VARCHAR(20),
    status_ VARCHAR(20) CHECK (status_ IN ('open', 'assigned', 'closed')),
    time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES User (user_id),
    FOREIGN KEY (agent_id) REFERENCES User (user_id)
    
);

CREATE TABLE FAQ (
    faq_id INTEGER PRIMARY KEY AUTOINCREMENT,
    question TEXT NOT NULL,
    answer TEXT NOT NULL
);

CREATE TABLE Message_ (
    message_id INTEGER PRIMARY KEY AUTOINCREMENT,
    ticket_id INTEGER NOT NULL,
    sender_username TEXT NOT NULL,
    content TEXT NOT NULL,
    time DATETIME(0) NOT NULL DEFAULT (strftime('%d-%m-%Y %H:%M', 'now')),
    FOREIGN KEY (ticket_id) REFERENCES Ticket (ID_ticket) ,
    FOREIGN KEY (sender_username) REFERENCES User (username)
);


INSERT INTO User(username,email,password,usertype) Values ('administrador','emailteste1','2e6f9b0d5885b6010f9167787445617f553a735f',3);
INSERT INTO User(username,email,password,usertype) Values ('agente','emailteste2','2e6f9b0d5885b6010f9167787445617f553a735f',2);
INSERT INTO User(username,email,password,usertype) Values ('cliente','emailteste3','2e6f9b0d5885b6010f9167787445617f553a735f',1);

INSERT INTO Department(name_department) Values ('Law');
INSERT INTO Department(name_department) Values ('Finances');
INSERT INTO Department(name_department) Values ('Marketing');
INSERT INTO Department(name_department) Values ('Sales');

INSERT INTO Ticket(department, title_ticket, description, client_id, status_)
VALUES ('Finances', 'AssuntoTeste1', 'I need help.', 3, 'open');
INSERT INTO Ticket(department, title_ticket, description, client_id, status_)
VALUES ('Law', 'AssuntoTeste2', 'I require legal advice regarding a specific matter. ', 3, 'open');
INSERT INTO Ticket(department, title_ticket, description, client_id, status_)
VALUES ('Law', 'AssuntoTeste3', 'I have a legal question related to my current situation.', 3, 'open');
INSERT INTO Ticket(department, title_ticket, description, client_id, status_)
VALUES ('Finances', 'AssuntoTeste4', 'I need assistance in finances. Can you help me?', 3, 'open');
INSERT INTO Ticket(department, title_ticket, description, client_id, status_)
VALUES ('Marketing', 'AssuntoTeste5', 'Can you help me?', 3, 'open');