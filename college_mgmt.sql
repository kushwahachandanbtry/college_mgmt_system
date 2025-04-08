-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2025 at 05:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `college_mgmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `attendance` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `attendance`) VALUES
(1, '{\"name\":\"chandan kushwahah\",\"admission_id\":\"1\",\"class\":\"BCA\",\"semester\":\"1st\",\"subject\":\"math I\",\"status\":\"1\",\"date\":\"2025-04-08\",\"taken_by\":\"yeti\"}');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `heading` text NOT NULL,
  `overview` text NOT NULL,
  `image` varchar(200) NOT NULL,
  `publisher` varchar(100) NOT NULL,
  `publish_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `bname` varchar(40) NOT NULL,
  `wname` varchar(50) NOT NULL,
  `class` varchar(20) NOT NULL,
  `pubdate` varchar(20) NOT NULL,
  `book_id` varchar(20) NOT NULL,
  `uploade` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `bname`, `wname`, `class`, `pubdate`, `book_id`, `uploade`) VALUES
(8, 'Computer', 'Raj', 'BCA', '03/1/2024', '1', '16/09/2024'),
(9, 'Science', 'Raj', 'BBA', '03/11/2022', '1', '16/09/2024');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `history` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `history`, `name`, `phone`, `email`, `created_at`) VALUES
(1, '[{\"question\":\"Which course?\",\"answer\":\"BA( MICE [Event] Management)~ BA-MM\"},{\"question\":\"What is your name?\",\"answer\":\"chandan\"},{\"question\":\"What is your phone number?\",\"answer\":\"9823196848\"},{\"question\":\"What is your email address?\",\"answer\":\"chandan@gmail.com\"}]', 'chandan', '9823196848', 'chandan@gmail.com', '2025-04-08 09:29:31');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `classes` varchar(10) NOT NULL,
  `university` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `classes`, `university`) VALUES
(1, 'bca', 'tu'),
(2, 'bhm', 'spu'),
(3, 'bba', 'TU');

-- --------------------------------------------------------

--
-- Table structure for table `college_info`
--

CREATE TABLE `college_info` (
  `id` int(11) NOT NULL,
  `college_name` varchar(255) NOT NULL,
  `college_address` text NOT NULL,
  `country_code` varchar(20) NOT NULL,
  `college_phone` varchar(100) NOT NULL,
  `college_email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `college_info`
--

INSERT INTO `college_info` (`id`, `college_name`, `college_address`, `country_code`, `college_phone`, `college_email`) VALUES
(3, 'Yeti Int\'l College', 'Buddhanagar, Kathmandu ', 'NP', '9803323042', 'yeti@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `contact_users`
--

CREATE TABLE `contact_users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_users`
--

INSERT INTO `contact_users` (`id`, `name`, `phone`, `email`, `comment`) VALUES
(1, 'chandan kushwahah', '9823196848', 'chandan@gmail.com', 'ftsdfsw'),
(2, 'chandan kushwahah', '9823196848', 'chandan@gmail.com', 'test'),
(3, 'chandan kushwahah', '9823196848', 'chandan@gmail.com', 'test2');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_title` text NOT NULL,
  `duration` int(11) NOT NULL,
  `intake` varchar(100) NOT NULL,
  `course_description` text NOT NULL,
  `course_image` varchar(255) NOT NULL,
  `categories` varchar(100) NOT NULL,
  `course_objectives` varchar(2000) NOT NULL,
  `syllabus_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_title`, `duration`, `intake`, `course_description`, `course_image`, `categories`, `course_objectives`, `syllabus_image`) VALUES
