CREATE TABLE `Recruiter`
(
  `Username` VARCHAR(255) NOT NULL,
  `Password` VARCHAR(255) NOT NULL,
  `Department` VARCHAR(255) NOT NULL,
  `Full_Name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`Username`)
);

CREATE TABLE `Job`
(
  `Department` VARCHAR(255) NOT NULL,
  `Job_Name` VARCHAR(255) NOT NULL,
  `Description` VARCHAR(255) NOT NULL,
  `Quota` INT(11) NOT NULL,
  `Deadline` DATE NOT NULL,
  PRIMARY KEY (`Department`, `Job_Name`)
);

CREATE TABLE `Applicant`
(
  `Full_Name` VARCHAR(255) NOT NULL,
  `IC` VARCHAR(255) NOT NULL,
  `Phone_No.` INT(11) NOT NULL,
  `DOB` DATE NOT NULL,
  `Gender` VARCHAR(255) NOT NULL,
  `Email_Address` VARCHAR(255) NOT NULL,
  `Job_Name` VARCHAR(255) NOT NULL,
  `Work_Experience` INT(11) NOT NULL,
  `Level_of_Education` VARCHAR(255) NOT NULL,
  `Major` VARCHAR(255) NOT NULL,
  `CV` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`IC`)
);

CREATE TABLE `Manages`
(
  `Username` VARCHAR(255) NOT NULL,
  `Department` VARCHAR(255) NOT NULL,
  `Name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`Username`, `Department`, `Name`),
  FOREIGN KEY (`Username`) REFERENCES `Recruiter`(`Username`),
  FOREIGN KEY (`Department`, `Name`) REFERENCES `Job`(`Department`, `Job_Name`)
);

CREATE TABLE `Applies`
(
  `Applicant_No.` INT(11) NOT NULL,
  `IC` VARCHAR(255) NOT NULL,
  `Department` VARCHAR(255) NOT NULL,
  `Name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`IC`, `Department`, `Name`),
  FOREIGN KEY (`IC`) REFERENCES `Applicant`(`IC`),
  FOREIGN KEY (`Department`, `Name`) REFERENCES `Job`(`Department`, `Job_Name`)
);