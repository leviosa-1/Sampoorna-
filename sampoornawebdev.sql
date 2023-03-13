create database iips;
use iips;
create table Club(
CId smallint not null auto_increment,
Cname varchar(50) unique,
Formation_date date default '20220801',
club_logo varchar(200) default 'bydefault club logo.png',
primary key(CId)
);

create table Club_master(
ClubID smallint not null,
MID smallint not null ,
primary key(ClubID, MID));
create table Club_description(
ClubID smallint,
DID smallint not null default 101,
Heading_of_description varchar(80),
Body longtext,
primary key(ClubID,dID));
create table Eventt(
ClubID smallint,
EID smallint not null default 101,
Ename varchar(50),
primary key(ClubID,EID));
create table Event_description(
ClubID smallint,
EventID smallint,
DID smallint default 101,
Heading_of_description varchar(80),
Body longtext,
primary key(ClubID,EventID,DID));
create table Faculty(
FID smallint auto_increment primary key,
Fname varchar(30)
);
create table Event_organizer(
ClubID smallint,
EventID smallint,
OrgID smallint default 101,
primary key(ClubID,EventID,OrgID));
create table Coordinator(
COID smallint primary key auto_increment,
Coname varchar(30),
course varchar(10)
);
create table Event_coordination(
ClubID smallint,
EventID smallint,
COID smallint default 101,
Cotype varchar(20),
primary key(ClubID,EventID,COID));
create table Speaker(
ClubID smallint,
EventID smallint,
SID smallint default 101,
Sname varchar(30),
Sdescription text,
primary key(ClubID,EventID,SID));
create table Event_pics(
Sno smallint default 1,
ClubID smallint,
EventID smallint,
pic_path varchar(200) default 'bydefault event pic.png',
primary key(Sno,ClubID,EventID));
alter table club_description add foreign key(ClubID) references club(CId) on delete cascade on update cascade;
alter table eventt add foreign key(ClubID) references club(CId) on delete cascade on update cascade;
alter table club_master add foreign key(ClubID) references club(CId) on delete cascade on update cascade;
alter table event_organizer add foreign key(ClubID,EventID) references eventt(ClubID,EID) on delete cascade on update cascade;
alter table event_organizer add foreign key(OrgID) references faculty(FID) on delete cascade on update cascade;
alter table club_master add foreign key(MID) references faculty(FID) on delete cascade on update cascade;
alter table event_coordination add foreign key(ClubID,EventID) references eventt(ClubID,EID) on delete cascade on update cascade;
alter table event_coordination add foreign key(COID) references coordinator(COID) on delete cascade on update cascade;
alter table speaker add foreign key(ClubID,EventID) references eventt(ClubID,EID) on delete cascade on update cascade;
alter table event_pics add foreign key(ClubID,EventID) references eventt(ClubID,EID) on delete cascade on update cascade;
alter table event_description add foreign key(ClubID,EventID) references eventt(ClubID,EID) on delete cascade on update cascade;
alter table club auto_increment=101;
alter table faculty auto_increment=101;
alter table coordinator auto_increment=101;
select * from club_description;
delete from club