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

PROMPT Создание таблицы "компоненты"
DROP TABLE components CASCADE CONSTRAINTS;

CREATE TABLE
    components (
        comp_job_id INTEGER NOT NULL,
        comp_id INTEGER NOT NULL,
        comp_value VARCHAR(20) NOT NULL,
        comp_type VARCHAR(20) NOT NULL
    );

PROMPT Добавление первичного ключа для components
ALTER TABLE components
DROP CONSTRAINT components;

ALTER TABLE components ADD (CONSTRAINT components PRIMARY KEY (comp_id));

PROMPT Создание таблицы "Документы"
DROP TABLE docs CASCADE CONSTRAINTS;

CREATE TABLE
    docs (
        doc_order_id INTEGER NOT NULL,
        doc_id INTEGER NOT NULL,
        doc_name VARCHAR(20) NOT NULL
    );

PROMPT Добавление первичного ключа для docs
ALTER TABLE docs
DROP CONSTRAINT docs;

ALTER TABLE docs ADD (CONSTRAINT docs PRIMARY KEY (doc_id));

PROMPT Создание таблицы "Предметы"
DROP TABLE items CASCADE CONSTRAINTS;

CREATE TABLE
    items (
        item_doc_id INTEGER NOT NULL,
        item_id INTEGER NOT NULL,
        item_state INTEGER NOT NULL,
        item_defect VARCHAR(20) NOT NULL
    );

PROMPT Создание таблицы "Работы"
DROP TABLE jobs CASCADE CONSTRAINTS;

CREATE TABLE
    jobs (
        job_id INTEGER NOT NULL,
        job_perf INTEGER NOT NULL,
        job_equip VARCHAR(20) NOT NULL,
        job_type VARCHAR(20) NOT NULL,
        job_item_id INTEGER NOT NULL
    );

PROMPT Добавление первичного ключа для jobs
ALTER TABLE jobs
DROP CONSTRAINT jobs;

ALTER TABLE jobs ADD (CONSTRAINT jobs PRIMARY KEY (job_id));

PROMPT Создание таблицы "Заказы"
DROP TABLE orders CASCADE CONSTRAINTS;

CREATE TABLE
    orders (
        order_cust VARCHAR(20) NOT NULL,
        order_id INTEGER NOT NULL,
        order_date DATE NOT NULL
    );

PROMPT Добавление первичного ключа для orders
ALTER TABLE orders
DROP CONSTRAINT orders;

ALTER TABLE orders ADD (CONSTRAINT orders PRIMARY KEY (order_id));

PROMPT Создание таблицы "Расходные материалы"
DROP TABLE raws CASCADE CONSTRAINTS;

CREATE TABLE
    raws (
        raw_job_id INTEGER NOT NULL,
        raw_id INTEGER NOT NULL,
        raw_name VARCHAR(20) NOT NULL,
        raw_num INTEGER NOT NULL
    );

PROMPT Добавление первичного ключа для raws
ALTER TABLE raws
DROP CONSTRAINT raws;

ALTER TABLE raws ADD (CONSTRAINT raws PRIMARY KEY (raw_id));

PROMPT Создание таблицы "Пользователи"
DROP TABLE users CASCADE CONSTRAINTS;

CREATE TABLE
    users (
        user_job_id INTEGER NOT NULL,
        user_id INTEGER NOT NULL,
        user_surname VARCHAR(20) NOT NULL,
        user_post VARCHAR(20) NOT NULL,
        user_thirdname VARCHAR(20) NOT NULL,
        user_ph VARCHAR(20) NOT NULL,
        user_name VARCHAR(20) NOT NULL
    );

PROMPT Добавление первичного ключа для users
ALTER TABLE users
DROP CONSTRAINT users;

ALTER TABLE users ADD (CONSTRAINT users PRIMARY KEY (user_id));

PROMPT Добавление ограничения для components в зависимости от jobs
ALTER TABLE components
DROP CONSTRAINT c_job_id;

ALTER TABLE components ADD (
    CONSTRAINT c_job_id FOREIGN KEY (comp_job_id) REFERENCES jobs
);

PROMPT Добавление ограничения для docs в зависимости от orders
ALTER TABLE docs ADD (
    CONSTRAINT c_order_id FOREIGN KEY (doc_order_id) REFERENCES orders
);

PROMPT Добавление ограничения для items в зависимости от docs
ALTER TABLE items
DROP CONSTRAINT c_doc_id;

ALTER TABLE items ADD (
    CONSTRAINT c_doc_id FOREIGN KEY (item_doc_id) REFERENCES docs
);

PROMPT Добавление ограничения для jobs в зависимости от items
ALTER TABLE jobs
DROP CONSTRAINT c_item_id;

ALTER TABLE jobs ADD (
    CONSTRAINT c_item_id FOREIGN KEY (job_item_id) REFERENCES items
);

PROMPT Добавление ограничения для raws в зависимости от jobs
ALTER TABLE raws
DROP CONSTRAINT c_job_id;

ALTER TABLE raws ADD (
    CONSTRAINT c_job_id FOREIGN KEY (raw_job_id) REFERENCES jobs
);

PROMPT Добавление ограничения для users в зависимости от jobs
ALTER TABLE users
DROP CONSTRAINT c_job_id;

ALTER TABLE users ADD (
    CONSTRAINT c_job_id FOREIGN KEY (user_job_id) REFERENCES jobs
);

PROMPT Создание тригера 1
CREATE
OR REPLACE TRIGGER tr_components BEFORE INSERT ON components FOR EACH ROW BEGIN
SELECT
    seq_components.NEXTVAL
INTO :new.comp_id
FROM
    DUAL;
END;
/

PROMPT Создание тригера 2
CREATE
OR REPLACE TRIGGER tr_docs BEFORE INSERT ON docs FOR EACH ROW BEGIN
SELECT
    seq_docs.NEXTVAL
INTO :new.doc_id
FROM
    DUAL;
END;
/

PROMPT Создание тригера 3
CREATE
OR REPLACE TRIGGER tr_items BEFORE INSERT ON items FOR EACH ROW BEGIN
SELECT
    seq_items.NEXTVAL
INTO :new.item_id
FROM
    DUAL;
END;
/

PROMPT Создание тригера 4
CREATE
OR REPLACE TRIGGER tr_jobs BEFORE INSERT ON jobs FOR EACH ROW BEGIN
SELECT
    seq_jobs.NEXTVAL
INTO :new.job_id
FROM
    DUAL;
END;
/

PROMPT Создание тригера 5
CREATE
OR REPLACE TRIGGER tr_orders BEFORE INSERT ON orders FOR EACH ROW BEGIN
SELECT
    seq_orders.NEXTVAL
INTO :new.order_id
FROM
    DUAL;
END;
/

PROMPT Создание тригера 6
CREATE
OR REPLACE TRIGGER tr_raws BEFORE INSERT ON raws FOR EACH ROW BEGIN
SELECT
    seq_raws.NEXTVAL
INTO :new.raw_id
FROM
    DUAL;
END;
/

PROMPT Создание тригера 7
CREATE
OR REPLACE TRIGGER tr_users BEFORE INSERT ON users FOR EACH ROW BEGIN
SELECT
    seq_users.NEXTVAL
INTO :new.user_id
FROM
    DUAL;
END;
/

SPOOL OFF;

exit