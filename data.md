copy text below and add into SQL:

```SQL
INSERT INTO `job` 
(`jobName`, `department`, `quota`, `jDescription`, `minQualification`, `numExperience`, `jRequirements`, `closeDate`, `minQualificationIndex`) 
VALUES 
('Korean Language Lecturer', 'Language', '2', 'Teach Korean Language', 'Masters', '2', 'Fluent in Korean Language', '2022-04-24', '5'), 
('Janitor', 'Science', '20', 'Cleaning', 'Olevel', '0', 'Hardworking', '2022-04-24', '1'),
('Cybersecurity Lecturer', 'Science', '1', 'Teach Students', 'PHD', '3', 'Knowledgeable', '2022-04-24', '6');


INSERT INTO `applicant` 
(`Full_Name`, `IC`, `Phone_No`, `DOB`, `Gender`, `Email_Address`, `jobName`, `Work_Experience`, `Level_of_Education`, `Major`, `CV`, `Level_of_Education_Index`, `Applicant_status`, `File_Location`) 
VALUES 
('John Doe', '0000001', '111111', '1990-04-01', 'male', 'johnDoe@gmail.com', 'Korean Language Lecturer', '1', 'PHD', 'testing', 'cv.pdf', '6', 'Pending', './uploads/'),
('Marry Smith', '0000002', '222222', '1990-04-01', 'female', 'marrySmith@gmail.com', 'Janitor', '3', 'O Level', 'testing', 'cv.pdf', '1', 'Pending', './uploads/'),
('Jackson Hills', '0000003', '333333', '1990-04-01', 'male', 'jacksonHills@gmail.com', 'Cybersecurity Lecturer', '0', 'A Level', 'testing', 'cv.pdf', '1', 'Rejected', './uploads/');
```
