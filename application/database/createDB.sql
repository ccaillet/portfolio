-- Creation Script - SQLite3 

-- Table tasks    
CREATE TABLE tasks (
  id		   INTEGER PRIMARY KEY AUTOINCREMENT,
  name		   CHARACTER VARYING(80),
  description  CHARACTER VARYING(200),
  goal         CHARACTER VARYING(200),
  duration     CHARACTER VARYING(50),
  level        INTEGER,
  mandatory    BOOLEAN,
  onlyOnce     BOOLEAN
);

-- Table prerequistes
CREATE TABLE prerequistes (
  tasksId				INTEGER,
  prerequiredTaskId		INTEGER,
  CONSTRAINT PK_prerequistes PRIMARY KEY (tasksId, prerequiredTaskId)
  FOREIGN KEY (tasksId) REFERENCES tasks(id)
  FOREIGN KEY (prerequiredTaskId) REFERENCES tasks(id)
);

-- Table tasks 
CREATE TABLE domains (
	id	    INTEGER PRIMARY KEY AUTOINCREMENT,
	name	CHARACTER VARYING(50)
);

-- Table pratices
CREATE TABLE practices (
	taskId	    INTEGER,
	domainId	INTEGER,
	CONSTRAINT PK_practices PRIMARY KEY(taskId,domainId)
	CONSTRAINT FK_tasks_taskId FOREIGN KEY (taskId) REFERENCES tasks(id)
    CONSTRAINT FK_domains_domainsId FOREIGN KEY (domainId) REFERENCES domains(id)
);
-- Table materials
CREATE TABLE materials (
	id	    INTEGER PRIMARY KEY AUTOINCREMENT,
	name	CHARACTER VARYING(100)
);

-- Table needs
CREATE TABLE needs (
  taskId				INTEGER,
  materialId    		INTEGER,
  CONSTRAINT PK_needs PRIMARY KEY (taskId, materialId)
  CONSTRAINT FK_tasks_taskId FOREIGN KEY (taskId) REFERENCES tasks(id)
  CONSTRAINT FK_materials_materialId FOREIGN KEY (materialId) REFERENCES materials(id)
);

-- Table ressources
CREATE TABLE ressources (
  id		   INTEGER PRIMARY KEY AUTOINCREMENT,
  taskId	   INTEGER,
  uri		   CHARACTER VARYING(255),
  description  CHARACTER VARYING(200),
  onlyForTeachers BOOLEAN,
  CONSTRAINT FK_tasks_taskId FOREIGN KEY (taskId) REFERENCES tasks(id)
);

-- Table modules
CREATE TABLE modules (
	id	    INTEGER PRIMARY KEY AUTOINCREMENT,
	ictCode	CHARACTER VARYING(10),
	title	CHARACTER VARYING(50)
);

-- Table needs
CREATE TABLE trains (
  taskId				INTEGER,
  moduleId    		INTEGER,
  CONSTRAINT PK_needs PRIMARY KEY (taskId, moduleId)
  CONSTRAINT FK_tasks_taskId FOREIGN KEY (taskId) REFERENCES tasks(id)
  CONSTRAINT FK_modules_moduleId FOREIGN KEY (moduleId) REFERENCES modules(id)
);