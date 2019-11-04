-- TABLE INSERTIONS -- 

-- Here are a set of test values for all of the tables. Some of the id's for some-
-- of the tables will be out of query range on purpose to avoid conflict with intended project data.

-- Recipe --
INSERT INTO Recipe(recipe_id, recipe_name, recipe_likes, readyInMinutes, recipe_image, recipe_instructions)
VALUES
	(999999, 'Turkey Meatloaf', 200, 15, 'test.jpg', 'Cook it right!'),
	(999998, 'Avocado Toast', 4234, 20, 'test.jpg', 'Cook it right!'),
	(999997, 'Wheatgrass Cleanse', 2345, 30, 'test.jpg', 'Cook it right!'),
	(999996, 'Spaghetti & Meatballs', 44, 60, 'test.jpg', 'Cook it right!'),
	(999995, 'Pad Thai', 239, 120, 'test.jpg', 'Cook it right!');

-- User --
INSERT INTO User(user_id, username, password)
VALUES 
	(999, 'John Lu', 'password'),
    (998, 'Mayah Vandertuig', 'password'),
    (997, 'Will Kolada', 'password'),
    (996, 'Hayden Lewis', 'password'),
    (995, 'Parker Johnson', 'password');
    
-- Comment --
INSERT INTO Comment(comment_id, recipe_id, user_id, comment, comment_likes, timestamp)
VALUES
	(99999999, 999999, 999, 'Yummy!', 345, '1970-01-01 00:20:01'),
    (99999998, 999998, 998, 'Delicious!', 12, '1987-03-01 00:30:01'),
    (99999997, 999997, 997, 'Tasty!', 67, '1990-01-09 00:45:01'),
    (99999996, 999996, 996, 'Radical!', 5543, '1999-07-08 07:00:01'),
    (99999995, 999995, 995, 'Okay.', 4, '2000-11-01 10:00:01');
    
-- Ingredient --
INSERT INTO Ingredient(ingredient_id, ingredient_name)
VALUES
	(999999, 'test milk'),
	(999998, 'test eggs'),
    (999997, 'test chocolate milk'),
	(999996, 'test yogurt'),
    (999995, 'test iguanas');
    
    
-- Ingredient_Cache -- REFERENCES Ingredient, User
INSERT INTO Ingredient_Cache(ingredient_id, user_id)
VALUES
	(999999,999),
    (999998,998),
    (999997,997),
    (999996,996),
    (999995,995);
    
    
-- Recipe_Cache -- REFERENCES Recipe, User
INSERT INTO Recipe_Cache(recipe_id, user_id)
VALUES
	(999999,999),
    (999998,998),
    (999997,997),
    (999996,996),
    (999995,995);

-- Recipe_Ingredients -- REFERENCES Recipe, Ingredient
INSERT INTO Recipe_Ingredients(recipe_id, ingredient_id, ingredient_amt)
VALUES
	(999999,999999, '5'),
    (999998,999998, '2'),
    (999997,999997, '1'),
    (999996,999996, '0.5'),
    (999995,999995, '100');
    
    