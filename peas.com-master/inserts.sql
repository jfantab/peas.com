-- TABLE INSERTIONS -- 

-- Here are a set of test values for all of the tables. Some of the id's for some-
-- of the tables will be out of query range on purpose to avoid conflict with intended project data.

-- Recipe --
INSERT INTO Recipe(recipe_id, recipe_name, recipe_likes)
VALUES
	(000001, 'Turkey Meatloaf', 200),
	(000002, 'Avocado Toast', 4234),
	(000003, 'Wheatgrass Cleanse', 2345),
	(000004, 'Spaghetti & Meatballs', 44),
	(000005, 'Pad Thai', 239);

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
	(00000000, 000001, 999, 'Yummy!', 345, '1970-01-01 00:20:01'),
    (00000001, 000002, 998, 'Delicious!', 12, '1987-03-01 00:30:01'),
    (00000002, 000003, 997, 'Tasty!', 67, '1990-01-09 00:45:01'),
    (00000003, 000004, 996, 'Radical!', 5543, '1999-07-08 07:00:01'),
    (00000004, 000005, 995, 'Okay.', 4, '2000-11-01 10:00:01');
    
-- Ingredient --
INSERT INTO Ingredient(ingredient_id, ingredient_name)
VALUES
	(999999, 'test_milk'),
	(999998, 'eggs'),
    (999997, 'chocolate milk'),
	(999996, 'yogurt'),
    (999995, 'iguanas');
    
    
-- Ingredient_Cache --
INSERT INTO Ingredient_Cache(ingredient_id, user_id)
VALUES
	(999999,999),
    (999998,998),
    (999997,997),
    (999996,996),
    (999995,995);