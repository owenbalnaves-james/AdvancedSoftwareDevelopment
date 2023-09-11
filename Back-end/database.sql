CREATE TABLE `employee` (
  `id` bigint(20) NOT NULL,
  `FName` varchar(20) NOT NULL,
  `LName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` BIGINT NOT NULL DEFAULT,
  `address` VARCHAR NOT NULL DEFAULT,
  `Role` boolean NOT NULL DEFAULT, 
  `Night / day shift` boolean NOT NULL DEFAULT,
  `password` VARCHAR(300) NOT NULL DEFAULT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `customer` (
  `customerID` bigint(20) NOT NULL,
  `FName` varchar(20) NOT NULL,
  `LName` varchar(30) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` BIGINT NOT NULL DEFAULT,
  `Credit card no.` VARCHAR NOT NULL DEFAULT,
  `address` VARCHAR(300) NOT NULL DEFAULT, 
  `password` VARCHAR(300) NOT NULL DEFAULT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `table` (
  `tableID` bigint(20) NOT NULL,
  `noSeats` int NOT NULL,
  `inside / outside` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `reservation` (
  `reservationID` bigint(20) NOT NULL,
  `customerID` int NOT NULL,
  `date & time` DATE(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `special event` (
  `eventID` bigint(20) NOT NULL,
  `customerID` bigint(20) NOT NULL,
  `category` varchar(100) NOT NULL,
  `date` DATE NOT NULL,
  `specialRequests` varchar(100) NOT NULL
  CONSTRAINT FKSE1 FOREIGN KEY (customerID)
  REFERENCES customer(customerID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `event table registration` (
  `eventID` bigint(20) NOT NULL,
  `customerID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `rating` (
  `ratingID` bigint(20) NOT NULL,
  `customerID` bigint(20) NOT NULL,
  `ratingValue` INT(20) NOT NULL,
  `ratingDesc` VARCHAR(3000) NOT NULL,
  `dateSubmitted` DATE(20) NOT NULL
  CONSTRAINT R1 FOREIGN KEY (customerID)
  REFERENCES customer(customerID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `order` (
  `orderID` bigint(20) NOT NULL,
  `customerID` bigint(20) NOT NULL,
  `totalPrice` INT NOT NULL,
  `timeOrdered` TIME NOT NULL
  CONSTRAINT O1 FOREIGN KEY (customerID)
  REFERENCES customer(customerID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `orderMenuItem` (
  `menuID` bigint(20) NOT NULL,
  `orderID` bigint(20) NOT NULL
  CONSTRAINT OMI1 FOREIGN KEY (menuID)
  REFERENCES menuItem(menuID)
  CONSTRAINT OMI1 FOREIGN KEY (orderID)
  REFERENCES order(orderID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `menuItem` (
  `menuID` bigint(20) NOT NULL,
  `name` bigint(20) NOT NULL,
  `category` bigint(20) NOT NULL,
  `price` bigint(20) NOT NULL,
  `pickupOnly` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `menuDeal` (
  `dealID` INT(20) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `price` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `menuItemDeal` (
  `dealID` bigint(20) NOT NULL,
  `menuID` INT(100) NOT NULL
  CONSTRAINT MID1 FOREIGN KEY (dealID)
  REFERENCES menuDeal(dealID)
  CONSTRAINT MID2 FOREIGN KEY (menuID)
  REFERENCES menuItem(menuID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

