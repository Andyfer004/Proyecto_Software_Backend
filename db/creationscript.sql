USE laravel;
CREATE TABLE priorities (
	id INT NOT NULL AUTO_INCREMENT,
	namepriority VARCHAR(50) DEFAULT NULL,
	created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);

CREATE TABLE profiles (
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(200) NOT NULL,
	image VARCHAR(100) NOT NULL,
	created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);

CREATE TABLE status (
	id INT NOT NULL AUTO_INCREMENT,
	statusname VARCHAR(50) NOT NULL,
	created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);

CREATE TABLE users (
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(200) NOT NULL,
	lastname VARCHAR(200) NOT NULL,
	email VARCHAR(100) NOT NULL,
	password VARCHAR(500) NOT NULL,
	phone VARCHAR(20) NOT NULL,
	tokenaccessfg VARCHAR(300) DEFAULT NULL,
	iduserfg VARCHAR(100) DEFAULT NULL,
	created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);

CREATE TABLE events (
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(100) NOT NULL,
	link VARCHAR(500) DEFAULT NULL,
	dateevent DATE DEFAULT NULL,
	isrepetitive TINYINT NOT NULL,
	dayweek INT DEFAULT NULL,
	hourstart TIME NOT NULL,
	hourfinish TIME NOT NULL,
	userid INT DEFAULT NULL,
	created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);

CREATE TABLE notes (
	id INT NOT NULL AUTO_INCREMENT,
	note TEXT NOT NULL,
	image VARCHAR(100) NOT NULL,
	profileid INT NOT NULL,
	created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);

CREATE TABLE profiles_has_user (
	id INT NOT NULL AUTO_INCREMENT,
	userid INT NOT NULL,
	profileid INT NOT NULL,
	created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);

CREATE TABLE progress_has_user (
	id INT NOT NULL AUTO_INCREMENT,
	progress DECIMAL(10, 2) NOT NULL,
	week INT NOT NULL,
	userid INT NOT NULL,
	created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);

CREATE TABLE reminders (
	id INT NOT NULL AUTO_INCREMENT,
	description TEXT NOT NULL,
	alarm TINYINT NOT NULL,
	datereminder DATE DEFAULT NULL,
	hourreminder TIME DEFAULT NULL,
	profileid INT NOT NULL,
	created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);

CREATE TABLE tasks (
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(500) NOT NULL,
	description TEXT NOT NULL,
	priorityid INT DEFAULT NULL,
	duedate DATE DEFAULT NULL,
	timeestimatehours DECIMAL(10, 2) DEFAULT NULL,
	profileid INT NOT NULL,
	statusid INT DEFAULT NULL,
	created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);

CREATE TABLE assignment_task (
	id INT NOT NULL AUTO_INCREMENT,
	userid INT NOT NULL,
	taskid INT NOT NULL,
	created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);

CREATE TABLE subtasks (
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(500) NOT NULL,
	description TEXT NOT NULL,
	priorityid INT DEFAULT NULL,
	duedate DATE DEFAULT NULL,
	timeestimatehours DECIMAL(10, 2) DEFAULT NULL,
	taskid INT DEFAULT NULL,
	statusid INT DEFAULT NULL,
	created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);

CREATE TABLE assignment_subtask (
	id INT NOT NULL AUTO_INCREMENT,
	userid INT NOT NULL,
	subtaskid INT NOT NULL,
	created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);

-- Añadiendo las constraints de clave foránea al final

ALTER TABLE events ADD CONSTRAINT fk_events_users FOREIGN KEY (userid) REFERENCES users(id);
ALTER TABLE notes ADD CONSTRAINT fk_notes_profiles FOREIGN KEY (profileid) REFERENCES profiles(id);
ALTER TABLE profiles_has_user ADD CONSTRAINT fk_profiles_has_user_profiles FOREIGN KEY (profileid) REFERENCES profiles(id);
ALTER TABLE profiles_has_user ADD CONSTRAINT fk_profiles_has_user_users FOREIGN KEY (userid) REFERENCES users(id);
ALTER TABLE progress_has_user ADD CONSTRAINT fk_progress_has_user_users FOREIGN KEY (userid) REFERENCES users(id);
ALTER TABLE reminders ADD CONSTRAINT fk_reminders_profiles FOREIGN KEY (profileid) REFERENCES profiles(id);
ALTER TABLE tasks ADD CONSTRAINT fk_tasks_profiles FOREIGN KEY (profileid) REFERENCES profiles(id);
ALTER TABLE tasks ADD CONSTRAINT fk_tasks_status FOREIGN KEY (statusid) REFERENCES status(id);
ALTER TABLE assignment_task ADD CONSTRAINT fk_assignment_task_tasks FOREIGN KEY (taskid) REFERENCES tasks(id);
ALTER TABLE assignment_task ADD CONSTRAINT fk_assignment_task_users FOREIGN KEY (userid) REFERENCES users(id);
ALTER TABLE subtasks ADD CONSTRAINT fk_subtasks_priorities FOREIGN KEY (priorityid) REFERENCES priorities(id);
ALTER TABLE subtasks ADD CONSTRAINT fk_subtasks_status FOREIGN KEY (statusid) REFERENCES status(id);
ALTER TABLE subtasks ADD CONSTRAINT fk_subtasks_tasks FOREIGN KEY (taskid) REFERENCES tasks(id);
ALTER TABLE assignment_subtask ADD CONSTRAINT fk_assignment_subtask_subtasks FOREIGN KEY (subtaskid) REFERENCES subtasks(id);
ALTER TABLE assignment_subtask ADD CONSTRAINT fk_assignment_subtask_users FOREIGN KEY (userid) REFERENCES users(id);




--updates
ALTER TABLE users
ADD COLUMN voided BOOLEAN DEFAULT 0;
