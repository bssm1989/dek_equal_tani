-- Active: 1676953127511@@127.0.0.1@8889@dek_equal_tani
UPDATE person
SET
    recorded_by = 1,
    recorded_date = NOW(),
    modified_by = 1,
    modified_date = NOW()
WHERE
    recorded_by IS NULL
    AND recorded_date IS NULL
    AND modified_by IS NULL
    AND modified_date IS NULL
    AND status_row IS NULL;

UPDATE child
SET
    recorded_by = 1,
    recorded_date = NOW(),
    modified_by = 1,
    modified_date = NOW()
WHERE
    recorded_by IS NULL
    AND recorded_date IS NULL
    AND modified_by IS NULL
    AND modified_date IS NULL
    AND status_row IS NULL;

UPDATE disptyp
SET
    recorded_by = 1,
    recorded_date = NOW(),
    modified_by = 1,
    modified_date = NOW()
WHERE
    recorded_by IS NULL
    AND recorded_date IS NULL
    AND modified_by IS NULL
    AND modified_date IS NULL
    AND status_row IS NULL;

ALTER TABLE inststay
ADD recorded_by int(5) COMMENT 'ผู้บันทึก',
ADD recorded_date datetime COMMENT 'วันที่บันทึก',
ADD modified_by int(5) COMMENT 'ผู้ปรับปรุงแก้ไข',
ADD modified_date datetime COMMENT 'วันที่ปรับปรุงแก้ไข',
ADD status_row int(2) COMMENT 'active 1,delete 0';
UPDATE inststay
SET
    recorded_by = 1,
    recorded_date = NOW(),
    modified_by = 1,
    modified_date = NOW()
WHERE
    recorded_by IS NULL
    AND recorded_date IS NULL
    AND modified_by IS NULL
    AND modified_date IS NULL
    AND status_row IS NULL;

UPDATE hedu
SET
    recorded_by = 1,
    recorded_date = NOW(),
    modified_by = 1,
    modified_date = NOW()
WHERE
    recorded_by IS NULL
    AND recorded_date IS NULL
    AND modified_by IS NULL
    AND modified_date IS NULL
    AND status_row IS NULL;

UPDATE hwork
SET
    recorded_by = 1,
    recorded_date = NOW(),
    modified_by = 1,
    modified_date = NOW()
WHERE
    recorded_by IS NULL
    AND recorded_date IS NULL
    AND modified_by IS NULL
    AND modified_date IS NULL
    AND status_row IS NULL;

UPDATE hhelpedu
SET
    recorded_by = 1,
    recorded_date = NOW(),
    modified_by = 1,
    modified_date = NOW()
WHERE
    recorded_by IS NULL
    AND recorded_date IS NULL
    AND modified_by IS NULL
    AND modified_date IS NULL
    AND status_row IS NULL;

UPDATE hhelpjob
SET
    recorded_by = 1,
    recorded_date = NOW(),
    modified_by = 1,
    modified_date = NOW()
WHERE
    recorded_by IS NULL
    AND recorded_date IS NULL
    AND modified_by IS NULL
    AND modified_date IS NULL
    AND status_row IS NULL;

UPDATE htraining
SET
    recorded_by = 1,
    recorded_date = NOW(),
    modified_by = 1,
    modified_date = NOW()
WHERE
    recorded_by IS NULL
    AND recorded_date IS NULL
    AND modified_by IS NULL
    AND modified_date IS NULL
    AND status_row IS NULL;

UPDATE hfolowup
SET
    recorded_by = 1,
    recorded_date = NOW(),
    modified_by = 1,
    modified_date = NOW()
WHERE
    recorded_by IS NULL
    AND recorded_date IS NULL
    AND modified_by IS NULL
    AND modified_date IS NULL
    AND status_row IS NULL;

UPDATE activity
SET
    recorded_by = 1,
    recorded_date = NOW(),
    modified_by = 1,
    modified_date = NOW()
WHERE
    recorded_by IS NULL
    AND recorded_date IS NULL
    AND modified_by IS NULL
    AND modified_date IS NULL
    AND status_row IS NULL;

UPDATE staff
SET
    recorded_by = 1,
    recorded_date = NOW(),
    modified_by = 1,
    modified_date = NOW()
WHERE
    recorded_by IS NULL
    AND recorded_date IS NULL
    AND modified_by IS NULL
    AND modified_date IS NULL
    AND status_row IS NULL;
    ALTER TABLE member
ADD recorded_by int(5) COMMENT 'ผู้บันทึก',
ADD recorded_date datetime COMMENT 'วันที่บันทึก',
ADD modified_by int(5) COMMENT 'ผู้ปรับปรุงแก้ไข',
ADD modified_date datetime COMMENT 'วันที่ปรับปรุงแก้ไข',
ADD status_row int(2) COMMENT 'active 1,delete 0';
UPDATE member
SET
    recorded_by = 1,
    recorded_date = NOW(),
    modified_by = 1,
    modified_date = NOW()
WHERE
    recorded_by IS NULL
    AND recorded_date IS NULL
    AND modified_by IS NULL
    AND modified_date IS NULL
    AND status_row IS NULL;


ALTER TABLE institute
ADD recorded_by int(5) COMMENT 'ผู้บันทึก',
ADD recorded_date datetime COMMENT 'วันที่บันทึก',
ADD modified_by int(5) COMMENT 'ผู้ปรับปรุงแก้ไข',
ADD modified_date datetime COMMENT 'วันที่ปรับปรุงแก้ไข',
ADD status_row int(2) COMMENT 'active 1,delete 0';
UPDATE institute
SET
    recorded_by = 1,
    recorded_date = NOW(),
    modified_by = 1,
    modified_date = NOW()
WHERE
    recorded_by IS NULL
    AND recorded_date IS NULL
    AND modified_by IS NULL
    AND modified_date IS NULL
    AND status_row IS NULL;
