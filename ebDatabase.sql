SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `convertunitstoamount` (IN `units` INT, OUT `results` INT)  BEGIN
    
    DECLARE x INT DEFAULT 0;
    DECLARE y INT DEFAULT 0;
    DECLARE z INT DEFAULT 0;
    DECLARE w INT DEFAULT 0;

    SELECT twohundred INTO x FROM unitsRate;
    SELECT fivehundred INTO y FROM unitsRate;
    SELECT thousand INTO z FROM unitsRate;
    SELECT abovethousand INTO w FROM unitsRate;

    IF units<200
    THEN
        SELECT x*units INTO results;
    
    ELSEIF units<500
    THEN
        SELECT (x*200)+(y*(units-200)) INTO results;
    ELSEIF units < 1000
    THEN
        SELECT (x*200)+(y*(300))+(z*(units-500)) INTO results;
    ELSE
        SELECT (x * 200) + (y * 300) + (z * 500) + (w * (units - 1000)) INTO results;    
    END IF;
    
END$$

DELIMITER ;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Create_Bill`(
    IN aid INT,
    IN uid INT,
    IN unit INT(10),
    IN amnt DECIMAL(10,2),
    IN stat VARCHAR(10),
    IN bdate DATE,
    IN ddate DATE
)
BEGIN
INSERT INTO bills (adminid,userid,units,amount,status,billdate,duedate) VALUES (aid,uid,unit,amnt,stat,bdate,ddate);
END$$
DELIMITER ;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Add_Complaint`(
    IN uid INT,
    IN aid INT,
    IN comp VARCHAR(150),
    IN stat VARCHAR(50)
)
BEGIN
    INSERT INTO complaint(userid,adminid,complaint,status)
    VALUES (uid,aid,comp,stat);
END$$
DELIMITER ;

CREATE TABLE `admin` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `email` VARCHAR(30) NOT NULL,
  `password` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'Samyuktha', 'samyukthas113@gmail.com', 'samyu@sky'),
(2, 'Ramyaa', 'apramya@gmail.com', 'Dhoni@7');

