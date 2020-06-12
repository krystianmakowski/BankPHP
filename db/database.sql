SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `freeaccounts` (
  `freeaccid` int(10) NOT NULL AUTO_INCREMENT,
  `accnumber` varchar(28) NOT NULL,
  `status` varchar(9) NOT NULL,
  `bankname` varchar(28) NOT NULL,
  `creditcardnumber` varchar(16) NOT NULL,
  PRIMARY KEY (`freeaccid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

INSERT INTO `freeaccounts` (`freeaccid`, `accnumber`, `status`, `bankname`, `creditcardnumber`) VALUES
(1, '41709610558690719689433331', 'ACTIVE', "MBANK", '4532861656613340'),
(2, '51787754470494660785629060', 'ACTIVE', "PKO BP", '4916697135385985'),
(3, '75437572913376722654175449', 'ACTIVE', "SANTANDER", '4844949321542896'),
(4, '88526237099145149173097131', 'NOTACTIVE', "MBANK", '4917670730939364'),
(5, '64903716938455407112592827', 'NOTACTIVE', "GETIN BANK", '4026578309988522'),
(6, '70866089901543860662508394', 'NOTACTIVE', "SANTANDER", '2221002642096379'),
(7, '56579024965436597128262055', 'NOTACTIVE', "MBANK", '5468686669984312'),
(8, '57029086948752065070759444', 'NOTACTIVE', "PKO SA", '5348169574555044'),
(9, '84112109084048977053252233', 'NOTACTIVE', "MBANK", '6763366390973310'),
(10, '32086909924091374823664917', 'NOTACTIVE', "SANTANDER", '6762291587998659');


CREATE TABLE IF NOT EXISTS `accounts` (
  `accid` int(10) NOT NULL AUTO_INCREMENT,
  `accnumber` varchar(28) NOT NULL,
  `customerid` int(10) NOT NULL,
  `accbalance` double(10,2) NOT NULL,
  `creditcardnumber` varchar(16) NOT NULL,
  PRIMARY KEY (`accid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


INSERT INTO `accounts` (`accid`, `accnumber`, `customerid`, `accbalance`, `creditcardnumber`) VALUES
(1, '41709610558690719689433331', 1, 100000.00, '4532861656613340'),
(2, '51787754470494660785629060', 2, 100.00, '4916697135385985'),
(3, '75437572913376722654175449', 3, 10000.00, '4844949321542896');


CREATE TABLE IF NOT EXISTS `customers` (
  `customerid` int(10) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `pesel` varchar(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`customerid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


INSERT INTO `customers` (`customerid`, `firstname`, `lastname`, `pesel`, `email`, `password`) VALUES
(1, 'Krystian', 'Makowski', '93110311234', 'krystian@gmail.com', '$2y$10$Qlb4usk6Z9PBPCFJozUIyu650xSuFeTw1Ns.HQu2gbWnUiWM1lOdS'),
(2, 'Jan', 'Kowalski', '91021211234', 'jan@gmail.com', '$2y$10$Qlb4usk6Z9PBPCFJozUIyu650xSuFeTw1Ns.HQu2gbWnUiWM1lOdS'),
(3, 'Dorota', 'Kowalska', '88050313234', 'dorota@gmail.com', '$2y$10$Qlb4usk6Z9PBPCFJozUIyu650xSuFeTw1Ns.HQu2gbWnUiWM1lOdS');

CREATE TABLE IF NOT EXISTS `loan` (
  `loanid` int(10) NOT NULL AUTO_INCREMENT,
  `amount` double(10,2) NOT NULL,
  `customerid` int(10),
  PRIMARY KEY (`loanid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

INSERT INTO `loan` (`loanid`, `amount`, `customerid`) VALUES
(1, 10000.00, 1);

CREATE TABLE IF NOT EXISTS `transaction` (
  `transactionid` int(10) NOT NULL AUTO_INCREMENT,
  `transactiondate` date NOT NULL,
  `paymentdate` date NOT NULL,
  `amount` double(10,2) NOT NULL,
  `customerid` int(10),
  `type` varchar(25) NOT NULL,
  PRIMARY KEY (`transactionid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


INSERT INTO `transaction` (`transactionid`, `transactiondate`, `paymentdate`, `amount`, `customerid`, `type`) VALUES
(1, '2019-12-13', '2019-12-14', 1.00, 1, "IN"),
(2, '2020-03-12', '2020-03-12', 1.00, 1, "OUT");
