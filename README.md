###How to...###
- Import structure first and then data : ![setup](figures/howtosetup.PNG)




###Change Logs###
**15 Septermber 2016**
1. Make creator constrain in the project table. Now each project will have a one-to-many relationships with users.
2. Delete the entrepreur role
3. Populate User table with test cases. 
4. Add Create Project button in the index.php
5. Clean up the DB connection related codes.
6. Retrieve Category Information when Create projects. 

**12 September 2016**  
1. Populate 'category' table
2. Modify 'category' _ id to tinyint(4)
3. Drop 'project_stage' table 
4. Drop 'project' project_status column 
5. Populate the status table;
6. Modify 'user' table to differentiate user from entrepreneur, and make it type tinyint(4)
7. Populate 'user' table
8. Separate structure and data 
