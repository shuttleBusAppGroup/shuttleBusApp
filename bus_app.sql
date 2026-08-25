-- Shuttle Bus database schema and fictional sample data
-- MySQL 8.0+

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `bus_app`;
USE `bus_app`;

CREATE TABLE `announcements` (
  `id` int NOT NULL,
  `title` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `addedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleteOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `buses` (
  `id` int NOT NULL,
  `bus_number` int NOT NULL,
  `capacity` int NOT NULL,
  `make` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `year` int NOT NULL,
  `status` enum('available','unavailable','maintenance') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `drivers` (
  `id` int NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `license_number` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hire_date` date NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `current_stop` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `driver_bus_assignments` (
  `id` int NOT NULL,
  `driver_id` int NOT NULL,
  `bus_id` int NOT NULL,
  `assignment_date` date NOT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `driver_shifts` (
  `id` int NOT NULL,
  `driver_id` int NOT NULL,
  `schedule_id` int NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `routes` (
  `id` int NOT NULL,
  `route_name` varchar(100) NOT NULL,
  `origin` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `stops` text,
  `estimated_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `route_stops` (
  `id` int NOT NULL,
  `route_id` int NOT NULL,
  `stop_id` int NOT NULL,
  `stop_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arrival_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `schedules` (
  `id` int NOT NULL,
  `route_id` int NOT NULL,
  `bus_id` int NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `days` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `subscriptions` (
  `id` int NOT NULL,
  `subscription_type` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `duration_days` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('admin','user','driver','guest','visitor','faculty','staff','student') NOT NULL DEFAULT 'user',
  `assigned_bus_id` int DEFAULT NULL,
  `assigned_route_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `user_subscriptions` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `subscription_id` int NOT NULL,
  `start_date` date NOT NULL,
  `expiry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `announcements` (`id`, `title`, `message`, `addedOn`, `deleteOn`) VALUES
(1, 'Demo service notice', 'Route 101 uses the east entrance during the sample maintenance window.', '2025-01-02 09:00:00', '2025-12-31 23:59:59');

INSERT INTO `buses` (`id`, `bus_number`, `capacity`, `make`, `model`, `year`, `status`) VALUES
(1, 101, 30, 'Demo Transit', 'City Mini', 2022, 'available'),
(2, 202, 42, 'Example Motors', 'Loop Runner', 2021, 'maintenance');

INSERT INTO `drivers` (`id`, `first_name`, `last_name`, `license_number`, `phone_number`, `email`, `hire_date`, `status`, `current_stop`) VALUES
(1, 'Avery', 'Example', 'DEMO-LIC-001', '+1-555-0101', 'avery.driver@example.invalid', '2024-01-15', 'active', 1),
(2, 'Jordan', 'Sample', 'DEMO-LIC-002', '+1-555-0102', 'jordan.driver@example.invalid', '2024-02-01', 'inactive', NULL);

INSERT INTO `driver_bus_assignments` (`id`, `driver_id`, `bus_id`, `assignment_date`, `status`) VALUES
(1, 1, 1, '2025-01-02', 'active'),
(2, 2, 2, '2025-01-02', 'inactive');

INSERT INTO `routes` (`id`, `route_name`, `origin`, `destination`, `stops`, `estimated_time`) VALUES
(1, 'Demo North Loop', 'North Hub', 'Central Hub', 'North Hub, Library Plaza, Central Hub', '00:25:00'),
(2, 'Demo South Loop', 'Central Hub', 'South Hub', 'Central Hub, Market Square, South Hub', '00:30:00');

INSERT INTO `route_stops` (`id`, `route_id`, `stop_id`, `stop_name`, `arrival_time`) VALUES
(1, 1, 101, 'North Hub', '08:00:00'),
(2, 1, 102, 'Central Hub', '08:25:00'),
(3, 2, 201, 'Central Hub', '09:00:00'),
(4, 2, 202, 'South Hub', '09:30:00');

INSERT INTO `schedules` (`id`, `route_id`, `bus_id`, `start_time`, `end_time`, `days`) VALUES
(1, 1, 1, '08:00:00', '18:00:00', 'Monday-Friday'),
(2, 2, 2, '09:00:00', '17:00:00', 'Saturday-Sunday');

INSERT INTO `driver_shifts` (`id`, `driver_id`, `schedule_id`, `date`) VALUES
(1, 1, 1, '2025-01-06'),
(2, 2, 2, '2025-01-11');

INSERT INTO `subscriptions` (`id`, `subscription_type`, `description`, `price`, `duration_days`) VALUES
(1, 'Demo day pass', 'Fictional one-day sample plan.', 4.00, 1),
(2, 'Demo monthly pass', 'Fictional 30-day sample plan.', 40.00, 30),
(3, 'Demo annual pass', 'Fictional 365-day sample plan.', 300.00, 365);

INSERT INTO `users` (`id`, `username`, `email`, `password`, `user_type`, `assigned_bus_id`, `assigned_route_id`) VALUES
(1, 'demo_admin', 'admin@example.invalid', '$2y$12$AbBR60LByZmLUyab5tCEVepiwcdp4VjvHHxZLN6rN3LByTGJRoOqe', 'admin', NULL, NULL),
(2, 'demo_rider', 'rider@example.invalid', '$2y$12$5oSSSeUYQlFbHA4YS2fqGONGP73vy2I6DxslNrUuM7fuuBcaTC9xS', 'user', NULL, 1),
(3, 'demo_driver', 'driver@example.invalid', '$2y$12$Fj2EWSO0G6vJ422pBgOx9uPyMOxIQwv3c1IXxDoNl2SAdVOGELwWS', 'driver', 1, 1),
(4, 'demo_guest', 'guest@example.invalid', '$2y$12$Zrc3mBOVg2z1N1bIU54eEuZ1yrL38sKDEkHMPU.39/qXrjCy3QsP2', 'guest', NULL, NULL);

INSERT INTO `user_subscriptions` (`id`, `user_id`, `subscription_id`, `start_date`, `expiry_date`) VALUES
(1, 2, 2, '2025-01-01', '2025-01-31'),
(2, 4, 1, '2025-01-15', '2025-01-15');

ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `buses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bus_number` (`bus_number`);

ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `driver_bus_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driver_id` (`driver_id`),
  ADD KEY `bus_id` (`bus_id`);

ALTER TABLE `driver_shifts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driver_id` (`driver_id`),
  ADD KEY `schedule_id` (`schedule_id`);

ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `route_stops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `route_id` (`route_id`);

ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `route_id` (`route_id`),
  ADD KEY `bus_id` (`bus_id`);

ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_assigned_bus_id` (`assigned_bus_id`),
  ADD KEY `fk_assigned_route_id` (`assigned_route_id`);

ALTER TABLE `user_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `subscription_id` (`subscription_id`);

ALTER TABLE `announcements`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `buses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `drivers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `driver_bus_assignments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `driver_shifts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `routes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `route_stops`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `schedules`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `subscriptions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `user_subscriptions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `driver_bus_assignments`
  ADD CONSTRAINT `driver_bus_assignments_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `driver_bus_assignments_ibfk_2` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`) ON DELETE CASCADE;

ALTER TABLE `driver_shifts`
  ADD CONSTRAINT `driver_shifts_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`),
  ADD CONSTRAINT `driver_shifts_ibfk_2` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`);

ALTER TABLE `route_stops`
  ADD CONSTRAINT `route_stops_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE CASCADE;

ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`),
  ADD CONSTRAINT `schedules_ibfk_2` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`);

ALTER TABLE `users`
  ADD CONSTRAINT `fk_assigned_bus_id` FOREIGN KEY (`assigned_bus_id`) REFERENCES `buses` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_assigned_route_id` FOREIGN KEY (`assigned_route_id`) REFERENCES `routes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `user_subscriptions`
  ADD CONSTRAINT `user_subscriptions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_subscriptions_ibfk_2` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`) ON DELETE CASCADE;

COMMIT;
