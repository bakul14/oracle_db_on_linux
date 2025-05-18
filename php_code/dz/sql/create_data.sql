SPOOL asutp_start.log

PROMPT Скрипт заполнения таблиц АСУ ТП изготовления радиопередатчика тестовыми данными
PROMPT Автор: Бакулевский М.В.

PROMPT в таблицу orders (заказы)
INSERT INTO
    orders (order_cust, order_id, order_date)
VALUES
    (
        'ООО Ромашка',
        NULL,
        TO_DATE ('2025-01-15', 'YYYY-MM-DD')
    );

INSERT INTO
    orders (order_cust, order_id, order_date)
VALUES
    (
        'АО Лилия',
        NULL,
        TO_DATE ('2025-02-20', 'YYYY-MM-DD')
    );

INSERT INTO
    orders (order_cust, order_id, order_date)
VALUES
    (
        'ИП Иванов',
        NULL,
        TO_DATE ('2025-03-10', 'YYYY-MM-DD')
    );

PROMPT в таблицу docs (документы)
INSERT INTO
    docs (doc_order_id, doc_id, doc_name)
VALUES
    (1, NULL, 'Название документа: ГОСТ 1 1991');

INSERT INTO
    docs (doc_order_id, doc_id, doc_name)
VALUES
    (2, NULL, 'Название документа: Справочник 2');

INSERT INTO
    docs (doc_order_id, doc_id, doc_name)
VALUES
    (3, NULL, 'Название документа: Спецификатор 3');

PROMPT в таблицу items (предметы)
INSERT INTO
    items (item_doc_id, item_id, item_state, item_defect)
VALUES
    (1, NULL, 1, 'Нет дефектов');

INSERT INTO
    items (item_doc_id, item_id, item_state, item_defect)
VALUES
    (2, NULL, 0, 'Непропай');

INSERT INTO
    items (item_doc_id, item_id, item_state, item_defect)
VALUES
    (3, NULL, 1, 'Попкорн');

PROMPT в таблицу jobs (работы)
INSERT INTO
    jobs (
        job_id,
        job_perf,
        job_equip,
        job_type,
        job_item_id
    )
VALUES
    (
        NULL,
        10,
        'Станок для засвета фоторезиста',
        'Нанесение рисунка',
        1
    );

INSERT INTO
    jobs (
        job_id,
        job_perf,
        job_equip,
        job_type,
        job_item_id
    )
VALUES
    (NULL, 2, 'Печь', 'Пайка', 1);

PROMPT в таблицу components (компоненты)
INSERT INTO
    components (comp_job_id, comp_id, comp_value, comp_type)
VALUES
    (1, NULL, '10 кОм 1 Вт', 'Резистор');

INSERT INTO
    components (comp_job_id, comp_id, comp_value, comp_type)
VALUES
    (1, NULL, '10 мкФ 25 В', 'Конденсатор');

INSERT INTO
    components (comp_job_id, comp_id, comp_value, comp_type)
VALUES
    (1, NULL, 'ИУ4...ПП', 'Плата печатная');

PROMPT в таблицу raws (расходные материалы)
INSERT INTO
    raws (raw_job_id, raw_id, raw_name, raw_num)
VALUES
    (1, NULL, 'Припой ПОС-61', 1);

INSERT INTO
    raws (raw_job_id, raw_id, raw_name, raw_num)
VALUES
    (1, NULL, 'Флюс', 1);

PROMPT в таблицу users (пользователи)
INSERT INTO
    users (
        user_job_id,
        user_id,
        user_surname,
        user_post,
        user_thirdname,
        user_ph,
        user_name
    )
VALUES
    (
        1,
        NULL,
        'Иванов',
        'Инженер',
        'Иванович',
        '123-456',
        'Иван'
    );

INSERT INTO
    users (
        user_job_id,
        user_id,
        user_surname,
        user_post,
        user_thirdname,
        user_ph,
        user_name
    )
VALUES
    (
        2,
        NULL,
        'Петров',
        'Уставший работяга',
        'Петрович',
        '234-567',
        'Пётр'
    );

INSERT INTO
    users (
        user_job_id,
        user_id,
        user_surname,
        user_post,
        user_thirdname,
        user_ph,
        user_name
    )
VALUES
    (
        3,
        NULL,
        'Сидоров',
        'Пайщик',
        'Сидорович',
        '345-678',
        ''
    );

COMMIT;

SPOOL OFF;

exit
