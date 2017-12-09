USE doingsdone;
CREATE TABLE users (
	id INT AUTO_INCREMENT PRIMARY KEY,
	email CHAR,
	name CHAR(32),
	password CHAR(16),
	reg_date DATE,
	contacts TEXT
);

CREATE TABLE projects (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name CHAR(16),
	user_id INT
);
CREATE TABLE tasks (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name CHAR,
	date_add DATE,
	date_end DATE,
	date_deadline DATE,
	user_id INT,
	project_id INT
);

CREATE UNIQUE INDEX email ON users (email);
CREATE UNIQUE INDEX name ON projects (name);
CREATE UNIQUE INDEX id ON tasks (id);
CREATE INDEX name ON tasks (name);
CREATE INDEX d_dead ON tasks (date_deadline);
CREATE INDEX d_end ON tasks (date_end);
CREATE INDEX user_id ON projects (user_id);
CREATE INDEX user_id ON tasks (user_id);
CREATE INDEX project_id ON tasks (project_id);