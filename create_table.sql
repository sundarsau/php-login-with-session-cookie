CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `email`, `name`, `password`) VALUES
(1, 'john@test.com', 'John Doe', '$2y$10$LGJx6.7bZjLHLmom7FlgBeSu56q2L2JvOTaWBAy1JHpt21dUYLwT6'),
(2, 'test@test.com', 'Test Name', '$2y$10$.a4RZbsYYOVuTfQEZz0a3uiJZFUrzxTMuYqhamQRkgDyQyR2Fdhru');

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;