(1, 'Master in Business Administration (MBA) ', 2, 'March, July , November', 'This program of studies consists of two (2) compulsory basic modules with credit 6 hours, six (6) compulsory modules with credit hours 18, eight (8) core - elective modules with credit hours 24, and two (2) research reports or thesis. These concentrate on essential understanding, methods, & advantageous performance of the contemporary organization. In addition to core practices studied, the course adopts a cross-functional approach by integrating wider managerial perspectives.', 'mba.jpg', 'Graduate', 'To demonstrate the ability to apply quantitative and qualitative reasoning and problem- solving models & justifications to business situations.\r\nTo demonstrate the ability to use technology in research to add value to presentations including professional reports.\r\nTo demonstrate the ability to apply core business principles in business decision-making and business analysis.\r\nTo produce management professionals, business experts, and dynamic entrepreneurs who can lead present organizations and have the vision to establish and run their ventures in long run.', 'mba_syllabus.png'),
(2, 'BA(Hotel & MICE Management)~ BHM', 4, 'March, July , November', 'Service-minded students want to learn creatively with hotel and MICE management courses and real practice around the world in the stateof-the-art Hotel Information System Lab and develop essential skills for real hoteliers. Unlimited fun with ample opportunities to enhance your ability to think, analyze and solve problems during industry oriented class with virtual work environment. Trainings and classes are conducted by the industry experts and well renowned academicians from the relevant fields. To extend knowledge and put the experience into practice!', 'bhm.jpg', 'Undergraduate', 'To acquire knowledge in business and economics that creates and develops well-rounded managers and executives to enable them to compete at the global hospitality and MICE industry level,\r\nTo produce graduates with the capability to integrate and apply the latest technology in hospitality management.\r\nTo contribute to the country’s development by producing graduates that fulfill the requirements of both private and public sectors in the MICE, tourism, and hospitality industry.', 'bhm syllabus (1).jpg'),
(3, 'BA(Airlines Business Management) BA-ABM', 4, 'March, July , November', 'Landing at SPU Airline, an airline where students learn from real laborato- ries! Ready to pave the way to the air hostess and air-ground for students! Build young people to have qualifications that match the aviation labor market. After all, there is a job to do! with state-of-the-art courses in the laboratory that simulates from the airport to the plane to practice Pass on knowledge from people who have direct experience in the aviation business to be proficient in both theory and practice Ready to fly with dignity. Awesome course not just focusing on knowledge in textbooks but here we focus on real practice in standard laboratories. Both ground service and in-flight service to Aviation Business Management Tighten your strengths in English and a third language.', 'ba-abm.jpg', 'Undergraduate', 'To develop an understanding of the airline industry,\r\nTo acquire knowledge of airline business management,\r\nTo understand airline marketing & customer service,\r\nTo study airline operations and logistics,\r\nTo develop skills in airline business analysis and decision-making,\r\nTo gain knowledge of aviation regulations and policy,\r\nTo foster an understanding of global aviation trends and challenges,', 'ba-abm syllabus (1).jpg'),
(4, 'BA( MICE [Event] Management)~ BA-MM', 4, 'March, July , November', 'The BA in MICE (Event) Management program at Sripatum University and YETI International College offers a comprehensive curriculum designed to equip students with the knowledge and skills required to succeed in the dynamic events industry. The program covers event planning, design, marketing, budgeting, risk management, and execution. Students gain hands-on experience through practical projects, internships, and industry interactions. The curriculum also emphasizes leadership, communication, and problem-solving skills, preparing graduates for a wide range of career opportunities in event management, hospitality, tourism, and related fields.', 'ba-mm.jpg', 'Undergraduate', 'Embark on an exciting journey into the dynamic world of events and conferences with a BA in MICE (Event) Management at Sripatum University, in partnership with YETI International College. Here\'s why this program is your gateway to a successful career in the thriving events industry:\r\n\r\n1. Experienced Faculty with Industry Expertise: Learn from seasoned professionals who have real-world experience in organizing and managing successful events, ensuring you receive practical and relevant education.\r\n\r\n2. Strong Industry Connections: Benefit from the university\'s network of event industry partners, providing opportunities for internships, job placements, and networking with potential employers.\r\n\r\n3. Focus on Practical Skills: Go beyond theory with hands-on learning experiences, simulations, and real-world projects that prepare you for the challenges and complexities of event management.\r\n\r\n4. Emphasis on Creativity and Innovation: Develop your creative thinking and problem-solving skills to design unique and memorable events that stand out in the competitive market.\r\n\r\n5. Holistic Development: Develop essential soft skills like communication, leadership, negotiation, and time management, which are crucial for success in the event industry.', 'ba-mm syllabus (1).jpg'),
(5, 'BA( Tourism & MICE Management)~ BTTM', 4, 'March, July , November', 'The BA in MICE (Event) Management program at Sripatum University and YETI International College offers a comprehensive curriculum designed to equip students with the knowledge and skills required to succeed in the dynamic events industry. The program covers event planning, design, marketing, budgeting, risk management, and execution. Students gain hands-on experience through practical projects, internships, and industry interactions. The curriculum also emphasizes leadership, communication, and problem-solving skills, preparing graduates for a wide range of career opportunities in event management, hospitality, tourism, and related fields.', 'ba-bttm.jpg', 'Undergraduate', '1. Globally Recognized Curriculum: Sripatum University\'s curriculum is aligned with international standards, ensuring graduates possess the knowledge and skills relevant in the global tourism and MICE landscape.\r\n\r\n2. Industry-Relevant Skills: The program focuses on developing practical skills such as event planning, marketing, budgeting, and client management, which are essential for success in the industry.\r\n3. Experienced Faculty: Learn from experienced faculty members who bring industry insights and expertise into the classroom, bridging the gap between theory and practice.\r\n\r\n4. State-of-the-Art Facilities: YETI INT\'L College provides modern facilities, including computer labs and simulation rooms, to enhance learning and practical experience.\r\n\r\n5. Internship Opportunities: Gain hands-on experience through internships with leading hotels, event companies, and tourism organizations, boosting your employability.\r\n\r\nScope and Career Prospects of BTTM\r\n\r\n1. Event Management: Graduates can work as event planners, coordinators, or managers, organizing various events such as conferences, exhibitions, weddings, and festivals.\r\n\r\n2. Tourism Management: Opportunities exist in travel agencies, tour operators, hotels, and resorts, where graduates can work in roles such as tourism marketing, customer service, or operations management.\r\n\r\n3. MICE Industry: MICE (Meetings, Incentives, Conferences, and Exhibitions) is a growing sector, and graduates can specialize in planning and executing MICE events for corporate clients.\r\n\r\n4. Hospitality Industry: The skills acquired in this program are highly transferable to the hospitality industry, where graduates can work in hotels, restaurants, or cruise lines.\r\n\r\n5. Government and Tourism Boards: Government tourism departments and tourism boards offer roles in tourism promotion, policy development, and research.', 'bttm syllabus (1).jpg'),
(6, 'Bachelor of Computer Application(BCA)', 4, 'March, July ', 'YETI International College(former Bhadra Ghale Multiple Campus) was established in 2005 and completed all the procedures of official registration, reorganization, and approval from Tribhuvan University in January 2008. The college initially operated the Bachelor of Business Studies(BBS) program under the Faculty of Management. In September 2018, the Faculty of Humanities and Social Sciences approved the Bachelor of Computer Application (BCA) program. YETI is imparting technical international standards in the field of professionalism. Recently YETI has been managed by a dedicated group of academicians with the vision to provide quality education at affordable prices in Nepal.', 'bca.jpg', 'Undergraduate', '1. To produce professionals in the field of computer applications as programmers and software developers.\r\n\r\n2. To provide knowledge about various tools and techniques used in software development.\r\n\r\n3. To provide students with both practical and theoretical aspects of studies related to computer applications.\r\n\r\n4. To provide students a fine base to continue their higher studies.', 'bca syllabus (1).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `exam_routine`
--

CREATE TABLE `exam_routine` (
  `id` int(11) NOT NULL,
  `class` varchar(100) NOT NULL,
  `year_or_semester` varchar(10) NOT NULL,
  `running_sem_or_year` varchar(10) NOT NULL,
  `images` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_routine`
--

INSERT INTO `exam_routine` (`id`, `class`, `year_or_semester`, `running_sem_or_year`, `images`) VALUES
(2, 'BHM', 'year', '4', '5bd14f19d5184-wallpaper-preview.jpg'),
(3, 'BCA', 'semester', '5', '05e2182f79b9001a76644ea7b72a26ec.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `FAQ_title` varchar(255) NOT NULL,
  `FAQ_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `FAQ_title`, `FAQ_description`) VALUES
(1, 'What programs and courses does the college offer?', 'Our college offers undergraduate, postgraduate, and diploma programs across various fields, including arts, science, commerce, engineering, management, and more. Visit the [Programs page] for a complete list.'),
(2, 'What are the eligibility criteria for admission?', 'Eligibility criteria vary depending on the program. Generally, undergraduate programs require completion of high school, while postgraduate programs require a bachelor\'s degree in a relevant field. Check the [Admissions page] for detailed requirements.'),
(3, 'Does the college offer scholarships or financial aid?', 'Yes, we provide scholarships based on academic performance, financial need, and other criteria. Learn more about eligibility and application procedures on the [Scholarships page].'),
(4, 'How can I apply for admission?', 'You can apply online through our [Admission Portal] or submit a physical application form at the college\'s admission office. Visit the [Admissions Process page] for step-by-step guidance.'),
(5, 'What are the campus facilities available?', 'Our campus includes a library, laboratories, sports facilities, hostels, a cafeteria, and student recreation areas. Explore the [Campus Facilities page] for a virtual tour.');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `features_title` varchar(100) NOT NULL,
  `features_heading` varchar(100) NOT NULL,
  `features_description` text NOT NULL,
  `features_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `features_title`, `features_heading`, `features_description`, `features_image`) VALUES
(2, 'lab and Internet', 'Computer lab and Internet', 'The college runs professional business programs based on efficient learning modules. Most BA-HM (BHM), MBA, and BCA curricula require computer support. To meet this need, the college has ensured the availability of a sophisticated computer lab equipped with branded computers, all connected to the Internet through a dedicated 100/100 Mbps lease line serving the needs of 400 students at a time.', '05e2182f79b9001a76644ea7b72a26ec.jpg'),
(3, 'Classrooms updated', 'Classrooms and surroundings', 'The classrooms of Yeti College have an in-built multi-media facility, audio-visual, and computer access. CCTV surveillance covers all the classrooms and most college areas ensuring a safe and secure learning environment.', '5bd14f19d5184-wallpaper-preview.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `image_name`, `image_path`) VALUES
(1, 'Chandan', 'IMG20241101170dfd956.jpg'),
(2, 'Rupesh', '448461924_2232329540461838_259339875270183246_n.jpg'),
(3, 'Pream', 'IMG20241101170841.jpg'),
(4, 'Lab', '265209702_128049319664543_8856147794274129357_n.jpg'),
(5, 'BHM practical', 'bhm.jpeg'),
(6, 'BHM practical', 'WhatsApp Image 2024-05-15 at 12.34.58 PM (1).jpeg'),
(7, 'BHM', 'WhatsApp Image 2024-05-15 at 12.34.52 PM.jpeg'),
(8, 'Fairwell program', '131.jpg'),
(9, 'Fairwell program', '132.jpg'),
(10, 'Fairwell program', '199.jpg'),
(11, 'Fairwell program', '110.png'),
(12, 'FEST program', '141.jpg'),
(13, 'FEST program', '40.jpg'),
(14, 'FEST program', '40.jpg'),
(15, 'Fairwell program', '198.jpg'),
(16, 'FEST program', '188.jpg'),
(17, 'FEST program', '196.jpg'),
(18, 'FEST program', '194.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `home-logo`
--

CREATE TABLE `home-logo` (
  `id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_logo`
--

CREATE TABLE `home_logo` (
  `id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home_logo`
--

INSERT INTO `home_logo` (`id`, `image`) VALUES
(1, 'logo.svg');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `email`, `status`) VALUES
(7, 'admin@gmail.com', '1'),
(8, 'admin@gmail.com', '1'),
(9, 'admin@gmail.com', '1'),
(10, 'admin@gmail.com', '1'),
(11, 'admin@gmail.com', '0');

-- --------------------------------------------------------

--
-- Table structure for table `map`
--

CREATE TABLE `map` (
  `id` int(11) NOT NULL,
  `iframe` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `map`
--

INSERT INTO `map` (`id`, `iframe`) VALUES
(1, 'sdfs'),
(2, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d455078.9424886373!2d85.00380765827418!3d26.988924127416578!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ec98ca3b6597e7%3A0x5966575fdf56e9d2!2sRautahat!5e0!3m2!1sen!2snp!4v1729838666275!5m2!1sen!2snp\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` bigint(20) NOT NULL,
  `msgid` varchar(60) NOT NULL,
  `sender` bigint(20) NOT NULL,
  `receiver` bigint(20) NOT NULL,
  `message` text NOT NULL,
  `files` text DEFAULT NULL,
  `date` datetime NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `received` int(11) NOT NULL DEFAULT 0,
  `deleted_sender` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_receiver` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `msgid`, `sender`, `receiver`, `message`, `files`, `date`, `seen`, `received`, `deleted_sender`, `deleted_receiver`) VALUES
(1, '5ZafbjkiEEwMzGwdE5JhsgTcfCI', 12216276, 8320675418029, 'hello', NULL, '2024-11-22 14:01:22', 0, 1, 0, 0),
(2, '5ZafbjkiEEwMzGwdE5JhsgTcfCI', 12216276, 8320675418029, 'how are you', NULL, '2024-11-22 14:01:35', 0, 1, 0, 0),
(3, '2D4QivKPP09c2oSP7Xkmgi8', 359451399834431432, 12216276, 'sdfsd', NULL, '2024-11-22 14:44:47', 1, 1, 1, 0),
(4, '2D4QivKPP09c2oSP7Xkmgi8', 12216276, 359451399834431432, 'skldfjsdklf', NULL, '2024-11-22 16:25:00', 1, 1, 0, 0),
(5, '2D4QivKPP09c2oSP7Xkmgi8', 12216276, 359451399834431432, 'sdfsdf', NULL, '2024-11-22 16:25:02', 1, 1, 0, 1),
(6, 'OZatEdniypgQ4QKFULnbRaNUAePUNJU', 894, 4, 'sdfsd', NULL, '2024-11-25 07:46:55', 1, 1, 1, 0),
(7, 'OZatEdniypgQ4QKFULnbRaNUAePUNJU', 894, 4, 'sdfdsf', NULL, '2024-11-25 07:47:10', 1, 1, 1, 0),
(8, 'OZatEdniypgQ4QKFULnbRaNUAePUNJU', 4, 894, 'lsdfjsd', NULL, '2024-11-26 03:16:32', 1, 1, 1, 1),
(9, 'OZatEdniypgQ4QKFULnbRaNUAePUNJU', 4, 894, 'jlksdfhsd', NULL, '2024-11-26 03:18:33', 1, 1, 0, 1),
(10, 'OZatEdniypgQ4QKFULnbRaNUAePUNJU', 894, 4, 'hello', NULL, '2024-11-29 08:13:01', 1, 1, 0, 0),
(11, 'OZatEdniypgQ4QKFULnbRaNUAePUNJU', 894, 4, 'sdfsdf', NULL, '2024-11-29 08:13:19', 0, 0, 0, 0),
(12, 'iJNF9kn866dbGQDnHvnmsxKN', 221116416, 335548718849331, 'hello chandan', NULL, '2024-12-12 05:39:15', 1, 1, 0, 0),
(13, 'iJNF9kn866dbGQDnHvnmsxKN', 335548718849331, 221116416, 'hii ramesh', NULL, '2024-12-12 05:39:31', 1, 1, 0, 0),
(14, 'iJNF9kn866dbGQDnHvnmsxKN', 221116416, 335548718849331, 'hello', NULL, '2024-12-12 09:52:30', 1, 1, 1, 0),
(15, 'urgDktmOHPnFnxZZuOLZ', 0, 335548718849331, 'heelo', NULL, '2025-01-05 04:54:13', 0, 0, 0, 0),
(16, 'trd36znprvUU4smFoFZS65wYK6nFqUewmos1ydzarTifVpnFOvqxQ', 63269363, 32859348, 'hryugjyh', NULL, '2025-01-08 03:48:37', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `meta_setting`
--

CREATE TABLE `meta_setting` (
  `id` int(11) NOT NULL,
  `pages` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `canonical_tag` varchar(255) NOT NULL,
  `og_title` varchar(255) NOT NULL,
  `og_description` text NOT NULL,
  `og_url` varchar(255) NOT NULL,
  `og_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `details` text NOT NULL,
  `posted_by` varchar(255) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `title`, `details`, `posted_by`, `date`) VALUES
