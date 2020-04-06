#### 2020-04-05
ALTER TABLE `dali_archive` ADD `quartiere` VARCHAR(100) NOT NULL AFTER `note`, ADD `municipalita` VARCHAR(10) NOT NULL AFTER `quartiere`;


#### 2020-04-01
ALTER TABLE `dali_users` ADD `type` INT(11) NOT NULL AFTER `status_activation_code`;
