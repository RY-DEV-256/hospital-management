-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2023 at 03:52 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin256');

-- --------------------------------------------------------

--
-- Table structure for table `admissions`
--

CREATE TABLE `admissions` (
  `admission_id` int(10) NOT NULL,
  `patient_id` int(10) NOT NULL,
  `doctor_id` int(10) NOT NULL,
  `admission_date` int(20) NOT NULL,
  `discharge_date` int(20) NOT NULL,
  `room_number` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(10) NOT NULL,
  `patient_id` int(10) NOT NULL,
  `doctor_id` int(10) NOT NULL,
  `date` date NOT NULL,
  `time` time(6) NOT NULL,
  `purpose` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(10) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `department_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`, `department_description`) VALUES
(1, 'Emergency Department', 'The emergency department is where patients with acute and life-threatening medical conditions are treated. It operates 24/7 and provides immediate medical care.'),
(2, 'Internal Medicine', 'This department deals with the diagnosis and treatment of internal medical conditions. Physicians in this department are often referred to as internists.'),
(3, 'Surgery', 'The surgical department is responsible for various surgical procedures, including general surgery, orthopedic surgery, neurosurgery, and more.'),
(4, 'Pediatrics', 'This department specializes in the care of infants, children, and adolescents. Pediatricians are the medical practitioners in this department.'),
(5, 'Obstetrics and Gynecology', 'This department focuses on women\'s health, including pregnancy, childbirth, and reproductive health.'),
(6, 'Cardiology', 'Cardiologists in this department deal with heart-related issues, including diagnosis and treatment of heart diseases.'),
(7, 'Orthopedics', 'The orthopedic department specializes in the diagnosis and treatment of musculoskeletal conditions, such as bone and joint disorders.'),
(8, 'Ophthalmology', 'Ophthalmologists in this department focus on eye care and visual health.'),
(9, 'ENT (Ear, Nose, and Throat)', 'ENT specialists, or otolaryngologists, diagnose and treat conditions related to the ear, nose, and throat.'),
(10, 'Neurology', ' Neurologists in this department address disorders of the nervous system, including the brain and spinal cord.'),
(11, 'Dermatology', 'Dermatologists specialize in skin-related issues and conditions.'),
(12, 'Radiology', 'Radiology departments handle medical imaging, such as X-rays, CT scans, MRIs, and ultrasounds.'),
(13, 'Pathology', 'Pathologists in this department analyze tissue samples and perform laboratory tests to diagnose diseases.'),
(14, 'Anesthesiology', 'Anesthesiologists are responsible for administering anesthesia to patients before surgery and monitoring their vital signs during the procedure.'),
(15, 'Psychiatry', 'The psychiatric department focuses on mental health and provides counseling, therapy, and treatment for psychiatric disorders.'),
(16, 'Physical Therapy and Rehabilitation', 'This department offers physical therapy services to help patients recover from injuries and surgeries.'),
(17, 'Pharmacy', 'The pharmacy department manages and dispenses medications prescribed to patients.'),
(18, 'Laboratory Services', 'The laboratory department conducts various diagnostic tests, including blood tests and microbiological analyses.'),
(19, 'Nursing', 'Nursing departments are responsible for patient care, including administering medication, monitoring patients, and providing support.'),
(20, 'Nutrition and Dietetics', 'Dietitians in this department provide dietary guidance and meal planning for patients with specific dietary needs.'),
(21, 'Administration', 'Hospital administration manages the overall operations, budgeting, and strategic planning of the hospital.'),
(22, 'Quality and Safety', 'This department focuses on ensuring the quality and safety of patient care and may include risk management and compliance functions.');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `specialization` varchar(20) NOT NULL,
  `department` varchar(20) NOT NULL,
  `addresss` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `username`, `password`, `first_name`, `last_name`, `specialization`, `department`, `addresss`, `email`, `phone_number`) VALUES
