select name, type, last_login
from user
where email="it.skbehera@optcl.co.in"

INSERT INTO `access_log` (`id`, `email`, `timestamp`, `ip`, `browser`)
VALUES (NULL, 'it.skbehera@optcl.co.in', '09-08-2020 11:49', 'localhost',
'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0');

insert into access_log (email, timestamp, ip, browser)
values ('it.skbehera@optcl.co.in', '09-08-2020 11:49', 'localhost',
'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0');

select timestamp from access_log where email="it.skbehera@optcl.co.in" order by id desc limit 1,1

INSERT INTO `power_source` (`source_id`, `sector_type_id`, `power_type_id`, `short_name`, `details`, `start_date`, `active`)
VALUES ('1', '1', '1', 'HIRAKUD', '', '2020-08-13', 'Y')

insert into power_source (source_id, sector_type_id, power_type_id, short_name, details, start_date, active) values (?, ?, ?, ?, ?, ?, ?)

select sector_id, sector_name from power_sector

select power_type_id, power_type_name from power_type

select count(*) as source_count from power_source

select s.source_id, x.sector_name, t.power_type_name, s.short_name, s.details, s.start_date, s.active
from power_source s, power_sector x, power_type t
where s.sector_type_id = x.sector_id
and s.power_type_id = t.power_type_id
order by s.source_id asc

select id, name, email, type, active from user where active = "Y" and email != "it.skbehera@optcl.co.in" order by type, id

select count(*) as user_count from user

insert into user (id, email, name, type, active) values (4, "ele.akmoharana@optcl.co.in", "Alok Kumar Maharana", "C", "Y");

update user set active="N" where id=5

update power_source set active="Y", start_date="2020-08-18" where source_id=6

select id, name from user where type="C" and active="Y" order by id asc

select source_id, short_name from power_source where active="Y" order by source_id asc

insert into assignment (user_id, source_id) values (1, 3)


select s.source_id, s.short_name
from power_source s, assignment a
where s.source_id = a.source_id
and a.user_id = 7

delete from assignment where user_id=3 and source_id=20

select distinct user_id from assignment

select id, name from user where type="C" and active="Y" and id not in (select distinct user_id from assignment)

select distinct source_id from assignment

select source_id, short_name from power_source where active="Y" and source_id not in (select distinct source_id from assignment) order by source_id asc


CREATE TABLE `pcm`.`journal`
( `source_id` INT(3) NOT NULL ,
`year` INT(4) NOT NULL ,
`month` INT(2) NOT NULL ,
`energy_billed` DECIMAL(5,2) NOT NULL ,
`transmission_loss` DECIMAL(5,2) NOT NULL ,
`fixed_cost` DECIMAL(5,2) NOT NULL ,
`variable_cost` DECIMAL(5,2) NOT NULL ,
`adjustment` DECIMAL(5,2) NOT NULL ,
`affect_date` DATE NOT NULL ,
`affect_by` INT(3) NOT NULL ,
PRIMARY KEY (`source_id`, `year`, `month`))

insert into journal (source_id, year, month, energy_billed, transmission_loss, fixed_cost, variable_cost, adjustment, affect_date, affect_by)
values (3, 2020, 08, 33.45, 0.00, 3.23, 0.32, 0.00, 2020-08-30, 1)

select j.source_id, s.short_name, p.sector_name, t.power_type_name, j.energy_billed, j.transmission_loss, j.fixed_cost, j.variable_cost, j.adjustment, j.affect_date, u.name
from journal j, power_source s, user u, power_sector p, power_type t
where j.source_id = s.source_id
and j.affect_by = u.id
and s.power_type_id = t.power_type_id
and s.sector_type_id = p.sector_id
order by j.affect_date desc

update journal
set adjustment=6.0
where source_id=5
and year=2020
and month=8

select count(*) from power_source where active = "Y"
select count(source_id) from journal where year=2020 and month=08

select round(((select count(source_id) from journal where year=2020 and month=08)/(select count(*) from power_source where active = "Y"))*100)
from user where id=1

select count(source_id)
from assignment
where user_id=3

select source_id
from journal
where source_id in (select source_id from assignment where user_id=3)
and year=2020
and month=8

