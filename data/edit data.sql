-- Active: 1693110158769@@127.0.0.1@3306@dek_equal_tani
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
