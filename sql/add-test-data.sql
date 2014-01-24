use kurssikysely;

insert into Rooli values ('coordinator'), ('teacher'), ('student');

insert into Kayttaja values ('co12345678', 'c*********', 'Co', 'Ordinator'),
                            ('te12345678', 't*********', 'Tea', 'Cher'),
                            ('st12345678', 's*********', 'Stu', 'Dent');

insert into Kysymys(tyyppi, teksti, vaihtoehtojenLkm) values
                   ('multipleChoises', 'The course material was useful.', 5),
                   ('multipleChoises', 'The lectures helped me to deepen my understanding of the subject.', 3),
                   ('freeText', 'What do you think was the most interesting topic on the course?', 0);                  

insert into Kurssi values (1576323, 'Introduction to programming', 4),
                          (1943124, 'Basics of JavaScript', 2),
                          (1244325, 'Software engineering', 6);
                   
insert into Kayttooikeus values ('co12345678', 'coordinator'),
                                ('te12345678', 'teacher'),
                                ('st12345678', 'student');
                                
insert into Kurssitoteutus(kurssikoodi, alkuPvm, loppuPvm, vastuuhenkilo) values
                          (1576323, '2013-01-10', '2013-05-14', 'te12345678'),
                          (1943124, '2013-01-11', '2013-05-15', 'te12345678'),
                          (1244325, '2014-01-12', '2014-05-16', 'te12345678');
                          
insert into Kysely(kurssi, laatija, tila, avautumisaika, sulkeutumisaika) values
                  (1576323, 'te12345678', 'inactive', '2013-05-10 08:00:00', '2013-05-20 23:59:59'),
                  (1943124, 'te12345678', 'inactive', '2013-05-11 08:00:00', '2013-05-21 23:59:59'),
                  (1244325, 'te12345678', 'active', '2014-01-20 08:00:00', '2014-05-31 23:59:59');                                    

insert into Kysymysryhma values (1, 3), (2, 3), (3, 3);
