CREATE TABLE IF NOT EXISTS codebook_for_categories (
  id         INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  category   VARCHAR(50)                    NOT NULL,
  created_at DATETIME DEFAULT now()         NOT NULL
);


INSERT INTO codebook_for_categories (category, created_at) VALUES ('Scripting languages', now());
INSERT INTO codebook_for_categories (category, created_at) VALUES ('Other languages', now());
INSERT INTO codebook_for_categories (category, created_at) VALUES ('Databases', now());
INSERT INTO codebook_for_categories (category, created_at) VALUES ('Personal skills', now());

CREATE TABLE IF NOT EXISTS codebook_for_skills (
  id                INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  skill             VARCHAR(50)                    NOT NULL,
  skill_category_id INT                            NOT NULL,
  created_at        DATETIME DEFAULT now()         NOT NULL,
  FOREIGN KEY (skill_category_id) REFERENCES codebook_for_categories (id)
);

INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('PHP', 1, now());
INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('JavaScript', 1, now());
INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('Ruby', 1, now());
INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('ASP', 1, now());
INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('Perl', 1, now());

INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('C', 2, now());
INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('C++', 2, now());
INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('Java', 2, now());
INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('Delphi', 2, now());

INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('MySQL', 3, now());
INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('MSSQL', 3, now());
INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('Oracle', 3, now());
INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('PostgreSQL', 3, now());


INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('Communication', 4, now());
INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('Leadership', 4, now());
INSERT INTO codebook_for_skills (skill, skill_category_id, created_at) VALUES ('Diligence', 4, now());

CREATE TABLE IF NOT EXISTS users (
  id                      INT PRIMARY KEY AUTO_INCREMENT     NOT NULL,
  first_name              VARCHAR(50)                        NOT NULL,
  last_name               VARCHAR(50)                        NOT NULL,
  street                  VARCHAR(255)                       NOT NULL,
  city                    VARCHAR(50)                        NOT NULL,
  zip                     VARCHAR(10)                        NOT NULL,
  state                   VARCHAR(20)                        NOT NULL,
  phone                   VARCHAR(15)                        NOT NULL,
  email                   VARCHAR(100)                       NOT NULL,
  skill_category_1        INT                                NOT NULL,
  skill_category_1_rating INT                                NOT NULL,
  skill_category_2        INT                                NOT NULL,
  skill_category_2_rating INT                                NOT NULL,
  skill_category_3        INT                                NOT NULL,
  skill_category_3_rating INT                                NOT NULL,
  skill_category_4        INT                                NOT NULL,
  skill_category_4_rating INT                                NOT NULL,
  created_at              DATETIME DEFAULT now()             NOT NULL,
  FOREIGN KEY (skill_category_1) REFERENCES codebook_for_skills (id),


  FOREIGN KEY (skill_category_2) REFERENCES codebook_for_skills (id),


  FOREIGN KEY (skill_category_3) REFERENCES codebook_for_skills (id),


  FOREIGN KEY (skill_category_4) REFERENCES codebook_for_skills (id)

);