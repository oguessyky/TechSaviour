create database TechSaViour;
use TechSaViour;

create table User (
    Username nvarchar primary key not null,
    Role enum('User','Admin') not null,
    Password nvarchar not null,
    Name nvarchar,
    Email nvarchar,
    Phone nvarchar
);

create table contact (
    ID int identity(1,1) primary key not null,
    Username foreign key references User(Username) not null,
    Inquiry nvarchar not null,
    status enum('Pending','Resolved') not null
);

create table CPU (
    ID int identity(1,1) primary key not null,
    Name nvarchar not null,
    Score int not null
);

create table storage (
    ID int identity(1,1) primary key not null,
    Type enum('HDD','SSD','M2 SSD DDR4','M2 SSD DDR5') not null,
    Capacity nvarchar not null,
    Score int not null
);

create table GPU (
    ID int identity(1,1) primary key not null,
    Name nvarchar not null,
    Score int not null
);

create table RAM (
    ID int identity(1,1) primary key not null,
    Capacity nvarchar not null,
    Score int not null
);

create table Laptop (
    ID int identity(1,1) primary key not null,
    Name nvarchar not null,
    Description nvarchar,
    Image blob,
    CPU int foreign key references CPU(ID) not null,
    GPU int foreign key references GPU(ID) not null,
    RAM int foreign key references RAM(ID) not null,
    Storage int foreign key references Storage(ID) not null,
    ScreenResolution nvarchar not null,
    ScreenRefreshRate nvarchar not null,
    Add_on nvarchar
);