create database TechSaViour;

use TechSaViour;

create table User (
    Username varchar(20) primary key not null,
    Role enum('User','Admin') not null,
    Password varchar(255) not null,
    Name varchar(255),
    Email varchar(255),
    Phone varchar(20)
);

create table Feedback (
    ID int auto_increment primary key not null,
    Username varchar(20) not null,
    Inquiry varchar(255) not null,
    Status enum('Pending','Resolved') not null default 'Pending',
    foreign key (Username) references User(Username)
);

create table CPU (
    ID int auto_increment primary key not null,
    Name varchar(255) not null,
    Manufacturer varchar(255) not null,
    Score int not null
);

create table GPU (
    ID int auto_increment primary key not null,
    Name varchar(255) not null,
    Manufacturer varchar(255) not null,
    Score int not null
);

create table Laptop (
    ID int auto_increment primary key not null,
    Name varchar(255) not null,
    Description varchar(255),
    Image blob,
    CPU int not null,
    GPU int not null,
    RAM int not null,
    RAMScore int not null, /* change to derived */
    Storage int not null,
    StorageType enum('HDD','SSD','M2 SSD DDR4','M2 SSD DDR5') not null,
    StorageScore int not null, /* change to derived */
    ScreenResolution varchar(255) not null,
    ScreenRefreshRate varchar(255) not null,
    Add_on varchar(255),
    foreign key (CPU) references CPU(ID),
    foreign key (GPU) references GPU(ID)
);