(1, 'Richard', 'ry', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `inpatients`
--

CREATE TABLE `inpatients` (
  `inpatient_id` int(10) NOT NULL,
  `admission_id` int(10) NOT NULL,
  `room_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(10) NOT NULL,
  `patient_id` int(10) NOT NULL,
  `date` date NOT NULL,
  `total` varchar(100) NOT NULL,
  `payment_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `laboratory`
--

CREATE TABLE `laboratory` (
  `lab_test_id` int(10) NOT NULL,
  `patient_id` int(10) NOT NULL,
  `test_name` int(100) NOT NULL,
  `test_date` int(100) NOT NULL,
  `test_result` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `medicine_id` int(10) NOT NULL,
  `medicine_name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `stock_quantity` varchar(100) NOT NULL,
  `unit_price` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `outpatients`
--

CREATE TABLE `outpatients` (
  `outpatient_id` int(10) NOT NULL,
  `appointment_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int(10) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL,
  `location` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `first_name`, `last_name`, `gender`, `date_of_birth`, `email`, `phone`, `password`, `location`) VALUES
(2, 'Mac', 'A', 'Female', '2000-04-04', 'mac@gmail.com', '0755591263', 'mac@256', 'Mbarara'),
(3, 'Dan', 'Omara', 'Male', '2001-03-21', 'dan@gmail.com', '077654334', 'dan@256', 'Lira');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy`
--

CREATE TABLE `pharmacy` (
  `pharmacy_id` int(10) NOT NULL,
  `prescription_id` int(10) NOT NULL,
  `medicine_id` int(10) NOT NULL,
  `quantity_dispensed` varchar(100) NOT NULL,
  `dispense_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `prescription_id` int(10) NOT NULL,
  `patient_id` int(10) NOT NULL,
  `doctor_id` int(10) NOT NULL,
  `date` date NOT NULL,
  `medication` varchar(100) NOT NULL,
  `dosage` varchar(100) NOT NULL,
  `instructions` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_number` int(10) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `room_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admissions`
--
ALTER TABLE `admissions`
  ADD PRIMARY KEY (`admission_id`),
  ADD KEY `pat_id` (`patient_id`),
  ADD KEY `doc_id` (`doctor_id`),
  ADD KEY `admission_room_number` (`room_number`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `appointment_doc_id` (`doctor_id`),
  ADD KEY `appointment_pat_id` (`patient_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `inpatients`
--
ALTER TABLE `inpatients`
  ADD PRIMARY KEY (`inpatient_id`),
  ADD KEY `inpatient_admission_id` (`admission_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `invoice_pat_id` (`patient_id`);

--
-- Indexes for table `laboratory`
--
ALTER TABLE `laboratory`
  ADD PRIMARY KEY (`lab_test_id`),
  ADD KEY `lab_pat_id` (`patient_id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medicine_id`);

--
-- Indexes for table `outpatients`
--
ALTER TABLE `outpatients`
  ADD PRIMARY KEY (`outpatient_id`),
  ADD KEY `outpatient_app_id` (`appointment_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD PRIMARY KEY (`pharmacy_id`),
  ADD KEY `pharmachy_pres_id` (`prescription_id`),
  ADD KEY `pharmachy_med_id` (`medicine_id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`prescription_id`),
  ADD KEY `prescription_pat_id` (`patient_id`),
  ADD KEY `prescription_doc_id` (`doctor_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_number`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admissions`
--
ALTER TABLE `admissions`
  MODIFY `admission_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inpatients`
--
ALTER TABLE `inpatients`
  MODIFY `inpatient_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laboratory`
--
ALTER TABLE `laboratory`
  MODIFY `lab_test_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medicine_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `outpatients`
--
ALTER TABLE `outpatients`
  MODIFY `outpatient_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pharmacy`
--
ALTER TABLE `pharmacy`
  MODIFY `pharmacy_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `prescription_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_number` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admissions`
--
ALTER TABLE `admissions`
  ADD CONSTRAINT `admission_room_number` FOREIGN KEY (`room_number`) REFERENCES `room` (`room_number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doc_id` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pat_id` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointment_doc_id` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_pat_id` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inpatients`
--
ALTER TABLE `inpatients`
  ADD CONSTRAINT `inpatient_admission_id` FOREIGN KEY (`admission_id`) REFERENCES `admissions` (`admission_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_pat_id` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laboratory`
--
ALTER TABLE `laboratory`
  ADD CONSTRAINT `lab_pat_id` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `outpatients`
--
ALTER TABLE `outpatients`
  ADD CONSTRAINT `outpatient_app_id` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`appointment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD CONSTRAINT `pharmachy_med_id` FOREIGN KEY (`medicine_id`) REFERENCES `medicine` (`medicine_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pharmachy_pres_id` FOREIGN KEY (`prescription_id`) REFERENCES `prescriptions` (`prescription_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescription_doc_id` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prescription_pat_id` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