CREATE TABLE `bills` (
  `billid` INT NOT NULL AUTO_INCREMENT,
  `adminid` INT NOT NULL,
  `userid` INT NOT NULL,
  `units` INT(10) NOT NULL,
  `amount` DECIMAL(10,2) NOT NULL,
  `status` VARCHAR(10) NOT NULL,
  `billdate` DATE NOT NULL,
  `duedate` DATE NOT NULL,
  PRIMARY KEY (`billid`),
  KEY `adminid` (`adminid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `complaint` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `userid` INT NOT NULL,
  `adminid` INT NOT NULL,
  `complaint` VARCHAR(150) NOT NULL,
  `status` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `adminid` (`adminid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `transaction` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `billid` INT NOT NULL,
  `amount` DECIMAL(10,2) NOT NULL,
  `paymentdate` DATE DEFAULT NULL,
  `status` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `billid` (`billid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `unitsRate` (
  `sno` INT PRIMARY KEY,
  `twohundred` INT NOT NULL,
  `fivehundred` INT NOT NULL,
  `thousand` INT NOT NULL,
  `abovethousand` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `unitsRate` (`sno`, `twohundred`, `fivehundred`, `thousand`, `abovethousand`) VALUES
(1, 7, 8, 10, 12);

CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `email` VARCHAR(30) NOT NULL,
  `password` VARCHAR(20) NOT NULL,
  `address` VARCHAR(100) NOT NULL,
  `pincode` INT,
  `total_units` INT,
  `total_amount` INT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `location` (
  `id` INT,
  `placename` VARCHAR(30),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `location` (`id`, `placename`) VALUES
(600001, 'Chennai'),
(620001,'Tiruchi'),
(632001, 'Vellore'),
(625531, 'Theni');

CREATE TABLE `powercut` (
  `pid` INT NOT NULL AUTO_INCREMENT,
  `cause` VARCHAR(150),
  `time1` TIME,
  `time2` TIME,
  `date` DATE,
  `locid` INT,
  PRIMARY KEY (`pid`),
  KEY `locid` (`locid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `lineman` (
  `lid` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `phone` VARCHAR(10) NOT NULL,
  `locid` INT,
  PRIMARY KEY (`lid`),
  KEY `locid` (`locid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `admin` MODIFY `id` INT NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `bills` MODIFY `billid` INT NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `complaint` MODIFY `id` INT NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `transaction` MODIFY `id` INT NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `users` MODIFY `id` INT NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `users`
  ADD CONSTRAINT `user_fk_1` FOREIGN KEY (`pincode`) REFERENCES `location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `bills`
  ADD CONSTRAINT `bills_fk_1` FOREIGN KEY (`adminid`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bills_fk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `complaint`
  ADD CONSTRAINT `complaint_fk_1` FOREIGN KEY (`adminid`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `complaint_fk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_fk_1` FOREIGN KEY (`billid`) REFERENCES `bills` (`billid`) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bill_summary`  AS 
SELECT `u`.`id` AS `id`, `u`.`name` AS `name`, sum(`b`.`amount`) AS `totalbilled`, sum(`t`.`amount`) AS `totalpaid` FROM ((`users` `u` left join `bills` `b` on(`u`.`id` = `b`.`userid`)) left join `transaction` `t` on(`b`.`billid` = `t`.`billid`)) WHERE `b`.`status` LIKE 'PAID' GROUP BY `u`.`id`, `u`.`name` ;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `powercut_summary`  AS 
SELECT `l`.`id` AS `locid`, `l`.`placename` AS `placename`, count(`p`.`pid`) AS `total_powercuts` FROM (`location` `l` left join `powercut` `p` on(`p`.`locid` = `l`.`id`)) GROUP BY `p`.`locid`, `l`.`placename` ;

DELIMITER $$
CREATE TRIGGER `Update_Transaction` AFTER UPDATE ON `bills`
 FOR EACH ROW BEGIN
    UPDATE transaction
    SET status = 'PROCESSED',paymentdate=curdate()
    WHERE billid = NEW.billid;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER totalunits AFTER INSERT ON bills
 FOR EACH ROW BEGIN
    DECLARE totalUnits INT;
    SELECT SUM(units) INTO totalUnits FROM bills WHERE userid = NEW.userid;
    UPDATE users
    SET total_units = totalUnits
    WHERE id = NEW.userid;
END 
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `totalpaidamount` AFTER UPDATE ON `bills`
 FOR EACH ROW BEGIN
    DECLARE totalamount INT;
    SELECT SUM(amount) INTO totalamount FROM bills WHERE  bills.billid=NEW.billid;
    UPDATE users
    SET total_amount = totalamount
    WHERE id = NEW.userid;
END
$$
DELIMITER ;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `Unpaid_amount`(uid INT) RETURNS int(11)
BEGIN
    DECLARE done INT DEFAULT 0;
    DECLARE unpaid1 INT DEFAULT 0;
    DECLARE unpaid2 INT DEFAULT 0;
    DECLARE bid INT;
    DECLARE cur CURSOR FOR SELECT billid FROM bills WHERE userid = uid;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
    OPEN cur;
    read_loop: LOOP
        FETCH cur INTO bid;
        IF done THEN
            LEAVE read_loop;
        END IF;
        SELECT amount INTO unpaid2
        FROM bills
        WHERE billid = bid AND (status NOT LIKE 'PAID' AND status NOT LIKE 'PROCESSED');
        SET unpaid1 = unpaid1 + unpaid2;
    END LOOP;
    CLOSE cur;
    RETURN unpaid1;
END$$
DELIMITER ;
DELIMITER $$
CREATE DEFINER=root@localhost FUNCTION retrieve_lateusers(id INT) RETURNS int(11)
BEGIN
    DECLARE count INT;
    
    SELECT COUNT(*)
    INTO count
    FROM bills
    WHERE CURDATE() > bills.duedate 
        AND CURDATE() < ADDDATE(bills.duedate, INTERVAL 25 DAY)
        AND bills.adminid = id
        AND bills.status = 'PENDING';
    
    RETURN count;
END$$
DELIMITER ;
DELIMITER $$
CREATE DEFINER=root@localhost FUNCTION remove_users(id INT) RETURNS int(11)
BEGIN
    DECLARE count INT;
    
    SELECT COUNT(*)
    INTO count
    FROM bills
    WHERE CURDATE() > ADDDATE(bills.duedate, INTERVAL 25 DAY)
        AND bills.adminid = id
        AND bills.status = 'PENDING';
    
    RETURN count;
END$$
DELIMITER ;