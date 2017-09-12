use oophp;

DROP TABLE IF EXISTS `Course`;
CREATE TABLE `Course`
(
	`code` CHAR(6),
	`nick` CHAR(12),
    `points` DECIMAL(3, 1),
	`name` VARCHAR(60)
);

DELETE FROM Course;
INSERT INTO Course
VALUES
	("DV1531", "python",     7.5, "Programmering och Problemlösning med Python"),
	("PA1439", "htmlphp",    7.5, "Webbteknologier"),
	("DV1561", "javascript", 7.5, "Programmering med JavaScript"),
	("PA1436", "design",     7.5, "Teknisk webbdesign och användbarhet"),
	("DV1547", "linux",      7.5, "Programmera webbtjänster i Linux"),
	("PA1437", "oopython",   7.5, "Objektorienterad design och programmering med Python"),
	("DV1546", "webapp",     7.5, "Webbapplikationer för mobila enheter"),
	("DV1506", "webgl",      7.5, "Spelteknik för webben"),
	("PA1444", "dbjs",      10.0, "Webbprogrammering och databaser")
;

SELECT * FROM Course;

EXPLAIN select * from Course;

EXPLAIN Course;

-- Skapa index via primärnyckel

-- Här väljer jag att lägga till primärnyckeln på den befintliga tabellen via ALTER TABLE.
ALTER TABLE Course ADD PRIMARY KEY(code);

-- Nu kan jag se hur EXPLAIN tolkar resultatet, nu med primärnyckel som ger ett index.
EXPLAIN SELECT * FROM Course WHERE code = "PA1444";

-- Nytt index med Unique

-- Det löser vi med att sätta kolumnen som UNIQUE vilket innebär att varje värde i kolumnen är unikt,
-- på samma sätt som primärnyckeln.
ALTER TABLE Course ADD CONSTRAINT nick_unique UNIQUE (nick);

EXPLAIN SELECT * FROM Course WHERE nick = "dbjs";

-- Visa och ta bort index

SHOW INDEX FROM Course;

-- Vill vi ta bort ett index kan vi göra det med DROP INDEX via dess namn.
DROP INDEX nick_unique ON Course;

-- Det finns andra sätt än ALTER TABLE att skapa ett index, du kan skapa nya index med CREATE INDEX.
CREATE UNIQUE INDEX nick_unique ON Course (nick);

-- Skapa index vid CREATE TABLE

-- Om vi återskapar vår egen tabell, nu med index från början, skulle koden kunna se ut så här.
DROP TABLE IF EXISTS `Course`;
CREATE TABLE `Course`
(
    `code` CHAR(6),
    `nick` CHAR(12),
    `points` DECIMAL(3, 1),
    `name` VARCHAR(60),

    PRIMARY KEY (`code`),
    UNIQUE KEY `nick_unique` (`nick`)
);


-- Index för delsökning av sträng


SELECT * FROM Course WHERE name LIKE "Webb%";

-- Det finns tre träffar på LIKE "Webb%" men det krävs en full table scan för att hitta dem.
-- Låt se hur bra ett index kan lösa detta.
CREATE INDEX index_name ON Course(name);

-- Vi skapar ett vanligt index som databasen kan använda för att indexera värden i kolumnen name.

EXPLAIN SELECT * FROM Course WHERE name LIKE "Webb%";

EXPLAIN Course;

-- Man undrar om det även löser frågor likt LIKE "%prog%" eller LIKE "%Python"?
-- Följande tester säger dock nej.

-- Full text index

-- Vi skapar ett FULLTEXT index och använder sedan MATCH och AGAINST
-- för att utföra en fulltext-sökning som returnerar en poäng för hur väl söksträngen matchade texten.

-- Först skapar vi indexet.
CREATE FULLTEXT INDEX full_name ON Course(name);

-- Sedan kör vi en fråga med MATCH och AGAINST. Svaret score visar hur bra söksträngarna matchade.
SELECT name, MATCH(name) AGAINST ("Program* web*" IN BOOLEAN MODE) AS score FROM Course ORDER BY score DESC;

-- Index för numeriska värden

-- Låt oss pröva en variant av SELECT och index där jag vill ha fram alla rader som är större än ettt numeriskt värde,
-- säg points > 7.5 för alla kurser som är större än 7.5hp.

SELECT * FROM Course WHERE points > 7.5;

EXPLAIN SELECT * FROM Course WHERE points > 7.5;

-- Det blev en table scan. Vi prövar att optimera med ett vanligt index.
CREATE INDEX index_points ON Course(points);


-- Där har vi resultatet av hela övningen, en tabell med primärnyckel,
-- en unique kolumn, ett par index varav ett är fulltext.

CREATE TABLE `Course` (
    `code` char(6) NOT NULL DEFAULT '',
    `nick` char(12) DEFAULT NULL,
    `points` decimal(3,1) DEFAULT NULL,
    `name` varchar(60) DEFAULT NULL,

    PRIMARY KEY (`code`),
    UNIQUE KEY `nick_unique` (`nick`),
    KEY `index_name` (`name`),
    KEY `index_points` (`points`),
    FULLTEXT KEY `full_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

-- Dock, innan man väljer index så bör man tänka igenom vilka frågor som kommer att ske mot databasen,
-- det underlättar att se vilka kolumner som behöver indexeras.
