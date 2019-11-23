-- TABLE CREATIONS --
-- You can't rewrite tables so you need to drop them again beforehand. 
-- CAUTION: RUNNING THIS FILE WILL ERASE ALL THE DATA FROM YOUR EXISTING TABLES IN THE PEAS DATABASE
-- Tables that contain primary keys that are referenced to by other tables have to be deleted after the referencee tables are deleted.
DROP TABLE IF EXISTS Recipe_Ingredients;
DROP TABLE IF EXISTS Recipe_Cache;
DROP TABLE IF EXISTS Ingredient_Cache;
DROP TABLE IF EXISTS Ingredient;
DROP TABLE IF EXISTS Likes;
DROP TABLE IF EXISTS Recipe;
DROP TABLE IF EXISTS User;

-- Recipe -- 
CREATE TABLE Recipe (
	recipe_id 			INT NOT NULL UNIQUE,
	recipe_name     	VARCHAR(50) NOT NULL,
	recipe_likes    	INT NOT NULL DEFAULT 0,
    readyInMinutes  	INT NOT NULL,
    recipe_serving		Int NOT NULL,
    recipe_image    	VARCHAR(100) NOT NULL,
    recipe_instructions LONGTEXT NOT NULL,
    recipe_vegan	    BOOLEAN,
    recipe_dairy        BOOLEAN,
	recipe_gluten       BOOLEAN,
    recipe_fodmap	    BOOLEAN,
	PRIMARY KEY     (recipe_id)
);

-- User --
CREATE TABLE User (
	user_id        	INT NOT NULL AUTO_INCREMENT,
	username       	VARCHAR(45) NOT NULL UNIQUE,
	password       	VARCHAR(45) NOT NULL,
    email		    VARCHAR(50) NOT NULL,
	PRIMARY KEY     (user_id)
);

-- Likes --
CREATE TABLE Likes (
	recipe_id		INT NOT NULL,
	user_id         INT NOT NULL,
    is_liked		BOOLEAN,
    PRIMARY KEY     (recipe_id, user_id),
    FOREIGN KEY		(recipe_id)      REFERENCES Recipe(recipe_id),
    FOREIGN KEY 	(user_id)		 REFERENCES User(user_id)
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
	user_id 	    INT NOT NULL,
	PRIMARY KEY	(ingredient_id, user_id),
	FOREIGN KEY	(ingredient_id) REFERENCES Ingredient(ingredient_id),
	FOREIGN KEY	(user_id)       REFERENCES User(user_id)
);

-- Recipe_Cache -- REFERENCES Recipe, User
CREATE TABLE Recipe_Cache (
	recipe_id   INT NOT NULL,
	user_id     INT NOT NULL,
	PRIMARY KEY (recipe_id, user_id),
	FOREIGN KEY (recipe_id) REFERENCES Recipe(recipe_id),
	FOREIGN KEY (user_id)   REFERENCES User(user_id)
);

-- Recipe_Ingredients -- REFERENCES Recipe, Ingredient
CREATE TABLE Recipe_Ingredients (
	recipe_id		INT NOT NULL,
	ingredient_id	INT NOT NULL,
	ingredient_amt  VARCHAR(50) NOT NULL,
    PRIMARY KEY 	(recipe_id, ingredient_id),
    FOREIGN KEY		(recipe_id)		REFERENCES Recipe(recipe_id),
    FOREIGN KEY 	(ingredient_id) REFERENCES Ingredient(ingredient_id)
);
