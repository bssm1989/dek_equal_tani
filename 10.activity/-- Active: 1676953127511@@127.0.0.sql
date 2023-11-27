-- Active: 1676953127511@@127.0.0.1@8889@dek_equal_tani
 SELECT
        a.actid,
        a.actnme,
        at.acttypnme AS activity_type,
        a.actdtestr,
        a.actdteend,
        a.actplc,
        cv.plcnmegen as actplc,
        a.actattdno,
        a.actdetail,
        a.plcid
    FROM
        activity a
   left JOIN
        acttyp at ON a.acttypid = at.acttypid
 left join
       const_plcnmegen cv on cv.plcidgen = a.plcid

       INSERT INTO staff (pid, titid, staffnme, staffsnme, stafftell, staffemail, stafforg, plcid, staffposid, staffprioid, recorded_by, recorded_date) VALUES ("1941000123538", "3", "refdfdfd", "fdfdfrwgft", "53563563", "sfgsdds@gmsil.vom", "sdgfdsfgdfg", "110201", "1", "0", "1", "2023-10-16 06:51:56")


       SELECT * FROM staff
           
            LEFT JOIN titname ON staff.titid = titname.titid
            -- LEFT JOIN const_vllnmegen ON staff.plcid = const_vllnmegen.plcid
            LEFT JOIN staffpos ON staff.staffposid = staffpos.staffposid
            LEFT JOIN staffprio ON staff.staffprioid = staffprio.staffprioid