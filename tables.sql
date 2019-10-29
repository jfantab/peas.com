-- TABLE CREATIONS --

-- You can't rewrite tables so you need to drop them again beforehand. 
-- CAUTION: RUNNING THIS FILE WILL ERASE ALL THE DATA FROM YOUR EXISTING TABLES IN THE PEAS DATABASE
-- Tables that contain primary keys that are referenced to by other tables have to be deleted after the referencee tables are deleted.
DROP TABLE IF EXISTS Ingredient_Cache;
DROP TABLE IF EXISTS Ingredient;
DROP TABLE IF EXISTS Comment;
DROP TABLE IF EXISTS Recipe;
DROP TABLE IF EXISTS User;

-- Recipe -- 
-- the only reason recipe is in here is so that we can track recipe likes. recipe_id and recipe_name will only ever be inserted on request- 
CREATE TABLE Recipe (
	recipe_id 		INT NOT NULL PRIMARY KEY,
	recipe_name     VARCHAR(50) NOT NULL,
	recipe_likes    INT NOT NULL DEFAULT 0
);

-- User --
CREATE TABLE User (
	user_id        	INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username       	VARCHAR(45) NOT NULL UNIQUE,
	password       	VARCHAR(45) NOT NULL
);

-- Comment -- REFERENCES Recipe, User
CREATE TABLE Comment (
	comment_id      INT NOT NULL  AUTO_INCREMENT,
	recipe_id       INT NOT NULL,
	user_id         INT NOT NULL,
	comment	        VARCHAR(100) NOT NULL,
	comment_likes   INT NOT NULL DEFAULT 0,
	timestamp       TIMESTAMP NOT NULL,
	PRIMARY KEY     (comment_id, recipe_id, user_id),
	FOREIGN KEY     (recipe_id) 	 REFERENCES Recipe(recipe_id),
	FOREIGN KEY     (user_id)   	 REFERENCES User(user_id)
);

-- Ingredient --
CREATE TABLE Ingredient (
	ingredient_id   INT NOT NULL  AUTO_INCREMENT, 
	ingredient_name VARCHAR(50) NOT NULL,
	PRIMARY KEY     (ingredient_id)
);

-- Ingredient_Cache -- REFERENCES Ingredient, User
CREATE TABLE Ingredient_Cache (
	ingredient_id   INT NOT NULL,
	user_id 	INT NOT NULL,
	PRIMARY KEY	(ingredient_id, user_id),
	FOREIGN KEY	(ingredient_id) REFERENCES Ingredient(ingredient_id),
	FOREIGN KEY	(user_id)   REFERENCES User(user_id)
);