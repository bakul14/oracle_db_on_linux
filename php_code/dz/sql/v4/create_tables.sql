DROP TABLE comp CASCADE CONSTRAINTS;
DROP TABLE device CASCADE CONSTRAINTS;
DROP TABLE job CASCADE CONSTRAINTS;
DROP TABLE technology CASCADE CONSTRAINTS;
DROP TABLE users CASCADE CONSTRAINTS;

CREATE TABLE comp (
  comp_id        number(10) GENERATED AS IDENTITY, 
  comp_name      varchar2(255), 
  comp_value     varchar2(255), 
  comp_device_id number(10) NOT NULL, 
  PRIMARY KEY (comp_id));
CREATE TABLE device (
  device_id   number(10) GENERATED AS IDENTITY, 
  device_name varchar2(255), 
  PRIMARY KEY (device_id));
CREATE TABLE job (
  job_id      number(10) GENERATED AS IDENTITY, 
  job_us_id   number(10) NOT NULL, 
  job_comp_id number(10) NOT NULL, 
  job_tech_id number(10) NOT NULL, 
  job_name    varchar2(255), 
  PRIMARY KEY (job_id));
CREATE TABLE technology (
  tp_id        number(10) GENERATED AS IDENTITY, 
  tp_device_id number(10) NOT NULL, 
  tp_name      varchar2(255), 
  PRIMARY KEY (tp_id));
CREATE TABLE users (
  us_id         number(10) GENERATED AS IDENTITY CHECK(us_id), 
  us_firstname  varchar2(255), 
  us_secondname varchar2(255), 
  us_thirdname  varchar2(255), 
  us_post       varchar2(255), 
  us_role       varchar2(255), 
  us_login      varchar2(255), 
  us_pass       varchar2(255), 
  PRIMARY KEY (us_id));
ALTER TABLE technology ADD CONSTRAINT FKtechnology374904 FOREIGN KEY (tp_device_id) REFERENCES device (device_id);
ALTER TABLE comp ADD CONSTRAINT FKcomp227789 FOREIGN KEY (comp_device_id) REFERENCES device (device_id);
ALTER TABLE job ADD CONSTRAINT FKjob30989 FOREIGN KEY (job_comp_id) REFERENCES comp (comp_id);
ALTER TABLE job ADD CONSTRAINT FKjob421852 FOREIGN KEY (job_us_id) REFERENCES users (us_id);
ALTER TABLE job ADD CONSTRAINT FKjob618286 FOREIGN KEY (job_tech_id) REFERENCES technology (tp_id);

exit
