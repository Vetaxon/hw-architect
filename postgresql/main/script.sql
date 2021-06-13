-- create main table
CREATE TABLE IF NOT EXISTS books
(
    id          bigint            not null,
    category_id int               not null,
    author      character varying not null,
    title       character varying not null,
    year        int               not null
);

CREATE RULE books_insert AS ON INSERT TO books DO INSTEAD NOTHING;
CREATE RULE books_update AS ON UPDATE TO books DO INSTEAD NOTHING;
CREATE RULE books_delete AS ON DELETE TO books DO INSTEAD NOTHING;

CREATE EXTENSION IF NOT EXISTS postgres_fdw;

-- add shard server 1
CREATE SERVER IF NOT EXISTS books_1_server
    FOREIGN DATA WRAPPER postgres_fdw
    OPTIONS ( host 'db-shard-1', port '5432', dbname 'books_1');

CREATE USER MAPPING IF NOT EXISTS FOR postgres
    SERVER books_1_server
    OPTIONS (user 'postgres', password 'postgres');

CREATE
FOREIGN TABLE IF NOT EXISTS books_1 (
    id bigint not null,
    category_id  int not null,
    author character varying not null,
    title character varying not null,
    year int not null )
    SERVER books_1_server
    OPTIONS (schema_name 'public', table_name 'books');

CREATE
RULE books_insert_to_1 AS ON
INSERT TO books
WHERE ( category_id = 1 )
DO INSTEAD INSERT INTO books_1 VALUES (NEW.*);

-- add shard server 2
CREATE SERVER IF NOT EXISTS books_2_server
    FOREIGN DATA WRAPPER postgres_fdw
    OPTIONS ( host 'db-shard-2', port '5432', dbname 'books_2' );

CREATE USER MAPPING IF NOT EXISTS FOR postgres
    SERVER books_2_server
    OPTIONS (user 'postgres', password 'postgres');

CREATE
FOREIGN TABLE IF NOT EXISTS books_2 (
    id bigint not null,
    category_id  int not null,
    author character varying not null,
    title character varying not null,
    year int not null )
    SERVER books_2_server
    OPTIONS (schema_name 'public', table_name 'books');


CREATE
RULE books_insert_to_2 AS ON
INSERT TO books
WHERE ( category_id = 2 )
DO INSTEAD INSERT INTO books_2 VALUES (NEW.*);

-- create view table
CREATE VIEW all_books AS
SELECT *
FROM books_1
UNION ALL
SELECT *
FROM books_2;

-- insert demo data
do
    $do$
declare i int;
declare s int;
begin
    for  i in 1..1000000
    loop
        s = floor(random() * 2 + 1);
        INSERT INTO books (id, category_id, author, title, year) values (i, s, CONCAT('author-', i), CONCAT('title-', i), 2000);
    end loop;
end;
$do$;


-- check server connections
select * from pg_foreign_server;