select count(source_id)
from journal
where source_id in (select source_id from assignment where user_id=3)
and year=2020
and month=8

select round(((select count(source_id)
from journal
where source_id in (select source_id from assignment where user_id=3)
and year=2020
and month=8)/(select count(source_id)
from assignment
where user_id=3))*100) as progress
from user
where id=1

ALTER TABLE tablename AUTO_INCREMENT = 1

select *
from journal
where source_id = 44
and

select s.short_name as SOURCE, sum(j.energy_billed) as MU, sum(j.variable_cost) as COST, round(sum(j.variable_cost)/sum(j.energy_billed)*1000, 2) as RATE
from journal j, power_source s, power_sector p, power_type t
where j.source_id = s.source_id
and s.sector_type_id = p.sector_id
and s.power_type_id = t.power_type_id
and p.sector_id = 4
and t.power_type_id = 9
and ((year = 2020 and month > 3) or (year = 2021 and month < 4))
group by s.source_id
order by s.source_id asc

select s.short_name as SOURCE, sum(j.energy_billed) as MU, sum(j.variable_cost) as COST, round(sum(j.variable_cost)/sum(j.energy_billed)*1000, 2) as RATE
from journal j, power_source s, power_sector p, power_type t
where j.source_id = s.source_id
and s.sector_type_id = p.sector_id
and s.power_type_id = t.power_type_id
and p.sector_id = 4
and t.power_type_id = 8
and ((year = 2020 and month > 3) or (year = 2021 and month < 4))
group by s.source_id
order by s.source_id asc

select s.short_name as SOURCE, sum(j.energy_billed) as MU, sum(j.transmission_loss) as LOSS, sum(j.energy_billed-j.transmission_loss) as NET,
sum(j.fixed_cost) as FIXED, sum(j.variable_cost) as VAR, sum(j.adjustment) as ADJ, sum(j.fixed_cost+j.variable_cost+j.adjustment) as COST,
round(sum(j.fixed_cost+j.variable_cost+j.adjustment)/sum(j.energy_billed)*1000, 2) as RATE
from journal j, power_source s, power_sector p, power_type t
where j.source_id = s.source_id
and s.sector_type_id = p.sector_id
and s.power_type_id = t.power_type_id
and p.sector_id = 1
and t.power_type_id = 1
and ((year = 2020 and month > 3) or (year = 2021 and month < 4))
group by s.source_id
order by s.source_id asc

select s.short_name as SOURCE, j.energy_billed as MU, j.transmission_loss as LOSS, j.energy_billed-j.transmission_loss as NET,
j.fixed_cost as FIXED, j.variable_cost as VAR, j.adjustment as ADJ, j.fixed_cost+j.variable_cost+j.adjustment as COST,
round(((j.fixed_cost+j.variable_cost+j.adjustment)/j.energy_billed)*1000,2) as RATE
from journal j, power_source s, power_sector p, power_type t
where j.source_id = s.source_id
and s.sector_type_id = p.sector_id
and s.power_type_id = t.power_type_id
and p.sector_id = 1
and t.power_type_id = 1
and j.month = 5
and j.year = 2020
order by s.source_id asc

select s.short_name as SOURCE, j.energy_billed as MU, j.variable_cost as COST, round(j.variable_cost/j.energy_billed*1000, 2) as RATE
from journal j, power_source s, power_sector p, power_type t
where j.source_id = s.source_id
and s.sector_type_id = p.sector_id
and s.power_type_id = t.power_type_id
and p.sector_id = 4
and t.power_type_id = 9
and j.month = 4
and j.year = 2020
order by s.source_id asc

select *
from journal
where year = 2020
and month = 10
and source_id = 10

select p.sector_name, count(p.sector_name)
from power_source s, power_sector p
where s.sector_type_id = p.sector_id
group by p.sector_name
order by p.sector_id asc



select sum(energy_billed)
from journal
where year = 2020
and month = 4
and source_id in (select source_id from power_source where sector_type_id in (1,2,3))

select month, sum(energy_billed)
from journal
where ((year = 2020 and month > 3) or (year = 2021 and month < 4))
and source_id in (select source_id from power_source where sector_type_id in (1,2,3))
group by month
