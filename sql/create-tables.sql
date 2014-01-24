use kurssikysely;

create table if not exists Rooli( nimi varchar(15) not null, primary key(nimi) );

create table if not exists Kayttaja( tunnus varchar(10) not null, salasana varchar(20) not null,
                                     etunimi varchar(20) not null, sukunimi varchar(20) not null,
                                     primary key(tunnus) );
          
create table if not exists Kysymys( tunnus int not null auto_increment, tyyppi varchar(20) not null,
                                    teksti varchar(120), vaihtoehtojenLkm int, primary key(tunnus) );

create table if not exists Kurssi( kurssikoodi int not null, nimi varchar(30) not null,
                                   opintopisteet int not null, primary key(kurssikoodi) );

create table if not exists Kayttooikeus( kayttaja varchar(10) not null, rooli varchar(15) not null,
                                         primary key(kayttaja, rooli), foreign key(kayttaja) references
                                         Kayttaja(tunnus), foreign key(rooli) references Rooli(nimi) );

create table if not exists Kurssitoteutus( tunnus int not null auto_increment, kurssikoodi int not null, alkuPvm date,
                                           loppuPvm date, vastuuhenkilo varchar(10), primary key(tunnus),
                                           foreign key(kurssikoodi) references Kurssi(kurssikoodi),
                                           foreign key(vastuuhenkilo) references Kayttaja(tunnus) );

create table if not exists Kysely( tunnus int not null auto_increment, kurssi int, laatija varchar(10) not null, tila varchar(20),
                                   avautumisaika datetime, sulkeutumisaika datetime, primary key(tunnus),
                                   foreign key(kurssi) references Kurssitoteutus(tunnus) );

create table if not exists Kysymysryhma( kysymys int not null, kysely int not null,
                                         primary key(kysymys, kysely), foreign key(kysymys) references
                                         Kysymys(tunnus), foreign key(kysely) references Kysely(tunnus) );
