use canvas;
LOAD DATA LOCAL INFILE 'student.csv' INTO TABLE student FIELDS TERMINATED BY ',' IGNORE 1 LINES;
LOAD DATA LOCAL INFILE 'course.csv' INTO TABLE course FIELDS TERMINATED BY ',' IGNORE 1 LINES;
set foreign_key_checks = 0;
LOAD DATA LOCAL INFILE 'instructor.csv' INTO TABLE instructor FIELDS TERMINATED BY ',' IGNORE 1 LINES;
LOAD DATA LOCAL INFILE 'ta.csv' INTO TABLE ta FIELDS TERMINATED BY ',' IGNORE 1 LINES;
set foreign_key_checks = 1;
LOAD DATA LOCAL INFILE 'assignment.csv' INTO TABLE assignment FIELDS TERMINATED BY ',' IGNORE 1 LINES;
LOAD DATA LOCAL INFILE 'grade.csv' INTO TABLE grade FIELDS TERMINATED BY ',' IGNORE 1 LINES;
LOAD DATA LOCAL INFILE 'take.csv' INTO TABLE take FIELDS TERMINATED BY ',' IGNORE 1 LINES;
LOAD DATA LOCAL INFILE 'post.csv' INTO TABLE post FIELDS TERMINATED BY ',' IGNORE 1 LINES;
LOAD DATA LOCAL INFILE 'tag.csv' INTO TABLE tag FIELDS TERMINATED BY ',' IGNORE 1 LINES;
LOAD DATA LOCAL INFILE 'reply.csv' INTO TABLE reply FIELDS TERMINATED BY ',' IGNORE 1 LINES;

UPDATE course SET YEAR=TRIM(TRAILING '\r' FROM `year`);
UPDATE instructor SET sid=TRIM(TRAILING '\r' FROM `sid`);
UPDATE reply SET reply=TRIM(TRAILING '\r' FROM `reply`);
UPDATE post SET TEXT=TRIM(TRAILING '\r' FROM `text`);
UPDATE student SET lname=TRIM(TRAILING '\r' FROM `lname`);
UPDATE ta SET sid=TRIM(TRAILING '\r' FROM `sid`);
UPDATE tag SET tag=TRIM(TRAILING '\r' FROM `tag`);