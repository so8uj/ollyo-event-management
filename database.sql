-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2025 at 06:29 PM
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
-- Database: `oem_task`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `featured_image` varchar(255) NOT NULL DEFAULT 'default_image.jpg',
  `maximum_capacity` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `featured_image`, `maximum_capacity`, `created_by`, `slug`, `event_date`, `created_at`) VALUES
(1, 'Artificial Intelligence & Machine Learning', '&lt;div&gt;&lt;b&gt;1. AI Convergence Summit:&amp;nbsp;&lt;/b&gt;A conference exploring the latest advancements in AI, deep learning, and neural networks.&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;&lt;b&gt;2. Machine Learning Frontiers:&lt;/b&gt;&amp;nbsp; A gathering of ML enthusiasts discussing applications in automation, healthcare, and finance.&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;&lt;b&gt;3. Neural Nexus:&lt;/b&gt; An event focused on AI ethics, neural networks, and the future of intelligent computing.&lt;/div&gt;', 'artificial-intelligence-machine-learning-1738165746.jpg', 50, 4, 'artificial-intelligence-machine-learning', '2025-02-06', '2025-01-29 15:49:06'),
(2, 'Cybersecurity & Blockchain', '&lt;p&gt;&lt;b&gt;1. CyberShield Conference&lt;/b&gt; – A cybersecurity event addressing the latest trends, threats, and solutions in digital security.&lt;/p&gt;&lt;p&gt;&lt;b&gt;2. Blockchain Revolution Expo&lt;/b&gt; – A conference on blockchain technology, smart contracts, and decentralized finance (DeFi).&lt;/p&gt;&lt;p&gt;&lt;b&gt;3. Hacker&#039;s Haven&lt;/b&gt; – An ethical hacking and cybersecurity challenge event for professionals and students.&lt;/p&gt;', 'cybersecurity-blockchain-1738166010.jpg', 80, 3, 'cybersecurity-blockchain', '2025-02-08', '2025-01-29 15:53:30'),
(3, 'Software Development & Engineering', '&lt;h3 class=&quot;&quot;&gt;CodeCrafters Summit – &lt;/h3&gt;&lt;p&gt;A meetup for software engineers to explore cutting-edge programming languages and development tools.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;h3 class=&quot;&quot;&gt;DevOps Nexus – &lt;/h3&gt;&lt;p&gt;An event focusing on DevOps methodologies, cloud infrastructure, and CI/CD pipelines.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;h3 class=&quot;&quot;&gt;Agile Innovators Forum – &lt;/h3&gt;&lt;p&gt;A deep dive into agile development, project management, and product lifecycle best practices.&lt;/p&gt;', 'software-development-engineering-1738166164.jpg', 75, 3, 'software-development-engineering', '2025-02-15', '2025-01-29 15:56:04'),
(4, 'IoT & Smart Tech', '&lt;ol&gt;&lt;li&gt;Smart Cities Forum – A discussion on the integration of IoT, AI, and sustainable technologies in urban development.&lt;/li&gt;&lt;li&gt;Connected World Summit – A platform to explore the latest trends in IoT, 5G, and smart devices.&lt;/li&gt;&lt;li&gt;Autonomous Tech Symposium – A deep dive into self-driving cars, drones, and AI-powered automation.&lt;/li&gt;&lt;/ol&gt;', 'iot-smart-tech-1738166392.jpg', 100, 6, 'iot-smart-tech', '2025-02-11', '2025-01-29 15:59:52'),
(5, 'FutureTech Expo 2025', '&lt;p&gt;FutureTech Expo 2025 is a premier global event that brings together tech enthusiasts, industry leaders, and innovators to explore the latest advancements in artificial intelligence, robotics, automation, and smart technology. Attendees will experience hands-on demonstrations, keynote sessions by leading tech visionaries, and panel discussions covering emerging trends such as quantum computing, augmented reality, and next-generation cybersecurity solutions. This event is a must-attend for startups, enterprises, and individuals looking to stay ahead in the ever-evolving world of technology.&lt;/p&gt;', 'futuretech-expo-2025-1738166654.jpg', 60, 6, 'futuretech-expo-2025', '2025-02-27', '2025-01-29 16:04:14'),
(6, 'CyberDefend Conference', '&lt;p&gt;CyberDefend Conference is a high-profile cybersecurity event dedicated to tackling modern cyber threats, data breaches, and ethical hacking. Security professionals, IT experts, and government officials gather to discuss the latest trends in cybersecurity, including AI-driven security, blockchain for secure transactions, and zero-trust network strategies. Attendees will participate in live hacking demonstrations, in-depth workshops, and networking sessions aimed at strengthening global cyber resilience.&lt;/p&gt;', 'cyberdefend-conference-1738166761.jpg', 50, 3, 'cyberdefend-conference', '2025-02-22', '2025-01-29 16:06:01'),
(7, 'CodeFest Hackathon', '&lt;p&gt;CodeFest Hackathon is a 48-hour coding challenge where developers, designers, and entrepreneurs come together to create innovative software solutions. Participants will form teams, collaborate on real-world problems, and present their final projects to a panel of expert judges. The event fosters creativity, teamwork, and problem-solving, with winning teams receiving cash prizes, mentorship opportunities, and potential funding from investors.&lt;/p&gt;', 'codefest-hackathon-1738166847.jpg', 70, 3, 'codefest-hackathon', '2025-02-21', '2025-01-29 16:07:27'),
(8, 'AI Vision Summit', '&lt;p&gt;AI Vision Summit is a global conference dedicated to artificial intelligence, machine learning, and computer vision technologies. Experts from academia and industry share insights on AI-driven automation, deep learning models, and real-world applications in healthcare, finance, and autonomous systems. The summit includes keynote speeches, technical workshops, and interactive AI exhibits showcasing cutting-edge innovations shaping the future of AI.&lt;/p&gt;', 'ai-vision-summit-1738166967.png', 100, 6, 'ai-vision-summit', '2025-02-15', '2025-01-29 16:09:27'),
(9, 'Blockchain Connect 2025', '&lt;p&gt;Blockchain Connect is a premier gathering for blockchain developers, fintech innovators, and crypto enthusiasts. The event covers topics such as decentralized finance (DeFi), smart contracts, non-fungible tokens (NFTs), and enterprise blockchain applications. Attendees will gain insights into the future of Web3, regulatory developments, and the impact of blockchain on various industries. The event also features networking opportunities with investors, startups, and industry leaders.&lt;/p&gt;', 'blockchain-connect-2025-1738167118.jpg', 75, 5, 'blockchain-connect-2025', '2025-02-19', '2025-01-29 16:11:58'),
(10, 'CloudSphere Summit', '&lt;p&gt;CloudSphere Summit is a leading technology event focused on cloud computing, serverless architecture, and digital transformation. Industry experts discuss the latest trends in multi-cloud strategies, hybrid cloud adoption, and security best practices. Attendees will learn about cloud-native development, Kubernetes orchestration, and AI-driven cloud solutions through in-depth sessions and hands-on labs.&lt;/p&gt;', 'cloudsphere-summit-1738167218.jpg', 35, 5, 'cloudsphere-summit', '2025-02-24', '2025-01-29 16:13:38'),
(11, 'NextGen Robotics Fair', '&lt;p&gt;NextGen Robotics Fair is a cutting-edge exhibition showcasing the latest advancements in robotics, automation, and AI-powered machines. The event features live demonstrations of humanoid robots, autonomous drones, and industrial automation solutions. Researchers, engineers, and business leaders come together to discuss the impact of robotics in manufacturing, healthcare, and everyday life.&lt;/p&gt;', 'nextgen-robotics-fair-1738167407.jpg', 100, 4, 'nextgen-robotics-fair', '2025-02-21', '2025-01-29 16:16:47'),
(12, 'Autonomous Mobility Expo', '&lt;p&gt;Autonomous Mobility Expo is dedicated to self-driving cars, AI-powered transportation, and next-gen mobility solutions. Automotive engineers, AI researchers, and policymakers discuss the future of autonomous vehicles, smart traffic systems, and electric mobility. The expo features live demos of self-driving technology and panel discussions on regulatory challenges and safety measures.&lt;/p&gt;', 'autonomous-mobility-expo-1738167514.png', 200, 2, 'autonomous-mobility-expo', '2025-02-28', '2025-01-29 16:18:34'),
(13, 'GameDev Universe Session', '&lt;p&gt;GameDev Universe is an exciting event for game developers, designers, and gaming enthusiasts. The event covers topics such as game engines, storytelling in games, VR gaming, and indie game development. Attendees can network with top game studios, participate in coding challenges, and explore the latest gaming hardware and software.&lt;/p&gt;', 'gamedev-universe-session-1738167661.jpg', 60, 2, 'gamedev-universe-session', '2025-03-08', '2025-01-29 16:21:01'),
(14, 'DevOps Evolution Summit', '&lt;p&gt;DevOps Evolution is a specialized conference focusing on DevOps methodologies, continuous integration and deployment (CI/CD), and cloud-native development. Industry experts discuss best practices for improving software development lifecycles, security automation, and containerization with Docker and Kubernetes. Attendees gain hands-on experience through interactive workshops and real-world case studies.&lt;/p&gt;', 'devops-evolution-summit-1738167839.jpg', 120, 3, 'devops-evolution-summit', '2025-03-17', '2025-01-29 16:23:59'),
(15, 'AR/VR Experience Expo', '&lt;p&gt;AR/VR Experience Expo is an interactive event dedicated to augmented reality (AR) and virtual reality (VR) technologies. Developers, designers, and tech enthusiasts explore immersive experiences in gaming, healthcare, and education. Attendees can test the latest AR/VR hardware, participate in workshops on 3D content creation, and network with industry pioneers shaping the future of virtual experiences.&lt;/p&gt;', 'ar-vr-experience-expo-1738167976.png', 50, 5, 'ar-vr-experience-expo', '2025-03-30', '2025-01-29 16:26:16'),
(16, 'eCommerce Future Forum', '&lt;p&gt;eCommerce Future Forum is an insightful event for online retailers, digital marketers, and fintech leaders. Topics include AI-driven personalization, blockchain for secure transactions, and the rise of social commerce. Attendees can learn from top eCommerce brands, explore digital payment solutions, and gain insights into the evolving landscape of online shopping.&lt;/p&gt;', 'ecommerce-future-forum-1738168223.jpg', 300, 2, 'ecommerce-future-forum', '2025-05-10', '2025-01-29 16:30:23'),
(17, 'AI Ethics & Society', '&lt;p&gt;AI Ethics &amp;amp; Society is a thought-provoking conference exploring the ethical implications of artificial intelligence. Experts discuss AI bias, data privacy, and the responsible use of AI in decision-making processes. The event fosters discussions on regulatory policies, ethical AI frameworks, and the impact of automation on jobs and society.&lt;/p&gt;', 'ai-ethics-society-1738168329.jpg', 280, 4, 'ai-ethics-society', '2025-05-15', '2025-01-29 16:32:09'),
(18, 'Metaverse World Summit', '&lt;p&gt;Metaverse World Summit is an event dedicated to the future of virtual worlds, digital identities, and Web3 applications. Attendees explore the potential of the metaverse in gaming, education, and business. Key topics include NFT integration, virtual real estate, and decentralized platforms shaping the next phase of the internet.&lt;/p&gt;', 'metaverse-world-summit-1738168437.jpg', 400, 5, 'metaverse-world-summit', '2025-06-15', '2025-01-29 16:33:57'),
(19, 'TechFusion Festival', '&lt;p&gt;TechFusion Festival is a multi-disciplinary technology event celebrating innovations across AI, robotics, space tech, biotech, and digital transformation. The event features hands-on experiences, startup showcases, expert talks, and networking opportunities, making it an essential gathering for tech enthusiasts and professionals.&lt;/p&gt;&lt;p&gt;These long descriptions can be used as dummy data for your website. Let me know if you need modifications!&amp;nbsp;&lt;/p&gt;', 'techfusion-festival-1738168572.jpg', 350, 5, 'techfusion-festival', '2025-07-10', '2025-01-29 16:36:12'),
(20, 'Digital Innovation Summit', '&lt;p&gt;The Digital Innovation Summit brings together industry leaders, entrepreneurs, and tech enthusiasts to explore the latest advancements in digital transformation. This event covers topics such as artificial intelligence, big data analytics, cloud computing, and blockchain technology. Attendees will gain insights from keynote speakers, participate in interactive panel discussions, and network with pioneers shaping the future of digital business&lt;/p&gt;', 'digital-innovation-summit-1738168928.png', 130, 6, 'digital-innovation-summit', '2025-02-14', '2025-01-29 16:42:08'),
(21, 'AI & Automation World', '&lt;p&gt;AI &amp;amp; Automation World is a premier event dedicated to artificial intelligence and process automation across industries. The event features sessions on machine learning, AI-driven automation, robotic process automation (RPA), and smart manufacturing. Industry experts will discuss real-world applications of AI, from predictive analytics in finance to autonomous robots in logistics.&lt;/p&gt;', 'ai-automation-world-1738169060.jpg', 160, 4, 'ai-automation-world', '2025-08-05', '2025-01-29 16:44:20'),
(22, 'Smart Manufacturing Expo', '&lt;p&gt;Smart Manufacturing Expo is the go-to event for professionals in the manufacturing sector looking to integrate Industry 4.0 technologies. The event showcases smart factories, IoT-powered automation, AI-driven quality control, and digital twin technology. Experts from leading companies will discuss how smart manufacturing is revolutionizing productivity, efficiency, and sustainability.&lt;/p&gt;', 'smart-manufacturing-expo-1738169182.jpg', 380, 6, 'smart-manufacturing-expo', '2025-05-27', '2025-01-29 16:46:22'),
(23, '3D Printing & Additive Manufacturing Forum', '&lt;p&gt;This forum explores the future of 3D printing and additive manufacturing, bringing together engineers, designers, and innovators. Attendees will learn about the latest advancements in rapid prototyping, medical implants, aerospace components, and customized consumer products. The event features live demonstrations of next-gen 3D printing technologies and expert insights on scaling additive manufacturing in industries.&lt;/p&gt;', '3d-printing-additive-manufacturing-forum-1738169336.jpg', 220, 5, '3d-printing-additive-manufacturing-forum', '2025-06-23', '2025-01-29 16:48:56'),
(24, 'AI for Healthcare Conference', '&lt;p&gt;AI for Healthcare Conference is dedicated to exploring the role of artificial intelligence in transforming the healthcare industry. The event covers topics such as AI-powered diagnostics, robotic surgeries, personalized treatment plans, and predictive analytics for disease prevention. Medical professionals, researchers, and AI developers will discuss how technology is enhancing patient care and operational efficiency in hospitals and clinics.&lt;/p&gt;', 'ai-for-healthcare-conference-1738169474.jpg', 500, 4, 'ai-for-healthcare-conference', '2025-10-12', '2025-01-29 16:51:14'),
(25, 'E-Mobility & Electric Vehicles Expo', '&lt;p&gt;E-Mobility &amp;amp; Electric Vehicles Expo is a global event focused on sustainable transportation, electric cars, and battery technology. Industry leaders will discuss advancements in EV charging infrastructure, battery efficiency, and self-driving capabilities. The expo features live test drives, product launches, and insights from top automotive brands shaping the future of green mobility.&lt;/p&gt;', 'e-mobility-electric-vehicles-expo-1738169579.jpg', 200, 3, 'e-mobility-electric-vehicles-expo', '2025-04-26', '2025-01-29 16:52:59'),
(26, 'CyberSecurity Threat Intelligence Summit', '&lt;p&gt;This summit is designed for cybersecurity professionals, ethical hackers, and IT decision-makers who want to stay ahead of emerging threats. Sessions cover ransomware attacks, social engineering tactics, AI-driven security solutions, and cyber warfare trends. Attendees will participate in live threat analysis workshops, cybersecurity simulations, and discussions on building stronger defense strategies&lt;/p&gt;', 'cybersecurity-threat-intelligence-summit-1738169702.jpg', 380, 2, 'cybersecurity-threat-intelligence-summit', '2025-07-06', '2025-01-29 16:55:02'),
(27, 'Digital Marketing & AI Conference', '&lt;p&gt;This conference is tailored for digital marketers, content creators, and AI-driven advertising professionals. The event covers SEO automation, AI-generated content, personalized marketing strategies, and the impact of big data on consumer behavior. Attendees will learn how to leverage AI tools to create highly targeted campaigns and improve customer engagement.&lt;/p&gt;', 'digital-marketing-ai-conference-1738169854.jpg', 220, 2, 'digital-marketing-ai-conference', '2025-06-18', '2025-01-29 16:57:34'),
(28, 'Next-Gen Biometric Security Expo', '&lt;p&gt;This event highlights the latest trends in biometric authentication, including facial recognition, fingerprint scanning, and AI-powered identity verification. Experts from the security and fintech industries will discuss the role of biometrics in cybersecurity, banking, and border control. Live demonstrations and hands-on workshops will provide attendees with insights into the future of biometric security.&lt;/p&gt;', 'next-gen-biometric-security-expo-1738169959.jpg', 550, 2, 'next-gen-biometric-security-expo', '2025-09-23', '2025-01-29 16:59:19'),
(29, 'Wearable Tech & Smart Gadgets Summit Test', '&lt;p&gt;Wearable Tech &amp;amp; Smart Gadgets Summit is an exclusive event for tech enthusiasts interested in smartwatches, fitness trackers, augmented reality glasses, and biometric devices. The event highlights AI-powered wearables, health-tracking innovations, and next-gen smart clothing. Attendees can explore new product launches, hear from leading gadget developers, and experience the future of wearable technology.&lt;/p&gt;', 'wearable-tech-smart-gadgets-summit-test-1738171523.jpg', 350, 4, 'wearable-tech-smart-gadgets-summit-test', '2025-02-09', '2025-01-29 17:01:39'),
(30, 'Web 3.0 & Decentralized Internet Summit', '&lt;p&gt;This event explores the next generation of the internet—Web 3.0—where decentralization, blockchain, and AI-driven applications are redefining how we interact online. Topics include decentralized applications (DApps), blockchain governance, NFT innovations, and data privacy in the new era of the internet. Attendees will engage with top blockchain developers, policymakers, and entrepreneurs leading the Web3 movement.&lt;/p&gt;', 'web-3-0-decentralized-internet-summit-1738170260.jpeg', 500, 2, 'web-3-0-decentralized-internet-summit', '2025-02-07', '2025-01-29 17:04:20');

