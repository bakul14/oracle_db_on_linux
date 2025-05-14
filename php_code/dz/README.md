Для входа в SQLPlus:
```bash
sqlplus sys/root as sysdba
```

Один раз при запуске АСУ:
```bash
sqlplus sys/root as sysdba @/dz/sql/create_shema.sql
sqlplus MISHA/MISHA @/dz/sql/create_all.sql
```