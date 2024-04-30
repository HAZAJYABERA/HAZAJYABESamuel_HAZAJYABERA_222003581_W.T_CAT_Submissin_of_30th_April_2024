ssssss-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2024 at 11:25 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hazajyabera_samuel_222003581`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteStudentOrTeacher` (IN `tableName` VARCHAR(50), IN `columnName` VARCHAR(50), IN `conditionValue` VARCHAR(100))   BEGIN
    DECLARE tableNameLowercase VARCHAR(50);
    SET tableNameLowercase = LOWER(tableName);
    
    SET @deleteQuery = CONCAT('DELETE FROM ', tableNameLowercase, ' WHERE ', columnName, ' = ?');
    
    PREPARE stmt FROM @deleteQuery;
    EXECUTE stmt USING conditionValue;
    DEALLOCATE PREPARE stmt;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DisplayAllTablesData` ()   BEGIN
    SELECT * FROM students;
    SELECT * FROM courses;
    SELECT * FROM Enrollment;
    SELECT * FROM teachers;
    SELECT * FROM attendance;
    SELECT * FROM classes;
    SELECT * FROM library;
    SELECT * FROM payments;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetStudentsInCourse` (IN `courseName` VARCHAR(100))   BEGIN
    SELECT Student_name, Email
    FROM students
    WHERE Stu_id IN (
        SELECT Stu_id
        FROM Enrollment
        WHERE Course_id = (SELECT Course_id FROM courses WHERE Course_name = courseName)
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertAttendance` (IN `studentID` INT, IN `classID` INT, IN `attendanceDate` DATE, IN `status` VARCHAR(50))   BEGIN
    INSERT INTO attendance (Stu_id, Class_id, Attendance_date, Status)
    VALUES (studentID, classID, attendanceDate, status);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertClass` (IN `classLevel` INT, IN `location` VARCHAR(20), IN `year` INT)   BEGIN
    INSERT INTO classes (Class_level, Location, Year)
    VALUES (classLevel, location, year);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertEnrollment` (IN `studentID` INT, IN `courseID` INT, IN `enrollmentDate` DATE)   BEGIN
    INSERT INTO Enrollment (Stu_id, Course_id, Enrollment_Date)
    VALUES (studentID, courseID, enrollmentDate);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertLibraryBook` (IN `title` VARCHAR(50), IN `publicationYear` DATE, IN `author` VARCHAR(30))   BEGIN
    INSERT INTO library (Title, Publication_year, Author)
    VALUES (title, publicationYear, author);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertPayment` (IN `studentID` INT, IN `paymentDate` DATE, IN `paymentAmount` INT, IN `paymentMethod` VARCHAR(50), IN `status` VARCHAR(50))   BEGIN
    INSERT INTO payments (Stu_id, Payment_date, Payment_amaunt, Payment_method, Status)
    VALUES (studentID, paymentDate, paymentAmount, paymentMethod, status);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertStudents` (IN `studentName` VARCHAR(100), IN `email` VARCHAR(50), IN `telephone` VARCHAR(10), IN `dateOfBirth` DATE, IN `nationality` VARCHAR(20), IN `gender` CHAR, IN `courseName` VARCHAR(50), IN `enrollmentDate` DATE, IN `parents` VARCHAR(100))   BEGIN
 INSERT INTO students (Student_name, Email, Telephone, Date_of_birth, Nationality, Gender, Course_name, Enrollment_date, Parents)
    VALUES (studentName, email, telephone, dateOfBirth, nationality, gender, courseName, enrollmentDate, parents);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertTeacher` (IN `teacherName` VARCHAR(100), IN `contact` VARCHAR(40), IN `email` VARCHAR(50), IN `courseName` VARCHAR(100), IN `officeHours` INT)   BEGIN
    INSERT INTO teachers (Teacher_name, Contact, Email, Course_name, Office_hours)
    VALUES (teacherName, contact, email, courseName, officeHours);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateStudentOrCourse` (IN `tableName` VARCHAR(50), IN `recordID` INT, IN `columnName` VARCHAR(50), IN `newValue` VARCHAR(100))   BEGIN
    DECLARE tableNameLowercase VARCHAR(50);
    SET tableNameLowercase = LOWER(tableName);
    
    SET @updateQuery = CONCAT('UPDATE ', tableNameLowercase, ' SET ', columnName, ' = ?', ' WHERE ', tableNameLowercase, '_id = ?');
    
    PREPARE stmt FROM @updateQuery;
    EXECUTE stmt USING newValue, recordID;
    DEALLOCATE PREPARE stmt;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `Class_id` int(11) NOT NULL,
  `Class_level` int(11) NOT NULL,
  `Location` varchar(20) NOT NULL,
  `Year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`Class_id`, `Class_level`, `Location`, `Year`) VALUES
(1, 1, 'Room A101', 2023),
(2, 2, 'Room B202', 2023),
(3, 1, 'Room C103', 2023),
(4, 2, 'Room D204', 2023),
(5, 3, 'huye', 2020),
(6, 1, 'Room A101', 2023),
(7, 1, 'Room A101', 2023),
(8, 2, 'Room B202', 2023),
(9, 1, 'Room C103', 2023),
(10, 2, 'Room D204', 2023),
(11, 3, 'Room E305', 2023),
(12, 1, 'Room A101', 2023);

--
-- Triggers `classes`
--
DELIMITER $$
CREATE TRIGGER `AfterDeleteClasses` AFTER DELETE ON `classes` FOR EACH ROW BEGIN
    
    INSERT INTO class_audit (class_id, action, action_date)
    VALUES (OLD.class_id, 'DELETE', NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `librarys`
--

CREATE TABLE `librarys` (
  `Book_id` int(11) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Publication_year` date NOT NULL,
  `Author` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `librarys`
--

INSERT INTO `librarys` (`Book_id`, `Title`, `Publication_year`, `Author`) VALUES
(1, 'eeeeeeee', '2024-04-26', 'wwwwwwww');

--
-- Triggers `librarys`
--
DELIMITER $$
CREATE TRIGGER `AfterInsertlibrary` AFTER INSERT ON `librarys` FOR EACH ROW BEGIN
    INSERT INTO librarys_audit (book_id, action, action_date)
    VALUES (NEW.book_id, 'INSERT', NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `Payment_id` int(11) NOT NULL,
  `Stu_id` int(11) DEFAULT NULL,
  `Payment_date` date DEFAULT NULL,
  `Payment_amaunt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`Payment_id`, `Stu_id`, `Payment_date`, `Payment_amaunt`) VALUES
(3, 3, '2023-08-03', 1200);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `Stu_id` int(11) NOT NULL,
  `Student_name` varchar(100) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Telephone` varchar(10) NOT NULL,
  `Gender` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`Stu_id`, `Student_name`, `Email`, `Telephone`, `Gender`) VALUES
(1, 'tttttt', 'ttttt@gmail.com', '43434343', 'm'),
(2, 'tttttt', 'ttttt@gmail.com', '43434343', 'm'),
(3, 'ererer', 'ttttt@gmail.com', '43434343', 'm'),
(4, 'jean pierre Niyonzima', 'niyonzima@example.com', '2507999999', 'M'),
(5, 'Grace Abijuru', 'grace@example.com', '2507999800', 'M'),
(6, 'Divine Mukamana', 'divine@example.com', '2507123456', 'F'),
(7, 'tumukunde valens', 'tumukundevalens@gmail.com', '0786954328', 'M'),
(8, 'Emmanuel Nzeyimana', 'emmanuel.nzeyimana@example.com', '2507888888', 'M'),
(9, 'Marie Uwase', 'marie@example.com', '2507377777', 'F'),
(10, 'Fidele Niyonzima', 'fidele@example.com', '2507999999', 'M'),
(11, 'jean pierre Niyonzima', 'niyonzima@example.com', '2507999999', 'M'),
(12, 'Grace Abijuru', 'grace@example.com', '2507999800', 'M'),
(13, 'Divine Mukamana', 'divine@example.com', '2507123456', 'F'),
(18, 'ererer', 'rrrr@gmail.com', '1234455', NULL),
(20, 'wwwwww', 'ww@gmail.com', '54323432', NULL);

--
-- Triggers `students`
--
DELIMITER $$
CREATE TRIGGER `AfterDeletestudents` AFTER DELETE ON `students` FOR EACH ROW BEGIN
    
    INSERT INTO students_audit (Stu_id, action, action_date)
    VALUES (OLD.Stu_id, 'DELETE', NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `Teacher_id` int(11) NOT NULL,
  `Teacher_name` varchar(100) NOT NULL,
  `Contact` varchar(40) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`Teacher_id`, `Teacher_name`, `Contact`, `Email`) VALUES
(13, 'Michael Smith', '9876543210', 'michael@example.com'),
(1, 'wwwww', '0780000566', 'fdf@gmail.com'),
(2, 'gasana samuel', '0782134566', 'fdf@gmail.com');

--
-- Triggers `teachers`
--
DELIMITER $$
CREATE TRIGGER `AfterUpdateteachers` AFTER UPDATE ON `teachers` FOR EACH ROW BEGIN
    
    INSERT INTO teachers_audit (teacher_id, action, action_date)
    VALUES (NEW.teacher_id, 'UPDATE', NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(6) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `gender` varchar(7) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `gender`) VALUES
(2, 'urhuye', '3322', 'hazajyabera', 'samuel', 'fff@gm', 'male'),
(3, 'urhuye', '222', 'ummmmm', 'dddd', 'fff@gm', 'male'),
(0, 'samuel', '111111', 'wwwwww', 'eeeee', 'eee@gm', '3'),
(0, 'samuel', '111111', 'wwwwww', 'eeeee', 'eee@gm', '3'),
(0, 'samuel', '111111', 'wwwwww', 'eeeee', 'eee@gm', '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`Class_id`);

--
-- Indexes for table `librarys`
--
ALTER TABLE `librarys`
  ADD PRIMARY KEY (`Book_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`Payment_id`),
  ADD KEY `fk_payments_student_id` (`Stu_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