(2, 'test', 'details', 'chandan', 'Monday 28th of October 2024 06:23:57 PM'),
(3, 'drtgdr', 'dgfdsgf', 'chandan', 'Thursday 21st of November 2024 08:57:20 AM'),
(4, '21', 'fdgdfgdg', 'dffgdg', 'Wednesday 4th of December 2024 02:08:07 PM'),
(5, 'sdfs', 'sdfdsfs', 'sdfsdf', 'Wednesday 4th of December 2024 02:10:33 PM'),
(6, 'ch', 'sdfsdf', 'sdfsd', 'Wednesday 4th of December 2024 02:10:43 PM'),
(7, 'sdfs', 'sdfsdfs', 'sdfs', 'Wednesday 4th of December 2024 02:11:39 PM'),
(8, 'ch', 'sdfsd', 'sdfs', 'Wednesday 4th of December 2024 02:25:42 PM');

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `occupation` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(30) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `childrens_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`id`, `name`, `gender`, `occupation`, `email`, `address`, `phone`, `childrens_name`) VALUES
(2, 'chandan kushwaha', 'male', 'farmer', 'chandan@gmail.com', 'Imadol', '9823196848', 'dsfwrfew');

-- --------------------------------------------------------

--
-- Table structure for table `popup`
--

CREATE TABLE `popup` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `bio` varchar(200) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `username`, `name`, `bio`, `image`) VALUES
(1, 'kushwahhachandan@gmail.com', 'chadnan', 'sdfdsfdsfsdaf', 'download (1).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `registered_users`
--

CREATE TABLE `registered_users` (
  `id` int(11) NOT NULL,
  `fname` varchar(40) NOT NULL,
  `mname` varchar(40) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `phone` int(10) NOT NULL,
  `fathername` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `course` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registered_users`
