ALTER TABLE `person` CHANGE `adr` `adr` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'ที่อยู่ปัจจุบัน บ้านเลขที่';


-- Drop the existing primary key constraint
ALTER TABLE person DROP PRIMARY KEY;

-- Modify the perid column to be auto-increment and set it as the primary key
ALTER TABLE person
MODIFY perid BIGINT AUTO_INCREMENT PRIMARY KEY;
-- disptyp
ALTER TABLE disptyp DROP PRIMARY KEY;
ALTER TABLE disptyp
MODIFY disptypid  BIGINT AUTO_INCREMENT PRIMARY KEY;