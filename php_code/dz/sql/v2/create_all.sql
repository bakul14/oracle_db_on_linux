SPOOL asutp_start.log PROMPT Создание последовательностей
DROP SEQUENCE seq_components;

DROP SEQUENCE seq_docs;

DROP SEQUENCE seq_items;

DROP SEQUENCE seq_jobs;

DROP SEQUENCE seq_orders;

DROP SEQUENCE seq_raws;

DROP SEQUENCE seq_users;

CREATE SEQUENCE seq_components START
WITH
    1 INCREMENT BY 1;

CREATE SEQUENCE seq_docs START
WITH
    1 INCREMENT BY 1;

CREATE SEQUENCE seq_items START
WITH
    1 INCREMENT BY 1;

CREATE SEQUENCE seq_jobs START
WITH
    1 INCREMENT BY 1;

CREATE SEQUENCE seq_orders START
WITH
    1 INCREMENT BY 1;

CREATE SEQUENCE seq_raws START
WITH
    1 INCREMENT BY 1;

CREATE SEQUENCE seq_users START
WITH
    1 INCREMENT BY 1;

PROMPT Создание таблицы "Пользователи"
DROP TABLE users CASCADE CONSTRAINTS;

CREATE TABLE
    users (
        user_job_id INTEGER NOT NULL,
        user_id INTEGER NOT NULL,
        user_firstname VARCHAR(20) NOT NULL,
        user_secondname VARCHAR(20) NOT NULL,
        user_thirdname VARCHAR(20) NOT NULL,
        user_post VARCHAR(20) NOT NULL
    );

PROMPT Добавление первичного ключа для users
ALTER TABLE users
DROP CONSTRAINT users;

ALTER TABLE users ADD (CONSTRAINT users PRIMARY KEY (user_id));