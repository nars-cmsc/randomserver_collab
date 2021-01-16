SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


use cs127group3final;



CREATE TABLE `checklist` (
  `COURSE_COUNTER` int(11) NOT NULL,
  `SAIS_ID` int(9) NOT NULL,
  `COURSE_NUM` varchar(10) NOT NULL,
  `TERM_TAKEN` text NOT NULL,
  `STATUS` varchar(11) NOT NULL,
  `GRADE` decimal(3,2) NOT NULL,
  `TO_COMPUTE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `checklist` (`COURSE_COUNTER`, `SAIS_ID`, `COURSE_NUM`, `TERM_TAKEN`, `STATUS`, `GRADE`, `TO_COMPUTE`) VALUES
(10, 0, 'CMSC 11', 'FIRST SEM 2020-2021', 'PASSED', '2.25', 'YES');


CREATE TABLE `course` (
  `COURSE_CODE` int(5) NOT NULL,
  `COURSE_NUM` varchar(10) NOT NULL,
  `COURSE_TITLE` varchar(30) NOT NULL,
  `COURSE_UNITS` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `course` (`COURSE_CODE`, `COURSE_NUM`, `COURSE_TITLE`, `COURSE_UNITS`) VALUES
(12345, 'CMSC 11', 'Introduction to Computer Scien', '3.00'),
(12355, 'Math 53', 'Elementary Analysis I', '5.00'),
(12356, 'Math 54', 'Elementary Analysis II', '5.00');


CREATE TABLE `login` (
  `UP_EMAIL` varchar(30) NOT NULL,
  `PASSWORD` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `login` (`UP_EMAIL`, `PASSWORD`) VALUES
('', 'd41d8cd98f00b204e9800998ecf8427e'),
('stud1@up', '81dc9bdb52d04dc20036dbd8313ed055'),
('user1@up', 'd41d8cd98f00b204e9800998ecf8427e'),
('user2@up', 'd41d8cd98f00b204e9800998ecf8427e'),
('user@up', '12345');


CREATE TABLE `student` (
  `SAIS_ID` int(9) NOT NULL,
  `STUDENT_ID` bigint(9) NOT NULL,
  `LAST_NAME` varchar(15) NOT NULL,
  `FIRST_NAME` varchar(20) NOT NULL,
  `MIDDLE_NAME` varchar(12) NOT NULL,
  `GWA` decimal(4,3) NOT NULL,
  `UP_EMAIL` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `student` (`SAIS_ID`, `STUDENT_ID`, `LAST_NAME`, `FIRST_NAME`, `MIDDLE_NAME`, `GWA`, `UP_EMAIL`) VALUES
(0, 0, '', '', '', '2.250', ''),
(10000000, 200000000, 'a', 'b', 'c', '0.000', 'user@up'),
(10000001, 200000001, '1', 'use', 'r', '0.000', 'user1@up'),
(10000002, 200000002, '2', 'use', 'r', '0.000', 'user2@up'),
(90876543, 213456789, 'Error', 'Trial', 'and', '2.250', 'stud1@up');



CREATE TABLE `usersession` (
  `UP_EMAIL` varchar(30) NOT NULL,
  `TOKEN` varchar(80) NOT NULL,
  `SESSION_TIME` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `usersession` (`UP_EMAIL`, `TOKEN`, `SESSION_TIME`) VALUES
('stud1@up', 'EgGwJYL0nu', '2021-01-12 11:42:22'),
('stud1@up', 'EgGwJYL0nu', '2021-01-12 12:26:36'),
('stud1@up', 'EgGwJYL0nu', '2021-01-12 12:27:39'),
('stud1@up', 'EgGwJYL0nu', '2021-01-12 12:28:41'),
('stud1@up', 'EgGwJYL0nu', '2021-01-12 12:29:09');


ALTER TABLE `checklist`
  ADD PRIMARY KEY (`COURSE_COUNTER`),
  ADD KEY `SAIS_ID` (`SAIS_ID`),
  ADD KEY `COURSE_NUM` (`COURSE_NUM`);


ALTER TABLE `course`
  ADD PRIMARY KEY (`COURSE_NUM`);


ALTER TABLE `login`
  ADD PRIMARY KEY (`UP_EMAIL`);

ALTER TABLE `student`
  ADD PRIMARY KEY (`SAIS_ID`),
  ADD KEY `UP_EMAIL` (`UP_EMAIL`);


ALTER TABLE `checklist`
  MODIFY `COURSE_COUNTER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;


ALTER TABLE `checklist`
  ADD CONSTRAINT `checklist_ibfk_1` FOREIGN KEY (`SAIS_ID`) REFERENCES `student` (`SAIS_ID`),
  ADD CONSTRAINT `checklist_ibfk_2` FOREIGN KEY (`COURSE_NUM`) REFERENCES `course` (`COURSE_NUM`);


ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`UP_EMAIL`) REFERENCES `login` (`UP_EMAIL`);
COMMIT;

