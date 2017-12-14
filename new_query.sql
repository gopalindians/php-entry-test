/* Table to store skills categories*/
CREATE TABLE IF NOT EXISTS codebook_for_categories (
  id         INT PRIMARY KEY AUTO_INCREMENT              NOT NULL,
  category   VARCHAR(50)                                 NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP         NOT NULL
);


INSERT INTO codebook_for_categories (category, created_at) VALUES ('Scripting languages', CURRENT_TIMESTAMP);
INSERT INTO codebook_for_categories (category, created_at) VALUES ('Other languages', CURRENT_TIMESTAMP);
INSERT INTO codebook_for_categories (category, created_at) VALUES ('Databases', CURRENT_TIMESTAMP);
INSERT INTO codebook_for_categories (category, created_at) VALUES ('Personal skills', CURRENT_TIMESTAMP);


/* Table to store skills*/
CREATE TABLE IF NOT EXISTS codebook_for_skills (
  id                INT PRIMARY KEY AUTO_INCREMENT              NOT NULL,
  skill             VARCHAR(50)                                 NOT NULL,
  skill_category_id INT                                         NOT NULL,
  created_at        TIMESTAMP DEFAULT CURRENT_TIMESTAMP         NOT NULL,
  FOREIGN KEY (skill_category_id) REFERENCES codebook_for_categories (id)
);

INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('PHP', 1, CURRENT_TIMESTAMP);
INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('JavaScript', 1, CURRENT_TIMESTAMP);
INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('Ruby', 1, CURRENT_TIMESTAMP);
INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('ASP', 1, CURRENT_TIMESTAMP);
INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('Perl', 1, CURRENT_TIMESTAMP);

INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('C', 2, CURRENT_TIMESTAMP);
INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('C++', 2, CURRENT_TIMESTAMP);
INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('Java', 2, CURRENT_TIMESTAMP);
INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('Delphi', 2, CURRENT_TIMESTAMP);

INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('MySQL', 3, CURRENT_TIMESTAMP);
INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('MSSQL', 3, CURRENT_TIMESTAMP);
INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('Oracle', 3, CURRENT_TIMESTAMP);
INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('PostgreSQL', 3, CURRENT_TIMESTAMP);


INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('Communication', 4, CURRENT_TIMESTAMP);
INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('Leadership', 4, CURRENT_TIMESTAMP);
INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('Diligence', 4, CURRENT_TIMESTAMP);


/* Table to store users*/
CREATE TABLE IF NOT EXISTS users (
  id         INT PRIMARY KEY AUTO_INCREMENT                  NOT NULL,
  first_name VARCHAR(50)                                     NOT NULL,
  last_name  VARCHAR(50)                                     NOT NULL,
  street     VARCHAR(255)                                    NOT NULL,
  city       VARCHAR(50)                                     NOT NULL,
  zip        VARCHAR(10)                                     NOT NULL,
  state      VARCHAR(20)                                     NOT NULL,
  phone      VARCHAR(15)                                     NOT NULL,
  email      VARCHAR(100)                                    NOT NULL,

  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP             NOT NULL
);


/* Table to store skills categories*/
CREATE TABLE IF NOT EXISTS skill_categories (
  id            INT PRIMARY KEY AUTO_INCREMENT              NOT NULL,
  sc_name       VARCHAR(50)                                 NOT NULL,
  user_id       INT                                         NOT NULL,
  sc_evaluation INT                                         NOT NULL,
  created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP         NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users (id)

);

/* Table to store skills*/
CREATE TABLE IF NOT EXISTS skills (
  id                INT PRIMARY KEY AUTO_INCREMENT              NOT NULL,
  skill_name        VARCHAR(50)                                 NOT NULL,
  skill_rating      INT                                         NOT NULL,
  skill_category_id INT                                         NOT NULL,
  user_id           INT                                         NOT NULL,
  created_at        TIMESTAMP DEFAULT CURRENT_TIMESTAMP         NOT NULL,
  FOREIGN KEY (skill_category_id) REFERENCES skill_categories (id),
  FOREIGN KEY (user_id) REFERENCES users (id)
);