SPOOL asutp_start.log

PROMPT Скрипт заполнения таблиц АСУ ТП изготовления радиопередатчика тестовыми данными
PROMPT Автор: Бакулевский М.В.

INSERT INTO
    users (
        user_job_id,
        user_id,
        user_firstname,
        user_secondname,
        user_thirdname,
        user_post,
        user_login,
        user_password
    )
VALUES
    (
        1,
        NULL,
        'Михаил',
        'Бакулевский',
        'Владиславович',
        'Инженер',
        'admin',
        'admin'
    );

COMMIT;

SPOOL OFF;
