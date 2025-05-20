-- SELECT
SELECT comp_id, comp_name, comp_value, comp_device_id 
  FROM comp;
SELECT device_id, device_name 
  FROM device;
SELECT job_id, job_us_id, job_comp_id, job_tech_id, job_name 
  FROM job;
SELECT tp_id, tp_device_id, tp_name 
  FROM technology;
SELECT us_id, us_firstname, us_secondname, us_thirdname, us_post, us_role, us_login, us_pass 
  FROM users;

-- INSERT
INSERT INTO comp
  (comp_id, 
  comp_name, 
  comp_value, 
  comp_device_id) 
VALUES 
  (?, 
  ?, 
  ?, 
  ?);
INSERT INTO device
  (device_id, 
  device_name) 
VALUES 
  (?, 
  ?);
INSERT INTO job
  (job_id, 
  job_us_id, 
  job_comp_id, 
  job_tech_id, 
  job_name) 
VALUES 
  (?, 
  ?, 
  ?, 
  ?, 
  ?);
INSERT INTO technology
  (tp_id, 
  tp_device_id, 
  tp_name) 
VALUES 
  (?, 
  ?, 
  ?);
INSERT INTO users
  (us_id, 
  us_firstname, 
  us_secondname, 
  us_thirdname, 
  us_post, 
  us_role, 
  us_login, 
  us_pass) 
VALUES 
  (?, 
  ?, 
  ?, 
  ?, 
  ?, 
  ?, 
  ?, 
  ?);

-- UPDATE
UPDATE comp SET 
  comp_name = ?, 
  comp_value = ?, 
  comp_device_id = ? 
WHERE
  comp_id = ?;
UPDATE device SET 
  device_name = ? 
WHERE
  device_id = ?;
UPDATE job SET 
  job_us_id = ?, 
  job_comp_id = ?, 
  job_tech_id = ?, 
  job_name = ? 
WHERE
  job_id = ?;
UPDATE technology SET 
  tp_device_id = ?, 
  tp_name = ? 
WHERE
  tp_id = ?;
UPDATE users SET 
  us_firstname = ?, 
  us_secondname = ?, 
  us_thirdname = ?, 
  us_post = ?, 
  us_role = ?, 
  us_login = ?, 
  us_pass = ? 
WHERE
  us_id = ?;

-- DELETE
DELETE FROM comp 
  WHERE comp_id = ?;
DELETE FROM device 
  WHERE device_id = ?;
DELETE FROM job 
  WHERE job_id = ?;
DELETE FROM technology 
  WHERE tp_id = ?;
DELETE FROM users 
  WHERE us_id = ?;