--

INSERT INTO `registered_users` (`id`, `fname`, `mname`, `lname`, `phone`, `fathername`, `email`, `password`, `course`, `gender`, `address`) VALUES
(1, 'chandan', '', 'kushwahah', 2147483647, '', 'chandan@gmail.com', 'chandan@123', 'BCA', 'male', 'Imadol');

-- --------------------------------------------------------

--
-- Table structure for table `routines`
--

CREATE TABLE `routines` (
  `id` int(11) NOT NULL,
  `class` varchar(20) NOT NULL,
  `routine` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `routines`
--

INSERT INTO `routines` (`id`, `class`, `routine`) VALUES
(11, '11', '{\"sunday\":{\"1st\":\"sf\",\"2nd\":\"sdf\",\"3rd\":\"sdf\",\"break\":\"2-3\",\"4th\":\"ewf\",\"5th\":\"sef\"},\"monday\":{\"1st\":\"rewf\",\"2nd\":\"sdf\",\"3rd\":\"sdf\",\"break\":\"2-3\",\"4th\":\"sfd\",\"5th\":\"sef\"},\"tuesday\":{\"1st\":\"sdfv\",\"2nd\":\"xcv\",\"3rd\":\"sdf\",\"break\":\"2-3\",\"4th\":\"sfd\",\"5th\":\"sef\"},\"wednesday\":{\"1st\":\"sdf\",\"2nd\":\"sdf\",\"3rd\":\"er\",\"break\":\"2-3\",\"4th\":\"sdf\",\"5th\":\"sfewef\"},\"thrusdady\":{\"1st\":\"sdf\",\"2nd\":\"sdf\",\"3rd\":\"sdf\",\"break\":\"2-3\",\"4th\":\"sef\",\"5th\":\"sdf\"},\"friday\":{\"1st\":\"sdfr\",\"2nd\":\"sdf\",\"3rd\":\"sdf\",\"break\":\"2-3\",\"4th\":\"sf\",\"5th\":\"sfd\"}}'),
(12, 'BCA', '{\"sunday\":{\"1st\":\"sf\",\"2nd\":\"sdf\",\"3rd\":\"sdf\",\"break\":\"sdf\",\"4th\":\"ewf\",\"5th\":\"sef\"},\"monday\":{\"1st\":\"rewf\",\"2nd\":\"sdf\",\"3rd\":\"sdf\",\"break\":\"sfd\",\"4th\":\"sfd\",\"5th\":\"sef\"},\"tuesday\":{\"1st\":\"sdfv\",\"2nd\":\"xcv\",\"3rd\":\"sdf\",\"break\":\"sdf\",\"4th\":\"sfd\",\"5th\":\"sef\"},\"wednesday\":{\"1st\":\"sdf\",\"2nd\":\"sdf\",\"3rd\":\"er\",\"break\":\"sdf\",\"4th\":\"sdf\",\"5th\":\"sfewef\"},\"thrusdady\":{\"1st\":\"sdf\",\"2nd\":\"sdf\",\"3rd\":\"sdf\",\"break\":\"sdf\",\"4th\":\"sef\",\"5th\":\"sdf\"},\"friday\":{\"1st\":\"sdfr\",\"2nd\":\"sdf\",\"3rd\":\"sdf\",\"break\":\"sf\",\"4th\":\"sf\",\"5th\":\"sfd\"}}');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service_title` varchar(255) NOT NULL,
  `service_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_title`, `service_description`) VALUES
(1, 'Academic Support Services', 'Comprehensive guidance through tutoring, academic counseling, and mentorship programs to help students excel in their studies.'),
(2, 'Career Development and Placement', 'Assistance with internships, job placement, resume building, and career counseling to prepare students for successful professional futures.'),
(3, 'Library and Information Resources', 'Access to a vast collection of physical and digital resources, including books, journals, and research tools, along with dedicated study spaces.'),
(4, 'Health and Wellness Services', 'On-campus medical facilities, mental health counseling, and fitness programs to support the overall well-being of students.');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `slider_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `slider_img`) VALUES
(3, '[\"istockphoto-629628952-612x612.jpg\",\"json.webp\",\"json1.png\"]');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `staff_name` varchar(255) NOT NULL,
  `staff_phone` varchar(50) NOT NULL,
  `staff_email` varchar(200) NOT NULL,
  `about_staff` text NOT NULL,
  `staff_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `staff_name`, `staff_phone`, `staff_email`, `about_staff`, `staff_image`) VALUES
(1, 'Ram Dinesh Misra', '45435345', 'chandan@gmail.com', 'fdgf', 'IMG20241101170dfd956.jpg'),
(2, 'sdfsd', '4564356', 'chandan@gmail.com', 'fghdh', 'IMG20241101170956.jpg'),
(3, 'dfgdfgd', '43532', 'chandan@gmail.com', 'dfssd', '430169078_1473210063634241_6871166501460939405_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `status_table`
--

CREATE TABLE `status_table` (
  `id` int(11) NOT NULL,
  `status` enum('on','off') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_table`
