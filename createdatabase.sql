create database canvas CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
use canvas;
CREATE TABLE student (
    sid varchar(255),
    lid varchar(255),
    fname varchar(255),
    lname varchar(255),
    constraint studentPK primary key(sid)
);
CREATE TABLE course (
    cid varchar(255),
    cnum varchar(255),
    cname varchar(255),
    semester varchar(255),
    year varchar(255),
    constraint coursePK primary key(cid)
);
CREATE TABLE instructor (
	iindex varchar(255),
    cid varchar(255),
    sid varchar(255),
    constraint instructorPK primary key(iindex),
    constraint instructorFK foreign key(cid) references course(cid),
    constraint instructorFK2 foreign key(sid) references student(sid)
);
CREATE TABLE ta (
	tindex varchar(255),
    cid varchar(255),
    sid varchar(255),
    constraint taPK primary key(tindex),
    constraint taFK foreign key(cid) references course(cid),
    constraint taFK2 foreign key(sid) references student(sid)
);
CREATE TABLE assignment (
    cid varchar(255),
    aname varchar(255) not null,
    due timestamp,
    instruction varchar(255),
    point int,
    constraint assignmentFK foreign key(cid) references course(cid)
);
CREATE INDEX index_name ON assignment(aname);
CREATE TABLE grade (
    cid varchar(255),
    aname varchar(255),
	sid varchar(255),
    grade int,
    constraint gradeFK foreign key(cid) references course(cid),
    constraint gradeFK2 foreign key(aname) references assignment(aname),
    constraint gradeFK3 foreign key(sid) references student(sid)
);
CREATE TABLE take (
    sid varchar(255),
    cid varchar(255),
    lettergrade varchar(255),
    constraint takeFK foreign key(sid) references student(sid),
    constraint takeFK2 foreign key(cid) references course(cid)
);
CREATE TABLE post (
    pid varchar(255),
    cid varchar(255),
    sid varchar(255),
    ptitle varchar(255),
    pdate timestamp,
    text varchar(255),
    constraint postPK primary key(pid),
    constraint postFK foreign key(sid) references student(sid),
    constraint postFK2 foreign key(cid) references course(cid)
);
CREATE TABLE tag (
    pid varchar(255),
    cid varchar(255),
    tag varchar(255),
    constraint tagFK foreign key(pid) references post(pid),
    constraint tagFK2 foreign key(cid) references course(cid)
);
CREATE TABLE reply (
    cid varchar(255),
    pid varchar(255),
    rid varchar(255),
    sid varchar(255),
    rtime timestamp,
    reply varchar(255),
    constraint replyFK foreign key(cid) references post(cid),
    constraint replyFK2 foreign key(pid) references post(pid),
    constraint replyPK primary key(rid),
    constraint replyFK3 foreign key(sid) references student(sid)
);