-- --------------------------------------------------------

--
-- Table structure for table `event_registrations`
--

CREATE TABLE `event_registrations` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'Admin', 'admin', '$2y$10$rmawxt2yMM1ffSWKU02.xuL9.Zt0RMlItbotpUe7IiZkhiBunocvG', 1, '2025-01-29 15:34:39'),
(2, 'Mohammad Sobuj', 'user', '$2y$10$8EqTwR/NUSN66SHy.tEPyOz1161.0fXUYd5rkQHlcbk.msiFToZCW', 0, '2025-01-29 15:35:00'),
(3, 'Prodip Raj', 'user2', '$2y$10$93qzlIctzJUJ17JLW7JsSepB4J4c.RkINJTjB0epSouMUDifi9eYC', 0, '2025-01-29 15:37:30'),
(4, 'Farhana Afia', 'user3', '$2y$10$93qzlIctzJUJ17JLW7JsSepB4J4c.RkINJTjB0epSouMUDifi9eYC', 0, '2025-01-29 15:38:09'),
(5, 'Sumaia Akter', 'user4', '$2y$10$0Se8ojduDkuDd85o7.0wBeJO7mA4SkIEnTq2.RUIZrTVk7GPYHM8a', 0, '2025-01-29 15:39:51'),
(6, 'Sumon Ahmed', 'user5', '$2y$10$JsgTfnG2EAmaOBvY4LOq4utvZtIlaXZOLfZd39jZ47WgbsMK9SYiO', 0, '2025-01-29 15:40:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `event_registrations`
--
ALTER TABLE `event_registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD CONSTRAINT `event_id` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