--

INSERT INTO `status_table` (`id`, `status`) VALUES
(1, 'off');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `fname` varchar(40) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `blood` varchar(11) NOT NULL,
  `religion` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `admissionid` varchar(20) NOT NULL,
  `section` varchar(10) NOT NULL,
  `shortbio` varchar(400) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `class` varchar(10) NOT NULL,
  `semester` varchar(4) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `fname`, `lname`, `gender`, `dob`, `blood`, `religion`, `email`, `admissionid`, `section`, `shortbio`, `phone`, `class`, `semester`, `image`) VALUES
(5, 'Ananta', 'Mainali', 'male', '2024-10-30', 'A-', 'Islam', 'mainaliak@gmail.com', '12', 'A', 'sdfsdf', '9851079023', 'BBA', '2nd', 'chandan.jpg'),
(6, 'chandan', 'kushwahah', 'male', '2024-11-12', 'A-', 'Hindu', 'chandan@gmail.com', '1', 'A', 'gfdgfdg', '9823196848', 'BCA', '1st', '70.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `s_name` varchar(255) NOT NULL,
  `class` varchar(100) NOT NULL,
  `semester` varchar(100) NOT NULL,
  `teacher` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `s_name`, `class`, `semester`, `teacher`) VALUES
(1, 'math I', 'bca', '1st', 'chandan11 kushwahah');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `fname` varchar(40) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `religions` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `address` varchar(30) NOT NULL,
  `Phone` varchar(12) NOT NULL,
  `shortbio` varchar(200) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `fname`, `lname`, `gender`, `religions`, `email`, `address`, `Phone`, `shortbio`, `image`) VALUES
