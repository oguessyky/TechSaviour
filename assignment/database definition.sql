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

create table Laptop (
    ID int auto_increment primary key not null,
    Name varchar(255) not null,
    Description varchar(255),
    ImageAddress varchar(255),
    CPUName varchar(255) not null,
    CPUManufacturer varchar(255) not null,
    CPUScore int not null,
    GPUName varchar(255) not null,
    GPUManufacturer varchar(255) not null,
    GPUScore int not null,
    RAM int not null,
    Storage int not null,
    StorageType enum('HDD','SSD','M2 SSD DDR4','M2 SSD DDR5') not null,
    ForGaming boolean not null,
    ForBusiness boolean not null,
    ForArt boolean not null
);

/* admin user */
INSERT INTO User VALUES ('admin','Admin','admin','Admin','admin@techsaviour.com','+60123456789');

INSERT INTO Laptop(Name,Description, ImageAddress, CPUName, CPUManufacturer, CPUScore, GPUName, GPUManufacturer, GPUScore, RAM, Storage, StorageType, ForGaming, ForBusiness, ForArt)
VALUES ('[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]','[value-11]','[value-12]','[value-13]','[value-14]','[value-15]','[value-16]')

UPDATE Laptop SET
Name='[value-2]',
Description='[value-3]',
ImageAddress='[value-4]',
CPUName='[value-5]',
CPUManufacturer='[value-6]',
CPUScore='[value-7]',
GPUName='[value-8]',
GPUManufacturer='[value-9]',
GPUScore='[value-10]',
RAM='[value-11]',
Storage='[value-12]',
StorageType='[value-13]',
ForGaming='[value-14]',
ForBusiness='[value-15]',
ForArt='[value-16]'
WHERE ID='[value-1]';