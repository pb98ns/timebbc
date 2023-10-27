drop procedure if exists week;
delimiter //
create procedure week(IN user_id int(11), IN start_date date,  IN end_date date, IN type_vacation varchar(11),IN size float(11))

begin
DECLARE Counter INT;
DECLARE TotalCount INT;
DECLARE DateValue DATE;
DECLARE userid INT;
DECLARE CounterUser INT;

SET userid = user_id;
SET Counter = 0;
SET TotalCount = DateDiff(end_date, start_date);
SET start_date = DATE_SUB(start_date, INTERVAL 1 DAY);


WHILE (Counter <=TotalCount) DO


  SET  DateValue = DATE_ADD(start_date, INTERVAL 1 DAY);
   SET  CounterUser = ((select count(*) from vacations t1 where ((t1.user_id = userid && t1.vacation_date = DateValue))));
  if (dayofweek(DateValue) != "1" && dayofweek(DateValue) != "7" && DateValue != "2023-01-01" && DateValue != "2023-01-06" && DateValue != "2023-04-09" && DateValue != "2023-04-10" && DateValue != "2023-05-01" && DateValue != "2023-05-03" && DateValue != "2023-06-08" && DateValue != "2023-08-15" && DateValue != "2023-11-01" && DateValue != "2023-11-11" && DateValue != "2023-12-25" && DateValue != "2023-12-26" && DateValue != "2024-01-01" && DateValue != "2024-01-06" && DateValue != "2024-03-31" && DateValue != "2024-04-01" && DateValue != "2024-05-01" && DateValue != "2024-05-03" && DateValue != "2024-05-30" && DateValue != "2024-08-15" && DateValue != "2024-11-01" && DateValue != "2024-11-11" && DateValue != "2024-12-25" && DateValue != "2024-12-26" && DateValue != "2025-01-01" && DateValue != "2025-01-06" && DateValue != "2025-04-20" && DateValue != "2025-04-21" && DateValue != "2025-05-01" && DateValue != "2025-05-03" && DateValue != "2025-06-08" && DateValue != "2025-06-19" && DateValue != "2025-08-15" && DateValue != "2025-11-01" && DateValue != "2025-11-11" && DateValue != "2025-12-25" && DateValue != "2025-12-26" && DateValue != "2026-01-01" && DateValue != "2026-01-06" && DateValue != "2026-04-05" && DateValue != "2026-04-06" && DateValue != "2026-05-01" && DateValue != "2026-05-03" && DateValue != "2026-05-24" && DateValue != "2026-05-04" && DateValue != "2026-08-15" && DateValue != "2026-11-01" && DateValue != "2026-11-11" && DateValue != "2026-12-25" && DateValue != "2026-12-26") then
if (CounterUser = 0 )
then
    INSERT INTO vacations (user_id, vacation_date, type_vacation,size, status1) values (user_id, DateValue, type_vacation,size, "Oczekuje na potwierdzenie");
end if;
 end if;
    SET Counter = Counter + 1;
    SET start_date = DateValue;
END WHILE;


end //

delimiter ;