(12, 'chandan11', 'kushwahah', 'male', 'Hindu', 'chandan@gmail.com', 'Imadol', '9823196848', 'dfgbdf', 'WIN_20241018_18_27_45_Pro.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `userid` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `password` varchar(64) NOT NULL,
  `image` varchar(500) NOT NULL,
  `date` datetime NOT NULL,
  `online` int(11) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userid`, `username`, `email`, `gender`, `password`, `image`, `date`, `online`, `role`) VALUES
(1, 978962642266382, 'yeti', 'yeti@gmail.com', '', '$2y$10$.MXhR3DCBzVDD17gojfrJ.hmrCO3TUcypAqQN0UurOOS86AGr.2Qy', '67f492756043e_logo (2).png', '0000-00-00 00:00:00', 0, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `video_and_content`
--

CREATE TABLE `video_and_content` (
  `id` int(11) NOT NULL,
  `video_heading` varchar(255) NOT NULL,
  `video_description` text NOT NULL,
  `video_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `video_and_content`
--

INSERT INTO `video_and_content` (`id`, `video_heading`, `video_description`, `video_file`) VALUES
(1, '𝟭𝟮𝘁𝗵 𝗔𝗻𝗻𝘂𝗮𝗹 𝗗𝗮𝘆, 𝗙𝗮𝗿𝗲𝘄𝗲𝗹𝗹 𝗮𝗻𝗱 𝗪𝗲𝗹𝗰𝗼𝗺𝗲 𝗣𝗿𝗼𝗴𝗿𝗮𝗺 𝟮𝟬𝟴𝟬 || Yeti International College ', '𝟭𝟮𝘁𝗵 𝗔𝗻𝗻𝘂𝗮𝗹 𝗗𝗮𝘆, 𝗙𝗮𝗿𝗲𝘄𝗲𝗹𝗹 𝗮𝗻𝗱 𝗪𝗲𝗹𝗰𝗼𝗺𝗲 𝗣𝗿𝗼𝗴𝗿𝗮𝗺 𝟮𝟬𝟴𝟬!!!👨‍🎓👩‍🎓\r\n𝐅𝐫𝐨𝐦 𝐅𝐫𝐞𝐬𝐡𝐦𝐞𝐧 𝐭𝐨 𝐀𝐥𝐮𝐦𝐧𝐢. 𝐀 𝐒𝐩𝐞𝐜𝐭𝐚𝐜𝐮𝐥𝐚𝐫 𝐅𝐚𝐫𝐞𝐰𝐞𝐥𝐥 𝐏𝐫𝐨𝐠𝐫𝐚𝐦 𝐌𝐚𝐫𝐤𝐢𝐧𝐠 𝐭𝐡𝐞 𝐄𝐧𝐝 𝐨𝐟 𝐚𝐧 𝐔𝐧𝐟𝐨𝐫𝐠𝐞𝐭𝐭𝐚𝐛𝐥𝐞 𝐂𝐡𝐚𝐩𝐭𝐞𝐫🧑‍🎓🎓\r\nAlso we would like to welcome new learners with endorsement and provide best wishes for the graduates. 🌸🌸\r\n𝗔𝗱𝗺𝗶𝘀𝘀𝗶𝗼𝗻 𝗢𝗽𝗲𝗻 !!!✨✨✨✨\r\nHurry up and get yourself enrolled in 𝗬𝗲𝘁𝗶. ', 'https://www.youtube.com/watch?v=KKVNhm7afvo');

-- --------------------------------------------------------

--
-- Table structure for table `what_people_say`
--

CREATE TABLE `what_people_say` (
  `id` int(11) NOT NULL,
  `overview` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `batch` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `what_people_say`
--

INSERT INTO `what_people_say` (`id`, `overview`, `name`, `batch`, `image`) VALUES
(1, 'For me, choosing Yeti turned out to be the best decision. Yeti International College offers an outstanding blend of practical and theoretical knowledge. The faculty is highly supportive, maintainable, and the resources provided are top-notch. It\'s truly a place where students can thrive and achieve their academic goals.', 'Chandan Kushwaha', '2020 BCA [Batch]', 'IMG20241101170dfd956.jpg'),
(2, 'Words convey our feelings and a &ldquo;THANK YOU&rdquo; conveys our gratitude and appreciation. So, I must thank YETI Int&rsquo;l College (Former ICHM Lalitpur College) for striding the dream in all of us and supporting a lot in fulfilling it. YETI Int&rsquo;l College supports developing a strong feeling of self-confidence among the students to win in this competitive world.', 'Dhiraj Shah ', '2020 BCA [Batch]', 'dhiraj.jpg'),
(3, 'Yeti international college is the best college in kathmandu .This College has good infrastructure and monument and vast college environment and equipment are good in condition and libraries are plenty of books and sports centers with all sports equipment and classrooms with good classrooms and infrastructure.', 'Rupesh kushwaha', '2021 BCA [Batch]', '448461924_2232329540461838_259339875270183246_n.jpg'),
(4, 'sdfsfs', 'sfdsdf', '2020 BCA [Batch]', 'samsung.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `college_info`
--
ALTER TABLE `college_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_users`
--
ALTER TABLE `contact_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_routine`
--
ALTER TABLE `exam_routine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_logo`
--
ALTER TABLE `home_logo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `map`
--
ALTER TABLE `map`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meta_setting`
--
ALTER TABLE `meta_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `popup`
--
ALTER TABLE `popup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registered_users`
--
ALTER TABLE `registered_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routines`
--
ALTER TABLE `routines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_table`
--
ALTER TABLE `status_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_and_content`
--
ALTER TABLE `video_and_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `what_people_say`
--
ALTER TABLE `what_people_say`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `college_info`
--
ALTER TABLE `college_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_users`
--
ALTER TABLE `contact_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `exam_routine`
--
ALTER TABLE `exam_routine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `home_logo`
--
ALTER TABLE `home_logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `map`
--
ALTER TABLE `map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `meta_setting`
--
ALTER TABLE `meta_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `popup`
--
ALTER TABLE `popup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `registered_users`
--
ALTER TABLE `registered_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `routines`
--
ALTER TABLE `routines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status_table`
--
ALTER TABLE `status_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `video_and_content`
--
ALTER TABLE `video_and_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `what_people_say`
--
ALTER TABLE `what_people_say`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
