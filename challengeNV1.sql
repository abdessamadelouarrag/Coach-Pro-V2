--1)--
select users.nom, count(seances.id) total_seances from users inner join seances on users.id = seances.coach_id group by users.nom;

--2)--
select users.nom, count(seances.id) as nbr_seances_reserver from users inner join seances on users.id = seances.coach_id where seances.statut = 'reservee' group by users.nom ;

--3)--
select users.nom, (count(reservations.id) * 100 / count(seances.id)) from users inner join seances on seances.coach_id = users.id
inner join reservations on reservations.seance_id = seances.id group by users.nom;

--4)--
SELECT u.nom,COUNT(s.id) as nbr_seances from users u inner join seances s on s.coach_id = u.id
Where u.role = 'coach' group by u.id, u.nom having COUNT(s.id) >= 3;
